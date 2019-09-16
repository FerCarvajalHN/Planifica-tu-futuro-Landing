<!DOCTYPE html>
<html lang="Es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
	<meta name="description" content="Fondo de Pensiones Atlántida. Dale valor al tiempo y haz que tus ahorros trabajen para ti.">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Es hora de planificar tu futuro - AFP Atlántida</title>
    
	<!-- Loading Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
		integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Loading Template CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style-magnific-popup.css" rel="stylesheet">


    <!-- Awsome Fonts -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="shortcut icon" type="image/png" href="images/favicon.png" />
	   
    
</head>

<body>

    <?php

        $secretKey = "6LejyXoUAAAAADyyZpKM8NCZFeC7gQtXhMeI5juH";
		$responseKey = $_POST['g-recaptcha-response'];
		$userIP = $_SERVER['REMOTE_ADDR'];

		$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
		$response = file_get_contents($url);
        $response = json_decode($response);
        
        if ($response->success) {

            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cabeceras .= "From: LandingPage Afiliate hoy<cmaradiaga@afpatlantida.com>" . "\r\n";

            $msg = '<html><body>';
            $msg .= '<h2><b>Se ha recibido una solicitud de asesoría desde la página de Landing Page Afíliate Hoy 2019</b></h2>';
            $msg .= '<p style="margin:0;"><b>Nombre y Apellido: </b>'.$_POST['contact_names'].'</p>';
            $msg .= '<p style="margin:0;"><b>No. de Identidad: </b>'.$_POST['contact_id'].'</p>';
            $msg .= '<p style="margin:0;"><b>Correo Electrónico: </b>'.$_POST['contact_email'].'</p>';
            $msg .= '<p style="margin:0;"><b>Celular: </b>'.$_POST['contact_cel'].'</p>';
            $msg .= '<p style="margin:0;"><b>Ciudad de Residencia: </b>'.$_POST['contact_residencia'].'</p>';
            $msg .= '<p style="margin:0;"><b>Cuéntanos cuáles son tus dudas: </b>'.$_POST['contact_message'].'</p>';
            $msg .= '</body></html>';

            $para      = 'cmaradiaga@afpatlantida.com, jsalgado@afpatlantida.com';
            // $para      = 'fermin@ansolidata.com';
            $titulo    = 'Solicitud de Formulario Afíliate hoy 2019';
            // $para      = 'fermin@ansolidata.com';
            // $titulo    = 'Solicitud de asesoría - Afiliate Hoy!';

            mail($para, $titulo, utf8_decode($msg), $cabeceras);

            $cab  = 'MIME-Version: 1.0' . "\r\n";
            $cab .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cab .= "From: AFP Atlantida<cmaradiaga@afpatlantida.com>" . "\r\n";

            $msg_2 = '<html><body>';
            $msg_2 .= '<p>Te informamos que hemos recibido tu solicitud, muy pronto estaremos en contacto contigo.</p>';
            $msg_2 .= '<img src="https://www.afpatlantida.com/afiliate-hoy/images/formulario-recibido.jpg">';
            $msg_2 .= '</body></html>';

            $correo_usuario = $_POST['email'];

            mail($correo_usuario, 'Solicitud de informacion recibida', utf8_decode($msg_2), $cab);

            $usuario = $_POST['contact_names'];
            $identidad = $_POST['contact_id'];
            $email = $_POST['contact_email'];
            $celular = $_POST['contact_cel'];
            $zona = $_POST['contact_residencia'];
            $comentarios = $_POST['contact_message'];

            date_default_timezone_set('America/Tegucigalpa');
            $current_date = date('Y/m/d');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://prod-73.westus.logic.azure.com/workflows/a82d28d4a770493299b0f541a9f06b3c/triggers/manual/paths/invoke/Leads?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=6njKc1pgH9nCeMRvZEZNGg1REiAZKat7Or_ocVPKlx4",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\r\n        \"fecha_solicitud\": \"$current_date\",\r\n        \"nombre_cliente\": \"$usuario\",\r\n        \"identidad\": \"$identidad\",\r\n        \"email\": \"$email\",\r\n        \"celular\": \"$celular\",\r\n        \"zona\": \"$zona\",\r\n        \"producto\": \"Fondo Individual de Pensiones Atlántida\",\r\n        \"Comentarios\": \"$comentarios\",\r\n        \"origen\": \"Landing Page\" \r\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Postman-Token: a3d943ef-6ddf-4c1b-b310-6b3651577e46",
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }

            // date_default_timezone_set('America/Tegucigalpa');
            
            // $current_date = date('Y/m/d == H:i:s');

            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            // CURLOPT_URL => "https://prod-73.westus.logic.azure.com/workflows/a82d28d4a770493299b0f541a9f06b3c/triggers/manual/paths/invoke/Leads?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=6njKc1pgH9nCeMRvZEZNGg1REiAZKat7Or_ocVPKlx4",
            // CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_ENCODING => "",
            // CURLOPT_MAXREDIRS => 10,
            // CURLOPT_TIMEOUT => 30,
            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // CURLOPT_CUSTOMREQUEST => "POST",
            // CURLOPT_POSTFIELDS => "{\r\n        \"fecha_solicitud\": \"$current_date\",\r\n        \"nombre_cliente\": \"$_POST['usuario']\",\r\n        \"identidad\": \"$_POST['identidad']\",\r\n        \"email\": \"$_POST['email']\",\r\n        \"celular\": \"$_POST['celular']\",\r\n        \"zona\": \"$_POST['city']\",\r\n        \"producto\": \"Fondo Individual de Pensiones Atlántida\",\r\n        \"comentarios\": \"$_POST['message']\",\r\n        \"origen\": \"Landing Page\" \r\n}",
            // CURLOPT_HTTPHEADER => array(
            //     "Content-Type: application/json",
            //     "Postman-Token: a3d943ef-6ddf-4c1b-b310-6b3651577e46",
            //     "cache-control: no-cache"
            // ),
            // ));

            // $response = curl_exec($curl);
            // $err = curl_error($curl);

            // curl_close($curl);

            // if ($err) {
            // echo "cURL Error #:" . $err;
            // } else {
            // echo $response;
            // }

        }

    ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 mt-5" style="text-align: center;">
                <a href="http://www.afpatlantida.com/afiliate-hoy/" style="display: inline-block; padding: 1rem 3rem; background-color:#D9272E; color: #FFF; text-decoration: none; border-radius: .5rem; font-family: Neo-Sans, sans-serif;">Volver a Formulario</a>
                <a href="https://www.afpatlantida.com/" style="display: inline-block; padding: 1rem 3rem; background-color:#D9272E; color: #FFF; text-decoration: none; border-radius: .5rem; font-family: Neo-Sans, sans-serif;">Ir al Sitio Web</a>
            </div>
            <div class="col-xs-12" style="text-align: center;">
                <img src="https://www.afpatlantida.com/afiliate-hoy/images/formulario-recibido.jpg" alt="" style="width: 70%;">
            </div>
            <div class="col-xs-12" style="text-align: center;">
                <a href="http://www.afpatlantida.com/afiliate-hoy/" style="display: inline-block; padding: 1rem 3rem; background-color:#D9272E; color: #FFF; text-decoration: none; border-radius: .5rem; font-family: Neo-Sans, sans-serif;">Volver a Formulario</a>
                <a href="https://www.afpatlantida.com/" style="display: inline-block; padding: 1rem 3rem; background-color:#D9272E; color: #FFF; text-decoration: none; border-radius: .5rem; font-family: Neo-Sans, sans-serif;">Ir al Sitio Web</a>
            </div>
        </div>
    </div>

    <!-- Load JS here for greater good =============================-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
    <script src="js/jquery.scrollTo-min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.nav.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/plugins.js"></script>
    
</body>
</html>