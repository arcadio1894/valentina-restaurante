var map;
var isOpened = false;

function initialAll(address_array) {

    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    // Multiple Markers
    var markers = [];

    // Info Window Content
    var infoWindowContent = [];

    for ( var i=0; i < address_array.length; ++i )
    {
        markers.push([address_array[i].name, address_array[i].latitude, address_array[i].longitude]);
        infoWindowContent.push(['<div class="info_content">' +
            '<h3>'+address_array[i].name+'</h3>' +
            '<p class="number">'+address_array[i].phone+'</p>' +
            '<p>'+address_array[i].attention_schedule+'</p>' +
            '</div>']
        );
    }
    console.log(markers);
    console.log(infoWindowContent);

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow();

    // Loop through our array of markers & place each one on the map
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0],
            icon: image
        });

        // Allow each marker to have an info window
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });

}

$(document).ready(function () {
    $.getJSON('../../address_locals/',function(response)
    {
        initialAll(response);
    });

    $('[data-marker]').on('click', showInMap);
});

function showInMap() {
    var name = $(this).data('name');
    var longitude = $(this).data('longitude');
    var latitude = $(this).data('latitude');
    var schedule = $(this).data('schedule');
    var phone = $(this).data('phone');

    var infoWindowContent ='<div class="info_content">' +
        '<h3>'+name+'</h3>' +
        '<p class="number">'+phone+'</p>' +
        '<p>'+schedule+'</p>' +
        '</div>';

    var position = new google.maps.LatLng(latitude, longitude);

    var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: name,
        icon: image
    });

    var infoWindow = new google.maps.InfoWindow();

    if(!isOpened){
        infoWindow.setContent(infoWindowContent);
        infoWindow.open(map, marker);
        isOpened = true;
    }

    setTimeout(function () {
        infoWindow.close(); isOpened = false;}, 1500);
}
