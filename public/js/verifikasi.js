document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[action*='ResendCode']");
    const tombol = document.getElementById("btnKirimUlang");
    const status = document.getElementById("statusPesan");

    const DELAY = 60;
    const LAST_SEND_KEY = "last_resend_code_time";

    // =============================
    // FUNGSI UPDATE UI COUNTDOWN
    // =============================
    function updateUI(sec) {
        if (sec > 0) {
            tombol.disabled = true;
            tombol.classList.add("opacity-70", "cursor-not-allowed");
            tombol.textContent = `Tunggu ${sec} detik...`;

            status.textContent = "Kode baru telah dikirim. Silakan cek email.";
            status.classList.add("text-green-600", "font-semibold");
            status.classList.remove("text-black");
        } else {
            tombol.disabled = false;
            tombol.classList.remove("opacity-70", "cursor-not-allowed");
            tombol.textContent = "Kirim Ulang Kode";

            status.textContent = "Tidak menerima kode?";
            status.classList.remove("text-green-600", "font-semibold");
            status.classList.add("text-black");
        }
    }

    // =============================
    // START COUNTDOWN KETIKA HALAMAN DIBUKA
    // =============================
    function resumeCountdown() {
        const lastTime = localStorage.getItem(LAST_SEND_KEY);
        const now = Math.floor(Date.now() / 1000);

        if (!lastTime) return;

        let remaining = DELAY - (now - lastTime);
        if (remaining <= 0) {
            updateUI(0);
            return;
        }

        updateUI(remaining);

        const interval = setInterval(() => {
            remaining--;
            updateUI(remaining);
            if (remaining <= 0) clearInterval(interval);
        }, 1000);
    }

    resumeCountdown();

    // =============================
    // INTERCEPT FORM SUBMIT
    // =============================
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // cegah submit langsung

        // Set waktu terakhir klik
        const now = Math.floor(Date.now() / 1000);
        localStorage.setItem(LAST_SEND_KEY, now);

        updateUI(DELAY);

        // Count start
        let remaining = DELAY;
        const interval = setInterval(() => {
            remaining--;
            updateUI(remaining);
            if (remaining <= 0) clearInterval(interval);
        }, 1000);

        // Lanjut submit ke backend setelah 500 ms
        // supaya API tetap terpanggil
        setTimeout(() => {
            form.submit(); // submit manual
        }, 500);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".code-input");

    inputs.forEach((input, index) => {
        // Hanya angka
        input.addEventListener("input", function (e) {
            this.value = this.value.replace(/[^0-9]/g, "");

            // Auto next
            if (this.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        // Auto backspace
        input.addEventListener("keydown", function (e) {
            if (e.key === "Backspace" && !this.value && index > 0) {
                inputs[index - 1].focus();
            }
        });

        // Paste 6 digit langsung
        input.addEventListener("paste", function (e) {
            const pasteData = e.clipboardData
                .getData("text")
                .replace(/\D/g, "");

            if (pasteData.length === 6) {
                pasteData.split("").forEach((num, i) => {
                    if (inputs[i]) inputs[i].value = num;
                });
                inputs[5].focus(); // fokus ke input terakhir
            }
            e.preventDefault();
        });
    });
});
