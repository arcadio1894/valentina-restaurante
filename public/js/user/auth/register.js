
function initialAll() {
    var map;
    var autocomplete;
    var position;
    var marker;
    var org = document.getElementById('address');
    var southWest = new google.maps.LatLng( -8.1559897, -79.0599835);
    var northEast = new google.maps.LatLng( -8.1159897, -79.0299835 );
    var hyderabadBounds = new google.maps.LatLngBounds( southWest, northEast );

    var $polygonsObject = $('#polygons');
    var polygons = JSON.parse($polygonsObject.val());
    var polygon;

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

        position = {lat: near_place.geometry.location.lat(), lng: near_place.geometry.location.lng()};
        var curPosition = new google.maps.LatLng(near_place.geometry.location.lat(),near_place.geometry.location.lng());
        for (var polygon of polygons) {
            polygon  = JSON.parse(polygon.polygon);
            console.log(polygon);
            var polygonGoogleMaps = [];
            for (var j = 0; j < polygon.length; j++) {
                polygonGoogleMaps.push(new google.maps.LatLng(parseFloat(polygon[j][0]), parseFloat(polygon[j][1])));
            }
            polygon = new google.maps.Polygon({
                paths: polygonGoogleMaps
            });
            if ( google.maps.geometry.poly.containsLocation(curPosition, polygon ) )
            {
                $.toast({
                    text : 'Su dirección si pertenece a una zona.',
                    showHideTransition : 'slide',
                    bgColor : 'green',
                    textColor : '#eee',
                    allowToastClose : false,
                    hideAfter : 3000,
                    stack : 5,
                    textAlign : 'left',
                    position : 'top-right',
                    icon: 'success',
                    heading: 'Éxito'
                });

            }else{
                $.toast({
                    text : 'Su dirección no pertenece a una zona.',
                    showHideTransition : 'slide',
                    bgColor : 'red',
                    textColor : '#eee',
                    allowToastClose : false,
                    hideAfter : 3000,
                    stack : 5,
                    textAlign : 'left',
                    position : 'top-right',
                    icon: 'error',
                    heading: 'Error'
                });
                setTimeout(function () {
                    $('#address').val('');
                }, 2000)

            }
        }
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
