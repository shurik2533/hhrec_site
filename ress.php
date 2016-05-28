<?php
if (isset($_COOKIE['user_id'])) { ?>
  <h1>Мои резюме</h1>
  <?php
  $headers = array(
    'Authorization: Bearer ' . $_COOKIE['access_token'],
    'User-Agent: HhRecommendationsSite'
  );
  $resp = curl_get_h("https://api.hh.ru/resumes/mine", $headers);
  $resumes = json_decode($resp);
  foreach($resumes->{'items'} as $item) {?>
    <div><h3><a href="/resume/<?php echo $item->{'id'};?>"><?php echo $item->{'title'};?></a></h3></div>
  <?php } ?>
<?php } else {?>
  <div class="jumbotron">
    <h1>Гадаем вакансии по вашему резюме</h1>
    <p class="lead">Всё, что вам нужно - авторизоваться и немного подождать, пока сервис автоматически подберет вакансии к вашим резюме, размещенным на hh.ru</p>
    <p><a class="btn btn-lg btn-success" href="https://hh.ru/oauth/authorize?response_type=code&client_id=LOTHHN3BSET0I7IQNF3N5I0362AE1D14I6M74CAIQ5H49F7MT4PLMTVV7JTOA6QF" role="button">Авторизоваться</a></p>
  </div>
<?php }
?>