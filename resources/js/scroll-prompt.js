const scrollPrompt = document.querySelector('.scroll-prompt');

if (scrollPrompt) {
    scrollPrompt.addEventListener('click', () => {
        const $parent = scrollPrompt.closest('[data-scroll-prompt-parent]');

        if ($parent) {
            $parent.nextElementSibling.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        }
    });
}
