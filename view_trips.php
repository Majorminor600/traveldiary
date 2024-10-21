<?php
session_start();
include 'db.php';

$stmt = $pdo->query("SELECT trips.*, users.username FROM trips JOIN users ON trips.user_id = users.id");
$trips = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Путешествия других пользователей</title>
    <style>
        .trip-card {
            margin-bottom: 20px;
        }
        .trip-image {
            max-height: 200px; /* Ограничение высоты изображений */
            object-fit: cover;  /* Корректное отображение изображений */
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-5">
    <h1>Путешествия других пользователей</h1>
    <div class="row">
        <?php foreach ($trips as $trip): ?>
        <div class="col-md-4">
            <div class="card trip-card">
                <img src="<?= $trip['image'] ?>" class="card-img-top trip-image" alt="<?= $trip['location'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $trip['location'] ?></h5>
                    <p class="card-text">Пользователь: <?= $trip['username'] ?></p>
                    <p class="card-text">Стоимость: <?= $trip['cost'] ?> руб.</p>
                    <p class="card-text">Культурные места: <?= $trip['heritage_sites'] ?></p>
                    <p class="card-text">Места для посещения: <?= $trip['places_to_visit'] ?></p>
                    <p class="card-text">Оценка удобства: <?= $trip['comfort_rating'] ?></p>
                    <a href="trip.php?id=<?= $trip['id'] ?>" class="btn btn-primary">Подробнее</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
