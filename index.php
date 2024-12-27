<?php
include "db.php";

$result = mysqli_query($mysql, "SELECT term, definition, image_path FROM terms");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Набор картинок</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Набор картинок</h1>
    <table>
        <thead>
            <tr>
                <th>Термин</th>
                <th>Определение</th>
                <th>Изображение</th>
             </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['term']); ?></td>
                    <td><?php echo htmlspecialchars($row['definition']); ?></td>
                    <td>
                        <img 
                            src="/Data/img/<?php echo htmlspecialchars($row['image_path']); ?>" 
                            alt="<?php echo htmlspecialchars($row['term']); ?>" 
                            title="<?php echo htmlspecialchars($row['term']); ?>"
                        />
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <div>
        <a href="add.php">Добавить данные</a>
    </div>
</body>
</html>