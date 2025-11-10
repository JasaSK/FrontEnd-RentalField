// Menampilkan nama file setelah dipilih
document.addEventListener('DOMContentLoaded', () => {
  const inputFile = document.getElementById('buktiPembayaran');
  if (!inputFile) return; // memastikan  elemen ada

  inputFile.addEventListener('change', () => {
    const file = inputFile.files[0];
    if (file) {
      alert(`Bukti pembayaran terpilih: ${file.name}`);
    }
  });
});
