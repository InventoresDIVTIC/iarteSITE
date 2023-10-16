<?php
// Define the path to your CSV file
$csvFilePath = '../data/registro.csv'; // Update with the correct file name
$jsonCachePath = 'cached_data.json';

// Check if the cached JSON data exists and is up-to-date
if (file_exists($jsonCachePath) && filemtime($jsonCachePath) >= filemtime($csvFilePath)) {
    // Serve the cached JSON data
    header('Content-Type: application/json');
    readfile($jsonCachePath);
} else {
    // Check if the CSV file exists
    if (!file_exists($csvFilePath)) {
        die("CSV file not found.");
    }

    // Open the CSV file for reading
    $csvFile = fopen($csvFilePath, 'r');

    if (!$csvFile) {
        die("Failed to open CSV file.");
    }

    // Initialize an array to hold the paintings
    $paintings = [];

    // Initialize an array to hold image data (base64-encoded images)
    $imageData = [];

    $headerRow = fgetcsv($csvFile);

    while (($row = fgetcsv($csvFile)) !== false) {
        for ($i = 1; $i <= 4; $i++) {
            $imageField = 'imagen' . $i;
            $descriptionField = 'descripcion' . $i;

            $imageFileName = $row[array_search($imageField, $headerRow)];

            if (!empty($imageFileName)) {
                $imageFileName = str_replace('./img/', '', $imageFileName);
                $imagePath = '../img/' . (($i <= 2) ? 'Producto innovador/' : 'Interacción ciber-humana/') . $imageFileName;

                if (file_exists($imagePath)) {
                    if (!isset($imageData[$imagePath])) {
                        $imageContent = file_get_contents($imagePath);
                        $imageData[$imagePath] = base64_encode($imageContent);
                    }

                    $painting = [
                        "image_id" => $row[array_search('id_registro', $headerRow)] . $imageFileName,
                        "title" => $row[array_search($descriptionField, $headerRow)],
                        "artist_title" => $row[array_search('nombre', $headerRow)],
                        "image" => $imageData[$imagePath],
                    ];

                    $paintings[] = $painting;
                }
            }
        }
    }

    // Close the CSV file
    fclose($csvFile);

    // Add any additional processing or data manipulation here

    // Add the last painting to the top of the array
    array_unshift($paintings, end($paintings));

    // Create copies and merge with the original paintings
    $lastPainting = end($paintings);
    $copies = [];

    for ($i = 1; $i <= 8; $i++) {
        $copiedPainting = $lastPainting;
        $copiedPainting["image_id"] = $lastPainting["image_id"] . "_copy" . $i;
        $copies[] = $copiedPainting;
    }

    $paintings = array_merge($copies, $paintings);

    // Output the paintings in JSON format
    $jsonData = json_encode(["data" => $paintings]);

    // Cache the JSON data
    file_put_contents($jsonCachePath, $jsonData);

    // Serve the JSON data
    header('Content-Type: application/json');
    echo $jsonData;
}
?>