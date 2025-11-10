document.addEventListener("DOMContentLoaded", () => {
  const editButtons = document.querySelectorAll(".editBtn");
  const modal = document.getElementById("editModal");
  const cancelEdit = document.getElementById("cancelEdit");
  const editForm = document.getElementById("editForm");

  const previewImage = document.getElementById("previewImage");
  const editImageInput = document.getElementById("editImage");
  const editDate = document.getElementById("editDate");
  const editStatus = document.getElementById("editStatus");

  let currentRow = null;
  let newImageData = null; // simpan base64 gambar baru sementara

  // Klik tombol edit
  editButtons.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      currentRow = e.target.closest("tr");
      const img = currentRow.querySelector(".banner-img");
      const date = currentRow.querySelector(".tanggal").textContent.trim();
      const status = currentRow.querySelector(".status-label").textContent.trim();

      previewImage.src = img.src;
      previewImage.classList.remove("hidden");
      editDate.value = formatDateForInput(date);
      editStatus.value = status;
      newImageData = null;

      modal.classList.remove("hidden");
    });
  });

  // Preview gambar baru di modal
  editImageInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (ev) => {
        previewImage.src = ev.target.result;
        previewImage.classList.remove("hidden");
        newImageData = ev.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  // Tutup modal
  cancelEdit.addEventListener("click", () => {
    modal.classList.add("hidden");
    editImageInput.value = "";
    previewImage.src = "";
    previewImage.classList.add("hidden");
  });

  // Simpan perubahan
  editForm.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!currentRow) return;

    const newDate = editDate.value;
    const newStatus = editStatus.value;
    const finalImageSrc = newImageData || previewImage.src;

    // 🔥 Update gambar di tabel (paksa refresh)
    const bannerImg = currentRow.querySelector(".banner-img");
    bannerImg.src = finalImageSrc + "?t=" + new Date().getTime();

    // Update tanggal
    currentRow.querySelector(".tanggal").textContent = formatDateDisplay(newDate);

    // Update status
    const statusSpan = currentRow.querySelector(".status-label");
    statusSpan.textContent = newStatus;

    if (newStatus === "Aktif") {
      statusSpan.className =
        "status-label bg-[#13810A] text-white text-sm font-semibold px-4 py-1 rounded-full shadow";
    } else {
      statusSpan.className =
        "status-label bg-[#D37B00] text-white text-sm font-semibold px-4 py-1 rounded-full shadow";
    }

    modal.classList.add("hidden");
    editImageInput.value = "";
    previewImage.src = "";
    previewImage.classList.add("hidden");
  });

  // Fungsi bantu ubah format tanggal
  function formatDateForInput(dateString) {
    const parts = dateString.split(" ");
    if (parts.length !== 3) return "";
    const months = {
      Jan: "01", Feb: "02", Mar: "03", Apr: "04", Mei: "05", Jun: "06",
      Jul: "07", Agu: "08", Sep: "09", Okt: "10", Nov: "11", Des: "12",
    };
    return `2025-${months[parts[1]] || "01"}-${parts[0].padStart(2, "0")}`;
  }

  function formatDateDisplay(dateInput) {
    if (!dateInput) return "";
    const dateObj = new Date(dateInput);
    const months = [
      "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
      "Jul", "Agu", "Sep", "Okt", "Nov", "Des",
    ];
    return `${dateObj.getDate()} ${months[dateObj.getMonth()]} ${dateObj.getFullYear()}`;
  }
});
