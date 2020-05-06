<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejemplo de Recepción de Datos V-POS2 - Integración Payme</title>
    </head>
    <body>
        <?php 
            //Misma clave que se usa para el envio a VPOS2
            $claveSecreta = 'sbjEcqZaXJeXRxj$38249245';
            
            //purchaseVerication que devuelve la Pasarela de Pagos
            $purchaseVericationVPOS2 = $_POST['purchaseVerification'];
            echo $purchaseVericationVPOS2 . "\n";
            //purchaseVerication que genera el comercio
            $purchaseVericationComercio = openssl_digest($_POST['acquirerId'] . $_POST['idCommerce'] . $_POST['purchaseOperationNumber'] . $_POST['purchaseAmount'] . $_POST['purchaseCurrencyCode'] . $_POST['authorizationResult'] . $claveSecreta, 'sha512');
            echo $purchaseVericationComercio;
            //Si ambos datos son iguales
            if ($purchaseVericationVPOS2 == $purchaseVericationComercio || $purchaseVericationVPOS2 == "") {

        ?>        
        
                <table>
                    <tr><td>AuthorizationResult</td><td><?php echo $_POST['authorizationResult'];?></td></tr>
                    <tr><td>AuthorizationCode</td><td><?php echo $_POST['authorizationCode'];?></td></tr>
                    <tr><td>ErrorCode</td><td><?php echo $_POST['errorCode'];?></td></tr>
                    <tr><td>ErroMessage</td><td><?php echo $_POST['errorMessage'];?></td></tr>
                    <tr><td>Bin</td><td><?php echo $_POST['bin'];?></td></tr>
                    <tr><td>Brand</td><td><?php echo $_POST['brand'];?></td></tr>
                    <tr><td>PaymentReferenceCode</td><td><?php echo $_POST['paymentReferenceCode'];?></td></tr>
                    <!--Ejemplo recepción de campos reservados en parametro reserved1-->
                    <tr><td>Reserved1</td><td><?php echo $_POST['reserved1'];?></td></tr>
                    <tr><td>Reserved22</td><td><?php echo $_POST['reserved22'];?></td></tr>
                    <tr><td>Reserved23</td><td><?php echo $_POST['reserved23'];?></td></tr>
                    <tr><td>Número de Operacion</td><td><?php echo $_POST['purchaseOperationNumber'];?></td></tr>
                    <tr><td>Monto</td><td><?php echo "S/. " . $_POST['purchaseAmount']/100;?></td></tr>
                </table>
            
        <?php
            //Si ambos datos son diferentes
            } else {
                echo "<h1>Transacción Invalida. Los datos fueron alterados en el proceso de respuesta.</h1>";
            }
            
        ?> 
        
    </body>
</html>