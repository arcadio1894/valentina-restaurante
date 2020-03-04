$(document).on('ready', main);

function main(){
	var url = $('#url_session').val();
	var store = $('#stores');

	$('#stores').on('change', function(){
		$.ajax({
			type:'post',
			url:url,
			data:{
				store: store.val()
			}
		}).done(function(data){
			location.reload();
		});
	});
}