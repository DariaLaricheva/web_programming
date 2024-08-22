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
 
<section class="add-lesson">
        <div class="container">
            <h2 class="text-center">Добавить новый рецепт</h2>

            <form class="form" action="add_recipe_process.php"method="POST">

            <fieldset class="account-info">
        <label for="recipe_title">Название рецепта:</label>
        <input type="text" id="recipe_title" name="recipe_title" required>


        <label for="recipe_description">Описание рецепта:</label>
        <textarea id="recipe_description" name="recipe_description"></textarea>


        <label for="category_id">Категория:</label>


        <select id="category id" name="category_id">
        <?php
        

        $pdo = new PDO('mysql:host=localhost;dbname=web_lab2.1', 'root', '');
        $query = "SELECT * FROM Categories";
        $result = $pdo->query($query);
        //$result = mysqli_query($conn, "SELECT * FROM Categories", MYSQLI_USE_RESULT);

        $options = '';
        if ($result !== false) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $category_id = htmlspecialchars($row['category_id']);
                $category_name = htmlspecialchars($row['category_name']);
                $options .= '<option value="' . $category_id . '">' . $category_name . '</option>';
    }
}
        echo $options; 
        ?>
        </select><br>

</fieldset>
        <fieldset class="account-action">

        <input type="submit" class="btn" value="Добавить рецепт">
        </fieldset>
        </form>
        </div>
        
        </section>

</body>
</html>