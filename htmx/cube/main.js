import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
// create a scene
const scene = new THREE.Scene();

// create a camera
const camera = new THREE.PerspectiveCamera( 75, 1, 0.1, 1000 );

// create a render
const renderer = new THREE.WebGLRenderer();
console.log("renderer created");
renderer.setSize( 100, 100 );
renderer.setPixelRatio( window.devicePixelRatio );
var cubex = document.getElementById('cube');
cubex.appendChild( renderer.domElement );

// create a cube
const geometry = new THREE.BoxGeometry( 1, 1, 1 );
const material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
const cube = new THREE.Mesh( geometry, material );
scene.add( cube );

camera.position.z = 3;

function animate() {
	requestAnimationFrame( animate )
	console.log("rendering");
	cube.rotation.x += 0.01;
	cube.rotation.y += 0.01;

	renderer.render( scene, camera );
}

animate();