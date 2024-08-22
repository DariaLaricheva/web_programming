<?php
require_once 'db.php';
require_once __DIR__.'/boot.php';



// проверяем наличие пользователя с указанным юзернеймом
$stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
$stmt->execute(['username' => $_POST['username']]);
if (!$stmt->rowCount()) {
    flash('Пользователь с такими данными не зарегистрирован');
    header('Location: login.php');
    die;
}
$user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user_id'] = $user['user_id'];
    header('Location: index.php');
    die;

header('Location: index.php');


?>