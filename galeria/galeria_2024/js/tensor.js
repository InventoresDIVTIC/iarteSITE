/**
 * @license
 * Copyright 2018 Google LLC. All Rights Reserved.
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * =============================================================================
 */

const status = document.getElementById('status');
status.innerText = 'Loaded TensorFlow.js - version: ' + tf.version.tfjs;

(async () => {
    // XOR data
    const data = [ [ 0, 0 ], [ 0, 1 ], [ 1, 0 ], [ 1, 1 ] ];
    const output = [ [ 0 ], [ 1 ], [ 1 ], [ 0 ] ];

    const xs = tf.stack( data.map( a => tf.tensor1d( a ) ) );
    const ys = tf.stack( output.map( a => tf.tensor1d( a ) ) );

    // Define our model with several hidden layers
    const model = tf.sequential();
    model.add(tf.layers.dense( { units: 100, inputShape: [ 2 ] } ) );
    model.add(tf.layers.dense( { units: 100, activation: 'relu' } ) );
    model.add(tf.layers.dense( { units: 10, activation: 'relu' } ) );
    model.add(tf.layers.dense( { units: 1 } ) );
    model.summary();

    model.compile( { loss: 'meanSquaredError', optimizer: "adam", metrics: [ "acc" ] } );

    // Train the model using the data.
    let result = await model.fit( xs, ys, {
        epochs: 100,
        shuffle: true,
        callbacks: {
            onEpochEnd: ( epoch, logs ) => {
                console.log( "Epoch #", epoch, logs );
            }
        }
    } );

    for( let i = 0; i < data.length; i++ ) {
        let x = data[ i ];
        let result = model.predict( tf.stack( [ tf.tensor1d( x ) ] ) );
        let prediction = await result.data();
        console.log( x[ 0 ] + " -> Expected: " + output[ i ][ 0 ] + " Predicted: " + prediction[ 0 ] );
    }
})();
