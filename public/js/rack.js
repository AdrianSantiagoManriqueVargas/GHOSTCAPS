// Lógica del rack de nuevos productos (Alpine)
document.addEventListener('alpine:init', () => {
    Alpine.data('rack', (total) => ({
        activo: 0,
        total: total,
        maxVisto: 0,
        arrastrando: false,
        movido: false,
        inicioX: 0,
        desplazamiento: 0,

        ir(i) {
            this.activo = Math.max(0, Math.min(this.total - 1, i));
            if (this.activo > this.maxVisto) {
                this.maxVisto = this.activo;
            }
        },

        empezar(e) {
            if (e.button !== 0) return;
            this.arrastrando = true;
            this.movido = false;
            this.inicioX = e.clientX;
            this.desplazamiento = 0;
        },

        mover(e) {
            if (!this.arrastrando) return;
            this.desplazamiento = e.clientX - this.inicioX;
            if (Math.abs(this.desplazamiento) > 5) this.movido = true;
        },

        soltar() {
            if (!this.arrastrando) return;
            this.arrastrando = false;
            if (this.desplazamiento < -60) this.ir(this.activo + 1);
            else if (this.desplazamiento > 60) this.ir(this.activo - 1);
            this.desplazamiento = 0;
        },
    }));
});