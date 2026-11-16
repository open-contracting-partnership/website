import { tns } from "tiny-slider";

const $blocks = document.querySelectorAll("[data-block='youtube-shorts']");

if ($blocks.length) {
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

    function createIframe(videoId) {
        const iframe = document.createElement("iframe");
        iframe.className = "youtube-short__iframe";
        iframe.src = `https://www.youtube.com/embed/${videoId}?enablejsapi=1&autoplay=1`;
        iframe.title = "YouTube Short";
        iframe.allow =
            "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
        iframe.allowFullscreen = true;
        iframe.frameBorder = "0";

        return iframe;
    }

    function setupBlock($block) {
        const $items = $block.querySelectorAll("[data-youtube-carousel-item]");

        if (!$items?.length) return;

        // Register any existing iframes (fallback for items without poster)
        $block
            .querySelectorAll("[data-youtube-short-iframe]")
            .forEach((iframe) => registerPlayer(iframe, $block));

        // Handle play button clicks to create iframe lazily
        $block.addEventListener("click", (event) => {
            const button = event.target.closest(
                "[data-youtube-short-play-button]"
            );
            if (!button) return;

            const wrapper = button.closest("[data-youtube-short]");
            if (!wrapper) return;

            // Prevent multiple clicks
            if (wrapper.dataset.videoLoaded === "true") return;
            wrapper.dataset.videoLoaded = "true";

            const iframe = createIframe(button.dataset.videoId);

            wrapper.replaceChildren(iframe);
            registerPlayer(iframe, $block);
        });

        if ($items.length > 1) {
            initializeSlider($block, $items);
        }
    }

    function initializeSlider($block, $items) {
        const $carousel = $block.querySelector("[data-youtube-carousel]");
        const $prevButton = $block.querySelector(
            '[data-youtube-carousel-controls] [rel="prev"]'
        );
        const $nextButton = $block.querySelector(
            '[data-youtube-carousel-controls] [rel="next"]'
        );

        const slider = tns({
            container: $carousel,
            swipeAngle: false,
            prevButton: $prevButton,
            nextButton: $nextButton,
            nav: false,
            speed: 400,
            items: 1,
            gutter: 16,
            loop: false,
            responsive: {
                768: {
                    items: 2,
                },
                1024: {
                    items: 4,
                },
            },
        });

        slider.events.on("transitionEnd", (info) => {
            pauseNonVisibleVideos($items, info.displayIndex);
        });
    }

    // pause video if its slide is not visible
    function pauseNonVisibleVideos($items, visibleIndex) {
        $items.forEach(($item, index) => {
            if (index !== visibleIndex) {
                players.forEach((block, player) => {
                    if (block === $item.closest("[data-block='youtube-shorts']")) {
                        player.pauseVideo();
                    }
                });
            }
        });
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

    $blocks.forEach(($block) => {
        observer.observe($block);
    });
}
