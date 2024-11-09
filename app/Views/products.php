<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <title>Document</title>
</head>

<body>
    <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('msg')?>
        </div>
    <?php endif; ?>
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