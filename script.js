document.addEventListener('DOMContentLoaded', function() {
    // Add event listener to the form submission
    document.getElementById('weatherForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the value of city input and trim any leading/trailing whitespace
        const city = document.getElementById('city').value.trim();

        // Check if the city input is not empty
        if(city !== '') {
            fetchWeather(city); // Call fetchWeather function with the city name
        } else {
            // Display error message if city input is empty
            document.getElementById('weatherResults').innerHTML = '<p class="error">Please enter a city name.</p>';
        }
    });
});

// Function to fetch weather data from server-side PHP script
function fetchWeather(city) {
    fetch('weather.php', {
        method: 'POST', // Use POST method to send city name to server
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'city=' + encodeURIComponent(city), // Encode city name for URL-safe transmission
    })
    .then(response => response.text()) // Convert response to text format
    .then(data => {
        // Update weatherResults div with server response (HTML weather information)
        document.getElementById('weatherResults').innerHTML = data;
    })
    .catch(error => {
        console.error('Error fetching weather data:', error); // Log error message to console
        // Display error message in weatherResults div if fetching data fails
        document.getElementById('weatherResults').innerHTML = '<p class="error">Failed to fetch weather data. Please try again later.</p>';
    });
}
