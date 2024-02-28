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
                        Tutti gli articoli
                    </h1>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="container my-5">
                    <div class="row justify-content-center">
                        <?php foreach ($articles as $article) : ?>
                            <div class="col-12 col-md-3 my-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $article->title; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $article->subtitle; ?></h6>
                                        <p class="card-text truncate"><?php echo $article->body; ?></p>
                                        <div class="mt-4">
                                            <a href="/article/show?article_id=<?= $article->id ?>" class="btn btn-dark">Leggi</a>
                                            <a href="/article/edit?article_id=<?= $article->id ?>" class="btn btn-warning">Modifica</a>
                                            <form action="/article/destroy?article_id=<?= $article->id ?>" method="POST" class="d-inline">
                                                <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
                                                <button type="submit" class="btn btn-danger">Cancella</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <p class="m-0 small">
                                            <span class="fst-italic">Inserito il: </span>
                                            <?php echo $article->created_at->format('d/m/Y') ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>