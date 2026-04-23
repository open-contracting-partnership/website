document.addEventListener('alpine:init', () => {
    Alpine.data('alpineStickyCta', function (ctaHash) {
        return {
            open: false,

            get localStorageKey() {
                return `ocp_sticky_cta_is_closed_${ctaHash}`;
            },

            close() {
                window.localStorage.setItem(this.localStorageKey, "true");

                this.open = false;
            },

            init() {
                this.open = window.localStorage.getItem(this.localStorageKey) !== "true";
            }
        }
    });
});
