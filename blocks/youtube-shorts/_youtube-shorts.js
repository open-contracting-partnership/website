import { tns } from "tiny-slider";

const blocks = document.querySelectorAll(".youtube-shorts");

if (blocks.length) {
    let apiReady = null;
    const players = new Map();

    function initializeYouTubeAPI() {
        if (apiReady) return apiReady;

        apiReady = new Promise((resolve, reject) => {
            if (window.YT?.Player) {
                resolve(window.YT);
                return;
            }

            const previousCallback = window.onYouTubeIframeAPIReady;
            window.onYouTubeIframeAPIReady = () => {
                if (previousCallback) previousCallback();
                resolve(window.YT);
            };

            const existingScript = document.querySelector(
                'script[src="https://www.youtube.com/iframe_api"]'
            );
            if (existingScript) {
                return;
            }

            const script = document.createElement("script");
            script.src = "https://www.youtube.com/iframe_api";
            script.onerror = () =>
                reject(new Error("Could not load the YouTube player API."));
            document.head.appendChild(script);
        });

        return apiReady;
    }

    function registerPlayer(iframe, block) {
        initializeYouTubeAPI()
            .then((YT) => {
                const player = new YT.Player(iframe, {
                    events: {
                        onStateChange(event) {
                            if (event.data === YT.PlayerState.PLAYING) {
                                players.forEach((otherBlock, otherPlayer) => {
                                    if (
                                        otherBlock === block &&
                                        otherPlayer !== event.target
                                    ) {
                                        otherPlayer.pauseVideo();
                                    }
                                });
                            }
                        },
                    },
                });
                players.set(player, block);
            })
            .catch((error) => console.error(error));
    }

    function setupBlock(block) {
        const $carousel = block.querySelector("[data-youtube-carousel]");
        const items = $carousel.querySelectorAll(".youtube-shorts__item");

        // Register any existing iframes (fallback for items without poster)
        block
            .querySelectorAll(".youtube-short__iframe")
            .forEach((iframe) => registerPlayer(iframe, block));

        // Handle play button clicks to create iframe lazily
        block.addEventListener("click", (event) => {
            const button = event.target.closest(".youtube-short__play-btn");
            if (!button) return;

            const wrapper = button.closest(".youtube-short");
            if (!wrapper) return;

            // Prevent multiple clicks
            if (wrapper.dataset.videoLoaded === "true") return;
            wrapper.dataset.videoLoaded = "true";

            const iframe = document.createElement("iframe");
            iframe.className = "youtube-short__iframe";
            iframe.src = `https://www.youtube.com/embed/${button.dataset.videoId}?enablejsapi=1&autoplay=1`;
            iframe.title = "YouTube Short";
            iframe.allow =
                "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
            iframe.allowFullscreen = true;
            iframe.frameBorder = "0";

            wrapper.replaceChildren(iframe);
            registerPlayer(iframe, block);
        });

        // Initialize carousel
        if (items.length > 1) {
            const $carousel = block.querySelector("[data-youtube-carousel]");
            const $prevButton = block.querySelector('[data-youtube-carousel-controls] [rel="prev"]');
            const $nextButton = block.querySelector('[data-youtube-carousel-controls] [rel="next"]');

            tns({
                container: $carousel,
                swipeAngle: false,
                prevButton: $prevButton,
                nextButton: $nextButton,
                nav: false,
                speed: 400,
                items: 1,
                gutter: 16,
                responsive: {
                    768: {
                        items: 2,
                    },
                    1024: {
                        items: 4,
                    }
                }
            });
        }
    }

    // Use Intersection Observer to initialize only when block comes into view
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting && !entry.target.dataset.initialized) {
                    entry.target.dataset.initialized = "true";
                    setupBlock(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            rootMargin: "50px",
        }
    );

    blocks.forEach((block) => {
        observer.observe(block);
    });
}
