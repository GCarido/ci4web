<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?=base_url('/update')?>" method="POST">
        <input type="hidden" name="product_id" value="<?= $products['product_id']?>">
        <label for="">Name: </label>
        <input type="text" name="name" value="<?= $products['name']?>">
        <br>
        <label for="">Description: </label>
        <input type="text" name="description" value="<?= $products['description']?>">
        <br>
        <label for="">Quantity </label>
        <input type="text" name="quantity" value="<?= $products['quantity']?>">
        <br>
        <label for="">Price: </label>
        <input type="text" name="price" value="<?= $products['price']?>">
        <br>
        <label for="">Status: </label>
        <select name="status" id="">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        <input type="submit" name="active" value="Submit">
    </form>
</body>
</html>