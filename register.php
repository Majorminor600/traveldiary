<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    
    try {
        $stmt->execute();
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        $error = "Ошибка: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Регистрация</title>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-5">
    <h1 class="text-center">Регистрация</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" class="mt-4">
        <div class="form-group">
            <label for="username">Логин:</label>
            <input type="text" name="username" class="form-control" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
    </form>
    <div class="text-center mt-3">
        <p>Уже есть аккаунт? <a href="login.php">Войдите</a></p>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
