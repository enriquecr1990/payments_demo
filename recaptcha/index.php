<?php
  $siteKey = '6LdZ2fMrAAAAAAD8TVIEyC9NYhwgj5908-jFMwhc';
  $apiKey = '6LdZ2fMrAAAAAGfbDLnh2lPno7HJ8oQSySbxfW0r';
  //nuevas que no son ENTERPRISE
  $siteKeyPublic = '6Ld8svkrAAAAAAnWV_2TGVkffumoYpgVly9uwpqg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificador Captcha</title>     
  <script src="https://www.google.com/recaptcha/api.js?render=<?=$siteKeyPublic?>"></script>
</head>
<body>

<fieldset>
  <legend>Formulario captcha</legend>
  <form method="post">
    <label for="usuario">Usuario:</label><input type="text" name="usuario" id="usuario" placeholder="usuario">
    <label for="password">Contraseña:</label><input type="text" name="password" id="password" placeholder="contraseña">
    <button type="button" id="btn_enviar_form">Enviar</button>
    <button type="button">Cancelar</button>
  </form>
</fieldset>


<!-- scritp para lo del captcha -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  $(document).ready(function(){

    $(document).on('click','#btn_enviar_form',function(e){
      e.preventDefault();
      ReCaptcha.validarToken();
    });

  });
  var ReCaptcha = {
    validarToken : function(){
      grecaptcha.ready(function() {
        grecaptcha.execute('<?=$siteKeyPublic?>', {action: 'formulario'}).then(function(token) {
          // Construir datos del formulario + token
          const datos = {
            token: token
          };

          $.ajax({
            url: 'validar.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(datos),
            dataType: 'json',
            success: function(respuesta) {
              if (respuesta.success) {
                alert('Formulario enviado con éxito. Score: ' + respuesta.score);
              } else {
                alert('Falló la validación reCAPTCHA. Score: ' + respuesta.score);
              }
            },
            error: function(err) {
              console.error('Error en AJAX:', err);
              alert('Error al enviar el formulario.');
            }
          });
        });
      });
    }
  };  
</script>


</body>
</html>