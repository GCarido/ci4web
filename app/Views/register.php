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
    <div class="container mt-5">
        <div class="d-flex justify-content-center">

            <div class="col-5">
                <h2>Register</h2>
                <?php if (isset($validation)): ?>
                    <div class="alert alert-warning">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
            </div>

            <form action="/store" method="post" class="w-25 d-flex flex-column gap-2">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" value="<?= set_value('name') ?>">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control">
                <label for="">Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control">
                <input type="submit" name="button" class="btn btn-primary" value="Register">
            </form>
        </div>
    </div>
</body>

</html>