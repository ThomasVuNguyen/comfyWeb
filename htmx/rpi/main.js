// main.js

// Import necessary Three.js modules
import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

// Function to initialize and load the glTF model
function loadModel() {
    // Get the container div
    const container = document.getElementById('rpi');

    // Create a scene
    const scene = new THREE.Scene();

    // Create a camera
    const camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
    camera.position.z = 5;

    // Create a renderer
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(500, 500);
    container.appendChild(renderer.domElement);

    // Load the glTF model
    const loader = new GLTFLoader();
    loader.load('rpi.gltf', (gltf) => {
        // Traverse through all objects in the scene and apply color and lighting
        gltf.scene.traverse((child) => {
            if (child.isMesh) {
                // Set color to a custom color (e.g., light blue)
                child.material.color.set(0xADD8E6);

                // Add some ambient lighting
                const ambientLight = new THREE.AmbientLight(0x404040); // Soft white light
                scene.add(ambientLight);

                // Add a directional light
                const directionalLight = new THREE.DirectionalLight(0xffffff, 0.5);
                directionalLight.position.set(5, 5, 5);
                scene.add(directionalLight);
            }
        });

        // Add the model to the scene
        scene.add(gltf.scene);
    });

    // Function to animate the scene
    const animate = function () {
        requestAnimationFrame(animate);

        // Add any animations or updates here

        // Render the scene
        renderer.render(scene, camera);
    };

    // Start the animation loop
    animate();
}

// Call the loadModel function when the window has loaded
window.onload = loadModel;
