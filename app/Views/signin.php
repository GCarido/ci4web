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
                <h2>Signin</h2>
                <?php if (session()->getFlashdata('msg')): ?>
                    <?php
                        $msg = session()->getFlashdata('msg');
                        $alertClass = session()->getFlashdata('msg_type') === 'success' ? 'alert-success' : 'alert-danger';
                    ?>
                    <div class="alert <?= $alertClass ?>">
                        <?= $msg ?>
                    </div>
                <?php endif; ?>
            </div>

            <form action="/auth" method="post" class="w-25 d-flex flex-column gap-2">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control mb-3">
                <input type="submit" name="button" class="btn btn-primary" value="Login">
            </form>
        </div>
    </div>
</body>

</html>