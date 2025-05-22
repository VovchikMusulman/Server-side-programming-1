<?php /** @var bool $success */ ?>
<div class="container">
    <h1>Добавление библиотекаря</h1>

    <?php if ($success): ?>
        <div class="alert alert-success">Библиотекарь успешно добавлен!</div>
    <?php endif; ?>

    <form method="post" class="librarian-form">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" id="login" name="login" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Добавить библиотекаря</button>
    </form>
</div>