$(document).on('ready', main);

function main(){
	var $form = $('#form');

    $form.on('submit', function(e){
        e.preventDefault();

        var data = new FormData(this);
        var url  = this.action;
        var type = this.method;

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
                for(var attr in response.errors){
                    showMessage(response.errors[attr][0],'error');
                }
            }
        })
    });
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