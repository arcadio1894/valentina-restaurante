/**
 * Created by USUARIO on 07/02/2020.
 */
$(document).ready(function () {
    $modalEliminar = $('#modalEliminar');
    $formEliminar = $('#formEliminar');
    $('[data-eliminar]').on('click', showModalEliminar);
    $formEliminar.on('submit', eliminarCliente);

});

var $modalEliminar;
var $formEliminar;

function showModalEliminar() {
    // Obtener los datos
    var id = $(this).data('id');
    var name = $(this).data('name');
    $formEliminar.find('[name="store_id"]').val(id);
    $formEliminar.find('[name="nameD"]').val(name);
    $modalEliminar.modal('show');
}

function eliminarCliente() {
    event.preventDefault();
    var storeUrl = $formEliminar.data('url');
    $.ajax({
        url: storeUrl,
        method: 'POST',
        data: $formEliminar.serializeArray(),
        success: function (data) {
            if (data != "") {
                console.log(data);
                $modalEliminar.modal('hide');
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
                $modalEliminar.modal('hide');
                $.toast({
                    text : 'Cliente eliminada correctamente.',
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
