// Aparición al bajar: marca con la clase "visible" cada elemento con data-reveal
// cuando entra a la pantalla. Solo se anima la primera vez.
(function () {
    const elementos = document.querySelectorAll('[data-reveal]');

    if (!('IntersectionObserver' in window)) {
        elementos.forEach((el) => el.classList.add('visible'));
        return;
    }

    const observador = new IntersectionObserver((entradas) => {
        entradas.forEach((entrada) => {
            if (entrada.isIntersecting) {
                entrada.target.classList.add('visible');
                observador.unobserve(entrada.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });

    elementos.forEach((el) => observador.observe(el));
})();