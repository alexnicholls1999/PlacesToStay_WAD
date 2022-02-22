var map;

function init(){
    document.getElementById("search_btn").addEventListener('click', sendAjax);

    map = L.map ("map");

    var attrib = "Map data copyright OpenStreetMap Contrbutors, Open Database Licence";

    L.tileLayer
        ("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {attribution: attrib}).addTo(map);

    map.setView([51,-1], 14);

    if(navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition (

            gpspos=> {
                var pos = ([gpspos.coords.latitude, gpspos.coords.longitude]);
                var marker = L.marker(pos).addTo(map);

                map.setView(pos,14);
                console.log(`Lat ${gpspos.coords.latitude} Lon ${gpspos.coords.longitude}`);
            },

            err=>{
                alert(`An Error occured: ${err.code}`);
            }
        );
    } else {
        alert("Sorry, geolocation not supported in this browser")
    }
}

function sendAjax(){
    var a = document.getElementById('location').value;

    var ajaxConnection = new XMLHttpRequest();

    ajaxConnection.addEventListener ("load",e => 
    {
        var output = "";
        var allPlaces = JSON.parse(e.target.responseText);

        allPlaces.forEach( curPlace =>
            {
                output = output + `Name: ${curPlace.name} Type: ${curPlace.type} Location: ${curPlace.location} </br>`;
                L.marker([curPlace.latitude, curPlace.longitude]).addTo(map);
            });

            document.getElementById('responsivediv').innerHTML = output;
    });
    
    ajaxConnection.open("GET", `https://edward2.solent.ac.uk/~wad1910/PlacesToStay_AE2/accomodation/${a}`);

    ajaxConnection.send();
}