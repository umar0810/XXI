<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<!-- Or if you want a more recent alpha version -->
<!-- <script src="https://cdn.jsdelivr.net/npm/hls.js@alpha"></script> -->
<video id="video" controls></video>
<script>
  var video = document.getElementById('video');
  var videoSrc = 'https://goantri.com/hls/f5548554-ddb7-43c3-a550-7ce612183693.m3u8';
  if (Hls.isSupported()) {
    var hls = new Hls();
    hls.loadSource(videoSrc);
    hls.attachMedia(video);
    hls.on(Hls.Events.MANIFEST_PARSED, function() {
      video.play();
    });
  }
  else if (video.canPlayType('application/vnd.apple.mpegurl')) {
    video.src = videoSrc;
    video.addEventListener('loadedmetadata', function() {
      video.play();
    });
  }
</script>
