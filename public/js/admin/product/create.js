$(document).on('ready', main);

var $productType;
var $stepOne;
var $stepTwo;
var $contentOne;
var $contentTwo;
var $prev;
var $next;
var $navTabs;
var $navTabsFirst;
var $navTabsLast;
var $navContent;
var $navContentFirst;
var $navContentLast;
var $type;
var categories = [];
var items = [];

function main(){
	var $steps = $('.steps');
	var $contents = $('.step-content');
	var $productTypeError = $('.type-product-error');
	var $treeBranchProduct = $('.tree-branch-product');
	var $addOption = $('#add_option');
	var $items = $('.items');

	$productType = $('#product_type');
	$stepOne = $steps.find('[data-step=1]');
	$stepTwo = $steps.find('[data-step=2]');
	$type    = $('#type');

	$contentOne = $contents.find('[data-step=1]');
	$contentTwo = $contents.find('[data-step=2]');

	$prev = $('.btn-prev');
	$next = $('.btn-next');
	$navTabs      = $('.nav-tabs li');
	$navTabsFirst = $('.nav-tabs li:first-child');
	$navTabsLast  = $('.nav-tabs li:last-child');
	$navContent      = $('.tab-content .tab-pane');
	$navContentFirst = $('.tab-content .tab-pane:first-child');
	$navContentLast = $('.tab-content .tab-pane:last-child');
	$form = $('#product-form');
	$submitForm = $('.submit-form');

	$productType.on('change',function(){
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
		if($productType.val()){
			stepTwo();	
		}else{
			if($productTypeError.hasClass('hide')){
				$productTypeError.removeClass('hide');
			}
		}
	});

	/*Manage categories*/
	$treeBranchProduct.on('click', function(e){
		e.stopPropagation();
		var add_element = false;
		var element;

		if(e.target.tagName ==='SPAN' || e.target.tagName ==='I'){
			if(e.target.tagName === 'SPAN'){
				if(!$(e.target).hasClass('selected-category-label')){
					$(e.target).addClass('selected-category-label');
					$(e.target).prev().addClass('selected-category').removeClass('fa-times').addClass('fa-check');
					add_element = true;
				}else{
					$(e.target).removeClass('selected-category-label');
					$(e.target).prev().removeClass('selected-category').addClass('fa-times').removeClass('fa-check');;
					add_element = false;
				}
			}else{
				if(!$(e.target).hasClass('selected-category')){
					$(e.target).addClass('selected-category').removeClass('fa-times').addClass('fa-check');
					$(e.target).next().addClass('selected-category-label');
					add_element = true;
				}else{
					$(e.target).removeClass('selected-category').addClass('fa-times').removeClass('fa-check');;
					$(e.target).next().removeClass('selected-category-label');
					add_element = false;
				}
			}

			element = $(e.target).parent().data('category');

			if(add_element){
				categories.push(element);
			}else{
				categories = $.grep(categories, function(el){
					return el != element;
				});
			}
		}
	});

	/*Add product option*/
	$addOption.on('click', function(){
		var now = Date.now();
		var item = 
			'<div class="row selection-item option-'+now+'">'+
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
						'<button type="button" class="btn btn-info btn-sm" data-add-item="'+now+'">Agregar elementos</button>'+
					'</div>'+
				'</div>'+
			'</div>';

		$items.append(item);
	});

	/*Delete product option*/
	$(document).on('click','[data-delete-item]', function(){
		$(this).parent().parent().parent().remove();
	});

	/*Open modal to filter products*/
	$(document).on('click','[data-add-item]', function(){
		var $tableProducts = $('#modal-table-products');
		items = [];

		$tableProducts.empty();
		$('#temporay-option-id').val($(this).data('add-item'));
		$('#modal-products').modal('show');
	});

	/*Filter products*/
	$(document).on('click','#modal-filterable-products', function(){
		var url = $(this).data('modal-filterable-products-url');
		var $tableProducts = $('#modal-table-products');

		$tableProducts.empty();

		$.ajax({
			url:url,
			type:'post'
		}).done(function(response){
			if(response.count !== 0){
				elements = '';
				for(var el of response.data){
					elements += 
					'<tr>'+
						'<td><input type="checkbox" data-selected-modal-product-id="'+ el.id +
						'" data-selected-modal-product-name="'+el.name+'" data-selected-modal-product-price="'+el.price+'"></td>'+
						'<td>'+ el.id +'</td>'+
						'<td>'+ el.name +'</td>'+
						'<td>'+ el.code +'</td>'+
						'<td>S/ '+ el.price +'</td>'+
					'</tr>';
				}

				$tableProducts.append(elements);
			}
		});
	});

	/*Manage product option items*/
	$(document).on('click','[data-selected-modal-product-id]',function(){
		var id = $(this).data('selected-modal-product-id');
		var name = $(this).data('selected-modal-product-name');
		var price = $(this).data('selected-modal-product-price');
		var item = {
			id:id,
			name:name,
			price:price
		};
		var added = false;

		if(this.checked){
			added = $.grep(items,function(it) {
				return it.id === id;
			});

			if(added.length === 0){
				items.push(item);
			}
		}else{
			items = $.grep(items,function(it) {
				return it.id !== id;
			});
		}
	});
	
	/*Add product option items*/
	$(document).on('click','#modal-products-option-items-add',function(){
		var $optionId = '.option-' + $('#temporay-option-id').val();
		var $option = $($optionId);
		var toAppend = '';

		for(var it of items){
			toAppend += 
				'<tr>'+
					'<td>'+it.name+'</td>'+
					'<td>'+it.price+'</td>'+
					'<td><input type="text" value="0" /></td>'+
					'<td><input type="text" value="0" /></td>'+
					'<td><input type="radio" /></td>'+
					'<td>Eliminar</td>'+
				'</tr>'
			;
		}

		if($option.children().length === 2){
			toAppend =
			'<div class="col-md-12 table-responsive mt-20">'+
				'<table class="table table-striped">'+
					'<thead>'+
						'<tr class="table-products">'+
							'<th>Producto</th>'+
							'<th>Precio</th>'+
							'<th>Cantidad</th>'+
							'<th>Posición</th>'+
							'<th>Predeterminado</th>'+
							'<th>Eliminar</th>'+
						'</tr>'+
					'</thead>'+
					'<tbody class="option-table-items">'+
					toAppend+
					'</tbody>'+
				'</table>'+
			'</div>';
			
			$option.append(toAppend);
		}else{
			$($optionId + '.option-table-items').append(toAppend);
		}

		$('#modal-products').modal('hide');
	});

	/*Submit product form*/
	$submitForm.on('click',function(){
		if(!$productType.val()){
			return;
		}

		$button = $(this);
		$button.prop('disabled',true);
		$button.attr('disabled',true);

		data = new FormData($form[0]);
		data.append('categories',JSON.stringify(categories));

		$.ajax({
			type: $form[0].method,
			url: $form[0].action,
			data: data,
			processData: false,
			contentType: false
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

                $button.prop('disabled',false);
        		$button.attr('disabled',false);
            }
		});
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

	if(!$submitForm.hasClass('hide')){
		$submitForm.addClass('hide');
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

	if($submitForm.hasClass('hide')){
		$submitForm.removeClass('hide');
	}

	$navContent.removeClass('active');
	$navTabs.removeClass('active');
	$navContentFirst.addClass('active');
	$navTabsFirst.addClass('active');

	if($productType.val() === 'bundle'){
		$navTabsLast.removeClass('hide');
	}else{
		$navTabsLast.addClass('hide');
	}

	$type.val($productType.val());
}