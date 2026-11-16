const blocks = document.querySelectorAll('.youtube-shorts');

if (blocks.length) {
    let apiReady = null;
    let isInitialized = false;
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

            if (!document.querySelector('script[src="https://www.youtube.com/iframe_api"]')) {
                const script = document.createElement('script');
                script.src = 'https://www.youtube.com/iframe_api';
                script.onerror = () => reject(new Error('Could not load the YouTube player API.'));
                document.head.appendChild(script);
            }
        });

        return apiReady;
    }

    function registerPlayer(iframe, block) {
        initializeYouTubeAPI().then(YT => {
            const player = new YT.Player(iframe, {
                events: {
                    onStateChange(event) {
                        if (event.data === YT.PlayerState.PLAYING) {
                            players.forEach((otherBlock, otherPlayer) => {
                                if (otherBlock === block && otherPlayer !== event.target) {
                                    otherPlayer.pauseVideo();
                                }
                            });
                        }
                    },
                },
            });
            players.set(player, block);
        }).catch(error => console.error(error));
    }

    function setupBlock(block) {
        // Register any existing iframes (fallback for items without poster)
        block.querySelectorAll('.youtube-shorts__iframe').forEach(iframe => registerPlayer(iframe, block));

        // Handle play button clicks to create iframe lazily
        block.addEventListener('click', event => {
            const button = event.target.closest('.youtube-shorts__play-btn');
            if (!button) return;

            const wrapper = button.closest('.youtube-shorts__wrapper');
            if (!wrapper) return;

            // Prevent multiple clicks
            if (wrapper.dataset.videoLoaded === 'true') return;
            wrapper.dataset.videoLoaded = 'true';

            const iframe = document.createElement('iframe');
            iframe.className = 'youtube-shorts__iframe';
            iframe.src = `https://www.youtube.com/embed/${button.dataset.videoId}?enablejsapi=1&autoplay=1`;
            iframe.title = 'YouTube Short';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;
            iframe.frameBorder = '0';
            
            wrapper.replaceChildren(iframe);
            registerPlayer(iframe, block);
        });
    }

    // Use Intersection Observer to initialize only when block comes into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.initialized) {
                entry.target.dataset.initialized = 'true';
                setupBlock(entry.target);
                // Optionally stop observing once initialized
                observer.unobserve(entry.target);
            }
        });
    }, {
        rootMargin: '50px', // Start loading 50px before block enters viewport
    });

    blocks.forEach(block => {
        observer.observe(block);
    });
}
