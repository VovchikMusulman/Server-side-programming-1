<?php /** @var \Src\View $this */ ?>
<h1>Выдача книг</h1>

<?php if ($this->success): ?>
    <div class="alert alert-success">Книга успешно выдана!</div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="book_id">Выберите книгу:</label>
        <select name="book_id" id="book_id" class="form-control" required>
            <option value="">-- Выберите книгу --</option>
            <?php foreach ($books as $book): ?>
                <option value="<?= $book->id ?>">
                    <?= htmlspecialchars($book->title) ?> (<?= htmlspecialchars($book->author) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="reader_id">Выберите читателя:</label>
        <select name="reader_id" id="reader_id" class="form-control" required>
            <option value="">-- Выберите читателя --</option>
            <?php foreach ($readers as $reader): ?>
                <option value="<?= $reader->id ?>">
                    <?= htmlspecialchars($reader->name) ?> (№ <?= $reader->library_card ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Выдать книгу</button>
</form>