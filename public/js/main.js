document.addEventListener("DOMContentLoaded", () => {
    /* ====================
       NAVBAR HIDE / SHOW
    ==================== */
    const nav = document.getElementById("sectionNav");
    let lastScroll = window.scrollY;

    if (nav) {
        window.addEventListener("scroll", () => {
            const currentScroll = window.scrollY;

            if (currentScroll > lastScroll + 10) {
                nav.classList.add("-translate-y-full");
                nav.classList.remove("translate-y-0");
            } else if (currentScroll < lastScroll - 10) {
                nav.classList.remove("-translate-y-full");
                nav.classList.add("translate-y-0");
            }

            lastScroll = currentScroll;
        });
    }

    /* ====================
       BANNER CAROUSEL
    ==================== */
    const carousel = document.getElementById("banner-carousel");
    const slides = carousel?.children || [];
    const dots = document.querySelectorAll(".banner-dot");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    let currentSlide = 0;
    let carouselInterval;

    function updateCarousel() {
        if (!carousel) return;

        carousel.style.transform = `translateX(-${currentSlide * 100}%)`;

        dots.forEach((dot, i) => {
            dot.classList.toggle("!bg-white", i === currentSlide);
            dot.classList.toggle("opacity-100", i === currentSlide);
            dot.classList.toggle("opacity-60", i !== currentSlide);
        });
    }

    function startCarousel() {
        carouselInterval = setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            updateCarousel();
        }, 5000);
    }

    function stopCarousel() {
        clearInterval(carouselInterval);
    }

    if (carousel) {
        updateCarousel();
        startCarousel();

        carousel.addEventListener("mouseenter", stopCarousel);
        carousel.addEventListener("mouseleave", startCarousel);
    }

    prevBtn?.addEventListener("click", () => {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateCarousel();
    });

    nextBtn?.addEventListener("click", () => {
        currentSlide = (currentSlide + 1) % slides.length;
        updateCarousel();
    });

    /* ====================
       GALLERY FILTER
    ==================== */
    const filterButtons = document.querySelectorAll(".filter-btn");
    const galleryItems = document.querySelectorAll(".gallery-item");

    filterButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const filter = btn.dataset.filter;

            // Active button
            filterButtons.forEach((b) => b.classList.remove("active"));
            btn.classList.add("active");

            // === PHASE 1: hide all quickly ===
            galleryItems.forEach((item) => {
                item.classList.remove("show");
            });

            // === PHASE 2: show filtered items ===
            setTimeout(() => {
                galleryItems.forEach((item, index) => {
                    const show =
                        filter === "all" || item.classList.contains(filter);

                    if (show) {
                        item.style.display = "block";

                        setTimeout(() => {
                            item.classList.add("show");
                        }, index * 40); // stagger halus
                    } else {
                        item.style.display = "none";
                    }
                });
            }, 200); // tunggu item lama benar-benar hilang

            galleryItems.forEach((item, i) => {
                item.style.transitionDelay = `${i * 40}ms`;
            });
        });
    });

    /* ====================
       FORM LOADER
    ==================== */
    const form = document.getElementById("myForm");
    const formLoader = document.getElementById("formLoader");

    form?.addEventListener("submit", () => {
        formLoader?.classList.remove("hidden");
        formLoader?.classList.add("flex");
    });

    /* ====================
       TIME SELECT VALIDATION
    ==================== */
    const jamMulai = document.getElementById("jam_mulai");
    const jamSelesai = document.getElementById("close_time");

    function updateTimeOptions() {
        if (!jamMulai || !jamSelesai) return;

        const start = parseInt(jamMulai.value) || 0;
        const end = parseInt(jamSelesai.value) || 24;

        jamSelesai.querySelectorAll("option").forEach((opt) => {
            opt.disabled = parseInt(opt.value) <= start;
        });

        jamMulai.querySelectorAll("option").forEach((opt) => {
            opt.disabled = parseInt(opt.value) >= end;
        });
    }

    jamMulai?.addEventListener("change", updateTimeOptions);
    jamSelesai?.addEventListener("change", updateTimeOptions);
    updateTimeOptions();

    /* ====================
       SMOOTH SCROLL
    ==================== */
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", (e) => {
            const target = document.querySelector(anchor.getAttribute("href"));
            if (!target) return;

            e.preventDefault();
            const offset = window.innerWidth < 768 ? 80 : 100;

            window.scrollTo({
                top: target.offsetTop - offset,
                behavior: "smooth",
            });
        });
    });
});
