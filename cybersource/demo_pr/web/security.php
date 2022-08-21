<?php

define ('HMAC_SHA256', 'sha256');
define ('SECRET_KEY', '0258b2fa56f240e494517c534a9e69b7a4f8b59b7eca4cc9a0193f981021572777d60d4977e84575815af262dfef21ee5145661a06df4fb5a00093f30da51224e2313b354c944da2a81b8ff92f5317e1872be5aebfe646f3a56e06ea8f1222a2310fd908771b41f7a458c9e12c1cb6532d6a5e4ec3e44974a0a7161ab3a7ff0a');

function sign ($params) {
  return signData(buildDataToSign($params), SECRET_KEY);
}

function signData($data, $secretKey) {
    return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
}

function buildDataToSign($params) {
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as $field) {
           $dataToSign[] = $field . "=" . $params[$field];
        }
        return commaSeparate($dataToSign);
}

function commaSeparate ($dataToSign) {
    return implode(",",$dataToSign);
}

?>
