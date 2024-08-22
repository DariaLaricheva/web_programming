<!DOCTYPE html>
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
            <li><a href="logout.php" >Выход</a></1i>
            <li><a href="add_recipe.php">Добавить рецепт</a></1i>

            
          </ul>
        </div>
      </div>
    </nav>
     
  </header>

<section class="category">
    

        <h2 class="text-center"><?php echo $_GET["category"]; ?></h2>
        
        <?php
        
        $host = 'localhost';
        $dbname = 'web_lab2.1';
        $username = 'root';
        $password = '';

        require_once "db.php";
        

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Устанавливаем режим ошибок PDO в исключения
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }

    $category_name = $_GET["category"];

    $query = "SELECT Recipes.recipe_id, Recipes.recipe_title, Recipes.recipe_description, users.username, COALESCE(Likes.like_count, 0) AS like_count
    FROM Recipes
    INNER JOIN Categories ON Recipes.category_id = Categories.category_id
    INNER JOIN users ON Recipes.user_id = users.user_id
    LEFT JOIN Likes ON Recipes.recipe_id = Likes.recipe_id
    WHERE Categories.category_name = ?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$category_name]);


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='recipe'>";
        echo "<h3 class='note-title'>" . $row['recipe_title'] . '</h3>';
        echo "<p class='note-content'>" . $row['recipe_description'] . '</p>';
        echo "<I><p class='note-date'>Автор: " . $row['username'] . '</p></I>';
        
        // Вывод формы для лайков
        echo '<form method="post" action="add_like.php">';
        echo '<input type="hidden" name="recipe_id" value="' . $row['recipe_id'] . '">';
        echo '<input type="hidden" name="category" value="' . $_GET['category'] . '">';
        echo '<div style="display: flex; align-items: center;">';
        echo '<p style="margin-left: 95%;">' . $row["like_count"] . '</p>';
     

        echo '<button type="submit" style="background: none; border: none; text-align: left;">';
        echo '<img src="Like.png" alt="Лайк" width="20" height="20" style="float: right;">';
        echo '</button>';

     
        echo '</div>';
        echo '</form>';
    
        // Запрос комментариев к текущему рецепту
        $comment_query = "SELECT Comments.comment_text, users.username, Comments.timestamp
                          FROM Comments
                          INNER JOIN users ON Comments.user_id = users.user_id
                          WHERE Comments.recipe_id = ?";
        
        $comment_stmt = $pdo->prepare($comment_query);
        $comment_stmt->execute([$row['recipe_id']]);
        
        // Вывод комментариев
        echo '<div class="comments">';
        while ($comment_row = $comment_stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<p class="note-date">' . $comment_row['username'] . ' (' . $comment_row['timestamp'] . '): ' . $comment_row['comment_text'] . '</p>';
        }
        echo '</div>'; // Конец блока комментариев
    
        // Форма для добавления комментария

            echo '<form method="post" action="add_comment.php">';
            echo '<input type="hidden" name="recipe_id" value="' . $row['recipe_id'] . '">';
            echo '<input type="hidden" name="category" value="' . $_GET['category'] . '">';
            echo '<textarea name="comment_text" placeholder="Оставьте ваш комментарий" required style="font-family: Arial, sans-serif; font-size: 12px"></textarea><br>';
            echo '<button class="button" type="submit" style="background-color: #333; color: #fff; border: none; padding: 10px 40px; border-radius: 5px; cursor: pointer; ">Отправить</button>' ;
            echo '</form>' ;

        echo '</div>'; // Конец блока рецепта
    }
    

            ?>


</body> 
</html>