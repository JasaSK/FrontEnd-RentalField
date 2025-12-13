document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formResendCodeForgot"); // id unik
    const tombol = document.getElementById("btnKirimUlangForgot");
    const status = document.getElementById("statusPesanForgot");

    const DELAY = 60;
    const LAST_SEND_KEY = "last_resend_code_time";

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

    // resume countdown
    const lastTime = localStorage.getItem(LAST_SEND_KEY);
    if (lastTime) {
        let remaining = DELAY - (Math.floor(Date.now() / 1000) - lastTime);
        if (remaining > 0) {
            updateUI(remaining);
            const interval = setInterval(() => {
                remaining--;
                updateUI(remaining);
                if (remaining <= 0) clearInterval(interval);
            }, 1000);
        }
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const now = Math.floor(Date.now() / 1000);
        localStorage.setItem(LAST_SEND_KEY, now);

        updateUI(DELAY);

        let remaining = DELAY;
        const interval = setInterval(() => {
            remaining--;
            updateUI(remaining);
            if (remaining <= 0) clearInterval(interval);
        }, 1000);

        setTimeout(() => {
            form.submit();
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
