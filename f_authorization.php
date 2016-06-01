<?php
if (isset($_GET['code'])) {
  $server_output = curl_post(
    "https://hh.ru/oauth/token",
    "grant_type=authorization_code&client_id=".$client_id."&client_secret=".$client_secret."&code=".$_GET['code']);

  $token_json = json_decode($server_output);

  $headers = array(
    'Authorization: Bearer ' . $token_json->{'access_token'},
    'User-Agent: HhRecommendationsSite'
  );

  $resp = curl_get_h("https://api.hh.ru/me", $headers);
  $me = json_decode($resp);
  setcookie("access_token", $token_json->{'access_token'}, time()+$token_json->{'expires_in'});
  setcookie("refresh_token", $token_json->{'refresh_token'}, time()+$token_json->{'expires_in'});
  setcookie("user_id", $me->{'id'}, time()+$token_json->{'expires_in'});
  setcookie("myname", $me->{'first_name'} . ' ' . $me->{'last_name'}, time()+$token_json->{'expires_in'});
  header('Location: /resumes');
} else if (isset($_GET['page']) && $_GET['page']=='exit') {
  // unset cookies
  var_dump($_SERVER['HTTP_COOKIE']);
  if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
      $parts = explode('=', $cookie);
      $name = trim($parts[0]);
      setcookie($name, '', time()-1000);
      setcookie($name, '', time()-1000, '/');
    }
  }
  //header('Location: /');
}





