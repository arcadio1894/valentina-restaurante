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
	var $treeBranchProduct = $('.tree-branch-product');
	var $addOption = $('#add_option');
	var $items = $('.items');

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

	$treeBranchProduct.on('click', function(e){
		e.stopPropagation();

		if(e.target.tagName ==='SPAN' || e.target.tagName ==='I'){
			if(e.target.tagName === 'SPAN'){
				if(!$(e.target).hasClass('selected-category-label')){
					$(e.target).addClass('selected-category-label');
					$(e.target).prev().addClass('selected-category').removeClass('fa-times').addClass('fa-check');
				}else{
					$(e.target).removeClass('selected-category-label');
					$(e.target).prev().removeClass('selected-category').addClass('fa-times').removeClass('fa-check');;
				}
			}else{
				if(!$(e.target).hasClass('selected-category')){
					$(e.target).addClass('selected-category').removeClass('fa-times').addClass('fa-check');
					$(e.target).next().addClass('selected-category-label');
				}else{
					$(e.target).removeClass('selected-category').addClass('fa-times').removeClass('fa-check');;
					$(e.target).next().removeClass('selected-category-label');
				}
			}
		}
	});

	$addOption.on('click', function(){
		var item = 
			'<div class="row selection-item">'+
				'<div class="col-md-12">'+
					'<div class="col-md-9 mb-10">'+
						'<label for="title">Título</label>'+
						'<input type="text" name="title" class="form-control">'+
					'</div>'+
					'<div class="col-md-3 mt-27 mb-10">'+
						'<button type="button" class="btn btn-sm btn-danger" data-delete-item>Eliminar</button>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-12">'+
					'<div class="col-md-3">'+
						'<label for="option_type">Tipo</label>'+
						'<select name="option_type" id="option_type" class="form-control">'+
							'<option value="select">Select</option>'+
							'<option value="radio">Radio button</option>'+
							'<option value="checkbox">Checkbox</option>'+
							'<option value="multiselect">Multiselect</option>'+
						'</select>'+
					'</div>'+
					'<div class="col-md-3">'+
						'<label for="is_required">Requerido</label>'+
						'<select name="option_type" id="option_type" class="form-control">'+
							'<option value="0">Sí</option>'+
							'<option value="1">No</option>'+
						'</select>'+
					'</div>'+
					'<div class="col-md-3">'+
						'<label for="position">Pisición</label>'+
						'<input type="text" name="position" class="form-control">'+
					'</div>'+
					'<div class="col-md-3">'+
						'<div class="btn-label"></div>'+
						'<button type="button" class="btn btn-info btn-sm" data-add-item>Agregar elementos</button>'+
					'</div>'+
				'</div>'+
			'</div>';

		$items.append(item);
	});

	$(document).on('click','[data-add-item]', function(){
		$('#modal-products').modal('show');
	});

	$(document).on('click','[data-delete-item]', function(){
		$(this).parent().parent().parent().remove();
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