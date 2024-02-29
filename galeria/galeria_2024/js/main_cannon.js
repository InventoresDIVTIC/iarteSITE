
THREE.FirstPersonControls = function ( camera, MouseMoveSensitivity = 0.002, speed = 800.0, jumpHeight = 350.0, height = 30.0) {
    var scope = this;
    
    scope.MouseMoveSensitivity = MouseMoveSensitivity;
    scope.speed = speed;
    scope.height = height;
    scope.jumpHeight = scope.height + jumpHeight;
    scope.click = false;
    
    var moveForward = false;
    var moveBackward = false;
    var moveLeft = false;
    var moveRight = false;
    var canJump = false;
    var run = false;
    
    var velocity = new THREE.Vector3();
    var direction = new THREE.Vector3();
  
    var prevTime = performance.now();
  
    camera.rotation.set( 0, 0, 0 );
  
    var pitchObject = new THREE.Object3D();
    pitchObject.add( camera );
  
    var yawObject = new THREE.Object3D();
    yawObject.position.y = 10;
    yawObject.add( pitchObject );
  
    var PI_2 = Math.PI / 2;
  
    var onMouseMove = function ( event ) {
  
      if ( scope.enabled === false ) return;
  
      var movementX = event.movementX || event.mozMovementX || event.webkitMovementX || 0;
      var movementY = event.movementY || event.mozMovementY || event.webkitMovementY || 0;
  
      yawObject.rotation.y -= movementX * scope.MouseMoveSensitivity;
      pitchObject.rotation.x -= movementY * scope.MouseMoveSensitivity;
  
      pitchObject.rotation.x = Math.max( - PI_2, Math.min( PI_2, pitchObject.rotation.x ) );
  
    };
  
    var onKeyDown = (function ( event ) {
      
      if ( scope.enabled === false ) return;
      
      switch ( event.keyCode ) {
        case 38: // up
        case 87: // w
          moveForward = true;
          break;
  
        case 37: // left
        case 65: // a
          moveLeft = true;
          break;
  
        case 40: // down
        case 83: // s
          moveBackward = true;
          break;
  
        case 39: // right
        case 68: // d
          moveRight = true;
          break;
  
        case 32: // space
          if ( canJump === true ) velocity.y += run === false ? scope.jumpHeight : scope.jumpHeight + 50;
          canJump = false;
          break;
  
        case 16: // shift
          run = true;
          break;
  
      }
  
    }).bind(this);
  
    var onKeyUp = (function ( event ) {
      
      if ( scope.enabled === false ) return;
      
      switch ( event.keyCode ) {
  
        case 38: // up
        case 87: // w
          moveForward = false;
          break;
  
        case 37: // left
        case 65: // a
          moveLeft = false;
          break;
  
        case 40: // down
        case 83: // s
          moveBackward = false;
          break;
  
        case 39: // right
        case 68: // d
          moveRight = false;
          break;
  
        case 16: // shift
          run = false;
          break;
  
      }
  
    }).bind(this);
    
    var onMouseDownClick= (function ( event ) {
      if ( scope.enabled === false ) return; 
      scope.click = true;
    }).bind(this);
    
    var onMouseUpClick= (function ( event ) {
      if ( scope.enabled === false ) return; 
      scope.click = false;
    }).bind(this);
  
    scope.dispose = function() {
      document.removeEventListener( 'mousemove', onMouseMove, false );
      document.removeEventListener( 'keydown', onKeyDown, false );
      document.removeEventListener( 'keyup', onKeyUp, false );
      document.removeEventListener( 'mousedown', onMouseDownClick, false );
      document.removeEventListener( 'mouseup', onMouseUpClick, false );
    };
  
    document.addEventListener( 'mousemove', onMouseMove, false );
    document.addEventListener( 'keydown', onKeyDown, false );
    document.addEventListener( 'keyup', onKeyUp, false );
    document.addEventListener( 'mousedown', onMouseDownClick, false );
    document.addEventListener( 'mouseup', onMouseUpClick, false );
  
    scope.enabled = false;
  
    scope.getObject = function () {
  
      return yawObject;
        
    };
  
    scope.update = function () {
  
      var time = performance.now();
      var delta = ( time - prevTime ) / 1000;
  
      velocity.y -= 9.8 * 100.0 * delta;
      velocity.x -= velocity.x * 10.0 * delta;
      velocity.z -= velocity.z * 10.0 * delta;
  
      direction.z = Number( moveForward ) - Number( moveBackward );
      direction.x = Number( moveRight ) - Number( moveLeft );
      direction.normalize();
  
      var currentSpeed = scope.speed;
      if (run && (moveForward || moveBackward || moveLeft || moveRight)) currentSpeed = currentSpeed + (currentSpeed * 1.1);
  
      if ( moveForward || moveBackward ) velocity.z -= direction.z * currentSpeed * delta;
      if ( moveLeft || moveRight ) velocity.x -= direction.x * currentSpeed * delta;
  
      scope.getObject().translateX( -velocity.x * delta );
      scope.getObject().translateZ( velocity.z * delta );
      
      scope.getObject().position.y += ( velocity.y * delta );
  
      if ( scope.getObject().position.y < scope.height ) {
  
        velocity.y = 0;
        scope.getObject().position.y = scope.height;
  
        canJump = true;
      }
      prevTime = time;
    };
  };
  
  var instructions = document.querySelector("#instructions");
  var havePointerLock = 'pointerLockElement' in document || 'mozPointerLockElement' in document || 'webkitPointerLockElement' in document;
  if ( havePointerLock ) {
    var element = document.body;
    var pointerlockchange = function ( event ) {
      if ( document.pointerLockElement === element || document.mozPointerLockElement === element || document.webkitPointerLockElement === element ) {
        controls.enabled = true;
        instructions.style.display = 'none';
      } else {
        controls.enabled = false;
        instructions.style.display = '-webkit-box';
      }
    };
    var pointerlockerror = function ( event ) {
      instructions.style.display = 'none';
    };
  
    document.addEventListener( 'pointerlockchange', pointerlockchange, false );
    document.addEventListener( 'mozpointerlockchange', pointerlockchange, false );
    document.addEventListener( 'webkitpointerlockchange', pointerlockchange, false );
    document.addEventListener( 'pointerlockerror', pointerlockerror, false );
    document.addEventListener( 'mozpointerlockerror', pointerlockerror, false );
    document.addEventListener( 'webkitpointerlockerror', pointerlockerror, false );
  
    instructions.addEventListener( 'click', function ( event ) {
      element.requestPointerLock = element.requestPointerLock || element.mozRequestPointerLock || element.webkitRequestPointerLock;
      if ( /Firefox/i.test( navigator.userAgent ) ) {
        var fullscreenchange = function ( event ) {
          if ( document.fullscreenElement === element || document.mozFullscreenElement === element || document.mozFullScreenElement === element ) {
            document.removeEventListener( 'fullscreenchange', fullscreenchange );
            document.removeEventListener( 'mozfullscreenchange', fullscreenchange );
            element.requestPointerLock();
          }
        };
        document.addEventListener( 'fullscreenchange', fullscreenchange, false );
        document.addEventListener( 'mozfullscreenchange', fullscreenchange, false );
        element.requestFullscreen = element.requestFullscreen || element.mozRequestFullscreen || element.mozRequestFullScreen || element.webkitRequestFullscreen;
        element.requestFullscreen();
      } else {
        element.requestPointerLock();
      }
    }, false );
  } else {
    instructions.innerHTML = 'Your browser not suported PointerLock';
  }
  
  var camera, scene, renderer, controls, raycaster, arrow, world;
  
  init();
  animate();
  
  function init() {
  
    camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 3000 );
    
    world = new THREE.Group();
    
    raycaster = new THREE.Raycaster(camera.getWorldPosition(new THREE.Vector3()), camera.getWorldDirection(new THREE.Vector3()));
    arrow = new THREE.ArrowHelper(camera.getWorldDirection(new THREE.Vector3()), camera.getWorldPosition(new THREE.Vector3()), 3, 0x000000 );
  
    scene = new THREE.Scene();
    scene.background = new THREE.Color( 0xffffff );
    scene.fog = new THREE.Fog( 0xffffff, 0, 2000 );
    //scene.fog = new THREE.FogExp2 (0xffffff, 0.007);
  
    renderer = new THREE.WebGLRenderer( { antialias: true } );
    renderer.setPixelRatio( window.devicePixelRatio );
    renderer.setSize( window.innerWidth, window.innerHeight );
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    renderer.shadowMap.enabled = true;
    document.body.appendChild( renderer.domElement );
    renderer.outputEncoding = THREE.sRGBEncoding;
  
    window.addEventListener( 'resize', onWindowResize, false );
  
    var light = new THREE.HemisphereLight( 0xeeeeff, 0x777788, 0.75 );
    light.position.set( 0, 100, 0.4 );
    scene.add( light );
  
    var dirLight = new THREE.SpotLight( 0xffffff, .5, 0.0, 180.0);
    dirLight.color.setHSL( 0.1, 1, 0.95 );
    dirLight.position.set(0, 300, 100);
    dirLight.castShadow = true;
    dirLight.lookAt(new THREE.Vector3());
    scene.add( dirLight );
    
    dirLight.shadow.mapSize.width = 4096;
    dirLight.shadow.mapSize.height = 4096;
    dirLight.shadow.camera.far = 3000;
  
    //var dirLightHeper = new THREE.SpotLightHelper( dirLight, 10 );
    //scene.add( dirLightHeper );
  
    controls = new THREE.FirstPersonControls( camera );
    scene.add( controls.getObject() );
  
    // floor
  
    var floorGeometry = new THREE.PlaneBufferGeometry( 2000, 2000, 100, 100 );
    var floorMaterial = new THREE.MeshLambertMaterial();
    floorMaterial.color.setHSL( 0.095, 1, 0.75 );
  
    var floor = new THREE.Mesh( floorGeometry, floorMaterial );
    floor.rotation.x = - Math.PI / 2;
    floor.receiveShadow = true;
    world.add(floor);
  

    // objects
    var boxGeometry = new THREE.BoxBufferGeometry( 1, 1, 1 );
    boxGeometry.translate( 0, 0.5, 0 );
  
    for ( var i = 0; i < 500; i ++ ) {
  
      var boxMaterial = new THREE.MeshStandardMaterial( { color: Math.random() * 0xffffff, flatShading: false, vertexColors: false } );
  
      var mesh = new THREE.Mesh( boxGeometry, boxMaterial );
      mesh.position.x = Math.random() * 1600 - 800;
      mesh.position.y = 0;
      mesh.position.z = Math.random() * 1600 - 800;
      mesh.scale.x = 20;
      mesh.scale.y = Math.random() * 80 + 10;
      mesh.scale.z = 20;
      mesh.castShadow = true;
      mesh.receiveShadow = true;
      mesh.updateMatrix();
      mesh.matrixAutoUpdate = false;

    // Agregar una propiedad userData con el texto deseado para cada objeto
    mesh.userData = { text: 'Texto para el objeto ' + i };

      world.add(mesh);
    }

    // añadiremos un mesh con imagen
     
   // Cargar la textura de la imagen
// instantiate a loader
const loader = new THREE.TextureLoader();

// load a resource
loader.load(
	// resource URL
	'img/resources/negx.jpg',

	// onLoad callback
	function ( texture ) {
		// in this example we create the material when the texture is loaded
		const material = new THREE.MeshBasicMaterial( {
			map: texture
		 } );

     // Crear un cubo con el material aplicado
var cubeGeometry = new THREE.BoxBufferGeometry(40, 40, 5); // Tamaño del cubo
var cube = new THREE.Mesh(cubeGeometry, material);

// Posiciona el cubo en alguna parte de la escena
cube.position.set(0, 10, 4); // Cambia las coordenadas según lo necesites

    // Agregar una propiedad userData con el texto deseado para cada objeto
    cube.userData = { text: 'Texto para el mero CUVEITOR '  };

// Agregar el cubo a la escena
world.add(cube);

	},

	// onProgress callback currently not supported
	undefined,

	// onError callback
	function ( err ) {
		console.error( 'An error happened.' );
	}
);



    scene.add( world );
  
  }
  
  function onWindowResize() {
  
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
  
    renderer.setSize( window.innerWidth, window.innerHeight );
  
  }
  
  function animate() {

    var intersectedObject = null; // Variable para guardar el objeto intersectado

    requestAnimationFrame( animate );
  
    if ( controls.enabled === true ) {
  
      controls.update();
  
      raycaster.set(camera.getWorldPosition(new THREE.Vector3()), camera.getWorldDirection(new THREE.Vector3()));
      scene.remove ( arrow );
      arrow = new THREE.ArrowHelper(raycaster.ray.direction, raycaster.ray.origin, 5, 0x000000 );
      scene.add( arrow );
  
      if (controls.click === true ) {
  
        var intersects = raycaster.intersectObjects(world.children);
  
        if ( intersects.length > 0 ) {
          var intersect = intersects[ 0 ];
        
          makeParticles(intersect.point);
          
        // Accede a la propiedad userData para imprimir el texto asociado al objeto
        var text = intersect.object.userData.text;

        // la variable textura almacena el src de la imagen que contiene el objeto
        var textura = intersect.object.material.map.image.src;
        console.log(textura);

        
        // Actualiza el contenido del elemento HTML con el texto asociado al objeto
        document.getElementById('textOverlay').innerText = text;

        // Actualizar una img del objeto clickeado
        document.getElementById('objectImage').src = textura;



        //   FUNCIONES AGREGADAS
        // Guardar una referencia al objeto intersectado
        intersectedObject = intersect.object;
        
        // Cambiar su color
        intersectedObject.material.color.setHex(0xff0000); // Cambia el color a rojo, por ejemplo

        }


// También necesitarás agregar un código para restaurar el color del objeto cuando ya no está intersectado.
// Fuera de la condición donde se detecta la intersección
if (intersectedObject !== null && intersectedObject !== undefined) {
    intersectedObject.material.color.set(0xA020F0);
    intersectedObject = null; // Restablecer la referencia al objeto intersectado
}

      }
  
      if (particles.length > 0) {
        var pLength = particles.length;
        while (pLength--) {
          particles[pLength].prototype.update(pLength);
        }
      }
  
    }
  
    renderer.render( scene, camera );
  
  }

  
  var particles = new Array();
  
  function makeParticles(intersectPosition){
    var totalParticles = 80;
    
    var pointsGeometry = new THREE.Geometry();
    pointsGeometry.oldvertices = [];
    var colors = [];
    for (var i = 0; i < totalParticles; i++) {
      var position = randomPosition(Math.random());
      var vertex = new THREE.Vector3(position[0], position[1] , position[2]);
      pointsGeometry.oldvertices.push([0,0,0]);
      pointsGeometry.vertices.push(vertex);
  
      var color = new THREE.Color(Math.random() * 0xffffff);
      colors.push(color);
    }
    pointsGeometry.colors = colors;
  
    var pointsMaterial = new THREE.PointsMaterial({
      size: .8,
      sizeAttenuation: true,
      depthWrite: true,
      blending: THREE.AdditiveBlending,
      transparent: true,
      vertexColors: THREE.VertexColors
    });
  
    var points = new THREE.Points(pointsGeometry, pointsMaterial);
  
    points.prototype = Object.create(THREE.Points.prototype);
    points.position.x = intersectPosition.x;
    points.position.y = intersectPosition.y;
    points.position.z = intersectPosition.z;
    points.updateMatrix();
    points.matrixAutoUpdate = false;
  
    points.prototype.constructor = points;
    points.prototype.update = function(index) {
      var pCount = this.constructor.geometry.vertices.length;
        var positionYSum = 0;
      while(pCount--) {
        var position = this.constructor.geometry.vertices[pCount];
        var oldPosition = this.constructor.geometry.oldvertices[pCount];
  
        var velocity = {
          x: (position.x - oldPosition[0] ),
          y: (position.y - oldPosition[1] ),
          z: (position.z - oldPosition[2] )				
        }
  
        var oldPositionX = position.x;
        var oldPositionY = position.y;
        var oldPositionZ = position.z;
  
        position.y -= .03; // gravity
  
        position.x += velocity.x;
        position.y += velocity.y;
        position.z += velocity.z;
        
        var wordlPosition = this.constructor.position.y + position.y;
        
        if (wordlPosition <= 0) {
          //particle touched the ground
          oldPositionY = position.y;
          position.y = oldPositionY - (velocity.y * .3);
          
              positionYSum += 1;
        }
  
        this.constructor.geometry.oldvertices[pCount] = [oldPositionX, oldPositionY, oldPositionZ];
      }
      
      pointsGeometry.verticesNeedUpdate = true;
      
      if (positionYSum >= totalParticles) {
        particles.splice(index, 1);
          scene.remove(this.constructor);
        console.log('particle removed');
      }
    };

    particles.push( points );
    scene.add(points);
  }
  
  function randomPosition(radius) {
    radius = radius * Math.random();
    var theta = Math.random() * 2.0 * Math.PI;
    var phi = Math.random() * Math.PI;
  
    var sinTheta = Math.sin(theta); 
    var cosTheta = Math.cos(theta);
    var sinPhi = Math.sin(phi); 
    var cosPhi = Math.cos(phi);
    var x = radius * sinPhi * cosTheta;
    var y = radius * sinPhi * sinTheta;
    var z = radius * cosPhi;
  
    return [x, y, z];
  }
  
  var Controlers = function() {
    this.MouseMoveSensitivity = 0.002;
    this.speed = 800.0;
    this.jumpHeight = 350.0;
    this.height = 30.0;
  };
  
  window.onload = function() {
    var controler = new Controlers();
    var gui = new dat.GUI();
    gui.add(controler, 'MouseMoveSensitivity', 0, 1).step(0.001).name('Mouse Sensitivity').onChange(function(value) {
      controls.MouseMoveSensitivity = value;
    });
    gui.add(controler, 'speed', 1, 8000).step(1).name('Speed').onChange(function(value) {
      controls.speed = value;
    });
    gui.add(controler, 'jumpHeight', 0, 2000).step(1).name('Jump Height').onChange(function(value) {
      controls.jumpHeight = value;
    });
    gui.add(controler, 'height', 1, 3000).step(1).name('Play Height').onChange(function(value) {
      controls.height = value;
      camera.updateProjectionMatrix();
    });
  };