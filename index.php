<?php

// Function to make a cURL request
function makeCurlRequest($url, $params) {
    $ch = curl_init($url . '?' . http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Add more cURL options if needed

    $response = curl_exec($ch);

    if ($response === FALSE) {
        die('Error occurred while fetching the content');
    }

    curl_close($ch);

    return $response;
}

// URL to fetch
$baseUrl = "https://www.telecontact.ma/trouver/index.php";

// Arrays of strings and "ou" values
$strings = ["veterinaire", /* add more strings if needed */];
$ous = ["Casablanca", /* add more "ou" values if needed */];
$content="";
// Loop through each string
foreach ($strings as $string) {
    // Loop through each "ou" value for the current string
    foreach ($ous as $ou) {
        // Initialize the page counter
        $page = 1;

        do {
            // Set parameters for the cURL request
            $params = [
                'string' => $string,
                'ou' => $ou,
                'nxo' => 'moteur',
                'nxs' => 'process',
                'page' => $page,
            ];

            // Make the cURL request
            $content .= makeCurlRequest($baseUrl, $params);

            // Process the content (you can add your data extraction logic here)

            // Increment the page counter
            $page++;

            // Repeat until no result is found (you need to add the stop condition)
        } while ($page<5); // Add your stop condition logic here
    }
}
echo $content;
?>
