<?php
// Check if the form is submitted via POST and 'city' parameter is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["city"])) {
    $city = $_POST["city"]; // Get the city input from POST data
    $weather_data = fetchWeatherData($city); // Fetch weather data for the given city

    // If weather data is retrieved successfully, display weather information
    if ($weather_data) {
        displayWeatherInfo($city, $weather_data);
    } else {
        // If weather data is not found, display an error message
        echo '<p class="error">Weather data not found for ' . htmlspecialchars($city) . '. Please try again.</p>';
    }
}

// Function to fetch weather data from Open-Meteo API
function fetchWeatherData($city) {
    $url = 'https://api.open-meteo.com/v1/forecast?city=' . urlencode($city);

    $ch = curl_init(); // Initialize cURL session
    curl_setopt($ch, CURLOPT_URL, $url); // Set the URL of the API endpoint
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    $response = curl_exec($ch); // Execute the cURL session and fetch response
    curl_close($ch); // Close cURL session

    // If response is received, decode JSON response and return weather data
    if ($response) {
        return json_decode($response, true); // Decode JSON response to associative array
    } else {
        return false; // Return false if response is not received or empty
    }
}

// Function to display weather information in HTML format
function displayWeatherInfo($city, $data) {
    $today = $data['forecast']['daily'][0]; // Get today's weather data from API response

    // Output weather information in HTML format
    echo '<div class="weather-info">';
    echo '<h3>Weather in ' . htmlspecialchars($city) . ':</h3>';
    echo '<p>Temperature: ' . $today['temperature']['avg'] . '°C</p>';
    echo '<p>Humidity: ' . $today['humidity'] . '%</p>';
    echo '<p>Wind Speed: ' . $today['wind']['speed'] . ' m/s</p>';
    echo '<p>Description: ' . htmlspecialchars($today['weather']['description']) . '</p>';
    echo '</div>';

    // Display weather icon based on weather conditions
    $iconCode = $today['weather']['icon']; // Get weather icon code from API response
    $iconUrl = 'https://open-meteo.com/img/icons/' . $iconCode . '.png'; // Weather icon URL
    echo '<div class="weather-icons">';
    echo '<img src="' . $iconUrl . '" alt="Weather Icon" class="weather-icon">';
    echo '</div>';
}