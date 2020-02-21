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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="css/results.css">
</head>

<body>
    <?php
    if (empty($_POST)) {
        echo '<h1>No schedule found for selected cities/dates</h1>';
        exit();
    }

    // POST values from user input
    $startDate = strtotime($_POST["startDate"]);
    $endDate = strtotime($_POST["endDate"]);
    $fromCityId = $_POST["fromCityId"];
    $toCityId = $_POST["toCityId"];
    $fromCityName = $_POST["fromCityName"];
    $toCityName = $_POST["toCityName"];
    $countryName = $_POST["countryName"];

    $oddRow = true;
    $mh = curl_multi_init();
    $handles = [];
    $urls = [];
    $running = null;

    do {
        if ($countryName == 'us') {
            $departDate = date('Y-m-d', $startDate);
        } else {
            $departDate = date('Y-m-d', $startDate);
        }

        // Main URL
        $url = 'https://' . $countryName . '.megabus.com/journey-planner/journeys?originId=' . $fromCityId . '&destinationId=' . $toCityId . '&departureDate=' . $departDate . '&totalPassengers=1';
        $urlApi = 'https://' . $countryName . '.megabus.com/journey-planner/api/journeys?originId=' . $fromCityId . '&destinationId=' . $toCityId . '&departureDate=' . $departDate . '&totalPassengers=1';

        // Add page to list of CURL handles
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlApi);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_multi_add_handle($mh, $ch);

        $handles[] = $ch;
        $urls[] = $url;
        $startDate = strtotime('+1 day', $startDate);
    } while ($startDate <= $endDate);

    do {
        // Execute CURL requests in parallel
        curl_multi_exec($mh, $running);
    } while ($running);

    $startDate = strtotime($_POST["startDate"]);
    $flag = false;
    $day = 0;

    foreach ($handles as $ch) {
        // Get the HTML source and remove handle
        $html = curl_multi_getcontent($ch);
        $json = json_decode($html, true);
        curl_multi_remove_handle($mh, $ch);

        // Display header info if not already shown
        if (!$flag && isset($json['journeys'][0])) {
            $departStation = $json['journeys'][0]['origin']['stopName'];
            $arriveStation = $json['journeys'][0]['destination']['stopName'];

            if (strlen($departStation) == 0 || strlen($arriveStation) == 0) {
                $flag = false;
            } else {
                echo '<div id="container">';
                echo '<div id="header">';
                echo '<h3>Megabus Schedule</h3>';
                echo '<h4 id="dates">' . date('Y/n/j', $startDate) . ' - ' . date('Y/n/j', $endDate) . '</h4>';
                echo '<ul><li class="city"><h3>' . $fromCityName . '</h3><h5>' . $departStation . '</h5></li>';
                echo '<li class="city"><h3>' . $toCityName . '</h3><h5>' . $arriveStation . '</h5></li></ul>';
                echo '</div>';
                echo '<div id="content">';
                echo '<div class="table-responsive">';
                echo '<table class="table table-condensed table-hover">';
                echo '<tr>';
                echo '<th>Date</th>';
                echo '<th>Time</th>';
                echo '<th>Price</th>';
                echo '<th>Schedule</th>';
                echo '</tr>';
                $flag = true;
            }
        }

        // Get data fields
        foreach ($json['journeys'] as $k => $v) {
            $depart = date('g:ia', strtotime($v['departureDateTime']));
            $arrive = date('g:ia', strtotime($v['arrivalDateTime']));
            $duration = strtolower(substr($v['duration'], 2));
            $currency = ($countryName == 'uk') ? '£' : '$';
            $price = $currency . number_format($v['price'], 2);
            $journeyId = $v['journeyId'];

            // Alternate row colours
            $colour = $oddRow ? '#FFFFFF' : '#FFFFCC';

            // Output data fields for each row
            echo '<tr bgcolor=' . $colour . '>';
            echo '<td class="red bold"><h3>' . date('n/j', $startDate) . '</h3></td>';
            echo '<td>DEP ' . $depart . '<br>';
            echo 'ARR ' . $arrive . '<br>';
            echo '<h6>' . $duration . '</h6></td>';
            echo '<td class="blue bold"><h3><a href="' . $urls[$day] . '" target="_blank">' . $price . '</a></h3></td>';
            echo '<td><h4><a data-fancybox data-type="iframe" data-src="popup.php?country=' . $countryName . '&id=' . $journeyId . '"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></a></h4></td>';
            echo '</tr>';
        }

        $startDate = strtotime('+1 day', $startDate);
        $day++;
        $oddRow = !$oddRow;
    }
    echo '</table></div></div>';
    curl_multi_close($mh);
    ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
</body>