<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Дневник путешествий</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="view_trips.php">Просмотр путешествий</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="add_trip.php">Добавить путешествие</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Выйти</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Войти</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Регистрация</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
