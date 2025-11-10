document.addEventListener("DOMContentLoaded", () => {
  const editBtns = document.querySelectorAll(".editBtn");
  const editModal = document.getElementById("editModal");
  const cancelEdit = document.getElementById("cancelEdit");
  const editForm = document.getElementById("editForm");
  const editImage = document.getElementById("editImage");
  const previewImage = document.getElementById("previewImage");
  const editStatus = document.getElementById("editStatus");
  const editDate = document.getElementById("editDate");

  let currentRow = null;

  // Buka modal dan isi data
  editBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const row = e.target.closest("tr");
      currentRow = row;

      const imgSrc = row.querySelector("img").src;
      const status = row.querySelector(".status span").innerText.trim();
      const tanggal = row.querySelector(".tanggal").innerText.trim();

      // Tampilkan data ke modal
      previewImage.src = imgSrc;
      previewImage.classList.remove("hidden");
      editStatus.value = status;

      // Konversi tanggal format Indonesia → yyyy-mm-dd
      const parts = tanggal.split(" ");
      if (parts.length === 3) {
        const bulanMap = {
          Jan: "01", Feb: "02", Mar: "03", Apr: "04", Mei: "05",
          Jun: "06", Jul: "07", Agt: "08", Sep: "09", Okt: "10", Nov: "11", Des: "12"
        };
        const day = parts[0];
        const month = bulanMap[parts[1]];
        const year = parts[2];
        if (month) editDate.value = `${year}-${month}-${day.padStart(2, "0")}`;
      }

      editModal.classList.remove("hidden");
    });
  });

  // Preview gambar baru
  editImage.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
      previewImage.src = URL.createObjectURL(file);
      previewImage.classList.remove("hidden");
    }
  });

  // Tutup modal
  cancelEdit.addEventListener("click", () => {
    editModal.classList.add("hidden");
  });

  // Simpan perubahan (update tampilan DOM)
  editForm.addEventListener("submit", (e) => {
    e.preventDefault();

    if (currentRow) {
      const newStatus = editStatus.value;
      const newDate = editDate.value;
      const statusSpan = currentRow.querySelector(".status span");
      const dateCell = currentRow.querySelector(".tanggal");

      // Update status
      statusSpan.innerText = newStatus;
      statusSpan.className = newStatus === "Aktif"
        ? "bg-[#13810A] text-white text-sm font-semibold px-4 py-1 rounded-full shadow"
        : "bg-gray-400 text-white text-sm font-semibold px-4 py-1 rounded-full shadow";

      // Update tanggal (format ke versi Indonesia)
      if (newDate) {
        const dateObj = new Date(newDate);
        const bulan = [
          "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des"
        ];
        const formatted = `${dateObj.getDate()} ${bulan[dateObj.getMonth()]} ${dateObj.getFullYear()}`;
        dateCell.innerText = formatted;
      }

      // Update gambar jika ada
      if (editImage.files[0]) {
        currentRow.querySelector("img").src = URL.createObjectURL(editImage.files[0]);
      }

      // Tutup modal
      editModal.classList.add("hidden");
    }
  });
});
