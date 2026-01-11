    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const slots = Array.from(document.querySelectorAll(".hour-slot"));
            const selectedSlots = new Set();
            const submitButton = document.getElementById("submitButton");
            const selectedTimeDisplay = document.getElementById("selectedTimeDisplay");
            const selectedTimeText = document.getElementById("selectedTimeText");
            const startInput = document.getElementById("start_time");
            const endInput = document.getElementById("end_time");

            const selectedDate = "{{ $date ?? now()->toDateString() }}";
            const today = new Date().toISOString().slice(0, 10);
            const now = new Date();

            // Disable jam yang sudah lewat (hari ini)
            if (selectedDate === today) {
                slots.forEach((slot) => {
                    const startTime = slot.dataset.start;
                    const [hour, minute] = startTime.split(":");
                    const slotTime = new Date();
                    slotTime.setHours(hour, minute, 0, 0);

                    if (slotTime <= now) {
                        slot.disabled = true;
                        slot.classList.remove(
                            "bg-gradient-to-br",
                            "from-emerald-50",
                            "to-green-50",
                            "text-emerald-700",
                            "border-emerald-200"
                        );
                        slot.classList.add(
                            "bg-gradient-to-br",
                            "from-gray-100",
                            "to-gray-200",
                            "border-gray-300",
                            "text-gray-400",
                            "cursor-not-allowed"
                        );
                    }
                });
            }

            // Update state tombol submit - versi yang disederhanakan
            function updateSubmitButton() {
                if (selectedSlots.size === 0) {
                    submitButton.disabled = true;
                } else {
                    submitButton.disabled = false;
                }
            }

            // Update input hidden dan display
            function updateHiddenInputs() {
                if (selectedSlots.size === 0) {
                    startInput.value = "";
                    endInput.value = "";
                    selectedTimeDisplay.classList.add("hidden");
                    return;
                }

                const indexes = Array.from(selectedSlots).sort((a, b) => a - b);
                const startTime = slots[indexes[0]].dataset.start;
                const endTime = slots[indexes[indexes.length - 1]].dataset.end;

                startInput.value = startTime;
                endInput.value = endTime;

                selectedTimeText.textContent = `${startTime} - ${endTime} (${selectedSlots.size} jam)`;
                selectedTimeDisplay.classList.remove("hidden");
            }

            // Toggle slot
            function toggleSlot(slot, index) {
                if (slot.disabled) return;

                if (selectedSlots.has(index)) {
                    selectedSlots.delete(index);
                    slot.classList.remove(
                        "bg-gradient-to-r",
                        "from-emerald-500",
                        "to-green-500",
                        "text-white",
                        "border-emerald-600",
                        "scale-105"
                    );
                    slot.classList.add(
                        "bg-gradient-to-br",
                        "from-emerald-50",
                        "to-green-50",
                        "text-emerald-700",
                        "border-emerald-200"
                    );
                } else {
                    selectedSlots.add(index);
                    slot.classList.remove(
                        "bg-gradient-to-br",
                        "from-emerald-50",
                        "to-green-50",
                        "text-emerald-700",
                        "border-emerald-200"
                    );
                    slot.classList.add(
                        "bg-gradient-to-r",
                        "from-emerald-500",
                        "to-green-500",
                        "text-white",
                        "border-emerald-600",
                        "scale-105"
                    );
                }

                updateHiddenInputs();
                updateSubmitButton();
            }

            // Event listener untuk setiap slot
            slots.forEach((slot, index) => {
                slot.addEventListener("click", function() {
                    toggleSlot(slot, index);
                });
            });

            // Fungsi untuk clear selection
            window.clearSelection = function() {
                selectedSlots.forEach((index) => {
                    const slot = slots[index];
                    slot.classList.remove(
                        "bg-gradient-to-r",
                        "from-emerald-500",
                        "to-green-500",
                        "text-white",
                        "border-emerald-600",
                        "scale-105"
                    );
                    slot.classList.add(
                        "bg-gradient-to-br",
                        "from-emerald-50",
                        "to-green-50",
                        "text-emerald-700",
                        "border-emerald-200"
                    );
                });
                selectedSlots.clear();
                updateHiddenInputs();
                updateSubmitButton();
            };

            // Form submission loader
            const bookingForm = document.getElementById("bookingForm");
            bookingForm.addEventListener("submit", function(e) {
                if (selectedSlots.size === 0) {
                    e.preventDefault();
                    return false;
                }

                submitButton.innerHTML = `
                <div class="flex items-center justify-center">
                    <div class="spinner border-2 border-white border-t-transparent rounded-full w-6 h-6 animate-spin mr-3"></div>
                    Memproses booking...
                </div>
            `;
                submitButton.disabled = true;
            });

            // Initialize submit button state
            updateSubmitButton();
        });
    </script>
