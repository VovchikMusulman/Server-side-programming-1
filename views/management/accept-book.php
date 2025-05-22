<?php /** @var array $books */ ?>
<div class="container">
    <h1>Прием книг от читателей</h1>

    <?php if (isset($success)): ?>
        <div class="alert alert-success">Книга успешно принята!</div>
    <?php endif; ?>

    <?php if (empty($books)): ?>
        <div class="alert alert-info">Нет книг для возврата</div>
    <?php else: ?>
        <table class="table">
            <thead>
            <tr>
                <th>№</th>
                <th>Книга</th>
                <th>Читатель</th>
                <th>Дата выдачи</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $index => $book): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <strong><?= htmlspecialchars($book->title) ?></strong><br>
                        <em><?= htmlspecialchars($book->author) ?></em>
                    </td>
                    <td>
                        <?= htmlspecialchars($book->reader->name ?? '') ?>
                        <?= htmlspecialchars($book->reader->surname ?? '') ?>
                    </td>
                    <td>
                        <?= $book->issue_date ? date('d.m.Y', strtotime($book->issue_date)) : 'Не указана' ?>
                    </td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="book_id" value="<?= $book->id ?>">
                            <button type="submit" class="btn btn-sm btn-primary">Принять книгу</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<style>
    .table {
        display: flex;
        flex-direction: column;
        background-color: #202020;
        border-radius: 5px;
        width: 1200px;
        padding: 30px;
    }

    tr{
        gap: 30px;
        display: flex;
    }

    th {
        width: 200px;
        height: 30px;
    }

    td {
        width: 200px;
        height: 30px;
        background-color: #D0CDCD;
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
    }

    form {
        padding: 0;
    }

    button {
        width: 200px !important;
        height: 30px;
        background-color: #D0CDCD;
        border-radius: 5px;
        border: none;
    }

</style>