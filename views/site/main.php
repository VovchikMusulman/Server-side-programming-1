<h1>Книги</h1>
<?php
$baseUrl = '/Server-side-programming-1/public';
?>
<section class="content">
    <?php foreach ($books as $book): ?>
        <article class="book-card">
            <h3><?= htmlspecialchars($book->title) ?></h3>
            <?php if (!empty($book->image)): ?>
                <img src="<?= $baseUrl . $book->image ?>" alt="Обложка книги">
            <?php else: ?>
                <p>Обложка отсутствует</p>
            <?php endif; ?>
            <p><strong>Автор:</strong> <?= htmlspecialchars($book->author) ?></p>
            <p><strong>Год издания:</strong> <?= $book->year ?></p>
            <p><strong>Цена:</strong> <?= htmlspecialchars($book->price) ?></p>
            <p><strong>Описание:</strong> <?= htmlspecialchars($book->description) ?></p>
            <?php if ($book->is_new == 1): ?>
                <p><strong>Новое издание</strong></p>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</section>