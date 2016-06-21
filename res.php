<?php
if (isset($_COOKIE['user_id'])) {
  $q = $db->prepare("SELECT item FROM resumes WHERE item_id=?");
  $q->execute(array($_GET['resume_id']));
  $r = $q->fetch();

  $qd = $db->prepare("SELECT max(updated) last_updated FROM recommendations WHERE resume_id=?");
  $qd->execute(array($_GET['resume_id']));
  $rd = $qd->fetch();

  $item = json_decode($r['item']);?>
  <h1><a href="/resumes">Мои резюме</a>/<?php echo $item->{'title'}?></h1>
  <h4><a href="https://hh.ru/resume/<?php echo $item->{'id'}?>" target="_blank">Ваше резюме на hh.ru</a></h4>
  <h2>Рекомендованные вакансии</h2>
  <div>Последнее обновление было <?php echo getHumanDate($rd['last_updated']);?></div>
  <?php
  $q = $db->prepare("
    SELECT vacancy_id, cast(similarity AS DECIMAL(10,4)) similarity_f, vacancy_title
    FROM recommendations
    WHERE resume_id=? and is_active=1
    ORDER BY similarity_f DESC");
  $q->execute(array($_GET['resume_id']));
  $cnt = 0;?>
  <?php while ($r = $q->fetch()) {?>
    <li class="list-group-item"><span class="badge"><?php echo $r['similarity_f']?></span> <a href="https://hh.ru/vacancy/<?php echo $r['vacancy_id']?>" target="_blank"><?php echo $r['vacancy_title']?></a></li>
  <?php
  $cnt++;
  }?>
  </ul>
  <?php if ($cnt == 0) {?>
    <div class="alert alert-info" role="alert">Подбор рекомендаций в процессе. Это может занять до 15 минут. Вернитесь на страницу позже</div>
  <?php } else {?>
    <div class="alert alert-info" role="alert">Рекомендации постоянно обновляются на основе новых вакансий</div>
  <?php } ?>
<?php } else {?>
  <div class="jumbotron">
    <h1>Гадаем вакансии по вашему резюме</h1>
    <p class="lead">Всё, что вам нужно - авторизоваться и немного подождать, пока сервис автоматически подберет вакансии к вашим резюме, размещенным на hh.ru</p>
    <p><a class="btn btn-lg btn-success" href="https://hh.ru/oauth/authorize?response_type=code&client_id=LOTHHN3BSET0I7IQNF3N5I0362AE1D14I6M74CAIQ5H49F7MT4PLMTVV7JTOA6QF" role="button">Начать</a></p>
  </div>
<?php } ?>