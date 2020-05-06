<?php

$acquirerId = '144';
$idCommerce = '10432';
$purchaseOperationNumber = substr(time(),-6);
$purchaseAmount = '78';
$purchaseCurrencyCode = '604';
$clavePasarela = 'vjcZJfRBeFNsUbxCqk?42344289672';

$purchaseVerification = openssl_digest($acquirerId.$idCommerce.$purchaseOperationNumber.$purchaseAmount.$purchaseCurrencyCode.$clavePasarela,'sha512');

$html_form = '
    <form name="f1" id="f1" action="#" method="post" class="alignet-form-vpos2">
        <div class="row">
            <label class="col-lg-3">acquirerId</label><input type="text" class="col-lg-9" name="acquirerId" value="'.$acquirerId.'">
            <label class="col-lg-3">idCommerce</label><input type="text" class="col-lg-9" name="idCommerce" value="'.$idCommerce.'">
            <label class="col-lg-3">purchaseOperationNumber</label><input type="text" class="col-lg-9" name="purchaseOperationNumber" value="'.$purchaseOperationNumber.'">
            <label class="col-lg-3">purchaseAmount</label><input type="text" class="col-lg-9" name="purchaseAmount" value="'.$purchaseAmount.'">
            <label class="col-lg-3">purchaseCurrencyCode</label><input type="text" class="col-lg-9" name="purchaseCurrencyCode" value="'.$purchaseCurrencyCode.'">
            <label class="col-lg-3">language</label><input type="text" class="col-lg-9" name="language" value="SP">

            <label class="col-lg-3">shippingFirstName</label><input type="text" class="col-lg-9" name="shippingFirstName" value="Enrique">
            <label class="col-lg-3">shippingLastName</label><input type="text" class="col-lg-9" name="shippingLastName" value="Corona">
            <label class="col-lg-3">shippingEmail</label><input type="text" class="col-lg-9" name="shippingEmail" value="enriquecr1990@gmail.com">
            <label class="col-lg-3">shippingAddress</label><input type="text" class="col-lg-9" name="shippingAddress" value="Una calle de peru">
            <label class="col-lg-3">shippingZIP</label><input type="text" class="col-lg-9" name="shippingZIP" value="07016">
            <label class="col-lg-3">shippingCity</label><input type="text" class="col-lg-9" name="shippingCity" value="Lima">
            <label class="col-lg-3">shippingState</label><input type="text" class="col-lg-9" name="shippingState" value="Lima">
            <label class="col-lg-3">shippingCountry</label><input type="text" class="col-lg-9" name="shippingCountry" value="PE">

            <!--<label class="col-lg-3">userCommerce</label><input type="text" class="col-lg-9" name="userCommerce" value="">
            <label class="col-lg-3">userCodePayme</label><input type="text" class="col-lg-9" name="userCodePayme" value="">-->

            <label class="col-lg-3">descriptionProducts</label><input type="text" class="col-lg-9" name="descriptionProducts" value="Probando pagar con payme">
            <label class="col-lg-3">programmingLanguage</label><input type="text" class="col-lg-9" name="programmingLanguage" value="PHP">
            <label class="col-lg-3">purchaseVerification</label><input type="text" class="col-lg-9" name="purchaseVerification" value="'.$purchaseVerification.'">
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <input type="button" onclick="javascript:AlignetVPOS2.openModal(\'https://integracion.alignetsac.com/\')" class="btn btn-success" value="comprar">
            </div>
        </div>

    </form>
';

$response['status'] = true;
$response['msg'] = 'Todo bien';
$response['html_form'] = $html_form;

echo json_encode($response);exit;