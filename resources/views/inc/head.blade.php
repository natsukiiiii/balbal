<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146660411-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-146660411-1');
</script>

@if (!Request::is('material/genryo_contact')
  && !Request::is('material/dl_contact')
  && !Request::is('material/sample_contact')
  && !Request::is('contact')
  && !Request::is('genryo_video_key_request'))
  <script type="text/javascript">
  var _trackingid = 'LFT-12000-1';
  (function() {
      var lft = document.createElement('script'); lft.type = 'text/javascript'; lft.async = true;
      lft.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//track.list-finder.jp/js/ja/track.js';
      var snode = document.getElementsByTagName('script')[0]; snode.parentNode.insertBefore(lft, snode);
  })();
  </script>
@endif
