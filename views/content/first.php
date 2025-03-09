<div class="container mt-3">
    <div class="row">
        <div class="col-md">
            <google-cast-launcher class="cast-button"></google-cast-launcher>
            <div class="embed-responsive embed-responsive-16by9 mt-3 rounded border border-muted">
                <video class="embed-responsive-item cast-video" controls
                    poster="<?= BASE_URL ?>assets/storage/thumbnails_app/thumbnail_cocomelon.jpg"
                    oncontextmenu="return false;" controlsList="nodownload" playsinline>
                    <source src="<?= BASE_URL ?>assets/storage/videos_app/cocomelon1.mp4" type="video/mp4">
                    Seu navegador não suporta vídeos.
                </video>
            </div>
        </div>
        <div class="col-md">
            <google-cast-launcher class="cast-button"></google-cast-launcher>
            <div class="embed-responsive embed-responsive-16by9 mt-3 rounded border border-muted">
                <video class="embed-responsive-item cast-video" controls
                    poster="<?= BASE_URL ?>assets/storage/thumbnails_app/thumbnail_cocomelon.jpg"
                    oncontextmenu="return false;" controlsList="nodownload" playsinline>
                    <source src="<?= BASE_URL ?>assets/storage/videos_app/cocomelon_songs_for_kids.mp4" type="video/mp4">
                    Seu navegador não suporta vídeos.
                </video>
            </div>
        </div>
    </div>

    <script src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js"></script>

    <script>
        window['__onGCastApiAvailable'] = function(isAvailable) {
            if (isAvailable) {
                setTimeout(initializeCastApi, 500); // Espera um pouco para garantir que a API carregue
            }
        };

        function initializeCastApi() {
            if (typeof cast === "undefined" || typeof cast.framework === "undefined") {
                console.warn("Erro: A API do Chromecast ainda não está disponível.");
                return;
            }

            const context = cast.framework.CastContext.getInstance();
            context.setOptions({
                receiverApplicationId: chrome.cast.media.DEFAULT_MEDIA_RECEIVER_APP_ID,
                autoJoinPolicy: chrome.cast.AutoJoinPolicy.ORIGIN_SCOPED
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const castButtons = document.querySelectorAll(".cast-button");
            const videos = document.querySelectorAll(".cast-video");

            castButtons.forEach((button, index) => {
                button.addEventListener("click", function() {
                    if (typeof chrome === "undefined" || !chrome.cast || !chrome.cast.isAvailable) {
                        alert("Nenhum dispositivo Chromecast encontrado.");
                        return;
                    }

                    const mediaInfo = new chrome.cast.media.MediaInfo(videos[index].querySelector("source").src, "video/mp4");
                    const request = new chrome.cast.media.LoadRequest(mediaInfo);

                    const castSession = cast.framework.CastContext.getInstance().getCurrentSession();
                    if (!castSession) {
                        alert("Por favor, conecte-se a um dispositivo Chromecast antes de transmitir o vídeo.");
                        return;
                    }

                    castSession.loadMedia(request).catch((error) => console.log("Erro ao carregar vídeo:", error));
                });
            });
        });
    </script>
</div>