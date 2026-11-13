const blocks = document.querySelectorAll('.youtube-shorts');

if (blocks.length) {
    const players = new Map();
    const apiReady = new Promise((resolve, reject) => {
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

    function registerPlayer(iframe, block) {
        apiReady.then(YT => {
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

    blocks.forEach(block => {
        block.querySelectorAll('.youtube-shorts__iframe').forEach(iframe => registerPlayer(iframe, block));

        block.addEventListener('click', event => {
            const button = event.target.closest('.youtube-shorts__play-btn');
            if (!button) return;

            const wrapper = button.closest('.youtube-shorts__wrapper');
            const iframe = document.createElement('iframe');
            iframe.className = 'youtube-shorts__iframe';
            iframe.src = `https://www.youtube.com/embed/${button.dataset.videoId}?enablejsapi=1&autoplay=1`;
            iframe.title = 'YouTube Short';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;
            wrapper.replaceChildren(iframe);
            registerPlayer(iframe, block);
        });
    });
}
