import { createWorker } from "tesseract.js";

let worker = null;

async function getWorker(){
    if(worker){
        return worker;
    }

    worker=await createWorker("eng+ind");

    await worker.setParameters({
        tessedit_pageseg_mode: "4",
        preserve_interword_spaces: "1"
    });

    return worker;
}

export async function processOCR(canvas) {
    let src = cv.imread(canvas);

    let grayDetect = new cv.Mat();
    cv.cvtColor(src, grayDetect, cv.COLOR_RGBA2GRAY);

    let blurDetect = new cv.Mat();
    cv.GaussianBlur(grayDetect, blurDetect, new cv.Size(5,5), 0);

    let edge = new cv.Mat();
    cv.Canny(
        blurDetect,
        edge,
        75,
        200
    );

    let contours = new cv.MatVector();
    let hierarchy = new cv.Mat();

    let dilateKernel = cv.Mat.ones(
        3,
        3,
        cv.CV_8U
    );

    cv.dilate(
        edge,
        edge,
        dilateKernel
    );

    cv.findContours(
        edge,
        contours,
        hierarchy,
        cv.RETR_LIST,
        cv.CHAIN_APPROX_SIMPLE
    );

    let bestArea = 0;
    let cardContour = null;

    for (let i = 0; i < contours.size(); i++) {
        const cnt = contours.get(i);
        const area = cv.contourArea(cnt);

        if (area < 5000) continue;

        const peri = cv.arcLength(cnt, true);

        const approx = new cv.Mat();

        cv.approxPolyDP(
            cnt,
            approx,
            0.02 * peri,
            true
        );

        if (approx.rows === 4 && area > bestArea) {
            bestArea = area;
            cardContour = cnt;
        }

        approx.delete();
    }

    if (!cardContour) {
        throw new Error("KTP tidak ditemukan.");
    }

    let peri = cv.arcLength(cardContour, true);
    let approx = new cv.Mat();

    cv.approxPolyDP(
        cardContour,
        approx,
        0.02 * peri,
        true
    );

    if(approx.rows !== 4) {
        throw new Error("Object bukan kartu");
    }

    let corners = [];
    for(let i = 0; i < 4; i++) {
        corners.push({
            x: approx.intPtr(i, 0)[0],
            y: approx.intPtr(i, 0)[1]
        });
    }
    corners = orderPoints(corners);
    
    const cropped = warpCard(src, corners);

    let resized = new cv.Mat();

    cv.resize(
        cropped,
        resized,
        new cv.Size(cropped.cols * 2, cropped.rows * 2),
        0,
        0,
        cv.INTER_CUBIC
    );

    let gray = new cv.Mat();

    cv.cvtColor(
        resized,
        gray,
        cv.COLOR_RGBA2GRAY
    );

    let blur = new cv.Mat();

    cv.GaussianBlur(
        gray,
        blur,
        new cv.Size(5,5),
        0
    );

    const ratio = cropped.cols / cropped.rows;

    if(cropped.cols < 500 || cropped.rows < 300) {
        throw new Error("KTP terlalu kecil");
    }

    if(ratio < 1.3 || ratio > 1.9) {
        throw new Error("KTP tidak valid");
    }

    let thresh = new cv.Mat();

    cv.adaptiveThreshold(
        blur,
        thresh,
        255,
        cv.ADAPTIVE_THRESH_GAUSSIAN_C,
        cv.THRESH_BINARY,
        31,
        15
    );

    // Morphology
    let morphKernel = cv.Mat.ones(
        2,
        2,
        cv.CV_8U
    );

    cv.morphologyEx(
        thresh,
        thresh,
        cv.MORPH_CLOSE,
        morphKernel
    );

    cv.medianBlur(thresh, thresh, 3);

    if(cropped.rows > cropped.cols) {
        cv.rotate(
            thresh,
            thresh,
            cv.ROTATE_90_CLOCKWISE
        );
    }

    // Tampilkan hasil preprocessing
    const ocrCanvas = document.createElement("canvas");

    ocrCanvas.width = thresh.cols;
    ocrCanvas.height = thresh.rows;

    cv.imshow(ocrCanvas, thresh);

    const worker = await getWorker();

    const result = await worker.recognize(ocrCanvas);

    src.delete();
    resized.delete();
    gray.delete();
    blur.delete();
    thresh.delete();
    dilateKernel.delete();
    morphKernel.delete();
    edge.delete();
    hierarchy.delete();
    contours.delete();
    approx.delete();
    cropped.delete();
    grayDetect.delete();
    blurDetect.delete();


    return {
        text: result.data.text,
        data: parseKTP(result.data.text)
    };
}

function parseKTP(text){
    const lines = text
        .split("\n")
        .map(v => v.trim())
        .filter(Boolean);

    const data = {
        nik:"",
        nama:"",
        alamat:""
    };
    
    for(let i=0;i<lines.length;i++){
        
        const nik = lines[i].replace(/\D/g, "");
        if(nik.length >= 16 && !data.nik) {
            data.nik = nik.substring(0, 16);
        }
        
        const nama = lines[i].match(/Nama\s*:?\s*(.+)/i);
        if (nama) {
            data.nama = nama[1].trim();
        }
        
        const alamat = lines[i].match(/Alamat\s*:?\s*(.+)/i);
        if(alamat) {
            data.alamat = alamat[1].trim();
        }
    }

    return data;
}

function orderPoints(points) {
    let rect = new Array(4);
    const sum = points.map(p => p.x + p.y);
    const diff = points.map(p => p.x - p.y);
    rect[0] = points[sum.indexOf(Math.min(...sum))];
    rect[2] = points[sum.indexOf(Math.max(...sum))];
    rect[1] = points[diff.indexOf(Math.min(...diff))];
    rect[3] = points[diff.indexOf(Math.max(...diff))];

    return rect;
}

function warpCard(src,corners){

    const width=1000;
    const height=630;

    const srcTri=cv.matFromArray(
        4,
        1,
        cv.CV_32FC2,
        [

            corners[0].x,corners[0].y,

            corners[1].x,corners[1].y,

            corners[2].x,corners[2].y,

            corners[3].x,corners[3].y

        ]
    );

    const dstTri=cv.matFromArray(
        4,
        1,
        cv.CV_32FC2,
        [

            0,0,

            width,0,

            width,height,

            0,height

        ]
    );

    const M=cv.getPerspectiveTransform(
        srcTri,
        dstTri
    );

    let dst=new cv.Mat();

    cv.warpPerspective(
        src,
        dst,
        M,
        new cv.Size(width,height)
    );

    srcTri.delete();
    dstTri.delete();
    M.delete();

    return dst;

}

window.addEventListener(
    "beforeunload",
    async()=>{

        if(worker){

            await worker.terminate();

        }

    }
);