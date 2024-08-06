document.addEventListener('DOMContentLoaded', function () {
    const carousels = document.querySelectorAll('.carousel-container');
    const verDetalles = document.querySelectorAll('.ver-detalles');
            verDetalles.forEach(detalle => {
                detalle.addEventListener('click', function () {
                    const detalles = this.parentNode.querySelector('.detalles');
                    detalles.style.display = detalles.style.display === 'block' ? 'none' : 'block';
                });
            });
    carousels.forEach(carousel => {
        const track = carousel.querySelector('.carousel-track');
        if (!track) {
            console.error('No se encontró .carousel-track en', carousel);
            return;
        }

        const slides = Array.from(track.children);
        if (slides.length === 0) {
            console.error('No hay diapositivas dentro de .carousel-track en', carousel);
            return;
        }

        const nextButton = carousel.querySelector('.carousel-button.next');
        if (!nextButton) {
            console.error('No se encontró .carousel-button.next en', carousel);
            return;
        }

        const prevButton = carousel.querySelector('.carousel-button.prev');
        if (!prevButton) {
            console.error('No se encontró .carousel-button.prev en', carousel);
            return;
        }

        const slideWidth = slides[0].getBoundingClientRect().width;

        let currentIndex = 0;

        nextButton.addEventListener('click', () => {
            if (currentIndex < slides.length - 1) {
                currentIndex++;
                track.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
            }
        });

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                track.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
            }
        });
    });
});


    