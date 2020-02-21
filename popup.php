<!DOCTYPE html>
<html lang="en">

<head>
    <title>BusTracker -> Schedule</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="megabus, bustracker, bus, schedule, us, canada, booking, tickets, prices, coach">
    <meta name="description"
        content="Affordable daily express bus service in the US, Canada, and Europe, with easy to read Megabus schedules">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="css/results.css">
</head>

<body>
    <?php
    if (!isset($_GET['country']) || !isset($_GET['id'])) {
        header('Location: ' . 'index.php');
        exit();
    }
    // Setup CURL and obtain JSON data
    $countryName = $_GET['country'];
    $journeyId = $_GET['id'];
    $urlApi = 'https://' . $countryName . '.megabus.com/journey-planner/api/itinerary?journeyId=' . $journeyId;
    $url = 'https://' . $countryName . '.megabus.com/journey-planner/itinerary?journeyId=' . $journeyId;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlApi);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $html = curl_exec($ch);
    $json = json_decode($html, true);

    // Parse JSON data and output schedules
    echo '<div id="container">';
    echo '<div id="header">';
    echo '<h3><a href="' . $url . '">Schedule</a></h3>';
    echo '</div>';
    echo '<div id="stops">';

    foreach ($json['scheduledStops'] as $k => $v) {
        $departTime = date('g:ia', strtotime($v['departureTime']));
        $arrivalTime = date('g:ia', strtotime($v['arrivalTime']));
        $stopAddress = $v['location'];
        $stopCity = $v['cityName'];

        // Output schedule
        echo '<div class="stopTime">';
        if ($v['departureTime']) {
            echo 'DEP ' . $departTime . '<br>';
        } else {
            echo 'ARR ' . $arrivalTime . '<br>';
        }
        echo '</div>';
        echo '<div class="stopCity">' . $stopCity . '</div>' . $stopAddress . '<br><br>';
    }
    echo '</div></div></div>';
    ?>
</body>