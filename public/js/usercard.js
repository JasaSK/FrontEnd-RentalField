document.addEventListener("DOMContentLoaded", () => {
  const userBtn = document.getElementById("userBtn");
  const userCard = document.getElementById("userCard");
  const profileView = document.getElementById("profileView");
  const editView = document.getElementById("editView");
  const editImage = document.getElementById("editImage");
  const editPreview = document.getElementById("editPreview");
  const profileImage = document.getElementById("profileImage");
  const profilePic = document.getElementById("profilePic"); // di top bar
  const editBtn = document.getElementById("editBtn");
  const saveBtn = document.getElementById("saveBtn");
  const logoutBtn = document.getElementById("logoutBtn");

  let cardOpen = false;

  // Fungsi buka card
  function openUserCard() {
    userCard.classList.remove("hidden");
    setTimeout(() => {
      userCard.classList.remove("opacity-0", "scale-95");
      userCard.classList.add("opacity-100", "scale-100");
      cardOpen = true;
    }, 10);
  }

  // Fungsi tutup card
  function closeUserCard() {
    userCard.classList.add("opacity-0", "scale-95");
    setTimeout(() => {
      userCard.classList.add("hidden");
      userCard.classList.remove("opacity-100", "scale-100");
      cardOpen = false;

      // Kembali ke mode profile saat ditutup
      editView.classList.add("hidden");
      profileView.classList.remove("hidden");
    }, 200);
  }

  // Toggle card saat klik tombol user
  userBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    if (!cardOpen) openUserCard();
    else closeUserCard();
  });

  // Klik di luar card → tutup
  document.addEventListener("click", (e) => {
    if (cardOpen && !userCard.contains(e.target) && e.target !== userBtn) {
      closeUserCard();
    }
  });

  // Klik di dalam card jangan tutup
  userCard.addEventListener("click", (e) => {
    e.stopPropagation();
  });

  // Tombol edit profile
  editBtn.addEventListener("click", () => {
    profileView.classList.add("hidden");
    editView.classList.remove("hidden");
  });

  // Tombol simpan profile
  saveBtn.addEventListener("click", () => {
    document.getElementById("profileName").textContent = document.getElementById("editName").value;
    document.getElementById("profileEmail").textContent = document.getElementById("editEmail").value;
    document.getElementById("profilePhone").textContent = document.getElementById("editPhone").value;

    editView.classList.add("hidden");
    profileView.classList.remove("hidden");
  });

  // Pratinjau gambar saat diubah
  editImage.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (event) => {
        editPreview.src = event.target.result;
        profileImage.src = event.target.result;

        if (profilePic) {
          profilePic.src = event.target.result; // di top bar
        }
      };
      reader.readAsDataURL(file);
    } else {
      editPreview.src = profileImage.src; // Kembalikan ke gambar sebelumnya jika tidak ada file
    }
  });

  // Tombol logout
  logoutBtn.addEventListener("click", () => {
    window.location.href = "/beranda/index";
  });

});
