<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Хешируем пароль

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Неверные логин или пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Авторизация</title>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-5">
    <h1 class="text-center">Авторизация</h1>
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
        <button type="submit" class="btn btn-primary btn-block">Войти</button>
    </form>
    <div class="text-center mt-3">
        <p>Нет аккаунта? <a href="register.php">Зарегистрируйтесь</a></p>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
