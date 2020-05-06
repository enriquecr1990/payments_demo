<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejemplo de Envío de Datos V-POS2 - Integración Payme</title>
        <script type="text/javascript" src="https://integracion.alignetsac.com/VPOS2/js/modalcomercio.js" ></script>
    </head>
    <body>
        <?php
            //Parametros Configuración
            $acquirerId = '119';
            $idCommerce = '10498';
            $purchaseOperationNumber = '11000200'; //ECOMERCE TATOO EXPEDITIONS
            $purchaseAmount = '78';
            $purchaseCurrencyCode = '840';
			
            //Clave SHA-2 de VPOS2
            $claveSecreta = 'sbjEcqZaXJeXRxj$38249245';
			
            //VERSION PHP >= 5.3
            //echo openssl_digest('', 'sha512');
            //VERSION PHP < 5.3
            //echo hash('sha512', '$acquirerId . $idCommerce . $purchaseOperationNumber . $purchaseAmount . $purchaseCurrencyCode . $claveSecreta');
            $purchaseVerification = openssl_digest($acquirerId . $idCommerce . $purchaseOperationNumber . $purchaseAmount . $purchaseCurrencyCode . $claveSecreta, 'sha512');                       
        ?>
        <!--Envío de parametros a V-POS2-->
        <form name="f1" id="f1" action="#" method="post" class="alignet-form-vpos2">
            <table>
                <tr><td>acquirerId</td><td><input type="text" name ="acquirerId" value="<?php echo $acquirerId; ?>" /></td></tr>
                <tr><td>idCommerce</td><td> <input type="text" name ="idCommerce" value="<?php echo $idCommerce; ?>" /></td></tr>
                <tr><td>purchaseOperationNumber </td><td><input type="text" name="purchaseOperationNumber" value="<?php echo $purchaseOperationNumber; ?>" /></td></tr>
                <tr><td>purchaseAmount </td><td><input type="text" name="purchaseAmount" value="<?php echo $purchaseAmount; ?>" /></td></tr>
                <tr><td>purchaseCurrencyCode </td><td><input type="text" name="purchaseCurrencyCode" value="<?php echo $purchaseCurrencyCode; ?>" /></td></tr>
                <tr><td>language </td><td><input type="text" name="language" value="SP" /></td></tr>                
                <tr><td>shippingFirstName </td><td><input type="text" name="shippingFirstName" value="Cristhian" /></td></tr>
                <tr><td>shippingLastName </td><td><input type="text" name="shippingLastName" value="Incentivos" /></td></tr>
                <tr><td>shippingEmail </td><td><input type="text" name="shippingEmail" value="modalprueba1@test.com" /></td></tr>
                <tr><td>shippingAddress </td><td><input type="text" name="shippingAddress" value="Direccion ABC" /></td></tr>
                <tr><td>shippingZIP </td><td><input type="text" name="shippingZIP" value="ZIP 123" /></td></tr>
                <tr><td>shippingCity </td><td><input type="text" name="shippingCity" value="CITY ABC" /></td></tr>
                <tr><td>shippingState </td><td><input type="text" name="shippingState" value="STATE ABC" /></td></tr>
                <tr><td>shippingCountry </td><td><input type="text" name="shippingCountry" value="PE" /></td></tr>                
		        <!--Parametro para la Integracion con Pay-me. Contiene el valor del parametro codCardHolderCommerce. -->
                <tr><td>userCommerce </td><td><input type="text" name="userCommerce" value=" " /></td></tr> <!-- 0101010101 -->
                <!--Parametro para la Integracion con Pay-me. Contiene el valor del parametro codAsoCardHolderWallet.-->
                <tr><td>userCodePayme </td><td><input type="text" name="userCodePayme" value=" " /></td></tr> <!-- 5--420--2340 -->
                
                 <!--Envío campos reservados-->
                <tr><td>reserved1</td><td><input type="text" name="reserved1" value="SP" /></td></tr>     <!--Idioma-->
                <!--<tr><td>reserved2</td><td><input type="text" name="reserved2" value="8929" /></td></tr>  <!--Monto Fijo
                <tr><td>reserved3</td><td><input type="text" name="reserved3" value="1071" /></td></tr>    <!--Monto IVA
                <tr><td>reserved4 </td><td><input type="text" name="reserved4" value="000" /></td></tr>   <!--Monto Servicio
                <tr><td>reserved5 </td><td><input type="text" name="reserved5" value="000" /></td></tr>   <!--Monto Propina
                <tr><td>reserved9</td><td><input type="text" name="reserved9" value="000" /></td></tr>  <!--Monto No Grava IVA
                <tr><td>reserved10</td><td><input type="text" name="reserved10" value="8929" /></td></tr>  <!--Monto Grava IVA-->
                
                <!--Envío campos Taxes-->
                <tr><td>taxMontoFijo</td><td><input type="text" name="taxMontoFijo" value="<?=$purchaseAmount?>" /></td></tr>
                <tr><td>taxMontoGravaIva</td><td><input type="text" name="taxMontoGravaIva" value="63" /></td></tr>
                <tr><td>taxMontoIVA</td><td><input type="text" name="taxMontoIVA" value="15" /></td></tr>
                <tr><td>taxMontoNoGravaIva</td><td><input type="text" name="taxMontoNoGravaIva" value="000" /></td></tr>
                <tr><td>taxServicio</td><td><input type="text" name="taxServicio" value="000" /></td></tr>
                <tr><td>taxICE</td><td><input type="text" name="taxICE" value="0" /></td></tr>
                
                <tr><td>descriptionProducts </td><td><input type="text" name="descriptionProducts" value="abc" /></td></tr>
                <tr><td>programmingLanguage </td><td><input type="text" name="programmingLanguage" value="PHP" /></td></tr>
                <tr><td>purchaseVerification </td><td><input type="text" name="purchaseVerification" value="<?php echo $purchaseVerification; ?>" /></td></tr>
                <tr><td colspan="2"><input type="button" onclick="javascript:AlignetVPOS2.openModal('https://integracion.alignetsac.com/')" value="Comprar"></td></tr>
                
            </table>
        </form>
    </body>
</html>