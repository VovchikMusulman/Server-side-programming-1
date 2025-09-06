<!doctype html>
<html lang="ru">
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
    <?php if (app()->auth::check()): ?>
        <?php $userRole = app()->auth::user()->role ?? ''; ?>

        <?php if ($userRole === 'librarian' || $userRole === 'admin'): ?>
            <nav>
                <a href="<?= app()->route->getUrl('/add-books') ?>">Добавить книгу</a>
                <a href="<?= app()->route->getUrl('/add-reader') ?>">Добавить читателя</a>
                <a href="<?= app()->route->getUrl('/give-books') ?>">Выдать книгу</a>
                <a href="<?= app()->route->getUrl('/accept-book') ?>">Принять книгу</a>
                <a href="<?= app()->route->getUrl('/readers-books') ?>">Книги у читателей</a>

                <?php if ($userRole === 'admin'): ?>
                    <a href="<?= app()->route->getUrl('/add-librarians') ?>">Добавить библиотекаря</a>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

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
</body>
</html>