<?php
// Redirigir a index.php
header("Location: index.php");
?>
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	
	<title> Convocatoria - iArte 2024</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Bienal de pintura JA Monroy">
	<meta name="keywords" content="concurso de pintura, bienal de pintura, pintura udg, Convocatoria Bienal JA Monroy 2018">
	<meta name="author" content="d-i.mx">

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="">
	<meta property="og:image" content="">
	<meta property="og:url" content="https://www.facebook.com/Bienal-de-Pintura-Jos%C3%A9-Atanasio-Monroy-288452554635427/">
	<meta property="og:site_name" content="">
	<meta property="og:description" content="Bienal de pintura JA Monroy">
	<meta name="twitter:title" content="">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="https://twitter.com/AtanasioMonroy?lang=es">
	<meta name="twitter:card" content="">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Theme style  -->
	<!-- <link rel="stylesheet" href="css/style.css"> -->
	<link rel="stylesheet" href="css/custom.css">

	<link rel="shortcut icon" type="images/x-icon" href="">
	<!-- Modernizr JS -->
	<script async="" src="js/analytics.js"></script>
    <script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->


<!-- mi links -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- endmilinks -->


<!-- Para el forms -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

</head>
<body>

<!-- MODAL -->
<!-- MODAL ERROR -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Error de fecha</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			Lo sentimos la convocatoria ha concluido, espera los resultados proximamente. 😇
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		   <button type="button" class="btn btn-primary">Aceptar</button>
		</div>
	  </div>
	</div>
  </div> -->
<!-- END MODAL ERROR -->
<!-- END MODAL ERROR -->


<!-- Form Para el Registro -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <p>Formulario de Registro IArte 2024</p>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			
		</div>
	  </div>
	</div>
  </div>
<!-- Modal del formulario -->
<!-- END -->


<!-- Modal de Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <p>Inicia Sesion en tu cuenta</p>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="login-body">
			
		</div>
	  </div>
	</div>
  </div>
<!-- Modal del Login-->
<!-- END -->

<!-- Scripts de googleAnalytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','js/analytics.js','ga');

  ga('create', 'UA-74191543-1', 'auto');
  ga('send', 'pageview');
</script>		


<?php
session_start();

// Verifica si la sesión del usuario está activa
if (isset($_SESSION['usuario'])) {
    // El usuario está logueado, muestra el contenido
    ?>
    <div id="page">
        <!-- Aquí iría todo el contenido de tu página, como el navbar, el banner, etc. -->
        <h1>Bienvenido a la Convocatoria - iArte 2024</h1>
        <!-- Rest of the content -->
    </div>
    <?php
} else {
    // El usuario no está logueado, redirige al formulario de login
    header("Location: login.php");
    exit();
}
?>

<div id="page">

	<div class="container-wrap">
		
		<div id="countdown" style="font-size: 24px; text-align: center; margin-top: 20px;">
			Tiempo restante para participar:
			<span id="days" style="margin: 0 10px;">0</span> días
			<span id="hours" style="margin: 0 10px;">0</span> horas
			<span id="minutes" style="margin: 0 10px;">0</span> minutos
			<span id="seconds" style="margin: 0 10px;">0</span> segundos
		</div>
		<br>

		
		<div id="info-principal">
			<div class="row">
				<div class="col-sm-6 monroy">
					<div class="division"></div>
					
					<h1 class="border-amarillo"><a href="./ganadores/indexG.html">VER GANADORES DE LA CONVOCATORIA 2023</a></h1>

					<h1 class="border-amarillo"><a href="./galeria/iart-gallery/build.html">VER GALERIA 2023</a></h1>
					<div class="txt-convo">
						<div class="row">
							<h4>Producto innovadores</h4>
							Primer lugar: Juan Carlos Ramirez Flores<br>
							Segundo lugar: Vicente Gonzalez Garcia<br>
							Tercer lugar: Juan Carlos Moroy Tovar<br>
							<h4>Interaccion Ciber-humana</h4>
							Primer lugar: Alex Kevin Tapia Valle<br>
							Segundo lugar: Carlos David Macias Santillan<br>
							Tercer lugar: Juan Alejandro Sanchez Vazquez<br><br><br>
						</div>
					</div>
				</div>
					<h1 class="border-amarillo">CONVOCATORIA VI BIENAL</h1>
					<div class="txt-convo">
						<p class="sm">Abierta del 15 de Junio 2023 hasta el <del>. 31 de Agosto de 2023 a las 23:59 horas. <br>
						</del>  17 de septiembre del 2023 . </p>
						<p>Tiene como propósito explorar nuevas formas de
							expresión basadas en herramientas digitales de
							inteligencia artificial (IA), demostrar las
							capacidades de este tipo de medios, así como
							promover el desarrollo de nuevas ideas y
							aplicaciones en este campo.
							La creación de este tipo de imágenes ayuda a
							mejorar habilidades técnicas tanto en términos de
							escritura como de producción de imágenes; y
							conjuntamente difunde el conocimiento sobre IA,
							haciendo conciencia y generalizando su uso.
							La Universidad de Guadalajara, a través del
							Departamento de Innovación basada en la
							Información y el Conocimiento de la División de
							Tecnologías para la Integración Ciber-humana del
							Centro Universitario de Ciencias Exactas e
							Ingenierías convoca a participar de acuerdo con las
							siguientes bases:</p>
						
					</div>
					<div class="descargas">
						<div class="t-descargas">
							<h4>Descargas</h4>
						</div>
						<h3><a href="http://dibic.cucei.udg.mx/sites/default/files/convocatoria_1er_iarte2023.pdf" target="_blank">Convocatoria_1er_iArte2023</a></h3>
						<p class="pdf"><a href="http://dibic.cucei.udg.mx/sites/default/files/convocatoria_1er_iarte2023.pdf" target="_blank">PDF</a></p>
						<ul>
							<li><a href="#uno">¿Quién puede participar?</a></li>
							<li><a href="#dos">¿Cómo participar?</a></li>
							<li><a href="#tres">Selección de las imágenes</a></li>
							<li><a href="#cuatro">Premiación</a></li>
						</ul>
						
					</div>
				</div>
				<div class="col-md-4 col-md-offset-2 col-sm-5 col-sm-offset-1">

					<div class="row botones-inicio" style="margin-bottom:50px">
						<div class="col-sm-12">
							
						</div>
					</div>
					
					
				</div>
			</div>
			
		</div>
	</div>

	<section id="uno">
		<div class="container">
			<div class="row">
				<div class="col-sm-5 col-sm-offset-3">
					<div class="uno text-center">
						<!--h1>Uno</h1>
						<p class="l-blanca">_________________________</p-->
						<h2>¿Quién puede participar?</h2>
						<p><strong>UNO</strong>. Pueden participar personas mayores de 18 
							años cumplidos al momento de la inscripción a la 
							convocatoria.
							
							</p>
						<p><strong>DOS</strong>. El registro de participación será a través de la 
							página metaverso.udg.mx/IArte2023 y queda abierto 
							a partir del día 15 de junio del 2023 a las 19:00 hrs 
							concluyendo el día<del> 31 de agosto a las 23:59 hrs (Zona 
							Centro de México). </del>
							<br>
							</del>  17 de septiembre del 2023 a las 23:59 hrs (Zona 
							Centro de México).

							<br>
							Para el registro se requiere subir la siguiente 
							documentación: </p>
							<ol type="i" style="color: aliceblue;"> 
								<li style="text-align: initial;">
									Identificación oficial vigente
								</li>
								<li style="text-align: initial;">
									Comprobante de domicilio reciente 
									(no mayor a dos meses anteriores)
								</li>
								<li style="text-align: initial;">
									La imagen en formato jpg con un 
									tamaño máximo de 5 MB (1200x448px)
								
								</li>
								<li style="text-align: initial;">
									La cadena de texto generadora de la 
									imagen cuando sea generada mediante 
									prompt
								
								</li>
								<li style="text-align: initial;">
									El manifiesto firmado
								
								</li>
							</ol>
							</p>
						<a href="#dos"><img src="https://www.bienaljamonroy.mx/images/siguiente-blanco.png"></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="dos">
		<div class="container">
			<div class="row">
				<div class="col-sm-5 col-sm-offset-3">
					<div class="tres text-center">
						<!--h1>Tres</h1>
						<p class="l-negra">_________________________</p-->
						<h2>¿CÓMO PARTICIPAR?</h2>
						<p><strong>TRES</strong>. Para el registro se requiere subir la siguiente
							documentación:
							<ol type="a"> 
								<li style="text-align: initial;">Identificación oficial vigente.</li>
								<li style="text-align: initial;">Comprobante de domicilio reciente.</li>
								<li style="text-align: initial;">La imagen en formato jpg.</li>
								<li style="text-align: initial;">La cadena de texto generadora de la imagen cuando se generada con prompt.</li>
								<li style="text-align: initial;">El manifiesto firmado:</li>
								<li style="text-align: initial;">Descargar, rellenar y firmar el documento de MANIFIESTO.<br> <a href="./files/Manifiesto_1ER CONCURSO IA.doc" download="Manifiesto_1ER CONCURSO IA.doc">Descargalo aquí.</a></li>
								<li style="text-align: initial;">Realiza tu registro al concurso<br> <a href="./registro.php">AQUÍ.</a></li>
							</ol>

						<p></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="tres">
		<div class="container">
			<div class="row">
				<div class="col-sm-5 col-sm-offset-3">
					<div class="dos text-center">
						<!--h1>Dos</h1>
						<p class="l-negra">_________________________</p-->
						<h2>Selección de las Imágenes</h2>
						<p><strong>CUATRO</strong>. El jurado seleccionará primero, segundo y 
							tercer lugar de cada una de las dos categorías; además 
							de 44 menciones honorificas para hacer una exposición 
							que tendrá lugar en las instalaciones del CUCEI, 
							mismas que formarán parte de en un libro digital.
							El jurado estará integrado por especialistas en 
							innovación e interacción ciber-humana. Su fallo se 
							hará público en el mes de septiembre del 2023 y es 
							inapelable. Se notificará a los ganadores de las 
							imágenes seleccionadas vía correo electrónico.
						</p>
						
						<p><strong>CINCO</strong>. Los participantes pueden inscribir un máximo 
							de dos imágenes en cada una de las siguientes 
							categorías:</p>
							<ol type="a"> 
									
								<li style="text-align: initial;">Producto innovador, descripción de productos que
									no existan en el mercado actual con el objetivo de
									mostrar habilidades en la descripción de manera
									atractiva y creativa.</li>
								<li style="text-align: initial;"> Interacción ciber-humana, descripción de
									actividades que involucren este tipo de interacción en
									imágenes artísticas y expresivas. </li>
								</ol>
								<p>Las imágenes deben ser originales y no haberse 
									publicado en ningún medio con anterioridad. Los 
									autores deberán ceder cualquier derecho patrimonial 
									sobre las imágenes a la Universidad de Guadalajara, 
									conservando el derecho de autoría.</p>
							  
							
						<p><strong>SEIS</strong>. Los asuntos no previstos en la presente 
							convocatoria serán resueltos por el comité 
							organizador</p>
						
						<a href="#tres"><img src="https://www.bienaljamonroy.mx/images/siguiente-negro.png"></a>
					</div>
				</div>
			</div>
		</div>
	</section>


	<section id="cuatro">
		<div class="container">
			<div class="row">
				<div class="col-sm-5 col-sm-offset-3">
					<div class="cuatro text-center">
						<!--h1>cuatro</h1>
						<p class="l-blanca">_________________________</p-->
						<h2>PREMIACIÓN</h2>
						<p><strong>SIETE</strong>. 
							Los participantes que vivan en México o sean 
							extranjeros con dos años de estancia comprobable 
							en el país al momento de su inscripción, se harán 
							acreedores a un premio de la siguiente forma:
							<ol type="a" style="color: aliceblue;"> 
								<li style="text-align: initial;">Categoría producto innovador
									<ul>
										<li>Un primer lugar con un premio  una laptop</li>
										<li>Un segundo lugar con un premio de una Tablet</li>
										<li>Un tercer lugar con un premio de unos audífonos</li>
									</ul>
								</li>
								<li style="text-align: initial;">Categoría interacción ciber-humana
									<ul>
										<li>Un primer lugar con un premio  una laptop</li>
										<li>Un segundo lugar con un premio de una Tablet</li>
										<li>Un tercer lugar con un premio de unos audífonos</li>
									</ul>
								</li>
							</ol>
							<p style="text-align: initial;">
								El jurado estará integrado por especialistas 
								en innovación e interacción ciber-humana. Su 
								fallo se hará público en el mes de septiembre del 
								2023. Se notificará a los ganadores de las 
								imágenes seleccionadas vía correo electrónico.

							</p>
							
							
						<p class="atte">ATENTAMENTE<br>Guadalajara, Jalisco, México, 01 de Junio de 2023.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-offset-1 col-sm-9">
					<p class="atte">
						<strong>Dra. Adriana Peña Pérez Negrón</strong><br>
						Jefe de Departamento de Innovación Basada en la Información y el Conocimiento<br>
						Universidad de Guadalajara
					</p>
				</div>
				<div class="col-sm-offset-1 col-sm-9">
					<p class="atte">
						<strong>Dr. José Luis David Bonilla Carranza</strong><br>
						Coordinador de Ingeniería en Computación<br>
						Universidad de Guadalajara
					</p> 
				</div>
			</div>
		</div>
	</section> 
	

	<footer id="b-footer"  style="background-color: beige; border-color: aliceblue;" role="contentinfo">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">
				
			</div>
			<div class="row img-f text-center">
				<div class="col-md-2 col-sm-12">
					<img src="./images/Orange.png" width="150px" alt="" srcset="">
					
				</div>
				
				<div class="col-md-2 col-sm-12">
					<img src="./images/lUDG.png" width="360px" alt="" srcset="">
					
				</div>
				
			</div>

			<div class="row copyright">	
				<div class="col-md-12">
					<p> 
						<small class="block">Equipo de desarrollo web: </small><br>
						<small class="block"><a href="https://github.com/ajolote96" target="_blank">Jose Luis David Bonilla Carranza</a></small><br>
						<small class="block"><a href="https://github.com/SnowTrash" target="_blank">Juan Carlos Vargas López</a></small> <br>
						<small class="block"><a href="https://github.com/OscarRamos120" target="_blank">Oscar Ramos</a></small> <br>
						<small class="block"><a href="https://github.com/NomarGonz" target="_blank">Héctor Nomar González Flores</a></small> <br>
						<small class="block"><a href="https://github.com/ZeusCobian" target="_blank">Zeus Gutierrez Cobian</a></small><br><br>
						<!-- <small class="block">Izmael Guzmán Murguía</small><br> -->
						<small class="block">Fecha de actulizacion del sitio vie - 14/05/2024 </small> 
						<small class="block">© 2024 CUCEI UDG. Derechos Reservados</small> 
						<small class="block"><a href="http://transparencia.udg.mx/aviso-confidencialidad-integral" target="_blank">Aviso de privacidad</a></small>
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>

</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->

	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>


	<!-- Counters -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>



	<!-- Scripst del Modal -->
	<!-- Probar con _old.php y _new.php -->
<script>
		$('#form').on('click',function(){
			$('.modal-body').load('registro_new.php',function(){
				$('#formModal').modal({show:true});
			});
		});
</script>

<script>
	$('#logform').on('click',function(){
		$('.login-body').load('login.php',function(){
			$('#loginModal').modal({show:true});
		});
	});
</script>

</body>
</html>

<script>

const targetDate = new Date('2024-09-17 23:59:59').getTime();

function updateCountdown() {
  const currentDate = new Date().getTime();
  const timeLeft = targetDate - currentDate;

  const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
  const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

  document.getElementById('days').textContent = days;
  document.getElementById('hours').textContent = hours;
  document.getElementById('minutes').textContent = minutes;
  document.getElementById('seconds').textContent = seconds;
}

// Actualiza el contador cada segundo
setInterval(updateCountdown, 1000);

// Llama a updateCountdown() inmediatamente para evitar un retraso en la visualización inicial
updateCountdown();

</script>


<style>
#countdown {
  font-size: 24px;
  text-align: center;
  margin-top: 1px;
  color: #333; /* Color del texto */
  background-color: #f5f5f5; /* Color de fondo */
  padding: 10px;
  border-radius: 10px; /* Bordes redondeados */
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); /* Sombra */
}

#countdown span {
  margin: 0 10px;
  font-size: 1.2em; /* Tamaño del texto para días, horas, minutos y segundos */
  color: #fff; /* Color del texto para días, horas, minutos y segundos */
  background-color: #333; /* Color de fondo para días, horas, minutos y segundos */
  padding: 5px 10px; /* Espaciado interno */
  border-radius: 5px; /* Bordes redondeados */
}

body {
	max-width: 1060px;
	margin: 0 auto;
	margin-bottom: 1em;
	@media screen and (max-width: 1060px ) {
		width: 100%;
	}
}

</style>