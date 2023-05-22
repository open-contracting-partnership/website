const jumpToContent = document.querySelector('.report-header__jump-to-content');

if (jumpToContent) {
    jumpToContent.addEventListener('click', () => {
        jumpToContent.closest('.block').nextElementSibling.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    });
}
