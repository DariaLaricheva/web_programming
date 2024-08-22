<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $host = 'localhost';
    $dbname = 'web_lab2.1';
    $username = 'root';
    $password = '';
 
    $recipe_title = $_POST["recipe_title"];
    $recipe_description = $_POST["recipe_description"];
    $category_id = $_POST["category_id"];
   
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // Устанавливаем режим ошибок PDO в исключения
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }

   
    $login = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("INSERT INTO Recipes (recipe_title, recipe_description, category_id, user_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$recipe_title, $recipe_description, $category_id, $user_id]);
        // Перенаправляем пользователя на страницу index.php
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die("Ошибка при добавлении рецепта: " . $e->getMessage());
    }


    $pdo = null;
}


?>