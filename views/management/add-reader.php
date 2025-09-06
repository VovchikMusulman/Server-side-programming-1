<?php /** @var bool $success */ ?>
<div class="container">
    <h1>Добавление читателя</h1>

    <?php if ($success): ?>
        <div class="alert alert-success">Читатель успешно добавлен!</div>
    <?php endif; ?>

    <form method="post" class="reader-form">
        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="lastname">Фамилия:</label>
            <input type="text" id="lastname" name="lastname" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" name="phone" class="form-control" required pattern="[0-9]{10,15}">
        </div>

        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" id="login" name="login" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Добавить читателя</button>
    </form>
</div>