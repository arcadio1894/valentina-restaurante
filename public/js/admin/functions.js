$(document).on('ready', main);

function main(){
	var $form = $('#form');
	var $modalDelete = $('#modal-delete');
	var $buttonModalDelete = $('.button-modal-delete');
	var $buttonModalAccept = $('#button-modal-accept');

    $form.on('submit', function(e){
        e.preventDefault();

        var $button = $('#form-submit');
        var data = new FormData(this);
        var url  = this.action;
        var type = this.method;

        $button.attr('disabled',true);
        $button.prop('disabled',true);

        $.ajax({
            url:url,
            type:type,
            data:data,
            processData:false,
            contentType:false
        }).done(function(response){
            if(response.success){
                showMessage(response.message);
                setTimeout(function(){
                    location.href = response.url;
                },4000);
            }else{
            	counter = 0;

                for(var attr in response.errors){
                    showMessage(response.errors[attr][0],'error');

                    if(counter === 4){
                    	break;
                    }

                    counter++;
                }

                $button.attr('disabled',false);
        		$button.prop('disabled',false);
            }
        })
    });

    $buttonModalDelete.on('click', function(){
    	$('#modal-configure-title').text($(this).data('modal-configure-title'));
    	$('#modal-configure-name').val($(this).data('modal-configure-name'));
    	$('#modal-configure-id').val($(this).data('modal-configure-id'));
    	$('#modal-configure-url').val($(this).data('modal-configure-url'));

    	$modalDelete.modal('show');
    });

    $buttonModalAccept.on('click', function(){
        var url = $('#modal-configure-url').val();
        var id  = $('#modal-configure-id').val();

        $(this).prop('disabled',true);
        $(this).attr('disabled',true);

        $.ajax({
            url:url,
            type:'post',
            data:{
            	id:id
            }
        }).done(function(response){
            showMessage(response.message);
            setTimeout(function(){
                location.href = response.url;
            },4000);
        })
    })
}

function showMessage(message,type = null){
	var color = 'green';
	var icon  = 'success';
	var heading = 'Éxito';
	var hideAfter = 3000;

	if(type==='error'){
		color = 'red';
		icon  = 'error';
		heading = 'Error';
		hideAfter = 5000;
	}

	$.toast({
	    text : message,
	    showHideTransition : 'slide',
	    bgColor : color,
	    textColor : '#eee',
	    allowToastClose : false,
	    hideAfter : hideAfter,
	    stack : 5,
	    textAlign : 'left',
	    position : 'top-right',
	    icon: icon,
	    heading: heading
	});
}