<?php

require_once __DIR__.'/boot.php'; // Исправлено подключение файла boot.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Проверка наличия входных данных и защита от SQL-инъекций
    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        $stmt = pdo()->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->rowCount() > 0) {
            flash('Это имя пользователя уже занято.');
            header('Location: registration.php'); // Возврат на форму регистрации
            exit; // Заменил die на exit для остановки выполнения скрипта
        }
    }

// Добавление пользователя в базу данных
    if(isset($_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'])) {
        $username = $_POST['username'];
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля

        $stmt = pdo()->prepare("INSERT INTO users (username, first_name, last_name, email, password_hash) VALUES (:username, :first_name, :last_name, :email, :password_hash)");
        $stmt->execute([
            'username' => $username,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password_hash' => $passwordHash,
        ]);

        header('Location: login.php');
        exit;
    } else {
    // Обработка ошибки - не все данные были переданы
        flash('Пожалуйста, заполните все поля.');
        header('Location: registration.php'); // Возврат на форму регистрации
        exit;
    }
}



?>