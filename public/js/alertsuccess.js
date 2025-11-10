// alertsucces.js

document.addEventListener("DOMContentLoaded", () => {
  const submitBtn = document.getElementById("submitBtn");
  const popup = document.getElementById("popup");
  const closeBtn = document.getElementById("closeBtn");

  // Saat tombol "Kirim" ditekan → tampilkan popup
  submitBtn.addEventListener("click", () => {
    popup.classList.remove("hidden");
  });

  // Saat tombol "Kembali" ditekan → arahkan ke halaman login
  closeBtn.addEventListener("click", () => {
    window.location.href = "/beranda/login"; 
  });
});
