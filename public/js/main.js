// ==================== NAVBAR HIDE SHOW ====================
let last = scrollY;
const nav = document.getElementById('sectionNav');

addEventListener('scroll', () => {
  nav.classList.toggle('-translate-y-full', scrollY > last); // hide
  nav.classList.toggle('translate-y-0', scrollY <= last); // show
  last = scrollY;
});

// ==================== BANNER CAROUSEL ====================
const carousel = document.getElementById('banner-carousel');
const dots = document.querySelectorAll('[id^="dot-"]');
let index = 0;

function updateCarousel() {
  carousel.style.transform = `translateX(-${index * 100}%)`;
  dots.forEach((dot, i) => {
    dot.classList.toggle('bg-black', i === index);
    dot.classList.toggle('bg-gray-400', i !== index);
    dot.classList.toggle('opacity-100', i === index);
    dot.classList.toggle('opacity-60', i !== index);
  });
}

setInterval(() => {
  index = (index + 1) % dots.length;
  updateCarousel();
}, 4000);

// ==================== GALERI FILTER ====================
const filterButtons = document.querySelectorAll('.filter-btn');
const galleryItems = document.querySelectorAll('.gallery-item');

filterButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    // Reset semua tombol
    filterButtons.forEach(b => {
      b.classList.remove('bg-[#13810A]', 'text-white');
      b.classList.add('bg-transparent', 'text-[#13810A]');
    });

    // Tombol aktif
    btn.classList.remove('bg-transparent', 'text-[#13810A]');
    btn.classList.add('bg-[#13810A]', 'text-white');

    const filter = btn.dataset.filter;

    // Tampilkan/hilangkan item
    galleryItems.forEach(item => {
      item.style.display = (filter === 'all' || item.classList.contains(filter)) ? 'block' : 'none';
    });
  });
});
