<div class="container">
    <h1>Добавить новую книгу</h1>

    <?php if (isset($this->errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($this->errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" class="book-form">
        <div class="form-group">
            <label for="title">Название книги:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="author">Автор:</label>
            <input type="text" id="author" name="author" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="year">Год издания:</label>
            <input type="date" id="year" name="year" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Цена (руб.):</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="is_new">Новое издание:</label>
            <input type="checkbox" id="is_new" name="is_new" value="1">
        </div>

        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Добавить книгу</button>
    </form>
</div>