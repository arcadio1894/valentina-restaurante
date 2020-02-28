

function initialAll() {
    var map;
    var autocomplete;
    var position;
    var marker;
    var org = document.getElementById('address');
    var southWest = new google.maps.LatLng( -8.1559897, -79.0599835);
    var northEast = new google.maps.LatLng( -8.1159897, -79.0299835 );
    var hyderabadBounds = new google.maps.LatLngBounds( southWest, northEast );
    autocomplete = new google.maps.places.Autocomplete(org, {
        types: ['geocode'],
        componentRestrictions: {country: 'pe'},
        bounds: hyderabadBounds,
    });

    position = {lat: -8.1153718, lng: -79.0309532};
    map = new google.maps.Map(document.getElementById('map'), {
        center: position,
        zoom: 15
    });
    //marker = new google.maps.Marker({position: position, map: map});

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();

        position = {lat: near_place.geometry.location.lat(), lng: near_place.geometry.location.lng()}
        map = new google.maps.Map(document.getElementById('map'), {
            center: position,
            zoom: 17
        });
        marker = new google.maps.Marker({position: position, map: map});
    });
}

$(document).ready(function () {
    initialAll();
});
