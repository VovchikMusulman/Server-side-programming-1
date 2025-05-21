<h1>Книги</h1>

<section class="content">
    <?php foreach ($books as $book): ?>
        <article class="book-card">
            <h3><?= htmlspecialchars($book->title) ?></h3>
            <p><strong>Автор:</strong> <?= htmlspecialchars($book->author) ?></p>
            <p><strong>Год издания:</strong> <?= $book->year ?></p>
            <p><strong>Описание:</strong> <?= htmlspecialchars($book->description) ?></p>
        </article>
    <?php endforeach; ?>
</section>