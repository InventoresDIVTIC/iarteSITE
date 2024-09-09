<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" >
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- multistep form -->
<?php include('conexion.php'); ?>
<form id="msform" method="POST" action="procesa_fixed.php" enctype="multipart/form-data">

<!-- Input para el número -->
<input class="escondido" type="number" name="numberInput" id="numberInput" min="10" max="100" placeholder="Ingrese un número entre 10 y 100" style="margin-top: 20px;" value="0" oninput="adjustGradient(this.value)">
  
<!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Información Personal</li>
    <li>Documentos Oficiales</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Datos Personales</h2>
    <h3 class="fs-subtitle">Los campos marcados con * son OBLIGATORIOS </h3>

    <input type="text" id="nombre" name="nombre" placeholder="*Nombre Completo" onBlur="validateInput(this.id,this.value,this.style,document.getElementById('nombre-error').style,document.getElementById('nombre-error'))" />
    <p id="nombre-error"></p>
    <div id="validation-success" style="display: none; color: green;"> </div>
    
  <div style="display: flex; gap: 10px;">
    <input type="text" id="telefono" name="telefono" placeholder="*Telefono" onBlur="validateInput(this.id,this.value,this.style,document.getElementById('telefono-error').style,document.getElementById('telefono-error'))" class="telinpt"/>
    <input type="number" id="edad" name="edad" min="18" max="80" placeholder="Edad*" onBlur="validateInput(this.id,this.value,this.style,document.getElementById('edad-error').style,document.getElementById('edad-error'))" class="ageinpt" />  
  </div>
  <p id="telefono-error"></p>
  <p id="edad-error"></p>

  <div class="password-container">
  <input type="password" id="password" name="password" placeholder="*Contraseña" 
           onBlur="validateInput(this.id,this.value,this.style,document.getElementById('contrasena-error').style,document.getElementById('contrasena-error'))" />
    <i class="eye-icon" id="togglePassword"></i>  
  <p id="contrasena-error"></p>
  </div>

    <input type="email" id="correo" name="correo" placeholder="E-Mail" onBlur="validateInput(this.id,this.value,this.style,document.getElementById('email-error').style,document.getElementById('email-error'))" />
    <p id="email-error"></p>
    <input type="button" style="display:flex; width:100%;text-align: center;" name="next" class="next action-button" onBlur="" value="Next" />
    
  </fieldset>

  <fieldset id="compDom">
    <h2 class="fs-title">Documentos Necesarios</h2>
    <h3 class="fs-subtitle">(Comprueba tu identidad antes de concursar)</h3>
    <!-- Input File test -->


    <!-- Comprobante de domicilio -->
    <div class="file-drop-area">
    <span class="fake-btn">* Comprobante de domicilio </span>
    <span class="file-msg">[reciente en formato (.PDF)]</span>
    <p id="addrsInp-error"> </p>
    <input class="file-input" id="addrsInp" name="addrsInp" type="file" onchange="validateInput(this.id,this.value,this.style,document.getElementById('addrsInp-error').style,document.getElementById('addrsInp-error'))" accept="application/pdf" required >
    </div>

    <!-- INE -->
    <div class="file-drop-area">
    <span class="fake-btn">* Identificacion Oficial</span>
    <span class="file-msg">[vigente y por ambos lados]</span>
    <p id="idInp-error"> </p> 
    <input class="file-input" id="idInp" name="idInp" type="file" onchange="validateInput(this.id,this.value,this.style,document.getElementById('idInp-error').style,document.getElementById('idInp-error'))" accept="application/pdf" required >
    </div>
    
    <!-- Manifiesto firmado -->
    <div class="file-drop-area">
    <span class="fake-btn">* Manifiesto del concurso</span>
    <span class="file-msg">[firmado]</span>
    <p id="manifestInp-error"> </p>
    <input class="file-input" id="manifestInp" name="manifestInp" type="file" onchange="validateInput(this.id,this.value,this.style,document.getElementById('manifestInp-error').style,document.getElementById('manifestInp-error'))" accept="application/pdf" required >
    </div>

    <!-- Botones next y previious -->
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <!-- <input type="button" name="next" class="next action-button" value="Next" /> -->
    <!-- <a href="https://twitter.com/GoktepeAtakan" class="submit action-button" target="_top">Submit</a> -->
    <button type="submit" class="submit action-button" onclick="sendData();">Enviar</button>
  </fieldset>

  <!-- <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="fname" placeholder="First Name" />
    <input type="text" name="lname" placeholder="Last Name" />
    <input type="text" name="phone" placeholder="Phone" />
    <textarea name="address" placeholder="Address"></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
  </fieldset> -->
  
</form>

<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function () {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Cambiar el icono
    this.classList.toggle('show-password');
});

  function sendData(){
      document.getElementById("msform").submit();
    }
</script>

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
        
      // Activate next step on progressbar using the index of next_fs and add pulse effect
      var $nextProgressBarItem = $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("pulse");

      //show the next fieldset
      next_fs.show(); 

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
            // Remove pulse class after animation completes
            $nextProgressBarItem.removeClass('pulse');
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
        
    // Get current and previous progress bar items
    var $currentProgressBarItem = $("#progressbar li").eq($("fieldset").index(current_fs));
    var $previousProgressBarItem = $("#progressbar li").eq($("fieldset").index(previous_fs));

    // Deactivate current and activate previous step on progressbar
    $currentProgressBarItem.removeClass("active");
    $previousProgressBarItem.addClass("active pulse"); // Add pulse effect to the previous progress bar item
    
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
                $previousProgressBarItem.removeClass('pulse'); // Remove pulse class after animation
            }, 
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });
</script>


<!-- Validación -->
<script>
var adjustedProgress = {}; // Objeto para rastrear si ya se ajustó el progreso
function validateInput(elementId,value,style,errorStyle,errorDiv) {
    var input = document.getElementById(elementId);
    var successDiv = document.getElementById("validation-success");
    // var value = document.querySelector("#"+elementId).value;
    
    var progress = document.getElementById("numberInput").value;

    var clninput = 0;
    clninput = parseInt(progress);
    if (!adjustedProgress[elementId]) {
        adjustedProgress[elementId] = false;
    }

    console.log({"param":value , "numberinput":progress});
    // Flags
    let isValid = true;
    let errorMessage = '';
    // Remove previously set styles and class
    // input.classList.remove('invalid-input');
  switch (elementId) {
        case 'nombre':
            if (value === '' || value === null ) {
                // console.log("nombre required");
                errorMessage = "El nombre es requerido";
                isValid = false;
            } else if (value.length < 3) {
                errorMessage = "El nombre debe tener al menos 3 caracteres.";
                isValid = false;
            } else {isValid = true;}
            break;
        case 'correo':
            if (value === '') {
                errorMessage = "El correo electrónico es requerido.";
                isValid = false;
            } else if (!/[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm.test(value)) {
                errorMessage = "El correo electrónico no es válido.";
                isValid = false;
            }
            break;
        case 'telefono':
            if (value === '') {
                errorMessage = "El teléfono es requerido.";
                isValid = false;
            } else if (!/^\d{10}$/.test(value)) {
                errorMessage = "El teléfono debe tener 10 dígitos.";
                isValid = false;
            }
            break;
        case 'edad':
            if (value === '' || value === null) {
                errorMessage = "La edad es requerida.";
                isValid = false;
            } else if (parseInt(value) < 18) {
                errorMessage = "Debes ser mayor de 18 años.";
                isValid = false;
            } else {
                isValid = true;
            }
            break;

        // Resolver validación para archivos
        // Agregando validación para input img
        case 'addrsInp':
            var fileInput = input.files[0];
            style = document.getElementById(elementId).parentElement.style;
            if (!fileInput) {
                errorMessage = "Necesitas seleccionar un archivo al menos.";
                isValid = false;
            } else if (!/\.pdf$/i.test(fileInput.name)) {
                errorMessage = "El archivo no es válido. Solo se permiten archivos PDF.";
                isValid = false;
            } else {
                console.log("Archivo válido: " + fileInput.name);
                var msgContainer = input.parentElement.querySelector('.file-msg');
                msgContainer.textContent = fileInput.name;
                isValid = true;
            }
            break;
        case 'idInp':
            var fileInput = input.files[0];
            style = document.getElementById(elementId).parentElement.style;
            if (!fileInput) {
                errorMessage = "Necesitas seleccionar un archivo al menos.";
                isValid = false;
            } else if (!/\.pdf$/i.test(fileInput.name)) {
                errorMessage = "El archivo no es válido. Solo se permiten archivos PDF.";
                isValid = false;
            } else {
                console.log("Archivo válido: " + fileInput.name);
                var msgContainer = input.parentElement.querySelector('.file-msg');
                msgContainer.textContent = fileInput.name;
                isValid = true;
            }
            break;

        case 'manifestInp':
            var fileInput = input.files[0];
            style = document.getElementById(elementId).parentElement.style;
            if (!fileInput) {
                errorMessage = "Necesitas seleccionar un archivo al menos.";
                isValid = false;
            } else if (!/\.pdf$/i.test(fileInput.name)) {
                errorMessage = "El archivo no es válido. Solo se permiten archivos PDF.";
                isValid = false;
            } else {
                console.log("Archivo válido: " + fileInput.name);
                var msgContainer = input.parentElement.querySelector('.file-msg');
                msgContainer.textContent = fileInput.name;
                isValid = true;
            }
            break;

        case 'password':
          if (value === '') {
        errorMessage = "La contraseña es requerida.";
        isValid = false;
        } else if (value.length < 8) {
            errorMessage = "La contraseña debe tener al menos 8 caracteres.";
            isValid = false;
        } else if (!/[A-Z]/.test(value)) {
            errorMessage = "La contraseña debe contener al menos una letra mayúscula.";
            isValid = false;
        } else if (!/[0-9]/.test(value)) {
            errorMessage = "La contraseña debe contener al menos un número.";
            isValid = false;
        } else {
            isValid = true;
        }
          break;
        // case '':  ----------- Aqui deben ir los case para los otros pdf
        default:
            console.log("No se reconoce el ID del elemento.");
            isValid = false;
}

if (!isValid) {
    console.log({"Input: ": input, "Error:": errorDiv, "innerError": errorDiv.innerText});
    
    // Reset shake animation
    style.animation = 'none';
    input.offsetHeight;  // Trigger DOM reflow
    style.border = "5px solid #ff0000";
    style.animation = "shake 0.5s";
    
    // Set error message text
    errorDiv.innerText = errorMessage;

    console.log({"errorDiv.value:--": errorDiv.value, "errorDiv.innerText:--": errorDiv.innerText});
    
    window.navigator.vibrate([200, 100, 200]);

    errorDiv.offsetHeight;

    // Style error message
    errorStyle.width = "auto";
    errorStyle.height = "auto";
    errorStyle.font = "15px Arial";
    errorStyle.display = "flex";
    errorStyle.color = "orange";
    errorStyle.padding = "10px";
    errorStyle.position = "absolute";
    
    errorStyle.transform = "translateY(-53px)";
    errorStyle.background = "rgba(255, 0, 0, 0.7)";
    errorStyle.zIndex = "1000";
    errorStyle.pointerEvents = "none";  // Prevent blocking interaction with input

    // Auto-hide error message after 3 seconds
    setTimeout(() => {
        errorDiv.innerText = "";
        errorStyle.display = "none";
    }, 1900);  // Adjust the time as needed

    // Other logic for managing gradient or input progress...
    if (clninput > 0 && !adjustedProgress[elementId]) {
        clninput -= 15;
        adjustedProgress[elementId] = true;
    }

    document.getElementById("numberInput").value = clninput;
    adjustGradient(clninput);

} else {
    // Reset pulse animation
    style.animation = 'none';
    input.offsetHeight;  // Trigger DOM reflow

    style.animation = "pulse 0.6s";
    style.border = "5px solid #00ff00";
    style.zIndex = 10;

    // Hide error and show success message
    errorStyle.display = "none";
    successDiv.style.display = "block";

    // Other logic for managing gradient or input progress...
    if (clninput < 100 && !adjustedProgress[elementId]) {
        clninput += 15;
        adjustedProgress[elementId] = true;
    }
    
    document.getElementById("numberInput").value = clninput;
    adjustGradient(clninput);
}

  // console.log(errorMessage);
}
</script>


<!-- Filedrop validate -->
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


<!-- Scripts para local storage -->

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
  height: 80%;
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
  height: 70%;
	/* margin: 50px auto; */
	text-align: center;
	position: relative;
}

#msform fieldset {
  background: linear-gradient(rgba(255, 0, 0, 0.5), rgba(0, 128, 0, 0.5));
  /*  Configuración inicial del gradiente */
	/* border: 0 none; */
	border-radius: 3px;
	/* box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4); */
	padding: 20px 30px;
	box-sizing: border-box;
	width: 75%;
  height: auto;
  
	margin: 0 10%;
	
	/*stacking fieldsets above each other*/
	position: relative;
}

#msform .telinpt{
  width: 70%;
  flex: 1;
}

#msform .ageinpt {
  width: 20%;
  flex: 1;
}

.password-container {
  position: relative;
  width: 90%;
}

#password {
  padding-right: 30px; /* Espacio para el icono */
}

.eye-icon {
  position: absolute;
  top: 45%;
  right: 15px;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 20px; /* Ajusta el tamaño según tu preferencia */
}

.eye-icon:before {
  content: '\f06e'; /* Código de Font Awesome para el ícono de ojo */
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
}

.eye-icon.show-password:before {
  content: '\f070'; /* Código de Font Awesome para el ícono de ojo tachado */
}


/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
	display: none;
}

.escondido{
  display: none;
}

.visible{
  font-size: 12px;
  display: inherit;
  color: black;
  position: relative;
  background: linear-gradient(rgba(153, 153, 102, 0.8), rgba(102, 153, 153, 0.8)); /* Gradiente rojo-verde menos transparente */
}

/* ---------------------------------------------------------------- */
/* INPUT FILE DROPS */
/* Estilos para el input file */

#msform .file-drop-area.valid {
    border: 3px solid #00ff00;
}

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
  /* border: 5px solid rgba(250, 255, 0, 0.8); */
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
  height: 80%;
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

.addrsInp-error {
  border-color: blue;
  color: red;
}

/*Otros inputs con sus respectivos styles*/
#msform input, #msform textarea {
	padding: 15px;
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

}
.valid-input {
    border: 3px solid #0000ff;
}

.invalid-input {
    border: 3px solid #ff0000;
    animation: shake 0.3s;
    animation-iteration-count: 1;
}

@keyframes shake {
    0% { margin-left: 0px; }
    25% { margin-left: 15px; }
    75% { margin-left: -15px; }
    100% { margin-left: 0px; }
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
  transition: background-color 0.3s ease; /* Agrega una transición suave al cambiar el color de fondo */
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
  transition: background-color 0.3s ease; /* Transición suave para el cambio de color del indicador */
}
/*progressbar connectors*/
#progressbar li:after {
	content: '';
	width: 100%;
	height: 4px;
	background: red;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index: -1; /*put it behind the numbers*/
  transition: background-color 0.3s ease; /* Transición suave para el conector */
}
#progressbar li:first-child:after {
	/*connector not needed before the first step*/
	content: none;
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
	background: #00b300;
	color: black;
}
.modal-footer{
    height:fit-content;
}
/* Animación de pulso */
@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.7;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
.pulse {
    animation: pulse 1s infinite;
}

</style>