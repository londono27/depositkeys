<?php
$errores = [];
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['login']) {
        header('Location: Keys.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet" />
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

<div class="logo">
    <a class="logo" href="index.php">
      <img src="img/door-lock.png">
    </a>
    <h1>Deposit<span>Keys</span></h1>
  </div>

    <form action="index.php" method="post">
        <h2>Clave Creada Correctamente, la clave llegara a tu correo.</h2>
        <h2>Gracias por usar DepositKeys.</h2>
    </form>

</body>

</html>