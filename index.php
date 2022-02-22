<?php
require '/var/www/html/share/vendor/autoload.php';

$app = new \Slim\App(["settings"=> ["displayErrorDetails" => true]]);

$container = $app->getContainer();
$container['db'] = function() {

    $conn = new PDO("mysql:host=localhost;dbname=wad1910", "wad1910", "phexeeph");
    return $conn;
};

// $app->get('/',function($req, $res, array $args) {
//     $res->getBody()->write("route route");
// });


$app->get('/accomodation',function($req, $res, array $args) {
    $stmt = $this->db->prepare('SELECT * FROM accommodation');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res->withJSON($results);
});

$app->get('/accomodation/{location}', function($reg, $res, array $args) {
    $stmt = $this->db->prepare('SELECT * FROM accommodation WHERE location=:location');
    $stmt->bindParam(':location', $args["location"]);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res->withJSON($results);
});

$app->get('/accomodation/{type}/{location}', function($reg, $res, array $args) {
    $stmt = $this->db->prepare('SELECT * FROM accommodation WHERE type=:type AND location=:location');
    $stmt->bindParam(':type', $args["type"]);
    $stmt->bindParam(':location', $args["location"]);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res->withJSON($results);
});

$app->post('/book/create', function($req, $res, array $args){
    $post = $req->getParsedBody();
    // $res->getBody()->write("Accomodation details : Name: ". $post['name']. "Number of People: ". $post['qty']. "Booking Date: " . $post['date']);
    $stmt = $this->db->prepare('INSERT INTO acc_bookings(username, npeople , thedate) VALUES (:name, :qty, :date)');
    $stmt->bindParam(':name', $post['name']);
    $stmt->bindParam(':qty', $post['qty']);
    $stmt->bindParam(':date', $post['date']);
    $stmt->execute();

    // return $res->withJson($post);

    if($post['qty'] > 10){
        return $res->withStatus(400);
    }
    
    if($post['date'] == "" && $post['qty'] == "" && $post['name'] == ""){
        return $res->withStatus(406);
    }

});

$app->run();

?>
