<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library MVC</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <nav>
        <a href="<?= app()->route->getUrl('/add-books') ?>">Добавить книгу</a>
        <a href="<?= app()->route->getUrl('/add-reader') ?>">Добавить книгу</a>
        <a href="../managementPages/AddReader.html">Добавить читателя</a>
        <a href="../managementPages/GiveBook.html">Выдать книгу</a>
        <a href="../managementPages/AcceptBook.html">Принять книгу</a>
        <a href="../managementPages/ReadersBooks.html">Книги у читателей</a>
        <a href="../managementPages/GiveHistory.html">Историю выдачи</a>
        <a href="../managementPages/PopularBook.html">Популярные книги</a>
        <a href="../managementPages/AddLibrarians.html">Добавлять библиотекарей</a>
    </nav>
    <div>
        <h2>Library</h2>
        <nav>
            <a href="<?= app()->route->getUrl('/') ?>">Главная</a>
            <a href="<?= app()->route->getUrl('/popular-books') ?>">Популярные книги</a>
            <?php
            if (!app()->auth::check()):
                ?>
                <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
                <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
            <?php
            else:
                ?>
                <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
            <?php
            endif;
            ?>
        </nav>
    </div>
</header>
<main>
    <?= $content ?? '' ?>
</main>
<script src="/public/js/main.js"></script>
</body>
</html>