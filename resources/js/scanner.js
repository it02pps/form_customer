import { processOCR } from "./ocr";

let stream = null;

const upload = document.getElementById("uploadImage");
const preview = document.getElementById("preview");
const canvas = document.getElementById("canvas");

upload.addEventListener("change", e => {
    const file = e.target.files[0];
    
    if(!file) return;

    const img = new Image();

    img.onload = async () => {

        preview.src = img.src;
        preview.style.display = "block";

        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;

        const ctx = canvas.getContext("2d");

        ctx.drawImage(
            img,
            0,
            0,
            canvas.width,
            canvas.height
        );

        const result = await processOCR(canvas);

        console.log(result.text);
        console.log(result.data);

    };

    img.src = URL.createObjectURL(file);
});