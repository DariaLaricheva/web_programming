<?php

$host = 'localhost';
$dbname = 'web_lab2.1';
$username = 'root';
$password = '';
 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment_text = $_POST['comment_text'];
    $recipe_id = $_POST['recipe_id'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Устанавливаем режим ошибок PDO в исключения
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }

    $user_id = $_SESSION['user_id'];
    
    $query = "INSERT INTO Comments (comment_text, recipe_id, user_id, timestamp) VALUES (?, ?, ?, NOW())";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$comment_text, $recipe_id, $user_id]);

    if ($stmt === false) {
        print_r($pdo->errorInfo()); // Можно заменить на логирование или другую обработку ошибки
    } else {
        $category_name = $_POST["category"];
        header("Location: category.php?category=" . urlencode($category_name));
        exit();
    }
}


?>