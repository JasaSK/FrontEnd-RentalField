    <script>
        const bookingId = "{{ $booking_id }}";
        const apiUrl = "{{ rtrim($apiUrl, '/') }}";
        const expiresAt = "{{ $expiresAt }}".replace(' ', 'T');
        let timerInterval;
        let expiredHandled = false;
        let statusInterval = null;
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
                .then(res => res.json())
                .then(data => {
                    // Menggunakan GlobalAlertHijau untuk error
                    if (window.globalAlert) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Waktu Habis',
                            text: data.message ?? 'Batas waktu pembayaran telah habis.',
                            allowOutsideClick: false,
                            confirmButtonText: 'Mengerti',
                            customClass: {
                                popup: 'swal2-popup-hijau error-popup-hijau',
                                confirmButton: 'swal2-confirm-button-hijau error-btn',
                                title: 'swal2-title-hijau',
                                htmlContainer: 'swal2-html-container-hijau'
                            }
                        }).then(() => {
                            window.location.href = '/';
                        });
                    } else {
                        // Fallback jika GlobalAlert belum tersedia
                        Swal.fire({
                            icon: 'error',
                            title: 'Waktu Habis',
                            text: data.message ?? 'Batas waktu pembayaran telah habis.',
                            allowOutsideClick: false,
                            confirmButtonColor: '#ef4444'
                        }).then(() => {
                            window.location.href = '/';
                        });
                    }
                })
                .catch(err => {
                    // Menggunakan GlobalAlertHijau untuk error
                    if (window.globalAlert) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Expire Gagal',
                            text: err.message,
                            confirmButtonText: 'Mengerti',
                            customClass: {
                                popup: 'swal2-popup-hijau error-popup-hijau',
                                confirmButton: 'swal2-confirm-button-hijau error-btn',
                                title: 'swal2-title-hijau',
                                htmlContainer: 'swal2-html-container-hijau'
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Expire Gagal',
                            text: err.message,
                            confirmButtonColor: '#8B0C17'
                        });
                    }
                });
        }

        const checkStatus = () => {
            fetch(`/ajax/booking-status/${bookingId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'approved') {
                        clearInterval(timerInterval);
                        clearInterval(statusInterval);

                        // Menggunakan GlobalAlertHijau untuk success
                        if (window.globalAlert) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembayaran Berhasil!',
                                text: 'Anda akan diarahkan ke halaman tiket.',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                customClass: {
                                    popup: 'swal2-popup-hijau success-popup-hijau',
                                    title: 'swal2-title-hijau',
                                    htmlContainer: 'swal2-html-container-hijau'
                                }
                            }).then(() => {
                                window.location.href = `/ticket/${bookingId}`;
                            });
                        } else {
                            // Fallback
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembayaran Berhasil!',
                                text: 'Anda akan diarahkan ke halaman tiket.',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = `/ticket/${bookingId}`;
                            });
                        }
                    }
                })
                .catch(err => console.error(err));
        };

        document.addEventListener('DOMContentLoaded', () => {
            startTimer();
            statusInterval = setInterval(checkStatus, 5000);
        });
    </script>
