<?php
if (isset($_COOKIE['user_id'])) {
  $headers = array(
    'Authorization: Bearer ' . $_COOKIE['access_token'],
    'User-Agent: HhRecommendationsSite'
  );
  $resp = curl_get_h("https://api.hh.ru/resumes/mine", $headers);
  $resumes = json_decode($resp);
  foreach($resumes->{'items'} as $item) {
    $q=$db->prepare("
      UPDATE resumes SET is_active=0 WHERE item_id=?
    ");
    $q->execute(array($item->{'id'}));
    $resume = curl_get_h("https://api.hh.ru/resumes/" . $item->{'id'}, $headers);
    $q=$db->prepare("
      INSERT INTO resumes (item_id, updated, item, is_active) VALUES (?, now(), ?, 1)
    ");
    $q->execute(array($item->{'id'}, $resume));
  }
}