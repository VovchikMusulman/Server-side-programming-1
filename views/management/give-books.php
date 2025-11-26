<?php /** @var array $readers */ ?>
<?php /** @var array $availableBooks */ ?>
<?php /** @var bool $success */ ?>

<div class="container">
    <h1>Выдача книги читателю</h1>

    <?php if ($success): ?>
        <div class="alert alert-success">Книга успешно выдана читателю!</div>
    <?php endif; ?>

    <form method="post" class="content">
        <input type="hidden" name="csrf_token" value="<?= \Src\Session::get('csrf_token') ?>">
        <div class="form-group">
            <label for="reader_id">Выберите читателя:</label>
            <select id="reader_id" name="reader_id" class="drop-list" required>
                <option value="">Выберите читателя</option>
                <?php foreach ($readers as $reader): ?>
                    <option value="<?= $reader->id ?>">
                        <?= htmlspecialchars($reader->name . ' ' . $reader->lastname . ' (' . $reader->phone . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="book_id">Выберите книгу:</label>
            <select id="book_id" name="book_id" class="drop-list" required>
                <option value="">Выберите книгу</option>
                <?php foreach ($availableBooks as $book): ?>
                    <option value="<?= $book->id ?>">
                        <?= htmlspecialchars($book->title . ' - ' . $book->author . ' (' . $book->year . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Выдать книгу</button>
    </form>
</div>