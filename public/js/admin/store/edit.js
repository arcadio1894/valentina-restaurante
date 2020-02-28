/**
 * Created by USUARIO on 07/02/2020.
 */
function initialAll() {
    var map;
    var autocomplete;
    var position;
    var marker;
    var org = document.getElementById('search_input');
    var address = $('#search_input').val();

    var southWest = new google.maps.LatLng( -8.1559897, -79.0599835);
    var northEast = new google.maps.LatLng( -8.1159897, -79.0299835 );
    var hyderabadBounds = new google.maps.LatLngBounds( southWest, northEast );
    autocomplete = new google.maps.places.Autocomplete(org, {
        types: ['geocode'],
        componentRestrictions: {country: 'pe'},
        bounds: hyderabadBounds
    });

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            console.log(latitude, longitude);
            position = {lat: latitude, lng: longitude};
            map = new google.maps.Map(document.getElementById('map'), {
                center: position,
                zoom: 15
            });
            marker = new google.maps.Marker({position: position, map: map});
        }
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('loc_lat').value = near_place.geometry.location.lat();
        document.getElementById('loc_long').value = near_place.geometry.location.lng();

        document.getElementById('latitude_view').value = near_place.geometry.location.lat();
        document.getElementById('longitude_view').value = near_place.geometry.location.lng();
        position = {lat: near_place.geometry.location.lat(), lng: near_place.geometry.location.lng()}
        map = new google.maps.Map(document.getElementById('map'), {
            center: position,
            zoom: 15
        });
        marker = new google.maps.Marker({position: position, map: map});
    });
}

$(document).ready(function () {
    initialAll();
    $formRegistrar = $('#formRegistrar');
    $formRegistrar.on('submit', editarTienda);

});

var $formRegistrar;

function editarTienda() {
    event.preventDefault();
    var storeUrl = $formRegistrar.data('url');
    console.log(storeUrl);
    $.ajax({
        url: storeUrl,
        method: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {
            if (data != "") {
                console.log(data);
                for (var property in data){
                    $.toast({
                        text : data[property],
                        showHideTransition : 'slide',  // It can be plain, fade or slide
                        bgColor : 'red',              // Background color for toast
                        textColor : '#eee',            // text color
                        allowToastClose : false,       // Show the close button or not
                        hideAfter : 5000,              // `false` to make it sticky or time in miliseconds to hide after
                        stack : 5,                     // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
                        textAlign : 'left',            // Alignment of text i.e. left, right, center
                        position : 'top-right',       // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
                        icon: 'error',
                        heading: 'Error'
                    });
                }
            } else {
                $.toast({
                    text : 'Tienda modificada correctamente.',
                    showHideTransition : 'slide',  // It can be plain, fade or slide
                    bgColor : 'green',              // Background color for toast
                    textColor : '#eee',            // text color
                    allowToastClose : false,       // Show the close button or not
                    hideAfter : 5000,              // `false` to make it sticky or time in miliseconds to hide after
                    stack : 5,                     // `fakse` to show one stack at a time count showing the number of toasts that can be shown at once
                    textAlign : 'left',            // Alignment of text i.e. left, right, center
                    position : 'top-right',       // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values to position the toast on page
                    icon: 'success',
                    heading: 'Éxito'
                });
                setTimeout(function () {
                    location.reload();
                }, 5000)
            }
        },
        error: function (data) {
            console.log(data)
        }
    });
}