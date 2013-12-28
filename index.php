<?php

/**
 * @file
 * This is the index page that outputs the content.
 */

// Load include files.
include 'includes/functions.php';
include 'includes/config.php';

// Get defaults.
$values = instagram_page_get_defaults();

// Get overrides.
$values = instagram_page_get_query($values);

// Build API request urls.
$url = "https://api.instagram.com/v1/users/" . $values['user_id'] . "/media/recent/?access_token=" . $values['access_token'] . "&count=" . $values['count'];
$full_url = "https://api.instagram.com/v1/media/" . $values['id'] . "?access_token=" . $values['access_token'];

// Get info array for all instagram images.
$result = instagram_page_fetch_data($url);
$result = json_decode($result);

// Get info array for primary instagram image.
$full = instagram_page_fetch_data($full_url);
$full = json_decode($full);

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="includes/global.css">
  </head>
  <body>
    <div id="main" class="post">
      <a href="?id=<?php print $full->data->id; ?>">
        <img style="width: 695px;" src="<?php print $full->data->images->standard_resolution->url; ?>" >
      </a>
    </div>

    <?php foreach ($result->data as $post): ?>

      <div class="post">
        <a href="?id=<?php print $post->id; ?>">
          <img style="width: <?php print $values['width']; ?>px; height: <?php print $values['height']; ?>;" src="<?php print $post->images->{$values['quality']}->url; ?>" >
        </a>
      </div>

    <?php endforeach; ?>

  </body>
</html>
