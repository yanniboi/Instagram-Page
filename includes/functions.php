<?php

/**
 * @file
 * This file stores the processing functions.
 */

/**
 * Returns a json object from an API request.
 */
function instagram_page_fetch_data($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 20);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}


/**
 * Override defaults with page query parameters.
 */
function instagram_page_get_query(&$values) {
  if ($_GET['count']) {
    $values['count'] = $_GET['count'];
  }

  if ($_GET['width']) {
    $values['width'] = $_GET['width'];
  }

  if ($_GET['height']) {
    $values['height'] = $_GET['height'];
  }

  if ($_GET['id']) {
    $values['id'] = $_GET['id'];
  }

  if ($values['width'] > 340) {
    $values['quality'] = 'standard_resolution';
  }

  return $values;
}
