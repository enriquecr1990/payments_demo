var TOKEN =  null;
var COMPANY_ID = null;

var USER = null;
var PASS = null;
var TX_ID = null;
var CLIENT_ID = null;
var MONTO = null;
var ADICIONAL_AMOUNT = null;
var MERCHTAN_ID = null;
var REF_01 = null;
var REF_02 = null;
var REF_03 = null;
var LOGO = null;
var COLOR = null;
var MONEDA = null;
var MONTO_BASE = null;
var IMPUESTO = null;
var EMAIL = null;
var AMBIENTE = null;
var GIRE_SERVICE = null;
var GIRE_FRONT = null;
var URL_HOME = null;
var URL_CONFIM = null;
var SIGNATURE = null;
var NOMBRE_COMPANY = null;

//Pago en cuotas
var CUOTAS = null;
var RECARGO = null;

//Efectivo 
var DIAS_VENCIMIENTO = null;

//Promociones
var COD_PRODUCTO = null;

//FirstData
var PROVEEDOR = null;

//Validaciones
var VALIDATION_AMOUNTS_CODE = 000;

//Plan Cuotas
var PLAN_CUOTAS = null;

//Reserva de Saldo
var TIPO_OPERACION = null;
var IS_RESERVA_SALDO = null;

//DEFINICION DE RESPUESTAS
const BAD_COMPANY_DATA = 1001;
const BAD_MERCHANT_ID = 1002;
const REQUIRED_FIELD = 1003;
const MAX_LENGHT = 1004;
const BAD_AMOUNT_FORMAT = 1005;
const BAD_ADICIONAL_AMOUNT_FORMAT = 1006;
const BAD_MOTO_BASE_FORMAT = 1007;
const BAD_IMPUESTO_FORMAT = 1008;
const DONT_DESIGN = 1009;
const BAD_AMOUNTS = 1010;
const MONEDA_FORMAT = 1011;
const DUPLICATE_TX = 1012;
const URL_HOME_BAD_FORMAT = 1013;
const URL_CONFIRM_BAD_FORMAT = 1014;
const STRING_BAD_FORMAT = 1015;
const BAD_NUMBER_CUOTAS = 1016;
const INACTIVE_MEDIOPAGO_TARJETA = 1017;
const BAD_RECARGO = 1018;
const BAD_RECARGO_CUTAS = 1019;
const BAD_DIAS_VENCIMIENTO = 1020;
const BAD_PRODUCTO_NUMERICO = 1021;
const BAD_PRODUCTO_VERIFICATION = 1022;
const BAD_PRODUCTO_CUOTAS = 1023;
const BAD_PARAMETER = 1024;
const TIPOMEDIOPAGO_INACTIVO = 1025;
const TIPO_OPERACION_INVALIDO = 1026;
const NO_RESERVA_SALDO = 1027;



const SDK_VERSION = "06.00.00";

window.onload = function(){
    this.document.getElementById('GS_BOTON_PAGO').onclick = function(){
        obtenerDatos();
    }
}

/**
 * @author Ljimenez
 * @since 05/12/2018
 */
function obtenerDatos(){
    USER = document.getElementById("GS_USERNAME").value;
    PASS = document.getElementById("GS_PASSWORD").value;
    EMAIL = document.getElementById("GS_EMAIL").value;
    TX_ID = document.getElementById("GS_TX_ID").value;
    CLIENT_ID = document.getElementById("GS_CLIENT_ID").value;
    MONTO = document.getElementById("GS_IMPORTE").value;
    REF_01 = document.getElementById("GS_REF_01").value;
    REF_02 = document.getElementById("GS_REF_02").value;
    REF_03 = document.getElementById("GS_REF_03").value;
    MONTO_BASE = document.getElementById("GS_MONTO_BASE").value;
    IMPUESTO = document.getElementById("GS_IMPUESTOS").value;
    ADICIONAL_AMOUNT = document.getElementById("GS_MONTO_ADICIONAL").value;
    MONEDA = document.getElementById("GS_MONEDA").value;
    AMBIENTE = document.getElementById("GS_AMBIENTE").value;
    URL_HOME = document.getElementById("GS_URL_HOME").value;
    URL_CONFIM = document.getElementById("GS_URL_CONFIRM").value;
    CUOTAS = document.getElementById("GS_CUOTAS").value;
    RECARGO = document.getElementById("GS_RECARGO").value;
    SIGNATURE = document.getElementById("GS_SHASIGN").value;
    MERCHTAN_ID = document.getElementById("GS_MERCHANT_ID").value;
    TIPO_OPERACION = document.getElementById("GS_TIPO_OPERACION").value;

    try{
        DIAS_VENCIMIENTO  = document.getElementById("GS_DIAS_VENCIMIENTO").value;
    }catch(error){
        DIAS_VENCIMIENTO = "0";
       console.info("(Efectivo) No se recibio los dias de vencimiento.");
    }

    try{
        COD_PRODUCTO = document.getElementById("GS_PRODUCTO").value;
    }catch(error){
        COD_PRODUCTO = "";
       console.info("(Credito/Debito) No se recibio el cod de producto.");
    }

    try{
        PLAN_CUOTAS = document.getElementById("GS_PLAN_CUOTAS").value;
        PLAN_CUOTAS = PLAN_CUOTAS != "" ? PLAN_CUOTAS : "0";
    }catch(error){
        PLAN_CUOTAS = "0";
       console.info("No procesa plan Cuotas.");
    }


    switch(AMBIENTE){
        case "desa":
            GIRE_FRONT = "http://gsbotondepago.desa.gire.ent";
            GIRE_SERVICE = "http://gsbotondepago.desa.gire.ent/ws";
            break;

        case "test":
            GIRE_FRONT = "https://test.gsbotondepago.com";
            GIRE_SERVICE = "https://test.gsbotondepago.com/ws";
            break;

        case "prod":
            GIRE_FRONT = "https://gsbotondepago.com";
            GIRE_SERVICE = "https://gsbotondepago.com/ws";
            break;

        case "local":
            GIRE_FRONT = "http://localhost:4200";
            GIRE_SERVICE = "http://gsbotondepago.desa.gire.ent/ws";
            break;
    }

    if(USER != "" && PASS != ""){
        validarCampos();
    }else{
        alert("Codigo(1000) - Login incorrecto, User o Password vacios.");
    }
}

/**
 * @author Ljimenez
 * @since 05/12/2018
 */
function iniciarTx(){

    var urlToFrontend = GIRE_FRONT+
        "?codCia="+COMPANY_ID+
        "&empresa="+NOMBRE_COMPANY+
        "&descripcion="+REF_01+
        "&descripcion02="+REF_02+
        "&descripcion03="+REF_03+
        "&username="+USER+
        "&email="+EMAIL+
        "&moneda="+MONEDA+
        "&subtotal="+MONTO_BASE+
        "&impuestos="+IMPUESTO+
        "&gastosAdd="+ADICIONAL_AMOUNT+
        "&total="+MONTO+
        "&color="+COLOR+
        "&logo="+LOGO+
        "&token="+TOKEN+
        "&merchantId="+MERCHTAN_ID+
        "&clienteId="+CLIENT_ID+
        "&transaccionId="+TX_ID+
        "&signature="+SIGNATURE+
        "&cuotas="+CUOTAS+
        "&recargo="+RECARGO+
        "&diasVencimiento="+DIAS_VENCIMIENTO+
        "&codProducto="+COD_PRODUCTO+
        "&urlHome="+URL_HOME+
        "&urlConfim="+URL_CONFIM+
        "&planCuotas="+PLAN_CUOTAS;

    if(IS_RESERVA_SALDO){
        urlToFrontend += "&reservaSaldo=2";
    }

    if(TIPO_OPERACION == 3){
        urlToFrontend += "&tokeniza=1&tipoTarjeta=C";
        urlToFrontend = urlToFrontend.replace("?codCia=", "/tokenizacion?codCia=");

    }

    console.log("Url: " + urlToFrontend);
    window.location.replace(urlToFrontend);

}

/**
 * @author Ljimenez
 * @since 24/07/2018
 * @param {*} usuario 
 * @param {*} contrasena 
 * @returns TOKEN, COMPANY_ID
 */
function obtenerToken(){
    console.log("Loggin....");

    var http = new XMLHttpRequest();

    var url = GIRE_SERVICE+"/login";

    http.open("POST", url, true);
    http.setRequestHeader("Content-type", "application/json");

    http.onload = function(){
        if(http.readyState == 4 && http.status == "200"){

            TOKEN = http.getResponseHeader("Authorization");
            console.log(http.responseText);
            var response = JSON.parse(http.responseText);
            

            if(TOKEN != null){
                COMPANY_ID = JSON.parse(response.CompanyId).toString();
                IS_RESERVA_SALDO = JSON.parse(response.gsReservaSaldo);
                checkOperation();
                //verificarData();
            }
        }else{
            alert("Codigo(1001) - Login incorrecto, verifique sus datos");
        }
    }

    var data = JSON.stringify({"userName":USER, "password":PASS});    
    http.send(data);
}

/**
 * 
 * @author Ljimenez
 * @since 24/07/2018
 * @returns Si merchantId es valido.
 */
function verificarData(){
    var http = new XMLHttpRequest();
    var url = GIRE_SERVICE+"/verifyData";

    console.log("ALL HEADERS:" + http.getAllResponseHeaders());

    http.open("POST", url, true);
    http.setRequestHeader("Content-type", "application/json");
    http.setRequestHeader("Authorization", TOKEN);
    http.setRequestHeader("CompanyId", COMPANY_ID);

    http.onreadystatechange = function() {
        if (http.readyState == XMLHttpRequest.DONE) {
            var response = JSON.parse(http.responseText);

            if(response.MSG == "1020" ){

                if(COD_PRODUCTO != "" && response.tipoTarjeta == "D" && CUOTAS > 1){
                    alert("Codigo(1023) - No se puede enviar un codigo de producto 'Debito' con más de una cuota");
                }else{
                  verificarTxId();  
                }
                
            }

            if(response.MSG == "1019" ){
                alert("Codigo(1002) - EL campo merchantId no pertenece a la empresa...");
            }

            if(response.MSG == "1035" ){
                alert("Codigo(1022) - El codigo de producto no esta asociado al merchantId");
            }

            if(response.MSG == "1036" ){
                alert("Codigo(1025) - El tipo de medio de pago esta inactivo.");
            }
        }
    }
    var data = JSON.stringify({"companyId":COMPANY_ID, "merchantId":MERCHTAN_ID, "codProducto":COD_PRODUCTO});    
    http.send(data);
}



/**
 * 
 * @author Ljimenez
 * @since 24/07/2018
 * @returns Logo y color de la compañia
 */
function obtenerDesign(){
    var http = new XMLHttpRequest();
    var url = GIRE_SERVICE+"/companyDesign";

    http.open("POST", url, true);
    http.setRequestHeader("Content-type", "application/json");
    http.setRequestHeader("Authorization", TOKEN);
    http.setRequestHeader("CompanyId", COMPANY_ID);

    http.onreadystatechange = function() {
        if (http.readyState == XMLHttpRequest.DONE) {
            var response = JSON.parse(http.responseText);

            if(response.MSG != null){

                var companyDesign = JSON.parse(response.MSG);
                
                COLOR = companyDesign.color;
                LOGO = companyDesign.logo;
                NOMBRE_COMPANY = companyDesign.nombre;

               iniciarTx();
            }else{
                alert("No se obtuvo diseño de la compañia.");
            }
        }
    }
    var data = JSON.stringify({"companyId":COMPANY_ID});    
    http.send(data);
}

/**
 * 
 * @author Ljimenez
 * @since 24/07/2018
 * @returns No existan campos obligatorios vacios/nulos y no se excedan los caracteres requeridos.
 */
function validarCampos(){
    //Adicional not null
    adicionalFlag = true;

    //Expresion Regular para numericos
    var regNum = /(^\d{0,10})+\,\d{2}$/;

    //Expresion regular para Moneda
    var regMoneda = /[A-Z]{3}/;

    //Expresion regular para Url
    var regUrl = /^(http|https):///;

    //Validar que cuotas solo contenga numeros
    var regNumCuotas = /^\d+$/;

    var regNotCharacterUrl = /(&|\?|\[|\]|{|}|"|%|<|>| |\^|\\|\||~)/;
    var regNotCharacterRef = /(&|\?|\[|\]|{|}|"|%|<|>|\^|\\|\||~)/;
    //Validar campos requeridos
    if(COMPANY_ID != "" && MERCHTAN_ID != "" && CLIENT_ID != "" && TX_ID != "" 
        && MONTO != "" && REF_01 != "" && ADICIONAL_AMOUNT != "" && MONEDA != ""
            && IMPUESTO != "" && MONTO_BASE != "" && URL_HOME != "" && CUOTAS != ""
                && RECARGO != "" && DIAS_VENCIMIENTO != ""){

        if(MERCHTAN_ID.length > 20 || CLIENT_ID.length > 20 || TX_ID.length > 20
        || MONTO.length > 13 || REF_01.length > 100 || MONEDA.length > 3 || IMPUESTO.length > 13
            || MONTO_BASE.length > 13 || REF_02.length > 100 || REF_03.length > 100 || RECARGO.length > 13 || COD_PRODUCTO.length > 3){
            alert("Codigo(1004) - Verificar la longitud de los campos.");
        }else{

            //BDPWEB-550
            if(parseInt(CUOTAS) >= 1){

                if(!regNotCharacterUrl.test(USER) && !regNotCharacterUrl.test(EMAIL) && !regNotCharacterUrl.test(TX_ID) && !regNotCharacterUrl.test(AMBIENTE)
                    && !regNotCharacterUrl.test(CLIENT_ID) && !regNotCharacterUrl.test(MERCHTAN_ID) && !regNotCharacterRef.test(REF_01)
                        && !regNotCharacterRef.test(REF_02) && !regNotCharacterRef.test(REF_03) && !regNotCharacterUrl.test(MONEDA)){

                    //Validar cuotas
                    if(regNumCuotas.test(CUOTAS)){
                        
                        //Validar Moneda
                        if(regMoneda.test(MONEDA)){

                            //Validar Monto Base
                            if(regNum.test(MONTO_BASE)){
                                
                                //Validar Impuesto
                                if(regNum.test(IMPUESTO)){

                                    //Validar Monto Adicional
                                    if(regNum.test(ADICIONAL_AMOUNT)){

                                    	//Validar dias de vencimiento(Efectivo)
                                    	if(regNumCuotas.test(DIAS_VENCIMIENTO)){

                                    		//Validar Recargo
	                                        if(regNum.test(RECARGO)){

                                                if(verificarCodPromocion()){

                                                    //Validar que el recargo sea igua a 0.00 cuando la cuota es igual a 1
                                                    if(CUOTAS == 1 && RECARGO == "0,00" || parseInt(CUOTAS) > 1){
                                                        //Validar Monto Final
                                                        if(regNum.test(MONTO)){
                                                            if(URL_HOME.indexOf("http://") == 0 || URL_HOME.indexOf("https://") == 0 ){
                                                                if(URL_CONFIM.length > 1){

                                                                    if(URL_CONFIM.indexOf("http://") == 0 || URL_CONFIM.indexOf("https://") == 0 ){
                                                                        validarTotalMontos();
                                                                    }else{
                                                                        alert("Codigo(1014) - Formato incorrecto URL_CONFIRM");
                                                                    }
                                                                }else{
                                                                    validarTotalMontos();
                                                                }
                                                                
                                                            }else{
                                                                alert("Codigo(1013) - Formato incorrecto URL_HOME");
                                                            }
                                                        }else{
                                                            alert("Codigo(1005) - Monto invalido.");
                                                        }
                                                    }else{
                                                        alert("Codigo(1019) - Recargo no puede ser mayor a 0.00 con una cuota.");
                                                    }

                                                }else{
                                                     alert("Codigo(1021) - Codigo de producto debe ser Numerico");
                                                }
	                                        }else{
	                                            alert("Codigo(1018) - Recargo invalido.");
	                                        }
                                    	}else{
                                    		alert("Codigo(1020) - Días de vencimiento invalido");
                                    	}
                                    }else{
                                        alert("Codigo(1006) - Monto adicional invalido.");
                                    }

                                }else{
                                    alert("Codigo(1008) - impuesto invalido");
                                }

                            }else{
                                alert("Codigo(1009) - Monto Base invalido");
                            }
                        }else{
                            alert("Codigo(1011) - Formato de moneda incorrecta.");
                        }
                    }else{
                         alert("Codigo(1008) - Cuotas solo permite Números");
                    }
                }else{
                    alert("Codigo(1015) - Campos con caracteres no permitidos.");
                }
            }else{
                alert("Codigo(1016) - Numero de cuotas debe ser mayor a 0");
            }
        }
    }else{
        alert("Codigo(1003) - Verificar campos requeridos...");
    }
}


/**
 * @author Ljimenez
 * @since 06/08/2018
 * @description Valida si la suma del Impuesto, MontoBase y Adicional es igual al Importe
 */
function validarTotalMontos(){
    var impuesto = parseFloat(IMPUESTO.replace(",","."));
    var montoBase = parseFloat(MONTO_BASE.replace(",","."));
    var montoAdicional = parseFloat(ADICIONAL_AMOUNT.replace(",","."));
    
    //BDPWEB-550
    var recargo = parseFloat(RECARGO.replace(",","."))

    var total = parseFloat(MONTO.replace(",",".")).toFixed(2);
    
    //Se realiza la suma
    var calcularTotal = parseFloat(montoBase + impuesto + montoAdicional+ recargo).toFixed(2);


    //Se comparan los valores.
    if(total != calcularTotal){
        alert("Codigo(1010) - La suma de la base + impuesto + adicional + recargo no concuerda con el importe");
    }else{
        //Se Realiza el login y se obtiene el Token.
        encodeUrls();
    }
}

/**
 * 
 * @author Ljimenez
 * @since 27/08/2018
 * @returns Si el numero de TX es repetido
 * @description BDPWEB-265
 */
function verificarTxId(){
    var http = new XMLHttpRequest();
    var url = GIRE_SERVICE+"/verificarTX";

    console.log("ALL HEADERS:" + http.getAllResponseHeaders());

    http.open("POST", url, true);
    http.setRequestHeader("Content-type", "application/json");
    http.setRequestHeader("Authorization", TOKEN);
    http.setRequestHeader("CompanyId", COMPANY_ID);

    http.onreadystatechange = function() {
        if (http.readyState == XMLHttpRequest.DONE) {
            var response = JSON.parse(http.responseText);


            if(response.MSG == "1024" ){
                VerficarMedioPagoTarjetas();
                //obtenerDesign();
            }else{
                alert("Codigo(1012) - El ID de transaccion esta duplicado.");
            }
        }
    }
    var data = JSON.stringify({"companyId":COMPANY_ID, "clienteTxId":TX_ID});    
    http.send(data);
}

/**
 * @author Ljimenez
 * @since 16/10/2018
 * @returns actual version of SDK
 */
function sdkVersion(){
	alert("Versión SDK Botón de Pagos: " + SDK_VERSION);
}

/**
 * 
 * @author Ljimenez
 * @since 23/10/2018
 * @returns Si posee tarjetas habilitadas.
 */
function VerficarMedioPagoTarjetas(){

    if(parseInt(CUOTAS) > 1){
        var http = new XMLHttpRequest();
        var url = GIRE_SERVICE+"/tarjetasMedioPagoActivo";
    
        console.log("ALL HEADERS:" + http.getAllResponseHeaders());
    
        http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/json");
        http.setRequestHeader("Authorization", TOKEN);
        http.setRequestHeader("CompanyId", COMPANY_ID);
    
        http.onreadystatechange = function() {
            if (http.readyState == XMLHttpRequest.DONE) {
                var response = JSON.parse(http.responseText);
    
                if(response.MSG == "1031" ){
                    obtenerDesign();
                }else{
                    alert("Codigo(1017) - No esta habilitado para pagar en cuotas.");
                }
            }
        }
        var data = JSON.stringify({"username":USER});    
        http.send(data);
    }else{
        obtenerDesign();
    }
}

function encodeUrls(){
	URL_CONFIM = btoa(URL_CONFIM);
	URL_HOME = btoa(URL_HOME);
	
	obtenerToken(false);
}

function verificarCodPromocion() {
    var result = true;
    var regNum = /^\d+$/;

    if(COD_PRODUCTO != ""){
        if(!regNum.test(COD_PRODUCTO)){
            result = false;
        }
    }

    return result;
}

function verificarProveedor(){
    if(PROVEEDOR == "IG" && verificarMerchant() || PROVEEDOR =="FD" && COD_PRODUCTO != "" && verificarMerchant()){
        verificarData();
    }else if(PROVEEDOR =="FD" && COD_PRODUCTO == "" && MERCHTAN_ID != ""){
        verificarData();
    }else if(PROVEEDOR =="FD" && COD_PRODUCTO == "" && MERCHTAN_ID == ""){
        console.log("No se recibio codProducto, no se valida merchantId");
        verificarTxId();
    }else{
        alert("Codigo(1002) - Verificar Campo MerchantId no puede ser nulo ni superar los 20 caracteres.");
    }
}

function verificarMerchant(){
    if(MERCHTAN_ID != null && MERCHTAN_ID != "" && MERCHTAN_ID.length <= 20){
        return true;
    }else{
        return false;
    }
}

function checkOperation(){
    switch(TIPO_OPERACION){
        //Pagar Compra
        case "1":
            verificarData();
            IS_RESERVA_SALDO = false;
            break;

        case "2":
            if(IS_RESERVA_SALDO){
                verificarData();
             }else{
                 alert("Codigo(1027) - No esta habilitado para reservar saldo.");
             }
            break;

        case "3":
            verificarData();
            IS_RESERVA_SALDO = false;
            break;

        default:
            alert("Codigo(1026) - No se recibio un tipo de operacion valido.");
            break;
    }
}