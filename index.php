<?php
require_once __DIR__.'/boot.php';
require_once 'db.php';

$conn = connectDB();
$user = null;

if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

$query = "SELECT * FROM Categories";
$result = mysqli_query($conn, "SELECT * FROM Categories", MYSQLI_STORE_RESULT);
if ($result === false) {
  die(print_r(mysqli_errors(), true));
}
?>

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

              <?php 

               if ($user) { 
                echo '<li><a  href="logout.php">Выход</a></li>';
                echo '<li><a  href="add_recipe.php">Добавить рецепт</a></li>';
              }else {
                echo '<li><a  href="registration.php">Регистрация</a></li>';
                echo '<li><a  href="login.php">Вход</a></li>';
              }
              ?>
          </ul>
        </div>
      </div>
    </nav>
     
  </header>


<section class="welcome">
  <div class="container-fluid">
    <h2 class="text-center">Добро пожаловать на live in a dormetory</h2>
    <I><p class="text-center">С нашей платформой вы не останетесь голодными в общежитии!</p><I>
  </div>
</section>


<section class="popular-categories">
    
      <h2 class="text-center">Категории</h2>
      <ul>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<a href="category.php?category=' .urlencode($row['category_name']). '" class="cat-cont">'.$row['category_name'].'</a><br>';

        }
        ?>
      </ul>
    <aside class="text-center">
      <img src="image.png" alt="Main picture">
    </aside>
    
</section>
</body>
</html>















