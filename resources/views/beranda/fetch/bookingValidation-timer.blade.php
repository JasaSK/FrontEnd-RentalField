<script>
    const bookingId = "{{ $booking_id }}";
    const apiUrl = "{{ rtrim($apiUrl, '/') }}";
    const expiresAt = "{{ $expiresAt }}".replace(' ', 'T');
    let timerInterval;
    let expiredHandled = false;
    let totalDuration = 15 * 60; // 15 menit dalam detik

    function startTimer() {
        const timerDisplay = document.getElementById('countdown-timer');
        const progressBar = document.getElementById('timer-progress');
        const percentageDisplay = document.getElementById('timer-percentage');

        if (!timerDisplay) return;

        function updateTimer() {
            const now = Date.now();
            const expireTime = new Date(expiresAt).getTime();
            let timeLeft = Math.floor((expireTime - now) / 1000);

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timerDisplay.textContent = "00:00:00";
                progressBar.style.width = "0%";
                percentageDisplay.textContent = "0%";

                if (!expiredHandled) {
                    expiredHandled = true;
                    handleExpiredPayment();
                }
                return;
            }

            // Update timer display
            const hours = Math.floor(timeLeft / 3600);
            const minutes = Math.floor((timeLeft % 3600) / 60);
            const seconds = timeLeft % 60;

            timerDisplay.textContent =
                `${hours.toString().padStart(2,'0')}:${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;

            // Update progress bar
            const timeElapsed = totalDuration - timeLeft;
            const percentage = (timeElapsed / totalDuration) * 100;
            progressBar.style.width = `${percentage}%`;
            percentageDisplay.textContent = `${Math.round(percentage)}%`;

            // Change color based on time left
            if (timeLeft < 300) { // Less than 5 minutes
                timerDisplay.classList.remove('text-rose-700');
                timerDisplay.classList.add('text-red-600');
                progressBar.classList.remove('from-rose-500', 'to-red-500');
                progressBar.classList.add('from-red-500', 'to-orange-500');
            }
        }

        updateTimer();
        timerInterval = setInterval(updateTimer, 1000);
    }

    function handleExpiredPayment() {
        console.group('🔥 EXPIRE PAYMENT DEBUG');
        console.log('API URL:', apiUrl);
        console.log('Booking ID:', bookingId);
        console.log('Token:', "{{ session('token') ? 'ADA' : 'KOSONG' }}");

        fetch(`${apiUrl}/payment/${bookingId}/expire`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer {{ session('token') }}'
                },
                body: JSON.stringify({
                    reason: 'timeout'
                })
            })
            .then(async res => {
                console.log('STATUS CODE:', res.status);
                console.log('RESPONSE HEADERS:', [...res.headers.entries()]);

                const text = await res.text();
                console.log('RAW RESPONSE:', text);

                if (!res.ok) {
                    throw new Error(`HTTP ${res.status} - ${text}`);
                }

                return text ? JSON.parse(text) : {};
            })
            .then(data => {
                console.log('PARSED RESPONSE:', data);

                Swal.fire({
                    icon: 'error',
                    title: 'Waktu Habis',
                    text: data.message ?? 'Pembayaran expired',
                    confirmButtonText: 'OK',
                    allowOutsideClick: false
                }).then(() => {
                    window.location.href = '/';
                });
            })
            .catch(err => {
                console.error('❌ EXPIRE ERROR:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Expire Gagal',
                    text: err.message
                });
            })
            .finally(() => {
                console.groupEnd();
            });
    }

    const checkStatus = () => {
        fetch(`/ajax/booking-status/${bookingId}`)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'approved') {
                    clearInterval(timerInterval);

                    Swal.fire({
                        icon: 'success',
                        title: 'Pembayaran Berhasil!',
                        text: 'Anda akan diarahkan ke halaman tiket.',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    setTimeout(() => {
                        window.location.href = `/ticket/${bookingId}`;
                    }, 2000);
                }
            })
            .catch(err => console.error(err));
    };

    document.addEventListener('DOMContentLoaded', () => {
        startTimer();
        setInterval(checkStatus, 5000);
    });
</script>
