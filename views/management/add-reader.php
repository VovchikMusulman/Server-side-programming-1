<div class="management-container">
    <h1>Добавление нового читателя</h1>

    <form method="post" class="management-form">
        <div class="form-group">
            <label>Фамилия:</label>
            <input type="text" name="surname" required class="form-control">
        </div>

        <div class="form-group">
            <label>Имя:</label>
            <input type="text" name="name" required class="form-control">
        </div>

        <div class="form-group">
            <label>Отчество:</label>
            <input type="text" name="patronymic" class="form-control">
        </div>

        <div class="form-group">
            <label>Телефон:</label>
            <input type="tel" name="phone" required class="form-control">
        </div>

        <div class="form-group">
            <label>Адрес:</label>
            <input type="text" name="address" required class="form-control">
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label>Дата рождения:</label>
            <input type="date" name="birth_date" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Добавить читателя</button>
    </form>
</div>