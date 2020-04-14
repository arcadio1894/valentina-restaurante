$(document).on('ready', main);

var $type;
var $stepOne;
var $stepTwo;
var $contentOne;
var $contentTwo;
var $prev;
var $next;
var $options;

function main(){
	var $steps = $('.steps');
	var $contents = $('.step-content');
	var $productTypeError = $('.type-product-error');

	$type = $('#type');
	$stepOne = $steps.find('[data-step=1]');
	$stepTwo = $steps.find('[data-step=2]');

	$contentOne = $contents.find('[data-step=1]');
	$contentTwo = $contents.find('[data-step=2]');

	$prev = $('.btn-prev');
	$next = $('.btn-next');
	$options = $('.options');

	$type.on('change',function(){
		if($(this).val()){
			if(!$productTypeError.hasClass('hide')){
				$productTypeError.addClass('hide');
			}
		}
	});

	$prev.on('click', function(){
		stepOne();
	});

	$next.on('click', function(){
		if($type.val()){
			stepTwo();	
		}else{
			if($productTypeError.hasClass('hide')){
				$productTypeError.removeClass('hide');
			}
		}
	});
}

function stepOne(){
	$prev.prop('disabled',true);
	$next.prop('disabled',false);

	if($stepTwo.hasClass('active')){
		$stepTwo.removeClass('active');
	}

	if($contentTwo.hasClass('active')){
		$contentTwo.removeClass('active');
	}

	if(!$stepOne.hasClass('active')){
		$stepOne.addClass('active');
	}

	if(!$contentOne.hasClass('active')){
		$contentOne.addClass('active');
	}
}

function stepTwo(){
	$prev.prop('disabled',false);
	$next.prop('disabled',true);

	if($stepOne.hasClass('active')){
		$stepOne.removeClass('active');
	}

	if($contentOne.hasClass('active')){
		$contentOne.removeClass('active');
	}

	if(!$stepTwo.hasClass('active')){
		$stepTwo.addClass('active');
	}

	if(!$contentTwo.hasClass('active')){
		$contentTwo.addClass('active');
	}

	if($type.val() === 'bundle'){
		if($options.hasClass('hide')){
			$options.removeClass('hide');
		}
	}else{
		if(!$options.hasClass('hide')){
			$options.addClass('hide');
		}
	}
}