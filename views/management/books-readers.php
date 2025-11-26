<?php /** @var array $books */ ?>

<div class="container">
    <h1>Книги у читателей</h1>

    <?php if ($books->isEmpty()): ?>
        <div class="alert alert-info">В настоящее время нет выданных книг</div>
    <?php else: ?>
        <table class="table">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Название книги</th>
                <th>Автор</th>
                <th>Цена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $index => $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book->reader->name) ?></td>
                    <td><?= htmlspecialchars($book->reader->lastname) ?></td>
                    <td><?= htmlspecialchars($book->title) ?></td>
                    <td><?= htmlspecialchars($book->author) ?></td>
                    <td><?= htmlspecialchars($book->price) ?> руб.</td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="csrf_token" value="<?= \Src\Session::get('csrf_token') ?>">
                            <input type="hidden" name="book_id" value="<?= $book->id ?>">
                            <button type="submit" class="accept-button">Принять книгу</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>