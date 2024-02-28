<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CORE: the slim PHP MVC Framework</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #171527;">

    <main style="height:100vh;">
        <div class="container-fluid h-100 text-center text-white">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12">
                    <h1 class="display-2">
                        Welcome to
                    </h1>
                    <img width="350" class="my-5" src="https://www.logolynx.com/images/logolynx/c8/c8f3b76c568f89869d7a0d18d5cd3aec.png" alt="">
                    <h2>A slim PHP <span style="color: #ffa434;">MVC</span> Framework!</h2>
                </div>
            </div>
        </div>
        <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © <?php echo Carbon\Carbon::now()->format('Y'); ?> Made with ♥ by
            <a style="color: #ffa434;" href="">Andrea Mininni & Davide Cariola</a>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>