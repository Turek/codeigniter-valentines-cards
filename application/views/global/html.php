<!DOCTYPE html>
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <title><?php print $title; ?></title>
  <base href="<?php print $base_url; ?>" />
  <meta name="viewport" content="initial-scale=1">
  <link rel="stylesheet" href="<?php print $base_url; ?>assets/css/styles.css" />
  <script type="text/javascript"> var my_base_url = '<?php print $base_url; ?>'; </script>
  <!-- for Google -->
  <meta name="description" content="<?php print $meta_description; ?>" />
  <meta name="keywords" content="<?php print $meta_keywords; ?>" />
  <meta name="author" content="" />
  <meta name="copyright" content="" />
  <meta name="application-name" content="" />
  <!-- for Facebook -->          
  <meta property="og:title" content="<?php print $meta_title; ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="<?php print $meta_image; ?>" />
  <meta property="og:url" content="<?php print $current_url; ?>" />
  <meta property="og:description" content="<?php print $meta_description; ?>" />
  <!-- for Twitter -->          
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="<?php print $meta_title; ?>" />
  <meta name="twitter:description" content="<?php print $meta_description; ?>" />
  <meta name="twitter:image" content="<?php print $meta_image; ?>" />
</head>
<body>
  <div id="wrapper">
    <div class="page">
      <?php echo $this->load->view($current_view_file); ?>
    </div>
  </div>
  <script src="<?php print $base_url; ?>assets/js/scripts.js"></script>
</body>
</html>