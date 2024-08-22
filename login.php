<?php

require_once __DIR__.'/boot.php';

if (check_auth()) {
    header('Location: /');
    die;
}
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Recipes</title>
        
        <link rel="stylesheet" href="style.css" />
    
    </head>
<body>

<header>
    <nav class="navbar">
      <div class="container">     
        <a href="#" class="navbar-brand">Live in a dormetory</a>

        <div class="navbar-wrap">
          <ul class="navbar-menu">
            
            <li><a  href="index.php">Главная</a></li>
            <li><a  href="registration.php">Регистрация</a></li>
            <li><a  href="login.php">Вход</a></li>
            
          </ul>
        </div>
      </div>
    </nav>
     
  </header>

    <section class="registration-form">
        <div class="container">
            <h2 class="text-center">Вход</h2>

            <?php flash() ?>

            <form class="form" action="do_login.php" method="post">
            <fieldset class="account-info">

                <label for="username">Логин:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>



            </fieldset>
            <fieldset class="account-action">
                
                <input class="btn" type="submit" value="Войти">
                </fieldset>

            </form>
        </div>
    </section>
</body>
</html>