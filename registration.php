

<!doctype html>
<html lang="en">
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
    
        <h1 class="text-center">Регистрация</h1>

        <?php 
        require_once 'db.php';
        require_once 'boot.php';

        
        flash(); ?>
        <form class="form" action="registration_process.php" method="POST">


        <fieldset class="account-info">
        
            <label for="username">Логин:</label>
            <input type="text" id="username" name="username" required>
        
        
            <label for="firstname">Имя:</label>
            <input type="text" id="firstname" name="firstname" required>
        
        
            <label for="lastname">Фамилия:</label>
            <input type="text" id="lastname" name="lastname" required>
       
            <label for="email">email:</label>
            <input type="email" id="email" name="email" required>
      
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

        </fieldset>

            <fieldset class="account-action">
            <input type="submit" class="btn" value="Зарегестрироваться">
            </fieldset>

        <!-- ... -->
        </form>    
    </div>
</div>
</div>
</section>
</body>
</html>