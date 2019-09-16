<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fondo de Pensiones Atlántida</title>
    <meta name="description" content="Fondo de Pensiones Atlántida. Dale valor al tiempo y haz que tus ahorros trabajen para ti.">
    <link rel="icon" type="image/png" href="favicon.ico"/>
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/flexboxgrid.min.css" />
    <link rel="stylesheet" href="css/main.css"/>

    <!-- Google Analytics -->
	<script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  
            ga('create', 'UA-89969430-3', 'auto');
            ga('send', 'pageview');
      </script>
  
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107219231-1"></script>
      <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments)};
            gtag('js', new Date());
  
            gtag('config', 'UA-107219231-1');
      </script>
  
      <!-- Google Analytics END-->
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
            $msg .= '<h2><b>Se ha recibido una solicitud de asesoría desde la página de contáctanos.</b></h2>';
            $msg .= '<p style="margin:0;"><b>Nombre y Apellido: </b>'.$_POST['usuario'].'</p>';
            $msg .= '<p style="margin:0;"><b>No. de Identidad: </b>'.$_POST['identidad'].'</p>';
            $msg .= '<p style="margin:0;"><b>Correo Electrónico: </b>'.$_POST['email'].'</p>';
            $msg .= '<p style="margin:0;"><b>Celular: </b>'.$_POST['celular'].'</p>';
            $msg .= '<p style="margin:0;"><b>Ciudad de Residencia: </b>'.$_POST['city'].'</p>';
            $msg .= '<p style="margin:0;"><b>Cuéntanos cuáles son tus dudas: </b>'.$_POST['message'].'</p>';
            $msg .= '</body></html>';

            // $para      = 'cmaradiaga@afpatlantida.com, jsalgado@afpatlantida.com';
            $para      = 'fermin@ansolidata.com';
            $titulo    = 'Solicitud de Afiliate hoy';
            // $para      = 'fermin@ansolidata.com';
            // $titulo    = 'Solicitud de asesoría - Afiliate Hoy!';

            mail($para, $titulo, utf8_decode($msg), $cabeceras);

            $cab  = 'MIME-Version: 1.0' . "\r\n";
            $cab .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cab .= "From: AFP Atlantida<cmaradiaga@afpatlantida.com>" . "\r\n";

            $msg_2 = '<html><body>';
            $msg_2 .= '<p>Te informamos que hemos recibido tu solicitud, muy pronto estaremos en contacto contigo.</p>';
            $msg_2 .= '<img src="https://www.afpatlantida.com/afiliate-hoy/img/formulario-recibido.jpg">';
            $msg_2 .= '</body></html>';

            $correo_usuario = $_POST['email'];

            mail($correo_usuario, 'Solicitud de informacion recibida', utf8_decode($msg_2), $cab);

            $usuario = $_POST['usuario'];
            $identidad = $_POST['identidad'];
            $email = $_POST['email'];
            $celular = $_POST['celular'];
            $zona = $_POST['city'];
            $comentarios = $_POST['message'];

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

        } else {
            echo "Pruebe de nuevo";
        }

    ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12" style="text-align: center;">
                <img src="https://www.afpatlantida.com/afiliate-hoy/img/formulario-recibido.jpg" alt="" style="width: 80%;">
            </div>
            <div class="col-xs-12" style="text-align: center;">
                <a href="https://www.afpatlantida.com/afiliate-hoy#div-formulario" style="display: inline-block; padding: 1rem 3rem; background-color:#D9272E; color: #FFF; text-decoration: none; border-radius: .5rem;">Volver a Formulario</a>
            </div>
        </div>
    </div>

    <!--SCRIPTS-->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/jquery.scrollify.js"></script>
    <script src="js/main.js"></script>

    <script>
        $(function () {
            $('form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'form-sent.php',
                    data: $('form').serialize(),
                    success: function (html) {
                        $("#myElem").fadeIn("slow");
                        setTimeout(function() {
                            $("#myElem").fadeOut("slow"); 
                        }, 5000);
                    }
                });
            });
        });

        $(window).resize(function() {
            var width = $(this).width();
            if(width < 768) {
                $.scrollify.disable();
            } else {
                $.scrollify.enable();
            }
        });

        $(window).trigger('resize');
    </script>
    
</body>
</html>