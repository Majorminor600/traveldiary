<?php
session_start();
include 'db.php';

// Проверяем, есть ли идентификатор путешествия в URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// Получаем информацию о путешествии из базы данных
$stmt = $pdo->prepare("SELECT trips.*, users.username FROM trips JOIN users ON trips.user_id = users.id WHERE trips.id = :id");
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$trip = $stmt->fetch();

if (!$trip) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title><?= $trip['location'] ?></title>
    <style>
        .trip-container {
            display: flex;
            margin-top: 20px;
        }
        .trip-image {
            max-width: 400px; /* Ограничение ширины изображения */
            margin-right: 20px; /* Отступ справа от изображения */
        }
        .trip-content {
            max-width: 600px; /* Ограничение ширины контента */
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-5 trip-container">
    <img src="<?= $trip['image'] ?>" class="img-fluid trip-image" alt="<?= $trip['location'] ?>">
    <div class="trip-content">
        <h1><?= $trip['location'] ?></h1>
        <p>Пользователь: <?= $trip['username'] ?></p>
        <p>Стоимость: <?= $trip['cost'] ?> руб.</p>
        <p>Культурные места: <?= $trip['heritage_sites'] ?></p>
        <p>Места для посещения: <?= $trip['places_to_visit'] ?></p>
        <p>Оценка удобства: <?= $trip['comfort_rating'] ?></p>
        <p>Добавлено: <?= $trip['created_at'] ?></p>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
