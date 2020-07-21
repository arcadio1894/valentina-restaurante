/**
 * Created by USUARIO on 07/02/2020.
 */
$(document).ready(function () {
    $formEdit = $('#formEdit');
    $('[data-locedit]').on('click', fillFormEdit);
    $formEdit.on('submit', editarCliente);

    $formEditLocation = $('#formEditLocation');
    $formEditLocation.on('submit', editarLocation);

});

var $formEdit;
var $formEditLocation;

function fillFormEdit() {
    // Obtener los datos
    var locid = $(this).data('locedit');
    var customer_id = $(this).data('customer_id');
    var name = $(this).data('name');
    var lastname = $(this).data('lastname');
    var email = $(this).data('email');
    var phone = $(this).data('phone');
    var type_doc = $(this).data('type_doc');
    var document = $(this).data('document');
    var address = $(this).data('address');
    var latitude = $(this).data('latitude');
    var longitude = $(this).data('longitude');
    var type_place = $(this).data('type_place');
    var reference = $(this).data('reference');

    $formEditLocation.find('[name="loc_id"]').val(locid);
    $formEditLocation.find('[name="customer_id"]').val(customer_id);
    $formEditLocation.find('[name="type_doc"]').val(type_doc);

    $formEditLocation.find('[name="phone"]').val(phone);
    $formEditLocation.find('[name="name"]').val(name);
    $formEditLocation.find('[name="lastname"]').val(lastname);
    $formEditLocation.find('[name="document"]').val(document);
    $formEditLocation.find('[name="email"]').val(email);
    $formEditLocation.find('[name="address"]').val(address);
    $formEditLocation.find('[name="latitude"]').val(latitude);
    $formEditLocation.find('[name="longitude"]').val(longitude);
    $formEditLocation.find('[name="type_place"]').val(type_place);

    $formEditLocation.find('[name="reference"]').val(reference);

    initialAll();

}

function editarCliente() {
    event.preventDefault();
    var editUrl = $formEdit.data('url');
    $.ajax({
        url: editUrl,
        method: 'POST',
        data: $formEdit.serializeArray(),
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
                    text : 'Cliente editado correctamente.',
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
                }, 4000)
            }
        },
        error: function (data) {
            console.log(data)
        }
    });
}

function editarLocation() {
    event.preventDefault();
    var editUrl = $formEditLocation.data('url');
    $.ajax({
        url: editUrl,
        method: 'POST',
        data: $formEditLocation.serializeArray(),
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
                    text : 'Dirección editada correctamente.',
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
                }, 4000)
            }
        },
        error: function (data) {
            console.log(data)
        }
    });
}
