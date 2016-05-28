<div class="jumbotron">
  <?php
  if (isset($_COOKIE['user_id'])) {?>
    <p><a class="btn btn-lg btn-success" href="/resumes" role="button">Мои резюме</a></p>
  <?php } else {?>
    <h1>Гадаем вакансии по вашему резюме</h1>
    <p class="lead">Всё, что вам нужно - авторизоваться и немного подождать, пока сервис автоматически подберет вакансии к вашим резюме, размещенным на hh.ru</p>
    <p><a class="btn btn-lg btn-success" href="https://hh.ru/oauth/authorize?response_type=code&client_id=LOTHHN3BSET0I7IQNF3N5I0362AE1D14I6M74CAIQ5H49F7MT4PLMTVV7JTOA6QF" role="button">Начать</a></p>
  <?php }
  ?>
</div>