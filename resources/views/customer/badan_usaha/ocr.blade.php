@extends('layouts.main_app')

@section('title')
    <title>Scan | PT. PAPASARI</title>
@endsection

@section('css')
<style>
    body {
        overflow-y: hidden;
    }

    .container .header img {
        width: 35%;
    }

    .page-wrapper {
        max-height: auto;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .option-menu {
        width: 70%;
        gap: 12px;
    }

    .option-menu .badan_usaha, .option-menu .perseorangan {
        display: flex;
        align-items: center;
        flex-direction: column;
        border: 1px solid #D2D0D8;
        border-radius: 8px;
        padding: 32px 0;
        cursor: pointer;
    }

    .profile-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
    }

    .card {
        padding: 16px;
        cursor: pointer;
    }

    .modal-body .opsi1Perseorangan .card.active1,
    .modal-body .opsi1BadanUsaha .card.active1,
    .modal-body .opsi2Perseorangan .card.active2,
    .modal-body .opsi2BadanUsaha .card.active2 {
        border: 2px solid #0063ee;
    }

    .badan_usaha, .perseorangan {
        gap: 8px;
    }

    #overlay{
        position:absolute;
        border:3px solid lime;
        display:none;
    }

    /* TABLET RESOLUTION */
    @media (min-width: 576px) and (max-width: 991.98px) {
        body {
            overflow-y: auto;
        }

        .container .header img {
            width: 80%;
        }

        .modal-body .opsi1Perseorangan,
        .modal-body .opsi1BadanUsaha,
        .modal-body .opsi2Perseorangan,
        .modal-body .opsi2BadanUsaha {
            gap: 8px !important;
        }
    }

    /* MOBILE RESOLUTION */
    @media (max-width: 575.98px) {
        body {
            overflow-y: auto;
            background-image: none;
        }

        .container-fill-mobile {
            height: 100vh;
            flex: 1;
            display: flex;
            /* flex-direction: column; */
            /* justify-content: space-between; */
            padding: 0 !important;
        }

        .container .header img {
            width: 80%;
        }

        .container > div {
            border-radius: 0 !important;
            box-shadow: none !important;
            padding-left: 2rem !important;
            padding-right: 2rem !important;
        }

        .option-menu {
            width: 100%;
        }

        .modal-body .opsi1Perseorangan,
        .modal-body .opsi1BadanUsaha,
        .modal-body .opsi2Perseorangan,
        .modal-body .opsi2BadanUsaha {
            gap: 8px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="container container-fill-mobile py-5">
        <div class="p-5 bg-white rounded-4 shadow text-center position-relative">
            <div class="d-grid gap-4">
                <div class="header d-grid gap-3">
                    <div class="title text-center">
                        <h1 class="m-0">Scan Identitas</h1>
                        <p class="mb-0 text-muted">Silahkan siapkan NPWP</p>
                    </div>
                </div>
                <div class="text-center">
                    <video
                        id="camera"
                        autoplay
                        playsinline
                        class="w-100"
                    ></video>

                    <canvas
                        id="canvas"
                        class="d-none"
                    ></canvas>

                    <button
                        type="button"
                        id="btnCapture"
                        class="btn btn-primary mt-3"
                    >
                        Ambil foto        
                    </button>
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
    </div>
</div>
@endsection

@section('js')
<script>
    const video = document.getElementById('camera');
    const canvas = document.getElementById('canvas');
    const btnCapture = document.getElementById('btnCapture');
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
            console.log(error);
            alert("Tidak dapat mengakses kamera.");
        }
    }

    async function sendToOCR(blob) {
        const formData = new FormData();

        formData.append(
            'photo',
            blob,
            'npwp.jpg'
        );

        try {
            loadingOCR.style.display = 'block';
            btnCapture.disabled = true;

            const response = await fetch(
                "{{ route('ocr.npwp') }}",
                {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf_token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                }
            );

            const result = await response.json();

            console.log('OCR result:', result);

            if (!response.ok || !result.success) {

                throw new Error(
                    result.message ?? 'OCR gagal.'
                );
            }

            console.log('Data NPWP:', result.data);

            console.log(
                'Confidence:',
                result.data.confidence_score
            );

            // Untuk sementara tampilkan dulu
            alert(
                `Nama: ${result.data.nama}\n` +
                `NIK: ${result.data.no_npwp}\n` +
                `Confidence: ${result.data.confidence_score}`
            );
        } catch (error) {
            console.error('OCR error:', error);

            alert(error.message);
        } finally {
            loadingOCR.style.display = 'none';
            btnCapture.disabled = false;
        }

        const result = await response.json();
        console.log(result);
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

                await sendToOCR(blob);
            },
            'image/jpeg',
            0.9
        );
    });

    startCamera();
</script>
@endsection