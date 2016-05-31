<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HH Recommendations</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jumbotron-narrow.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="/">Home</a></li>
            <li role="presentation"><a href="https://dev.hh.ru">HH API</a></li>
            <li role="presentation"><a href="https://hh.ru">hh.ru</a></li>
            <?php if (isset($_COOKIE['myname'])) {?>
              <li role="presentation"><a href="/resumes">Резюме</a></li>
              <li role="presentation" class="active"><a href="/exit">Выйти<span class="badge"><?php echo $_COOKIE['myname']?></span></a></li>
            <?php }?>
          </ul>
        </nav>
        <h3 class="text-muted">HH Recommendations</h3>
      </div>

      <?php
      if (isset($_GET['page']) && $_GET['page']=='resumes') {
        include_once('ress.php');
      } elseif (isset($_GET['page']) && $_GET['page']=='resume') {
        include_once('res.php');
      } else {
        include_once('first.php');
      }
      ?>

      <footer class="footer">
        <p>2016 Shurik2533</p>
      </footer>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
