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
      INSERT INTO resumes (item_id, updated, item) VALUES (?, now(), ?)
      ON DUPLICATE KEY UPDATE updated=now(), item=?
    ");
    $item_str = json_encode($item);
    $q->execute(array($item->{'id'}, $item_str, $item_str));
  }
}