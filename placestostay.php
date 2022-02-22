<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript" src="ajax.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"/>
    <script type="text/javascript" src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
    <!-- <script type="text/javascript" src="mapapp.js"></script> -->
</head>
<body onload="init()">
    <h1>Search for places</h1>
    Location: <input id="location"/>
    <input type="button" id="search_btn" value="Search">

    <br>

    <div id="responsivediv"></div>

    <br>

    <div id="map" style="width:400px; height: 300px; right: 0;"></div>
</body>
</html>