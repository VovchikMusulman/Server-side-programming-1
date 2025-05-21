<h1>Популярные книги</h1>

<section class="content">
    <?php foreach ($books as $book): ?>
        <?php if ($book->category_id == 1): ?>
            <article class="book-card">
                <h3><?= htmlspecialchars($book->title) ?></h3>
                <p><strong>Автор:</strong> <?= htmlspecialchars($book->author) ?></p>
                <p><strong>Год издания:</strong> <?= $book->year ?></p>
                <p><strong>Описание:</strong> <?= htmlspecialchars($book->description) ?></p>
            </article>
        <?php endif; ?>
    <?php endforeach; ?>
</section>