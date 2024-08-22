<?php
function connectDB(){
    // Параметры подключения к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web_lab2.1";

// Создание подключения к базе данных
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Проверка соединения
    if ($conn->connect_error) {
         die("Ошибка подключения к базе данных: " . $conn->connect_error);
        }
    return $conn;

}

?>