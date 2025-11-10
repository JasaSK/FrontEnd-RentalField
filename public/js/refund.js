// Script modal refund
const openRefund = document.getElementById("openRefundModal");
const modalRefund = document.getElementById("refundModal");
const cancelRefund = document.getElementById("cancelRefund");

if (openRefund && modalRefund && cancelRefund) {
  openRefund.addEventListener("click", () => {
    modalRefund.classList.remove("hidden");
  });

  cancelRefund.addEventListener("click", () => {
    modalRefund.classList.add("hidden");
  });

  modalRefund.addEventListener("click", (e) => {
    if (e.target === modalRefund) {
      modalRefund.classList.add("hidden");
    }
  });
}
