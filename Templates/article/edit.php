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
                        Aggiorna articolo
                    </h1>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <form action="/article/update?article_id=<?= $article->id ?>" method="POST" class="rounded border shadow p-5">
                        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">

                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo $article->title; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Sottotitolo</label>
                            <input type="text" name="subtitle" id="subtitle" class="form-control" value="<?php echo $article->subtitle; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Contenuto</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control"><?php echo $article->body; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark">Modifica articolo</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>