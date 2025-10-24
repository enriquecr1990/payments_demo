<?php
  $siteKey = '6LdZ2fMrAAAAAAD8TVIEyC9NYhwgj5908-jFMwhc';
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Verificador Captcha</title>
     
</head>
<body>

<fieldset>
  <legend>Formulario captcha</legend>
  <form action="/iniciar_sesion.php" method="post">
    <label for="usuario">Usuario:</label><input type="text" name="usuario" id="usuario" placeholder="usuario">
    <label for="password">Contraseña:</label><input type="text" name="password" id="password" placeholder="contraseña">
    <button type="button" class="g-recaptcha" daata-sitekey="<?=$siteKey?>" id="inciar_sesion">Enviar</button>
    <button type="button">Cancelar</button>
  </form>
</fieldset>


<!-- scritp para lo del captcha -->
<script src="https://www.google.com/recaptcha/enterprise.js?render=<?=$siteKey?>"></script>
<script>
  function onSubmitCaptcha(token){
    console.log(token);
    document.getElementById("iniciar_session").submit();
  }
</script>


</body>
</html>