@extends('layouts.main_app')

@section('title')
    <title>Scan | PT. PAPASARI</title>
@endsection

@section('css')
<style>
    .camera-container {
        width: 100%;
        max-width: 600px;
        aspect-ratio: 1.586 / 1;
        overflow: hidden;
        border-radius: 12px;
        background: #000;
    }

    .camera-container video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .preview-canvas {
        width: 100%;
        max-width: 600px;
        border-radius: 12px;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="px-4 py-3 px-md-5">
    <div class="d-grid gap-4">
        <div class="header d-grid gap-3">
            <div class="title text-center position-relative">
                <a href="{{ route('form_customer.menu') }}" class="text-decoration-none position-absolute start-0" style="top: 20px;">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h1 class="m-0">Scan Identitas</h1>
                <p class="mb-0 text-muted">Silahkan siapkan KTP</p>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center w-100">
            <div id="scanOptions" class="d-flex gap-2 flex-wrap justify-content-center">
                <button
                    type="button"
                    id="btnCamera"
                    class="btn btn-primary"
                >
                    <i class="fa-solid fa-camera me-2 text-white"></i>
                    Scan Kamera
                </button>
                <button
                    type="button"
                    id="btnUpload"
                    class="btn btn-outline-primary"
                >
                    <i class="fa-solid fa-image me-2 text-primary"></i>
                    Upload Foto
                </button>
            </div>

            <div class="mt-3" id="uploadContainer" style="display: none;">
                <input
                    type="file"
                    id="ktpFile"
                    accept="image/jpeg,image/png,image/jpg"
                    class="form-control"
                >
            </div>

            <div id="cameraContainer" class="camera-container mt-2" style="display: none;">
                <video
                    id="camera"
                    autoplay
                    playsinline
                ></video>
            </div>

            <canvas
                id="canvas"
                class="d-none preview-canvas mt-2"
            ></canvas>

            <div id="captureActions" class="mt-3" style="display: none;">
                <button
                    type="button"
                    id="btnCapture"
                    class="btn btn-primary mt-3"
                >
                    <i class="fa-solid fa-camera me-2 text-white"></i>
                    Ambil foto
                </button>
            </div>

            <div
                id="previewActions"
                class="mt-3 d-flex gap-2"
                style="display: none !important;"
            >
                <button
                    type="button"
                    id="btnRetake"
                    class="btn btn-outline-secondary"
                >
                    <i class="fa-solid fa-rotate-left me-2 text-secondary"></i>
                    Foto Ulang
                </button>

                <button
                    type="button"
                    id="btnUsePhoto"
                    class="btn btn-primary"
                >
                    <i class="fa-solid fa-check me-2 text-white"></i>
                    Scan Foto
                </button>
            </div>
        </div>
        <div id="loadingOCR" class="text-center mt-4" style="display:none;">
            <div class="spinner-border text-primary" role="status"></div>

            <p class="mt-3 mb-0">
                Sedang memproses identitas...
            </p>

            <small class="text-muted">
                Mohon jangan menutup halaman ini.
            </small>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const video = document.getElementById('camera');
    const canvas = document.getElementById('canvas');

    const btnCamera = document.getElementById('btnCamera');
    const btnUpload = document.getElementById('btnUpload');
    const btnCapture = document.getElementById('btnCapture');
    const btnRetake = document.getElementById('btnRetake');
    const btnUsePhoto = document.getElementById('btnUsePhoto');

    const ktpFile = document.getElementById('ktpFile');

    const scanOptions = document.getElementById('scanOptions');
    const cameraContainer = document.getElementById('cameraContainer');
    const captureActions = document.getElementById('captureActions');
    const previewActions = document.getElementById('previewActions');
    const loadingOCR = document.getElementById('loadingOCR');

    let cameraStream = null;
    let capturedFile = null;
    let captureSource = null;

    async function startCamera() {
        try {
            stopCamera();

            cameraStream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: {
                        ideal: 'environment'
                    },
                    width: {
                        ideal: 1920
                    },
                    height: {
                        ideal: 1080
                    }
                },
                audio: false
            });

            video.srcObject = cameraStream;

            await video.play();

            const track = cameraStream.getVideoTracks()[0];

            const capabilities =
                track.getCapabilities?.();

            if (
                capabilities?.focusMode &&
                capabilities.focusMode.includes('continuous')
            ) {
                try {
                    await track.applyConstraints({
                        advanced: [
                            {
                                focusMode: 'continuous'
                            }
                        ]
                    });
                } catch (error) {
                    console.warn(
                        'Continuous focus tidak didukung:',
                        error
                    );
                }
            }

        } catch (error) {
            console.error(error);

            alert(
                'Tidak dapat mengakses kamera.'
            );

            resetToOptions();
        }
    }

    function stopCamera() {
        if (!cameraStream) {
            return;
        }

        cameraStream
            .getTracks()
            .forEach(track => {
                track.stop();
            });

        cameraStream = null;
        video.srcObject = null;
    }

    function captureCameraToCanvas() {
        const videoWidth = video.videoWidth;
        const videoHeight = video.videoHeight;

        const containerWidth =
            cameraContainer.clientWidth;

        const containerHeight =
            cameraContainer.clientHeight;

        const videoRatio =
            videoWidth / videoHeight;

        const containerRatio =
            containerWidth / containerHeight;

        let sx = 0;
        let sy = 0;
        let sw = videoWidth;
        let sh = videoHeight;

        /*
         * Karena preview memakai object-fit: cover,
         * canvas dibuat sesuai area yang terlihat user.
         */
        if (videoRatio > containerRatio) {

            sw =
                videoHeight *
                containerRatio;

            sx =
                (videoWidth - sw) / 2;

        } else {

            sh =
                videoWidth /
                containerRatio;

            sy =
                (videoHeight - sh) / 2;
        }

        canvas.width =
            Math.round(sw);

        canvas.height =
            Math.round(sh);

        const ctx =
            canvas.getContext('2d');

        ctx.clearRect(
            0,
            0,
            canvas.width,
            canvas.height
        );

        ctx.drawImage(
            video,

            sx,
            sy,
            sw,
            sh,

            0,
            0,
            canvas.width,
            canvas.height
        );
    }

    function loadUploadToCanvas(file) {
        return new Promise(
            (resolve, reject) => {

                const image = new Image();

                const objectUrl =
                    URL.createObjectURL(file);

                image.onload = () => {
                    try {
                        const originalWidth =
                            image.naturalWidth;

                        const originalHeight =
                            image.naturalHeight;

                        /*
                         * Batasi gambar terlalu besar.
                         *
                         * 2500 px sudah sangat cukup
                         * untuk OCR KTP dan mengurangi
                         * payload ke API.
                         */

                        const maxDimension = 2500;

                        let targetWidth =
                            originalWidth;

                        let targetHeight =
                            originalHeight;

                        if (
                            originalWidth >
                            maxDimension ||
                            originalHeight >
                            maxDimension
                        ) {
                            const scale =
                                Math.min(
                                    maxDimension /
                                        originalWidth,

                                    maxDimension /
                                        originalHeight
                                );

                            targetWidth =
                                Math.round(
                                    originalWidth *
                                    scale
                                );

                            targetHeight =
                                Math.round(
                                    originalHeight *
                                    scale
                                );
                        }

                        canvas.width =
                            targetWidth;

                        canvas.height =
                            targetHeight;

                        const ctx =
                            canvas.getContext('2d');

                        ctx.clearRect(
                            0,
                            0,
                            canvas.width,
                            canvas.height
                        );

                        ctx.drawImage(
                            image,
                            0,
                            0,
                            canvas.width,
                            canvas.height
                        );

                        URL.revokeObjectURL(
                            objectUrl
                        );

                        resolve();

                    } catch (error) {

                        URL.revokeObjectURL(
                            objectUrl
                        );

                        reject(error);
                    }
                };


                image.onerror = () => {

                    URL.revokeObjectURL(
                        objectUrl
                    );

                    reject(
                        new Error(
                            'Gambar tidak dapat dibaca.'
                        )
                    );
                };


                image.src = objectUrl;
            }
        );
    }

    function canvasToFile() {
        return new Promise(
            (resolve, reject) => {

                canvas.toBlob(
                    blob => {

                        if (!blob) {
                            reject(
                                new Error(
                                    'Gagal membuat file KTP.'
                                )
                            );

                            return;
                        }

                        const file =
                            new File(
                                [blob],
                                'ktp.jpg',
                                {
                                    type:
                                        'image/jpeg',

                                    lastModified:
                                        Date.now()
                                }
                            );

                        resolve(file);
                    },

                    'image/jpeg',

                    0.95
                );
            }
        );
    }

    function showPreview() {
        stopCamera();

        cameraContainer.style.display =
            'none';

        captureActions.style.display =
            'none';

        scanOptions.style.display =
            'none';

        canvas.classList.remove(
            'd-none'
        );

        previewActions.style.setProperty(
            'display',
            'flex',
            'important'
        );
    }


    function hidePreview() {
        canvas.classList.add(
            'd-none'
        );

        previewActions.style.setProperty(
            'display',
            'none',
            'important'
        );
    }

    function resetToOptions() {
        stopCamera();

        capturedFile = null;
        captureSource = null;

        hidePreview();

        cameraContainer.style.display =
            'none';

        captureActions.style.display =
            'none';

        scanOptions.style.display =
            'flex';
    }

    async function sendToOCR(file) {
        if (!file) {
            alert(
                'File KTP belum tersedia.'
            );

            return;
        }

        const formData =
            new FormData();

        formData.append(
            'photo',
            file,
            'ktp.jpg'
        );

        const menuValue =
            @json($menu);

        const statusValue =
            @json($status);

        const status2Value =
            @json($status2);

        const paramValue =
            @json($param);


        formData.append(
            'menu',
            menuValue
        );

        formData.append(
            'status',
            statusValue
        );


        if (status2Value) {
            formData.append(
                'status2',
                status2Value
            );
        }


        if (paramValue) {
            formData.append(
                'param',
                paramValue
            );
        }


        try {
            loadingOCR.style.display =
                'block';

            setButtonsDisabled(true);


            console.log(
                'Mengirim file OCR:',
                {
                    source:
                        captureSource,

                    name:
                        file.name,

                    type:
                        file.type,

                    size:
                        file.size,

                    width:
                        canvas.width,

                    height:
                        canvas.height
                }
            );


            const response =
                await fetch(
                    "{{ route('ocr.ktp') }}",
                    {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN':
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    .content,

                            'Accept':
                                'application/json'
                        },

                        body:
                            formData
                    }
                );


            const result =
                await response.json();


            if (
                !response.ok ||
                !result.success
            ) {
                throw new Error(
                    result.message ??
                    'OCR gagal.'
                );
            }


            window.location.href =
                result.redirect_url;


        } catch (error) {

            console.error(
                'OCR error:',
                error
            );

            alert(
                error.message
            );

        } finally {

            loadingOCR.style.display =
                'none';

            setButtonsDisabled(false);
        }
    }


    function setButtonsDisabled(disabled) {
        btnCamera.disabled =
            disabled;

        btnUpload.disabled =
            disabled;

        btnCapture.disabled =
            disabled;

        btnRetake.disabled =
            disabled;

        btnUsePhoto.disabled =
            disabled;
    }

    btnCapture.addEventListener(
        'click',
        async () => {

            if (
                !video.videoWidth ||
                !video.videoHeight
            ) {
                alert(
                    'Kamera belum siap. Tunggu sebentar.'
                );

                return;
            }


            try {
                /*
                 * Freeze frame kamera
                 * ke canvas.
                 */
                captureCameraToCanvas();


                /*
                 * Buat JPEG dari canvas.
                 */
                capturedFile =
                    await canvasToFile();


                console.log(
                    'Camera captured:',
                    {
                        width:
                            canvas.width,

                        height:
                            canvas.height,

                        size:
                            capturedFile.size
                    }
                );


                /*
                 * Sekarang baru camera
                 * dimatikan dan preview
                 * ditampilkan.
                 */
                showPreview();


            } catch (error) {

                console.error(error);

                alert(
                    'Gagal mengambil foto.'
                );
            }
        }
    );

    btnCamera.addEventListener(
        'click',
        async () => {

            capturedFile = null;

            captureSource =
                'camera';

            hidePreview();

            scanOptions.style.display =
                'none';

            cameraContainer.style.display =
                'block';

            captureActions.style.display =
                'block';

            await startCamera();
        }
    );

    btnUsePhoto.addEventListener(
        'click',
        async () => {

            if (!capturedFile) {
                alert(
                    'Belum ada foto yang tersedia.'
                );

                return;
            }


            /*
             * SELALU file JPEG hasil
             * canvas yang dikirim.
             *
             * Baik camera maupun upload.
             */
            await sendToOCR(
                capturedFile
            );
        }
    );

    btnUpload.addEventListener(
        'click',
        () => {

            stopCamera();

            capturedFile = null;

            captureSource =
                'upload';

            hidePreview();

            cameraContainer.style.display =
                'none';

            captureActions.style.display =
                'none';

            scanOptions.style.display =
                'none';

            ktpFile.value =
                '';

            ktpFile.click();
        }
    );


    ktpFile.addEventListener(
        'change',
        async () => {

            const file =
                ktpFile.files[0];

            if (!file) {
                resetToOptions();
                return;
            }


            try {

                console.log(
                    'Original upload:',
                    {
                        name:
                            file.name,

                        type:
                            file.type,

                        size:
                            file.size
                    }
                );


                /*
                 * File upload dibaca
                 * lalu digambar ulang
                 * ke canvas.
                 */
                await loadUploadToCanvas(
                    file
                );


                /*
                 * Canvas menjadi JPEG.
                 */
                capturedFile =
                    await canvasToFile();


                console.log(
                    'Normalized upload:',
                    {
                        width:
                            canvas.width,

                        height:
                            canvas.height,

                        size:
                            capturedFile.size,

                        type:
                            capturedFile.type
                    }
                );


                /*
                 * Jangan langsung OCR.
                 *
                 * Tampilkan preview dulu,
                 * sama seperti camera.
                 */
                showPreview();


            } catch (error) {

                console.error(error);

                alert(
                    error.message
                );

                resetToOptions();
            }
        }
    );

    btnRetake.addEventListener(
        'click',
        async () => {

            capturedFile =
                null;


            hidePreview();


            /*
             * Kalau asalnya kamera,
             * buka kamera lagi.
             */
            if (
                captureSource ===
                'camera'
            ) {
                cameraContainer.style.display =
                    'block';

                captureActions.style.display =
                    'block';

                await startCamera();

                return;
            }


            /*
             * Kalau asalnya upload,
             * buka file picker lagi.
             */
            if (
                captureSource ===
                'upload'
            ) {
                ktpFile.value =
                    '';

                ktpFile.click();

                return;
            }


            resetToOptions();
        }
    );
    
    window.addEventListener(
        'beforeunload',
        () => {
            stopCamera();
        }
    );

</script>
@endsection