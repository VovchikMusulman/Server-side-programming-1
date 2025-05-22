<div class="container">
    <h1>Книги у читателей</h1>

    <?php if (empty($books)): ?>
        <div class="alert alert-info">Нет выданных книг</div>
    <?php else: ?>
        <table class="table">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Дата выдачи</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $index => $book): ?>
                <?php if ($book->reader): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($book->reader->name ?? '') ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($book->reader->surname ?? '') ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($book->title) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($book->author) ?>
                        </td>
                        <td>
                            <?= $book->issue_date ? date('d.m.Y', strtotime($book->issue_date)) : 'Не указана' ?>
                        </td>
                    </tr>
                <?php endif; ?>
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

</style>