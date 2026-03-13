@if (!(request()->routeIs('kunjungan.laporan') && Auth::check() && (Auth::user()->hasRole('Collector') || Auth::user()->hasRole('Driver'))))
<style>
    #realtime-notification {
        position: fixed;
        top: 52px;
        right: 20px;
        background-color: #fff;
        padding: 10px 15px;
        border-radius: 8px;
        /* box-shadow has been moved into the animation */
        z-index: 1060;
        width: auto;
        min-width: 220px;
        cursor: pointer;
        display: none;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.5s ease;

        /* Indikator default adalah MERAH */
        border-left: 5px solid #e74c3c;

        /* [PERUBAHAN] Terapkan animasi pulse-red */
        animation: pulse-red 2s infinite;
    }

    /* Kelas "is-late" akan mengubah indikator menjadi HIJAU */
    #realtime-notification.is-late {
        border-left-color: #2ecc71;

        /* [PERUBAHAN] Ganti animasi menjadi pulse-green */
        animation-name: pulse-green;
    }

    #realtime-notification.show {
        display: block;
        opacity: 1;
        transform: translateX(0);
    }

    #realtime-notification .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #realtime-notification .notification-title {
        font-weight: 600;
        color: #333;
        margin-right: 20px;
    }

    #notification-timer {
        font-family: 'Courier New', Courier, monospace;
        font-size: 1.1em;
    }

    #realtime-notification .notification-close {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        color: #999;
    }

    #realtime-notification .notification-body {
        display: none;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #f0f0f0;
        color: #555;
    }

    /* [TAMBAHAN] Gaya untuk Tombol Checkout */
    .checkout-btn {
        display: none;
        /* Sembunyikan tombol secara default */
        width: 100%;
        margin-top: 10px;
        padding: 8px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .checkout-btn:hover {
        background-color: #2980b9;
    }

    /* [TAMBAHAN] Definisi Keyframes untuk Animasi */
    @keyframes pulse-red {
        0% {
            box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(231, 76, 60, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(231, 76, 60, 0);
        }
    }

    @keyframes pulse-green {
        0% {
            box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(46, 204, 113, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(46, 204, 113, 0);
        }
    }
</style>
<div id="realtime-notification">
    <div class="notification-header">
        <strong class="notification-title">
            <span id="notification-timer-label">Start Timer: </span>
            <span id="notification-timer">--:--</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch"
                viewBox="0 0 16 16">
                <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z" />
                <path
                    d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3" />
            </svg>
        </strong>
        <button type="button" class="notification-close" aria-label="Close">&times;</button>
    </div>

    <div class="notification-body">
        <div id="notification-details-text">
        </div>
        <button id="checkout-button" class="checkout-btn">Checkout Sekarang</button>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Deklarasi Elemen ---
        const notificationElement = document.getElementById('realtime-notification');
        if (!notificationElement) return; // Hentikan jika elemen notifikasi tidak ada

        const timerLabel = document.getElementById('notification-timer-label');
        const timerElement = document.getElementById('notification-timer');
        const notificationBody = notificationElement.querySelector('.notification-body');
        const detailsText = document.getElementById('notification-details-text');
        const closeButton = notificationElement.querySelector('.notification-close');
        const checkoutButton = document.getElementById('checkout-button');

        // --- Variabel State ---
        let lastShownCheckinId = null;
        let timerInterval = null;
        let redirectUrl = '';
        let pollingInterval = null;

        // --- Fungsi Utama ---

        /**
         * Memulai dan mengelola timer countdown 20 menit.
         * Mengubah warna indikator dan menampilkan/menyembunyikan tombol checkout.
         */
        function startTimer(checkinTimeString) {
            clearInterval(timerInterval);
            const checkinTime = new Date(checkinTimeString);
            
            // [PERUBAHAN] Jika role Collector atau Driver, tidak perlu menunggu 20 menit
            const isCollectorOrDriver = {{ Auth::user()->hasRole('Collector') || Auth::user()->hasRole('Driver') ? 'true' : 'false' }};
            const waitMinutes = isCollectorOrDriver ? 0 : 20;
            
            const waitTimeInMs = waitMinutes * 60 * 1000;
            const targetTime = new Date(checkinTime.getTime() + waitTimeInMs);

            timerInterval = setInterval(() => {
                const now = new Date();
                const diff = targetTime - now;

                if (diff > 0) { // Jika masih dalam masa tunggu (countdown)
                    notificationElement.classList.remove('is-late'); // Indikator Merah
                    timerLabel.textContent = 'Sisa Waktu: ';
                    const minutes = Math.floor(diff / 60000).toString().padStart(2, '0');
                    const seconds = Math.floor((diff % 60000) / 1000).toString().padStart(2, '0');
                    timerElement.textContent = `${minutes}:${seconds}`;
                    checkoutButton.style.display = 'none'; // Sembunyikan tombol checkout

                } else { // Jika sudah lewat masa tunggu
                    notificationElement.classList.add('is-late'); // Indikator Hijau
                    timerLabel.textContent = 'Selesai: ';
                    const overdueDiff = Math.abs(diff);
                    // const minutes = Math.floor(overdueDiff / 60000).toString().padStart(2, '0');
                    // const seconds = Math.floor((overdueDiff % 60000) / 1000).toString().padStart(2,
                    //     '0');
                    timerElement.textContent = `00:00`;
                    // timerElement.textContent = `+${minutes}:${seconds}`;
                    checkoutButton.style.display = 'block'; // Tampilkan tombol checkout
                }
            }, 1000); // Update setiap detik
        }

        /**
         * Menampilkan notifikasi dan mengatur state awal.
         */
        function showNotification(data) {
            if (data.id !== lastShownCheckinId) {
                lastShownCheckinId = data.id;
                notificationElement.dataset.attendanceId = data.id; // Simpan ID untuk checkout
                detailsText.textContent = `Kunjungan ke: ${data.nama_usaha}`;
                notificationBody.style.display = 'none'; // Selalu sembunyikan detail saat notif baru
                notificationElement.classList.add('show');
                redirectUrl = `/laporan/${data.general_id}/${data.jadwal_id}?tanggal=${data.date}`;
                startTimer(data.checkin_time);
            }
        }

        /**
         * Menutup dan mereset notifikasi.
         */
        function hideNotification() {
            lastShownCheckinId = null;
            notificationElement.classList.remove('show');
            clearInterval(timerInterval);
        }

        /**
         * Mengambil data check-in terbaru dari server.
         */
        async function checkForNotification() {
            try {
                const response = await fetch('{{ route('check.new.checkin') }}');
                if (!response.ok) return;
                const data = await response.json();

                if (Object.keys(data).length !== 0) {
                    showNotification(data);
                } else {
                    if (notificationElement.classList.contains('show')) {
                        hideNotification();
                    }
                    clearInterval(pollingInterval);
                }
            } catch (error) {
                console.error('Error saat fetch notifikasi:', error);
                clearInterval(pollingInterval);
            }
        }

        // --- Event Listeners (Aksi Pengguna) ---

        // 1. Klik tombol close (X)
        closeButton.addEventListener('click', (event) => {
            event.stopPropagation(); // Hentikan event agar tidak mentrigger klik lain
            hideNotification();
        });

        // 2. Klik area notifikasi untuk menampilkan/menyembunyikan detail
        notificationElement.addEventListener('click', () => {
            // Cek apakah tombol checkout atau close yang diklik, jika iya, jangan lakukan apa-apa
            if (event.target === checkoutButton || event.target === closeButton) {
                return;
            }
            const isHidden = notificationBody.style.display === 'none';
            notificationBody.style.display = isHidden ? 'block' : 'none';
        });

        // 3. Klik tombol checkout
        checkoutButton.addEventListener('click', async (event) => {
            event.stopPropagation(); // Hentikan event agar tidak mentrigger klik lain

            // Nonaktifkan tombol untuk mencegah klik ganda
            checkoutButton.disabled = true;
            checkoutButton.textContent = 'Mengarahkan...';
            // Jika URL redirect sudah ada, arahkan pengguna
            if (redirectUrl) {
                window.location.href = redirectUrl;
            }

        });

        // --- Inisialisasi ---
        checkForNotification(); // Periksa saat halaman dimuat
        pollingInterval = setInterval(checkForNotification, 60000);
    });
</script>
@endif
