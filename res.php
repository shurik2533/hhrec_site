<?php
if (isset($_COOKIE['user_id'])) {
  $q = $db->prepare("SELECT item FROM resumes WHERE item_id=?");
  $q->execute(array($_GET['resume_id']));
  $r = $q->fetch();
  $item = json_decode($r['item']);
}
?>
<h1><?php echo $item->{'title'}?></h1>
<h4><a href="https://hh.ru/resume/<?php echo $item->{'id'}?>" target="_blank">Ваше резюме на hh.ru</a></h4>
<h2>Рекомендованные вакансии</h2>
<div class="alert alert-info" role="alert">Подбор рекомендаций в процессе. Это может занять до 60 минут. Вернитесь на страницу позже</div>