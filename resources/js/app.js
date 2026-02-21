import './bootstrap';
import Alpine from 'alpinejs';

// ── Theme Manager ────────────────────────────────
window.themeManager = function () {
    return {
        isDark: localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),

        init() {
            this.$watch('isDark', val => {
                localStorage.setItem('theme', val ? 'dark' : 'light');
                document.documentElement.classList.toggle('dark', val);
            });
        },

        toggleTheme() {
            this.isDark = !this.isDark;
        }
    };
};

window.Alpine = Alpine;
Alpine.start();
