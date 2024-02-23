<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>CREA ARTICOLO</h1>
    <div>
        <form action="/article/store" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div>
                <input type="text" name="title">
                <input type="text" name="subtitle">
                <textarea name="body" cols="30" rows="10"></textarea>
                <button type="submit">Crea</button>
            </div>
        </form>
    </div>

</body>

</html>