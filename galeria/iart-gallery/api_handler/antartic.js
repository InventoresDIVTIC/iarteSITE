// Custom database containing artworks

// const customArtworks = require('./customArtworks.json');

const APIurl = "../api/api_galeria_csv.php";

module.exports = {
    fetchList: async function () {
        const startTime = performance.now(); // Record the start time in JavaScript

        const json = await fetch(APIurl).then(res => res.json());

        // Display the PHP execution time
        console.log("PHP Execution Time: " + json.execution_time_ms + " ms");

        var temp = json.data.filter((d) => d.image_id);
        
        const endTime = performance.now(); // Record the end time in JavaScript
        const jsExecutionTime = endTime - startTime; // Calculate the JavaScript execution time
        console.log("JavaScript Execution Time: " + jsExecutionTime + " ms");

        return temp;
        // Fetch the list of artworks from your custom database
    },
    fetchImage: async function (obj) {
        // Fetch image and title from your custom database
        // console.log("aqui manipulamos el obj en FetchImage---> " + obj.image);
         
        // Extract the file extension from the image path
        const fileExtension = obj.image.substring(obj.image.lastIndexOf('.') + 1);
                
        // Assuming you have received the base64ImageData from the API response
        // const contentType = 'image/jpeg'; // Specify the correct content type

          // Set the content type based on the file extension
        let contentType;
        if (fileExtension.toLowerCase() === 'jpg' || fileExtension.toLowerCase() === 'jpeg') {
            contentType = 'image/jpeg';
        } else if (fileExtension.toLowerCase() === 'png') {
            contentType = 'image/png';
        } else {
            // Handle other image formats if needed
            contentType = 'image/jpeg'; // Default to JPEG
        }


        const byteCharacters = atob(obj.image);
        const byteArrays = [];

        const sliceSize = 512;

        for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            const slice = byteCharacters.slice(offset, offset + sliceSize);
            const byteNumbers = new Array(slice.length);
        
            for (let i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }
          
            const byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }

        const blob = new Blob(byteArrays, { type: contentType });

        return {
            title: obj.title + " - " + obj.artist_title,
            // Assuming you have image paths in your custom database    
            image: blob
        };
    }
};