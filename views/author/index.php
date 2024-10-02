<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors List</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <h1>Authors List</h1>
    <a href="index.php?controller=author&action=add">Add New Author</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php foreach($authors as $author): ?>
        <tr>
            <td><?php echo $author->id; ?></td>
            <td><?php echo $author->name; ?></td>
            <td>
                <a href="index.php?controller=author&action=edit&id=<?php echo $author->id; ?>">Edit</a>
                <a href="index.php?controller=author&action=delete&id=<?php echo $author->id; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>