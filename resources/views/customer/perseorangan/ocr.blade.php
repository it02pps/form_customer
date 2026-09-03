@extends('layouts.main_app')

@section('title')
    <title>Scan | PT. PAPASARI</title>
@endsection

@section('css')
<style>
    .camera-container {
        width: 100%;
        max-width: 600px;
        aspect-ratio: 3 / 2;
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

    const npwpFile = document.getElementById('npwpFile');

    const scanOptions = document.getElementById('scanOptions');
    const cameraContainer = document.getElementById('cameraContainer');
    const uploadContainer = document.getElementById('uploadContainer');

    const captureActions = document.getElementById('captureActions');
    const previewActions = document.getElementById('previewActions');

    const loadingOCR = document.getElementById('loadingOCR');

    let cameraStream = null;
    let capturedFile = null;

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

            console.log("Camera settings : ", track.getSettings());

            const capabilities = track.getCapabilities?.();

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

            alert('Tidak dapat mengakses kamera.');

            cameraContainer.style.display = 'none';
            captureActions.style.display = 'none';
            scanOptions.style.display = 'flex';
        }
    }

    function stopCamera() {
        if(!cameraStream) {
            return;
        }

        cameraStream.getTracks().forEach(track => {
            track.stop();
        });

        cameraStream = null;
        video.srcObject = null;
    }

    function captureVisibleArea() {
        const videoWidth = video.videoWidth;
        const videoHeight = video.videoHeight;

        const containerWidth = cameraContainer.clientWidth;
        const containerHeight = cameraContainer.clientHeight;

        const videoRatio = videoWidth / videoHeight;
        const containerRatio =
            containerWidth / containerHeight;

        let sx = 0;
        let sy = 0;
        let sw = videoWidth;
        let sh = videoHeight;

        if (videoRatio > containerRatio) {
            // Video lebih lebar daripada container.
            // Crop sisi kiri dan kanan.
            sw = videoHeight * containerRatio;
            sx = (videoWidth - sw) / 2;
        } else {
            // Video lebih tinggi daripada container.
            // Crop bagian atas dan bawah.
            sh = videoWidth / containerRatio;
            sy = (videoHeight - sh) / 2;
        }

        canvas.width = Math.round(sw);
        canvas.height = Math.round(sh);

        const ctx = canvas.getContext('2d');

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

    function canvasToFile() {
        return new Promise((resolve, reject) => {
            canvas.toBlob(
                blob => {
                    if (!blob) {
                        reject(
                            new Error(
                                'Gagal membuat file hasil foto.'
                            )
                        );

                        return;
                    }

                    const file = new File(
                        [blob],
                        'ktp.jpg',
                        {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        }
                    );

                    resolve(file);
                },
                'image/jpeg',
                0.95
            );
        });
    }

    async function sendToOCR(file) {
        if(!file) {
            alert("File KTP belum dipilih.");
            return;
        }

        const formData = new FormData();

        formData.append(
            'photo',
            file,
            file.name ?? 'ktp.jpg'
        );

        const menuValue = @json($menu);
        const statusValue = @json($status);
        const status2Value = @json($status2);
        const paramValue = @json($param);

        formData.append("menu", menuValue);
        formData.append("status", statusValue);

        if(status2Value) {
            formData.append("status2", status2Value);
        }

        if(paramValue) {
            formData.append("param", paramValue);
        }

        try {
            loadingOCR.style.display = 'block';

            btnCapture.disabled = true;
            btnRetake.disabled = true;
            btnUsePhoto.disabled = true;
            btnUpload.disabled = true;

            const response = await fetch(
                "{{ route('ocr.ktp') }}",
                {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                        'Accept': 'application/json'
                    },
                    body: formData
                }
            );

            const result = await response.json();

            if (!response.ok || !result.success) {
                throw new Error(
                    result.message ?? 'OCR gagal.'
                );
            }

            window.location.href = result.redirect_url;
        } catch (error) {
            console.error('OCR error:', error);
            alert(error.message);
        } finally {
            loadingOCR.style.display = 'none';

            btnCapture.disabled = false;
            btnRetake.disabled = false;
            btnUsePhoto.disabled = false;
            btnUpload.disabled = false;
        }
    }

    btnCapture.addEventListener('click', async () => {
        if (!video.videoWidth || !video.videoHeight) {
            alert(
                'Kamera belum siap. Silakan tunggu sebentar.'
            );
            return;
        }

        captureVisibleArea();

        try {
            capturedFile =
                await canvasToFile();

            console.log({
                width: canvas.width,
                height: canvas.height,
                size: capturedFile.size
            });

            // Freeze hasil foto.
            stopCamera();

            // Hilangkan live camera.
            cameraContainer.style.display =
                'none';

            captureActions.style.display =
                'none';

            // Tampilkan canvas preview.
            canvas.classList.remove(
                'd-none'
            );

            // Tampilkan tombol Foto Ulang & Scan Foto.
            previewActions.style.setProperty(
                'display',
                'flex',
                'important'
            );

        } catch (error) {
            console.error(error);

            alert(
                'Gagal mengambil foto.'
            );
        }
    });

    btnRetake.addEventListener(
        'click',
        async () => {
            capturedFile = null;

            canvas.classList.add(
                'd-none'
            );

            previewActions.style.setProperty(
                'display',
                'none',
                'important'
            );

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
                    'Belum ada foto yang diambil.'
                );

                return;
            }

            // Yang dikirim ke OCR adalah
            // file hasil canvas preview,
            // bukan live camera.
            await sendToOCR(
                capturedFile
            );
        }
    );

    ktpFile.addEventListener('change', async () => {
        const file = ktpFile.files[0];

        if(!file) {
            return;
        }

        await sendToOCR(file);
    });

    btnUpload.addEventListener('click', async () => {
        stopCamera();

        capturedFile = null;

        canvas.classList.add(
            'd-none'
        );

        previewActions.style.setProperty(
            'display',
            'none',
            'important'
        );

        captureActions.style.display =
            'none';

        cameraContainer.style.display =
            'none';

        scanOptions.style.display =
            'none';

        uploadContainer.style.display =
            'block';

        ktpFile.value = '';

        ktpFile.click();
    });

    btnCamera.addEventListener('click', async () => {
        capturedFile = null;

        canvas.classList.add('d-none');

        previewActions.style.setProperty(
            'display',
            'none',
            'important'
        );

        scanOptions.style.display = 'none';
        uploadContainer.style.display = 'none';

        cameraContainer.style.display = 'block';
        captureActions.style.display = 'block';

        await startCamera();
    });
</script>
@endsection