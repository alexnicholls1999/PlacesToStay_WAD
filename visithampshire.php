<?php 

    $connection = curl_init();

    curl_setopt($connection, CURLOPT_URL, "https://edward2.solent.ac.uk/~wad1910/PlacesToStay_AE2/accomodation/hampshire");

    curl_setopt($connection, CURLOPT_RETURNTRANSFER,1);

    curl_setopt($connection, CURLOPT_HEADER, 0);

    $response = curl_exec($connection);

    curl_close($connection);

    $data = json_decode($response, true);

    echo "<h1>Visit Hampshire</h1>";

    for($i=0; $i<count($data); $i++)
    {
        echo "ID: " . $data[$i]["ID"] . " " . "</br>" .
             "Name: " . $data[$i]["name"] . " " . "</br>" .
             "Type: " . $data[$i]["type"] . " " . "</br>" . 
             "Location: " . $data[$i]["location"] . " " . "</br>";

        echo "<form method='post' action='bookacomodation.php'>";
        echo "<h3>Book Accomodation</h3>";
        echo "First Name: </br>";
        echo "<input name='name'> </br>";
        echo "Quantity: </br>";     
        echo "<input name='qty'> </br>";
        echo "Date: </br>";
        echo "<input name='date'> </br>";
        echo "<input name='bookID' type='hidden' value='" . $data[$i]["ID"] . "'>";
        echo "<input type='submit' value='book' />";
        echo "</form>";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <!-- <form action="/accomodation/{type}/hampshire" method="get">
        <input type="text" name="{type}">
        <input type="button" value="Search Places">
    </form> -->

</body>
</html>