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
$coord2 = new LatLng(['lat' => 50.45456, 'lng' => 30.5228]);
$map = new Map([
'center' => $coord,
'zoom' => 11,
]);
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

var_dump($markers);

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