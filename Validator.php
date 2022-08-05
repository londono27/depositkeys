<?php
$key = $_POST['key'];
$_post = json_decode(file_get_contents('php://input'), true);
date_default_timezone_set('America/Mexico_City');
if ($key != '') {
  //$key = $_post['key'];
  if (strlen($key) != 0) {
    $passwordHash = password_hash($key, PASSWORD_DEFAULT);
    $PDO = new PDO('mysql:host=localhost;dbname=Data', 'root', '');
    $result = $PDO->prepare("select val, fecha, duracion from `token`");
    $result->execute();
    $result = $result->fetchAll();
    $res = 'clave incorrecta';
    foreach ($result as $row) {
      $duracion = explode(':', $row['duracion']);
      $t = $duracion[0] * 3600 + $duracion[1] * 60 + $duracion[2];
      $fecha = strtotime($row['fecha']);
      if (password_verify($key, $row['val'])) {
        if ($fecha + $t < time() && $res != 'true') {
          $res = 'clave expirada';
        } else {
          $res = 'true';
        }
      }
    }
    echo $res;
  }
}