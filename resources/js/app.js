import './bootstrap';

document.addEventListener('alpine:init', () => {
    Alpine.data('countUp', (target = 0, duration = 1200) => ({
        value: 0,
        start() {
            const startTime = performance.now();
            const animate = (now) => {
                const progress = Math.min((now - startTime) / duration, 1);
                this.value = Math.floor(target * progress);
                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    this.value = target;
                }
            };
            requestAnimationFrame(animate);
        },
    }));
});
