<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $location = $_POST['location'];
    $image = $_POST['image'];
    $cost = $_POST['cost'];
    $heritage_sites = $_POST['heritage_sites'];
    $places_to_visit = $_POST['places_to_visit'];
    $comfort_rating = $_POST['comfort_rating'];

    $stmt = $pdo->prepare("INSERT INTO trips (user_id, location, image, cost, heritage_sites, places_to_visit, comfort_rating) VALUES (:user_id, :location, :image, :cost, :heritage_sites, :places_to_visit, :comfort_rating)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':cost', $cost);
    $stmt->bindParam(':heritage_sites', $heritage_sites);
    $stmt->bindParam(':places_to_visit', $places_to_visit);
    $stmt->bindParam(':comfort_rating', $comfort_rating);
    $stmt->execute();

    header("Location: view_trips.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить путешествие</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-5">
    <h1 class="text-center">Добавить путешествие</h1>
    <form method="POST" class="mt-4">
        <div class="form-group">
            <label for="location">Местоположение:</label>
            <input type="text" name="location" class="form-control" id="location" required>
        </div>
        <div class="form-group">
            <label for="image">Изображение:</label>
            <input type="text" name="image" class="form-control" id="image" required>
        </div>
        <div class="form-group">
            <label for="cost">Стоимость:</label>
            <input type="number" name="cost" class="form-control" id="cost" required>
        </div>
        <div class="form-group">
            <label for="heritage_sites">Места культурного наследия:</label>
            <input type="text" name="heritage_sites" class="form-control" id="heritage_sites" required>
        </div>
        <div class="form-group">
            <label for="places_to_visit">Места для посещения:</label>
            <input type="text" name="places_to_visit" class="form-control" id="places_to_visit" required>
        </div>
        <div class="form-group">
            <label for="comfort_rating">Оценка удобства (1-10):</label>
            <input type="number" name="comfort_rating" class="form-control" id="comfort_rating" min="1" max="10" required>
        </div>
        <button type="submit" class="btn btn-success btn-block">Добавить</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
