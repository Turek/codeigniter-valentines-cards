<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=341716419269019";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<h1><?php print $card[0]->name; ?></h1>
<p><?php print $card[0]->description; ?></p>

<div class="share">
	<div class="fb-share-button" data-href="<?php print $current_url; ?>" data-type="button_count"></div>
	<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php print $current_url; ?>">Tweet</a>
	<div class="g-plusone" data-size="small" data-annotation="inline" data-width="150" data-href="<?php print $current_url; ?>"></div>
</div>

<h2>Message:</h2>
<p><?php print $message[0]->message; ?></p>
<img src="<?php print $base_url . $card->image; ?>" width="800" />

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
