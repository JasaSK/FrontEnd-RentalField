document.addEventListener("DOMContentLoaded", () => {
  const buttons = document.querySelectorAll(".btnKonfirmasi");

  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const popup = btn.closest(".bg-white").querySelector(".popup");
      if (popup) popup.classList.remove("hidden");

      const closeBtn = popup.querySelector(".closeBtn");
      closeBtn.addEventListener("click", () => {
        window.location.href = "/admin/pemesanan";
      });
    });
  });
});
