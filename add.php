<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Подключение к базе данных
    include 'db.php';

    // Получение данных из формы
    $term = mysqli_real_escape_string($mysql, $_POST['term']);
    $definition = mysqli_real_escape_string($mysql, $_POST['definition']);

    // Обработка загрузки изображения
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/Data/img/';
        $imageName = basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            // Добавление записи в базу данных
            $query = "INSERT INTO terms (term, definition, image_path) VALUES ('$term', '$definition', '$imageName')";
            if (mysqli_query($mysql, $query)) {
                echo "<p>Данные успешно добавлены!</p>";
            } else {
                echo "<p>Ошибка добавления данных: " . mysqli_error($mysql) . "</p>";
            }
        } else {
            echo "<p>Ошибка загрузки изображения.</p>";
        }
    } else {
        echo "<p>Пожалуйста, выберите изображение.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить данные</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Добавить данные</h1>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <label for="term">Термин:</label>
        <input type="text" id="term" name="term" required>
        <br><br>
        <label for="definition">Определение:</label>
        <textarea id="definition" name="definition" rows="4" required></textarea>
        <br><br>
        <label for="image">Изображение:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <br><br>
        <button type="submit">Добавить</button>
    </form>
    <br>
    <a href="index.php">Вернуться на главную</a>
</body>
</html>