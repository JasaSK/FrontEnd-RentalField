document.addEventListener("DOMContentLoaded", () => {
  console.log("✅ JS admin-lapangan.js aktif!");

  const editButtons = document.querySelectorAll(".editBtn");

  editButtons.forEach((btn) => {
    const dropdown = btn.nextElementSibling;

    // buka/tutup dropdown saat tombol edit diklik
    btn.addEventListener("click", () => {
      document.querySelectorAll(".dropdown").forEach((d) => {
        if (d !== dropdown) d.classList.add("hidden");
      });
      dropdown.classList.toggle("hidden");
    });

    // handle klik pilihan status
    const options = dropdown.querySelectorAll(".dropdown-item");
    options.forEach((opt) => {
      opt.addEventListener("click", () => {
        const newStatus = opt.getAttribute("data-status");
        const statusCell = btn.closest("tr").querySelector(".status-label");

        // ubah teks & warna
        if (newStatus === "Available") {
          statusCell.textContent = "Available";
          statusCell.className =
            "status-label bg-[#13810A] text-white text-sm font-semibold px-3 py-1 rounded-lg shadow";
        } else if (newStatus === "Maintenance") {
          statusCell.textContent = "Maintenance";
          statusCell.className =
            "status-label bg-[#D37B00] text-white text-sm font-semibold px-3 py-1 rounded-lg shadow";
        }

        dropdown.classList.add("hidden");
      });
    });

    // Hapus baris
  document.querySelectorAll(".hapusBtn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const row = btn.closest("tr");
      row.remove();
    });
  });

    // tutup dropdown kalau klik di luar
    document.addEventListener("click", (e) => {
      if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add("hidden");
      }
    });
  });
});
