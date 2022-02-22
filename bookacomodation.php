<?php 

    $id = $_POST["bookID"];
    $name = $_POST["name"];
    $qty = $_POST["qty"];
    $date = $_POST["date"];
    

    $connection = curl_init();

    curl_setopt($connection, CURLOPT_URL, "https://edward2.solent.ac.uk/~wad1910/PlacesToStay_AE2/book/create");
    $dataToPost = 
        ["ID" => $id, 
        "date" => $date,
        "name" => $name,
        "qty" => $qty, 
        ];
    
    curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($connection, CURLOPT_HEADER,0);
    curl_setopt($connection, CURLOPT_POSTFIELDS, $dataToPost);
    $response = curl_exec($connection);

    $httpCode = curl_getinfo($connection,CURLINFO_HTTP_CODE);
    echo "The script has returned the HTTP status code: $httpCode <br />";

    curl_close($connection);   


?>