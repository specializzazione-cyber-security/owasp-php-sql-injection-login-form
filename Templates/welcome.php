<?php

use App\Modules\Csrf;

$token = Csrf::generateToken();
$_SESSION['csrf_token'] = $token;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Hello world!</h1>
    <a href="/article/create">Inserisci articolo</a>

</body>

</html>