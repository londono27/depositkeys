<?php
if (isset($_SESSION['usuario'])) {
  if ($_SESSION['login']) {
    header('Location: keys.php');
    exit();
  }
} else {
  if ($_POST) {
    $user = $_POST['user'];
    $pass = $_POST['q'];
    $PDO = new PDO('mysql:host=sql10.freesqldatabase.com;dbname=sql10511022', 'sql10511022', 'iWKPN2MgW1');
    $result = $PDO->prepare("select id, email from `users` where username = :user and pass = :pass");
    $result->execute(array(':user' => $user, ':pass' => $pass));
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $result = $result->fetch();
    if ($result) {
      session_start();
      $_SESSION['usuario'] = $user;
      $_SESSION['idusuario'] = $result['id'];
      $_SESSION['email'] = $result['email'];
      $_SESSION['login'] = true;
      header('Location: keys.php');
      exit();
    } else {
      echo 'Usuario o contraseña incorrectos';
    }
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
  <img src="img/door-lock.png">
  <h1>Deposit<span>Keys</span></h1>
  </div>

  <form action="index.php" method="post">
    <div class="fila">
      <label for="usuario">Nombre de usuario: </label>
      <input type="text" name="user" id="usuario">
    </div>
    <div class="fila">
      <label for="pass">Contraseña:</label>
      <input type="password" name="pass" id="pass">
      <input type="hidden" name="q">
    </div>
    <div>
      <input type="submit" class='btn' value="Aceptar">
      <h2 class="btn" id="signup">Registrarse</h2>
    </div>
  </form>
  <script src="js/Login.js"></script>
</body>

</html>