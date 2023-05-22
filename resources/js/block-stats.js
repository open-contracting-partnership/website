import { CountUp } from 'countup.js';

class StatObserver {
    constructor(selector, options) {
        if (!selector) {
            return;
        }

        this.selector = selector;
        this.options = options ? options : {};

        this.scrollTrigger();
    }

    scrollTrigger() {
        const targets = document.querySelectorAll(this.selector);

        [...targets].forEach((element) => {
            this.addObserver(element);
        });
    }

    addObserver(element) {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    this.startCounting(element);
                    observer.unobserve(entry.target);
                }
            });
        }, this.options);

        observer.observe(element);
    }

    startCounting(element) {
        let decimalPlaces = 0;

        if (element.dataset.value.includes('.')) {
            decimalPlaces = element.dataset.value.split('.')[1].length;
        }

        var countUp = new CountUp(element, element.dataset.value, {
            decimalPlaces,
            duration: 3
        });
        countUp.start();
    }
}

new StatObserver('.stat__value', { threshold: 1 });
