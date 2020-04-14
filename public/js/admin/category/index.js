$(document).on('ready', main);

function main(){
	var $trees = $('.tree-branch');
	var $buttonContainer = null;

	$trees.on('click', function(e){
		e.stopPropagation();
		$buttonContainer = $($(this).children()[1]).children();

		if(!$(this).hasClass('tree-selected')){
			$(this).addClass('tree-selected');

			$($buttonContainer.children()[2]).removeClass('hide');
			$($buttonContainer.children()[3]).removeClass('hide');
			$($buttonContainer.children()[4]).removeClass('hide');
		}else{
			$(this).removeClass('tree-selected');

			$($buttonContainer.children()[2]).addClass('hide');
			$($buttonContainer.children()[3]).addClass('hide');
			$($buttonContainer.children()[4]).addClass('hide');
		}
	});

	$('.icon-caret ').on('click', function(e) {
	    e.stopPropagation();
	    
	    if($(this).hasClass('tree-plus')){
			$(this).parent().addClass('tree-open');
			$(this).addClass('tree-minus');
			$(this).removeClass('tree-plus');
			$(this).next().next().removeClass('hidden');
		}else{
			$(this).parent().removeClass('tree-open');
			$(this).removeClass('tree-minus');
			$(this).addClass('tree-plus');
			$(this).next().next().addClass('hidden');
		}
	});
}
