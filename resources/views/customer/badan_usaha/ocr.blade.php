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
                <p class="mb-0 text-muted">Silahkan siapkan NPWP</p>
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
                    id="npwpFile"
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
                class="d-none"
            ></canvas>

            <div>
                <button
                    type="button"
                    id="btnCapture"
                    class="btn btn-primary mt-3"
                    style="display: none;"
                >
                    <i class="fa-solid fa-camera me-2 text-white"></i>
                    Ambil foto
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

    const npwpFile = document.getElementById('npwpFile');

    const scanOptions = document.getElementById('scanOptions');
    const cameraContainer = document.getElementById('cameraContainer');
    const uploadContainer = document.getElementById('uploadContainer');

    const loadingOCR = document.getElementById('loadingOCR');

    let cameraStream = null;

    async function startCamera() {
        try {
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
        } catch (error) {
            alert("Tidak dapat mengakses kamera.");

            cameraContainer.style.display = 'none';
            btnCapture.style.display = 'none';
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

    async function sendToOCR(file) {
        if(!file) {
            alert("File NPWP belum dipilih.");
            return;
        }

        const formData = new FormData();

        formData.append(
            'photo',
            file,
            file.name ?? 'npwp.jpg'
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
            btnUpload.disabled = true;

            const response = await fetch(
                "{{ route('ocr.npwp') }}",
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
            btnUpload.disabled = false;
        }
    }

    btnCapture.addEventListener('click', async () => {
        const width = video.videoWidth;
        const height = video.videoHeight;

        if (!width || !height) {
            alert(
                'Kamera belum siap. Silakan tunggu sebentar.'
            );
            return;
        }

        canvas.width = width;
        canvas.height = height;

        const ctx = canvas.getContext('2d');

        ctx.drawImage(
            video,
            0,
            0,
            width,
            height
        );

        canvas.toBlob(
            async (blob) => {
                if(!blob) {
                    alert('Gagal ambil foto.');
                    return;
                }

                const file = new File(
                    [blob],
                    'npwp.jpg',
                    {
                        type: 'image/jpeg'
                    }
                );

                await sendToOCR(file);
            },
            'image/jpeg',
            0.9
        );
    });

    npwpFile.addEventListener('change', async () => {
        const file = npwpFile.files[0];

        if(!file) {
            return;
        }

        await sendToOCR(file);
    });

    btnUpload.addEventListener('click', async () => {
        stopCamera();

        scanOptions.style.display = 'none';
        cameraContainer.style.display = 'none';
        btnCapture.style.display = 'none';

        uploadContainer.style.display = 'block';

        npwpFile.click();
    });

    btnCamera.addEventListener('click', async () => {
        scanOptions.style.display = 'none';
        uploadContainer.style.display = 'none';

        cameraContainer.style.display = 'block';
        btnCapture.style.display = 'block';

        
        await startCamera();
    });
</script>
@endsection