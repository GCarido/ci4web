<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>name</th>
            <th>description</th>
            <th>quantity</th>
            <th>price</th>
            <th>status</th>
            <th>Action</th>
        </tr>

        <?php foreach ($products as $item): ?>
            <?php extract($item); ?>
            <tr>
                <td> <?= $name ?> </td>
                <td> <?= $description ?> </td>
                <td> <?= $quantity ?> </td>
                <td> <?= $price ?> </td>
                <td> <?= $status ?> </td>
                <td>
                    <a href="/edit/<?= $product_id ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>