<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('msg') ?>
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

    <!-- Button trigger modal -->

    <?php foreach ($products as $item): ?>
        <?php extract($item) ?>
        <button type="button" class="btn btn-primary md" data-bs-toggle="modal" data-bs-target="#exampleModal" data-price="<?= $price ?>" data-description="<?= $description ?>">
            <?= $name ?>
        </button>
    <?php endforeach; ?>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="test1"></p>
                    <input type="text" class="test2">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function(){
        $(".md").click(function(){
            let price = $(this).attr("data-price");
            let description = $(this).attr("data-description");

            $(".test1").text(price);
            $(".test2").val(description);
        });
    });
</script>

</html>