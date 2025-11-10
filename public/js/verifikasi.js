document.addEventListener("DOMContentLoaded", function () {
  const tombol = document.getElementById("btnKirimUlang");
  const status = document.getElementById("statusPesan");

  tombol.addEventListener("click", function () {
    status.textContent = "Kode baru telah dikirimkan. Silakan cek email Anda.";
    status.classList.remove("text-black");
    status.classList.add("text-green-600", "font-semibold");

    tombol.disabled = true;
    tombol.classList.add("opacity-70", "cursor-not-allowed");
    tombol.textContent = "Kode Dikirim...";

    setTimeout(() => {
      tombol.disabled = false;
      tombol.classList.remove("opacity-70", "cursor-not-allowed");
      tombol.textContent = "Kirim Ulang Kode";
      status.classList.remove("text-green-600");
      status.classList.add("text-black");
      status.textContent = "Tidak menerima kode?";
    }, 10000);
  });
});
