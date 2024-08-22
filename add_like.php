<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipe_id = $_POST['recipe_id'];

    $host = 'localhost';
    $dbname = 'web_lab2.1';
    $username = 'root';
    $password = '';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Устанавливаем режим ошибок PDO в исключения
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }

    $user_id = $_SESSION['user_id'];


    $query = "INSERT INTO Likes (recipe_id, like_count)
    VALUES (?, 1)
    ON DUPLICATE KEY UPDATE like_count = like_count + 1;";
    
    $stmt = $pdo->prepare($query);
    
    if ($stmt->execute([$recipe_id])) {
        $category_name = $_POST['category'];
        header("Location: category.php?category=" . urlencode($category_name));
        exit();
    } else {
        print_r($stmt->errorInfo());
    }

    $pdo = null;
}


?>