<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Weather Forecast</h2>
        <form id="weatherForm" method="post">
            <label for="city">Enter City:</label>
            <input type="text" id="city" name="city" required aria-label="City Name Input">
            <button type="submit">Get Weather</button>
        </form>

        <div id="weatherResults">
            <!-- PHP includes weather.php to handle server-side processing and display -->
            <?php include 'weather.php'; ?>
        </div>
    </div>

    <!-- Include JavaScript file for client-side interactions -->
    <script src="script.js"></script>
</body>
</html>
