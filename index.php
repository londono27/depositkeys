<?php
$errores = [];
if (isset($_SESSION['usuario'])) {
  if ($_SESSION['login']) {
    header('Location: Keys.php');
    exit();
  }
} else {
  if ($_POST) {
    $user = $_POST['user'];
    $pass = $_POST['q'];
    $PDO = new PDO('mysql:host=sql10.freesqldatabase.com;dbname=sql10512547', 'sql10512547', 'W8PvTUG888');
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
      header('Location: Keys.php');
      exit();
    } else {
      $errores[] = 'El password es incorrecto';
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
    <a class="logo" href="index.php">
      <img src="img/door-lock.png">
    </a>
    <h1>Deposit<span>Keys</span></h1>
  </div>
  <form action="index.php" method="post">
    <div class="login">
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
    </div>
    <?php foreach ($errores as $error) : ?>
      <div class="alerta">
        <?php echo $error; ?>
      </div>
    <?php endforeach; ?>
  </form>
  <script src="js/Login.js"></script>
</body>

</html>