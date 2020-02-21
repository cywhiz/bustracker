<!DOCTYPE html>
<html lang="en">

<head>
    <title>Megabus Schedule Checker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="megabus, bustracker, bus, schedule, us, canada, booking, tickets, prices, coach">
    <meta name="description"
        content="Affordable daily express bus service in the US, Canada, and Europe, with easy to read Megabus schedules">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/redmond/jquery-ui.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div id="country">
        <div class="text-center"><img class="logo" src="img/logo.png"></div>
        <div class="text-center"><img class="logo" src="img/logo2.png"></div>
        <h1 class="text-center">Select country</h1>
        <div class="text-center">
            <img id="canada" src="img/icon_canada.png">
            <img id="us" src="img/icon_us.png">
            <img id="uk" src="img/icon_uk.png">
        </div>
    </div>
    <div id="cities">
        <div class="col-md-3">
            <form action="schedule.php" method="post" id="form">
                <h1 class="text-center">Select cities</h1>
                <select class="form-control input-lg" id="fromCityId" name="fromCityId"></select>
                <select class="form-control input-lg" id="toCityId" name="toCityId"></select>
                <button id="continue" type="button" class="btn btn-lg btn-primary btn-block" disabled>Continue</button>
                <input type="hidden" id="fromCityName" name="fromCityName">
                <input type="hidden" id="toCityName" name="toCityName">
                <input type="hidden" id="countryName" name="countryName" value="">
        </div>
    </div>
    <div id="dates">
        <div class="col-md-3">
            <h1 class="text-center">Select dates</h1>
            <input type="text" class="form-control input-lg" id="startDatepicker">
            <input type="text" class="form-control input-lg" id="endDatepicker">
            <button id="submitBtn" type="button" class="btn btn-lg btn-primary btn-block">Submit</button>
            <input type="hidden" id="startDate" name="startDate" value="">
            <input type="hidden" id="endDate" name="endDate" value="">
            </form>
        </div>
    </div>
    <div id="loading">
        <img class="loadingImg" src='img/spin.gif'>
        <p class="loadingText">Loading schedule...</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
    $(function() {
        function showCities(proxy, url, selector) {
            $.getJSON(proxy, {
                url: url
            }, function(data) {
                var origin = selector.is('#fromCityId') ? "origin" : "destination";
                var options = '<option selected="selected" value="-1">Select ' + origin + '</option>';

                $.each(data.cities, function(k, v) {
                    options += '<option value="' + v.id + '">' + v.name + '</option>';
                });
                selector.html(options);
            });
        }

        $('#loading').hide();
        $('#dates').hide();
        $('#cities').hide();

        $('#canada').click(function() {
            $('#canada').fadeTo('slow', 0.3);
            $('#us').fadeTo('slow', 1);
            $('#uk').fadeTo('slow', 1);

            $('#cities').show();
            $('html, body').animate({
                scrollTop: $('#cities').offset().top
            }, 2000);

            $('#countryName').val("ca");
            var url = "https://" + $('#countryName').val() +
                ".megabus.com/journey-planner/api/origin-cities";
            var proxy = "cities.php";
            var selector = $('#fromCityId');
            showCities(proxy, url, selector);
            $('#toCityId').empty();
        });

        $('#us').click(function() {
            $('#canada').fadeTo('slow', 1);
            $('#us').fadeTo('slow', 0.3);
            $('#uk').fadeTo('slow', 1);

            $('#cities').show();
            $('html, body').animate({
                scrollTop: $('#cities').offset().top
            }, 2000);

            $('#countryName').val("us");
            var url = "https://" + $('#countryName').val() +
                ".megabus.com/journey-planner/api/origin-cities";
            var proxy = "cities.php";
            var selector = $('#fromCityId');
            showCities(proxy, url, selector);
            $('#toCityId').empty();
        });

        $('#uk').click(function() {
            $('#canada').fadeTo('slow', 1);
            $('#us').fadeTo('slow', 1);
            $('#uk').fadeTo('slow', 0.3);

            $('#cities').show();
            $('html, body').animate({
                scrollTop: $('#cities').offset().top
            }, 2000);

            $('#countryName').val("uk");
            var url = "https://" + $('#countryName').val() +
                ".megabus.com/journey-planner/api/origin-cities";
            var proxy = "cities.php";
            var selector = $('#fromCityId');
            showCities(proxy, url, selector);
            $('#toCityId').empty();
        });

        $('#submitBtn').click(function(e) {
            e.preventDefault();
            $('#country').hide();
            $('#dates').hide();
            $('#cities').hide();
            $('#loading').show();
            $("#form").submit();
        });

        $('#fromCityId').change(function() {
            $('#fromCityName').val($('#fromCityId option:selected').text());
            var url = "https://" + $('#countryName').val() +
                ".megabus.com/journey-planner/api/destination-cities?originCityId=" + $(this).val();
            var proxy = "cities.php";
            var selector = $('#toCityId');
            showCities(proxy, url, selector);
        });

        $('#toCityId').change(function() {
            $('#toCityName').val($('#toCityId option:selected').text());

            if ($('#toCityName').val() == 'Select destination') {
                $('#continue').prop('disabled', true);
            } else {
                $('#continue').prop('disabled', false);
            }
        });

        $('#continue').click(function() {
            $('#dates').show();
            $('html, body').animate({
                scrollTop: $('#dates').offset().top
            }, 2000);
        });

        var today = $.datepicker.formatDate('m/d/yy', new Date());

        $('#startDatepicker').prop('readonly', true);
        $('#endDatepicker').prop('readonly', true);
        $('#startDate')
            .val(today);
        $('#endDate').val(today);

        $('#startDatepicker').datepicker({
            minDate: 0,
            dateFormat: 'm/d/yy',
            onSelect: function(selected) {
                $('#endDatepicker').datepicker('option', 'minDate', selected);
                $('#startDate').val(selected);
                $('#endDate').val(selected);
            }
        });

        $('#endDatepicker').datepicker({
            minDate: 0,
            dateFormat: 'm/d/yy',
            onSelect: function(selected) {
                $('#endDate').val(selected);
            }
        });

        $("#startDatepicker").datepicker('setDate', today);
        $("#endDatepicker").datepicker('setDate', today);
    });
    </script>
</body>