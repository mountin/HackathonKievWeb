<?php
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

$coord = new LatLng(['lat' => 50.45466, 'lng' => 30.5238]);
$map = new Map([
'center' => $coord,
'zoom' => 11,
]);
$map->height = '1000';
$map->width = '100%';


$polylineOptions = new PolylineOptions([
    'strokeColor' => 'black',
    'draggable' => true
]);

// Now the renderer
$directionsRenderer = new DirectionsRenderer([
    'map' => $map->getName(),
    'polylineOptions' => $polylineOptions
]);

// Lets configure the markers that renders the direction
foreach($markers as $marker){

    $newPoint = new Marker([
        'position' => new LatLng(['lat' => $marker->latitude, 'lng' => $marker->longitude]),
        'title' => $marker->name,
    ]);

    $newPoint->attachInfoWindow(
        new InfoWindow([
            'content' => $marker->name
        ]));
    $map->addOverlay($newPoint);
}

echo $map->display();
?>
<script>

    window.onload = function()

    {
        //alert("window load occurred!");
        //alert(jQuery("#gmap0-map-canvas").css("height"));
        jQuery("#gmap0-map-canvas").css("height", 1024);
    }




    //console.log(document.getElementById("gmap0-map-canvas").style.height);



</script>