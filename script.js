// Function to fetch weather data via AJAX
function getWeatherData(city) {
    fetch(`https://api.open-meteo.com/v1/forecast?city=${city}`)
        .then(response => response.json())
        .then(data => {
            if(data && data.forecast && data.forecast.daily) {
                const today = data.forecast.daily[0];
                const weatherInfo = `
                    <div class="weather-info">
                        <h3>Weather in ${city}:</h3>
                        <p>Temperature: ${today.temperature.avg}°C</p>
                        <p>Humidity: ${today.humidity}%</p>
                        <p>Wind Speed: ${today.wind.speed} m/s</p>
                        <p>Description: ${today.weather.description}</p>
                    </div>
                `;
                document.getElementById('weatherResults').innerHTML = weatherInfo;

                // Add weather icon
                const iconCode = today.weather.icon;
                const iconUrl = `https://open-meteo.com/img/icons/${iconCode}.png`;
                const weatherIcon = `<img src="${iconUrl}" alt="Weather Icon" class="weather-icon">`;
                document.getElementById('weatherResults').innerHTML += `<div class="weather-icons">${weatherIcon}</div>`;
            } else {
                document.getElementById('weatherResults').innerHTML = `<p class="error">Weather data not found for ${city}. Please try again.</p>`;
            }
        })
        .catch(error => {
            console.error('Error fetching weather data:', error);
            document.getElementById('weatherResults').innerHTML = `<p class="error">Failed to fetch weather data. Please try again later.</p>`;
        });
}

// Handle form submission
document.getElementById('weatherForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const city = document.getElementById('city').value.trim();
    if(city !== '') {
        getWeatherData(city);
    } else {
        document.getElementById('weatherResults').innerHTML = `<p class="error">Please enter a city name.</p>`;
    }
});
