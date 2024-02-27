<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini-framework</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include __DIR__ . '/../components/navbar.php'; ?>


    <main class="min-vh-100">
        <div class="container-fluid p-5 bg-light text-center">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h1 class="display-1">
                        <?php echo $article['title']; ?>
                    </h1>
                </div>
                <div class="col-12 my-5">
                    <h2 class="fs-3 fst-italic lead">
                        <?php echo $article['subtitle']; ?>
                    </h2>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <p>
                        <?php echo $article['body']; ?>
                    </p>
                </div>
            </div>
        </div>
    </main>


    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>