<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" >
    <title>Document</title>
</head>
<body>
    <!-- multistep form -->
<?php include('conexion.php'); ?>
<form id="msform" method="POST" action="procesa_registro.php" enctype="multipart/form-data">

<!-- Input para el número -->
<input type="number" id="numberInput" min="10" max="100" placeholder="Ingrese un número entre 10 y 100" style="margin-top: 20px;" oninput="adjustGradient(this.value)">
  
<!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Información Personal</li>
    <li>Documentos Oficiales</li>
    <li><< Participa >></li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Datos Personales</h2>
    <h3 class="fs-subtitle">Los campos marcados con * son OBLIGATORIOS </h3>

    <input type="text" id="nombre" name="nombre" placeholder="*Nombre Completo" required>
    <input type="text" id="telefono" name="telefono" placeholder="*Telefono" required>
    <input type="email" id="correo" name="correo" placeholder="E-Mail" onblur="validateInput()" required>
    <input type="number" id="edad" name="edad" min="18" max="80" placeholder="Edad*" required>
    <input type="button" style="display:flex; width:100%;text-align: center;" name="next" class="next action-button" value="Next" />
    
  </fieldset>

  <fieldset>
    <h2 class="fs-title">Documentos Necesarios</h2>
    <h3 class="fs-subtitle">(Comprueba tu identidad antes de concursar)</h3>
    <!-- Input File test -->

    <!-- INE -->
    <div class="file-drop-area">
    <span class="fake-btn">* Comprobante de domicilio </span>
    <span class="file-msg">[reciente (.PDF)]</span>
    <input class="file-input" type="file" multiple>
    </div>

    <!-- Comprobante de domicilio -->
    <div class="file-drop-area">
    <span class="fake-btn">Identificacion Oficial</span>
    <span class="file-msg">[vigente y por ambos lados]</span>
    <input class="file-input" type="file" multiple>
    </div>
    
    <!-- Manifiesto firmado -->
    <div class="file-drop-area">
    <span class="fake-btn">Identificacion Oficial</span>
    <span class="file-msg">[vigente y por ambos lados]</span>
    <input class="file-input" type="file" multiple>
    </div>

    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>

  <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <input type="text" name="lname" placeholder="Last Name" />
    <input type="text" name="phone" placeholder="Phone" />
    <textarea name="address" placeholder="Address"></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    
    <a href="https://twitter.com/GoktepeAtakan" class="submit action-button" target="_top">Submit</a>
  </fieldset>
</form>


<script>
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
    
$(".next").click(function(){
        if(animating) return false;
        animating = true;
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        //activate next step on progressbar using the index of next_fs
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
            'transform': 'scale('+scale+')',
            'position': 'absolute'
          });
                next_fs.css({'left': left, 'opacity': opacity});
            }, 
            duration: 800, 
            complete: function(){
                current_fs.hide();
                animating = false;
            }, 
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
});
    

$(".previous").click(function(){
        if(animating) return false;
        animating = true;
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //show the previous fieldset
        previous_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1-now) * 50)+"%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            }, 
            duration: 800, 
            complete: function(){
                current_fs.hide();
                animating = false;
            }, 
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });
</script>


<script>
var $fileInput = $('.file-input');
var $droparea = $('.file-drop-area');

// highlight drag area
$fileInput.on('dragenter focus click', function() {
  $droparea.addClass('is-active');
});

// back to normal state
$fileInput.on('dragleave blur drop', function() {
  $droparea.removeClass('is-active');
});

// change inner text
$fileInput.on('change', function() {
  var filesCount = $(this)[0].files.length;
  var $textContainer = $(this).prev();

  if (filesCount === 1) {
    // if single file is selected, show file name
    var fileName = $(this).val().split('\\').pop();
    $textContainer.text(fileName);
  } else {
    // otherwise show number of files
    $textContainer.text('Invalid' +filesCount + ' files selected');
  }
});
</script>


<script>
function adjustGradient(value) {
    console.log("Valor del input: " + value);
    const fieldsets = document.querySelectorAll('#msform fieldset');
    const min = 10; // El mínimo valor del input
    const max = 100; // El máximo valor del input
    const scale = (value - min) / (max - min); // Escala el valor entre 0 y 1
    console.log("scale: " + scale);

    // Aplica el cambio a todos los fieldsets en el formulario
    fieldsets.forEach(function(fieldset) {
        // Se configura un gradiente que varía en color de rojo a verde y en opacidad de más opaco a más transparente
        fieldset.style.background = `linear-gradient(rgba(255, 0, 0, ${1 - scale}), rgba(0, 128, 0, ${scale}))`;
    });
}
</script>


<!-- Validaciones -->
<script>
function validateInput(input) {
    let isValid = true;
    let errorMessage = "";

    if (input.value.trim() === "") {
        isValid = false;
        errorMessage = "Este campo es obligatorio.";
    } else if (input.type === "email") {
        // Expresión regular básica para un formato de correo electrónico
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(input.value)) {
            isValid = false;
            errorMessage = "Por favor, ingresa un correo electrónico válido.";
        }
    }

    // Manejo del mensaje de error
    const errorElement = document.getElementById(input.id + "-error");
    if (errorElement) {
        errorElement.textContent = errorMessage;
    }

    return isValid;
}

document.addEventListener("DOMContentLoaded", function() {
    // Agregar eventos blur a todos los campos requeridos
    const inputs = document.querySelectorAll("#msform input[required]");
    inputs.forEach(input => {
        const span = document.createElement("span");
        span.id = input.id + "-error";
        span.style.color = "red";
        input.parentNode.insertBefore(span, input.nextSibling);

        input.addEventListener("blur", function() {
            validateInput(input);
        });
    });
});
</script>


</body>
</html>

<style >
    /*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);

/*basic reset*/
* {margin: 0; padding: 0;}

.modal-header{
  height: 6%;
  text-align: center;
  color: black;
}

.modal-body {
  height: 85%;
	font-family: montserrat, arial, verdana;
}

.modal-content{
	display: inherit;
	height: auto;
  background: linear-gradient(rgba(153, 153, 102, 0.8), rgba(102, 153, 153, 0.8)); /* Gradiente rojo-verde menos transparente */
}

/*form styles*/
#msform {
	width: auto;
	/* margin: 50px auto; */
	text-align: center;
	position: relative;
}

#msform fieldset {
  background: linear-gradient(rgba(255, 0, 0, 0.5), rgba(0, 128, 0, 0.5));
  /*  Configuración inicial del gradiente */
	border: 0 none;
	border-radius: 3px;
	box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
	padding: 20px 30px;
	box-sizing: border-box;
	width: 80%;
  height: auto;
  
	margin: 0 10%;
	
	/*stacking fieldsets above each other*/
	position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
	display: none;
}


/* ---------------------------------------------------------------- */
/* INPUT FILE DROPS */
/* Estilos para el input file */

#msform .file-drop-area {
  position: relative;
  display: flex;
  align-items: flex-start; /* Alinear elementos en la parte superior */
  flex-direction: column; /* Apilar elementos verticalmente */
  width: 450px;
  max-width: 100%;
  padding: 20px;
  border-radius: 3px;
  transition: 0.2s;
  border: 5px solid rgba(250, 255, 0, 0.8);
  color: black;
}

#msform .file-drop-area.is-active {
  background-color: rgba(255, 255, 255, 0.05);
}

#msform .file-drop-area .fake-btn {
  background-color: rgba(255, 255, 255, 0.04);
  border-radius: 3px;
  padding: 8px 15px;
  margin-bottom: 10px; /* Espacio entre fake-btn y file-msg */
  font-size: 12px;
  text-transform: uppercase;
}

#msform .file-drop-area .file-msg {
  font-size: small;
  font-weight: 300;
  line-height: 1.4;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

#msform .file-drop-area .file-input {
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 100%;
  cursor: pointer;
  opacity: 0;
}

/* States of file */
#msform .file-drop-area .file-input:focus {
  outline: none;
}

.file-selected .file-drop-area {
  border-color: green;
}

.file-selected .file-msg {
  color: green;
}

.file-not-selected .file-drop-area {
  border-color: red;
}

.file-not-selected .file-msg {
  color: red;
}

/*Otros inputs con sus respectivos styles*/
#msform input, #msform textarea {
	padding: 15px;
	border: 3px solid #ccc;
	border-radius: 3px;
	margin-bottom: 10px;
	width: 100%;
	box-sizing: border-box;
	font-family: times;
	color: black;
	font-size: 13px;
}

/*buttons*/
#msform .action-button {
	width: 100px;
	background: #27AE60;
	font-weight: bold;
	color: black;
	border: 0 none;
	border-radius: 1px;
	cursor: pointer;
	padding: 10px;
	margin: 10px 5px;
  text-decoration: none;
  font-size: 14px;
}
#msform .action-button:hover, #msform .action-button:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
}

/*titulos y subtitulos imgs*/
.fs-title {
	font-size: 15px;
	text-transform: uppercase;
	color: black;
	margin-bottom: 10px;
}
.fs-subtitle {
	font-weight: normal;
	font-size: 13px;
	color: black;
	margin-bottom: 20px;
}
/* ---------------------------------------------------------------- */
/* ---------------------------------------------------------------- */
/*END Input File--------------------------------------------------- */
/* ---------------------------------------------------------------- */

/*progressbar*/
#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	/*CSS counters to number the steps*/
	counter-reset: step;
}
#progressbar li {
	list-style-type: none;
	color: white;
	font-size: 15px;
	width: 33.33%;
	float: left;
	position: relative;
}
#progressbar li:before {
	content: counter(step);
	counter-increment: step;
	width: 20px;
	line-height: 25px;
	display: block;
	font-size: 12px;
	color: #333;
	background: #ff1a1a;
	border-radius: 3px;
	margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: red;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
	/*connector not needed before the first step*/
	content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
	background: #00b300;
	color: white;
}
.modal-footer{
    height:fit-content;
}
</style>