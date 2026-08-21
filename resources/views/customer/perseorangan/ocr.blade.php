@extends('layouts.main_app')

@section('title')
    <title>Scan | PT. PAPASARI</title>
@endsection

@section('css')
<style>
</style>
@endsection

@section('content')
<div class="px-4 py-3 px-md-5">
    <div class="d-grid gap-4">
        <div class="header d-grid gap-3">
            <div class="title text-center">
                <h1 class="m-0">Scan Identitas</h1>
                <p class="mb-0 text-muted">Silahkan siapkan KTP</p>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <video
                id="camera"
                autoplay
                playsinline
                class="col-12 col-md-6"
            ></video>

            <canvas
                id="canvas"
                class="d-none"
            ></canvas>

            <div>
                <button
                    type="button"
                    id="btnCapture"
                    class="btn btn-primary mt-3"
                >
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
            'ktp.jpg'
        );

        try {
            loadingOCR.style.display = 'block';
            btnCapture.disabled = true;

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

            console.log('OCR result:', result);

            if (!response.ok || !result.success) {
                throw new Error(
                    result.message ?? 'OCR gagal.'
                );
            }

            console.log('Data KTP:', result.data);

            console.log(
                'Confidence:',
                result.data.confidence_score
            );

            alert(
                `KTP: ${result.data.no_ktp}\n` +
                `NAMA: ${result.data.nama}\n` +
                `ALAMAT: ${result.data.alamat}\n` +
                `RT_RW: ${result.data.rt_rw}\n` +
                `KELURAHAN: ${result.data.kelurahan}\n` +
                `KOTA: ${result.data.kota_kabupaten}\n` +
                `provinsi: ${result.data.provinsi}\n` +
                `Confidence: ${result.data.confidence_score}`
            );

        } catch (error) {
            console.error('OCR error:', error);

            alert(error.message);

        } finally {
            loadingOCR.style.display = 'none';
            btnCapture.disabled = false;
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

                await sendToOCR(blob);
            },
            'image/jpeg',
            0.9
        );
    });

    startCamera();
</script>
@endsection