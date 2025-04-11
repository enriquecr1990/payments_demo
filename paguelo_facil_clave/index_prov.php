<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LinkDeamon</title>
  <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=eF1TrTFePIMw6PjVCphhiBneF_7bCaslBVZAslIwqECWqa2HP4MJ5evvetOmLyYWeQaYffrEEmf4icWqDegwhkoWIhtwV8NiW1ImxVyCTFUVakMxwnHJyhvjZ8fDbPHX_0-Wvhf1wGclcdENag1OxuR_2qbx3mNVmuvEaEfPFnZsive8aqGFFNSkyWqaZJcE84NJjmem0Gk_w81VhoR_2gxibVYP_X6TGJLItQQquh0YyUETgnSjAlxxadvyvIdA8CDwhQWcpbWk-wYP3booLVOEFZgTNJHV_XF7kfF9kwTZ-eTLPlgQXLFh6e8xpJoPREUz07WBr_dIowg_MslcwQqkmiLCgHycaGyZUQRqmHw" charset="UTF-8"></script><style>
        .payfacil-lk-logo {
          text-align: center;
          background-color: #89cf19;
          width: 200px;
          margin: auto;
          padding: 7px;
          height: 50px;
          font-size: 16px;
          letter-spacing: 1px;
          font-weight: 800;
          color: #161616;
          border-radius: 8px;
          cursor: pointer;
          border: none;
        }
        .payfacil-lk-container {
          height: 90vh;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        body {
          background: #161616;
          height: 100vh;
          overflow: hidden;
        }
  </style>
</head>
<body>
  <div align="center" class="payfacil-lk-container">
    <button class="payfacil-lk-logo" onclick="generateLK()">ENLACE DE PAGO</button>
  </div>
  <script>
        
        
        const environment_sandbox = 'https://sandbox.paguelofacil.com/';
        const environment_prod = 'https://secure.paguelofacil.com/';
        const URL_BASE = `${environment_prod}LinkDeamon.cfm?`; //CAMBIAR DE AMBIENTE MODIFICA AUTOMÁTICAMENTE EL CCLW
          
        
        const CCLW_SAND = "72BB9FDFB2E8D97F9115B11DF1283706A9EEEA5046B3600C4404BC90F309C802A00CCAD8AB9A12FB154DC8E48B536F01B743BE8801AB9C8A07BD82156596B45F";
        //const CCLW_PROD = "41B7173C7144CB611A2A5B5842CB18DABF69E13B2AE7C0D57D42F64273232A5C455196AF1AE4B16A032BAD06CE8FECAC1922E58AD8A83393A2659EFC81492BA3";

        let CCLW = CCLW_SAND;

        if (URL_BASE.includes(environment_sandbox)) {
          CCLW = CCLW_SAND;
        } 
     //    else if (URL_BASE.includes(environment_prod)) {
     //      CCLW = CCLW_PROD;
     //    }

        let params = {
            CDSC: 'Test', // Descripción de la compra
            CMTN: 1, // Monto de la compra
            CCLW: CCLW, // Este es el código web
            //RETURN_URL: '',
            // CARD_TYPE: 'NEQUI,CASH,CLAVE,CARD,CRYPTO',
            // PF_CF: '[ {"id":"3Z4YNBQ","nameOrLabel":"id","type":"hidden","value":"3Z4YNBQ"}]',
            // CTAX: '',
            // PARM_1: '12345', // es posible enviar mas de 1 y puedes nombrarlo como desees, todos son retornados en la respuesta.
             //EXPIRES_IN: 3600, //Cantidad de segundos máxima que desea recibir el pago -> Ej.: 3600 – 600 – 60
        };

        function generateLK() {
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': "application/x-www-form-urlencoded",
                    'Accept': '*/*',
                }
            }

            let arr = Object.entries(params);
            let url = URL_BASE;
            arr.forEach((elem) => {
                url = url + '&'+elem[0]+'='+elem[1];
            })
            return fetch(url, options)
                .then((response) => response.json())
                .then((response) => response.data.url 
                  ? window.open(response.data.url) 
                  : alert(response.headerStatus.description + " (" + response.headerStatus.code + ")"))
                .catch((error) => console.log(error))
        }
  </script>
</body>
</html>