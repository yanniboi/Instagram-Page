<?php

/**
 * @file
 * This is the index page that outputs the content.
 */

// Load include files.
include 'functions.php';
include 'config.php';

// Get defaults.
$values = instagram_page_get_defaults();

// Get overrides.
$values = instagram_page_get_query($values);

// Build API request urls.
$full_url = "https://api.instagram.com/v1/media/" . $values['id'] . "?access_token=" . $values['access_token'];

// Get info array for primary instagram image.
$full = instagram_page_fetch_data($full_url);
$full = json_decode($full);
$date = DateTime::createFromFormat('U', $full->data->created_time);
$full->data->created_time = $date->format('j M Y');

?>
    <div id="main" class="post" style="width: 690px;">
      <img style="width: 100%;" src="<?php print $full->data->images->standard_resolution->url; ?>" >
      <div class="overlay">
        <h2><?php print $full->data->caption->text; ?></h2>
        <div class="hidden">
          <div class="date">
          <p><?php print $full->data->created_time;?></p>
          </div>
          <?php if (isset($full->data->likes->count) && $full->data->likes->count): ?>
            <div class="likes">
              <span class="like-image"></span>
              <?php foreach ($full->data->likes->data as $like): ?>
                <img src="<?php print $like->profile_picture; ?>" title="<?php print $like->full_name; ?>" />
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if (isset($full->data->comments->count) && $full->data->comments->count): ?>  
            <div class="comments">
              <span class="comment-image"></span>
              <?php foreach ($full->data->comments->data as $comment): ?>
                <img src="<?php print $comment->from->profile_picture; ?>" title="<?php print $comment->from->full_name . ' - \'' . $comment->text . '\''; ?>" />
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
