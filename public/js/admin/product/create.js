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
var $productId = null;

function main(){
	var $steps = $('.steps');
	var $contents = $('.step-content');
	var $productTypeError = $('.type-product-error');
	var $treeBranchProduct = $('.tree-branch-product');
	var $addOption = $('#add_option');
	var $optionItems = $('.option-items');

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
	$productId = $('#product_id');

	$productType.on('change',function(){
		var $containerVisibility = $('#container-visibility');
		var $containerStatus = $('#container-status');
		var $contentVisibility = '';
		var $contentStatus = '';

		$contentVisibility =
			'<div class="form-group">'+
				'<label for="visibility">Visibilidad: <span class="required">*</span></label>'+
				'<select name="visibility" class="form-control">'+
					'<option value="" class="hide">--Seleccionar--</option>'+
					'<option value="catalog">En catálogo</option>'+
					'<option value="bundle">No visible individualmente</option>'+
				'</select>'+
			'</div>'
		;
		$contentStatus = 
			'<div class="form-group">'+
				'<label for="status">Estado: <span class="required">*</span></label>'+
				'<select name="status" class="form-control">'+
					'<option value="" class="hide">--Seleccionar--</option>'+
					'<option value="enabled">Habilitado</option>'+
					'<option value="disabled">Desabilitado</option>'+
				'</select>'+
			'</div>	'
		;

		$containerVisibility.empty();
		$containerStatus.empty();

		if($(this).val() === 'simple'){
			$containerVisibility.append($contentVisibility);
			$containerStatus.append($contentStatus);
		}else if($(this).val() === 'bundle'){
			$containerVisibility.append($contentStatus);
		}

		if(!$productTypeError.hasClass('hide')){
			$productTypeError.addClass('hide');
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

	if($productId && $productId.val()){
		categories = JSON.parse($('#category_ids').val());
	}

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
		var optionItem = 
			'<div class="row option-object option-'+now+'">'+
				'<div class="col-md-12">'+
					'<div class="col-md-9 mb-10">'+
						'<label for="title">Título: <span class="required">*</span></label>'+
						'<input type="text" class="form-control">'+
					'</div>'+
					'<div class="col-md-3 mt-27 mb-10">'+
						'<button type="button" class="btn btn-sm btn-danger" data-delete-option>Eliminar</button>'+
					'</div>'+
				'</div>'+
				'<div class="col-md-12 mt-4">'+
					'<div class="col-md-3">'+
						'<label for="option_type">Tipo: <span class="required">*</span></label>'+
						'<select id="option_type" class="form-control">'+
							'<option value="select">Select</option>'+
							'<option value="radio">Radio button</option>'+
							'<option value="checkbox">Checkbox</option>'+
							'<option value="multiselect">Multiselect</option>'+
						'</select>'+
					'</div>'+
					'<div class="col-md-3">'+
						'<label for="is_required">Requerido: <span class="required">*</span></label>'+
						'<select id="is_required" class="form-control">'+
							'<option value="0">No</option>'+
							'<option value="1">Sí</option>'+
						'</select>'+
					'</div>'+
					'<div class="col-md-3">'+
						'<label for="position">Posición: <span class="required">*</span></label>'+
						'<input type="text" class="form-control">'+
					'</div>'+
					'<div class="col-md-3">'+
						'<div class="btn-label"></div>'+
						'<button type="button" class="btn btn-info btn-sm" data-add-item="'+now+'">Agregar elementos</button>'+
					'</div>'+
				'</div>'+
			'</div>';

		$optionItems.append(optionItem);
	});

	/*Delete product option*/
	$(document).on('click','[data-delete-option]', function(){
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
	$(document).on('click','#modal-search-products', function(){
		var url = $(this).data('modal-search-products-url');
		var $tableProducts = $('#modal-table-products');
		var temporaryOptionId = $('#temporay-option-id').val();
		var $optionItems = $('.option-'+temporaryOptionId + ' .option-table-items');
		var ids = [];
		var modalSearchId = $('#modal-search-id').val().trim();
		var modalSearchName = $('#modal-search-name').val().trim();
		var modalSearchCode = $('#modal-search-code').val().trim();
		var modalSearchPriceMin = $('#modal-search-min-price').val().trim();
		var modalSearchPriceMax = $('#modal-search-max-price').val().trim();

		if($optionItems.children().length > 0){
			$optionItems.children().each(function(key,tr){
				ids.push($(tr).data('product-id'));
			});
		}

		$tableProducts.empty();

		$.ajax({
			url:url,
			type:'post',
			data:{
				ids: ids,
				id:modalSearchId,
				name:modalSearchName,
				code:modalSearchCode,
				min_price:modalSearchPriceMin,
				max_price:modalSearchPriceMax
			}
		}).done(function(response){
			if(response.count !== 0){
				elements = '';
				for(var el of response.data){
					elements += 
					'<tr>'+
						'<td><input type="checkbox" data-modal-table-product-id="'+ el.id +
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
	$(document).on('click','[data-modal-table-product-id]',function(){
		var id = $(this).data('modal-table-product-id');
		var name = $(this).data('selected-modal-product-name');
		var price = $(this).data('selected-modal-product-price');
		var option = $('#temporay-option-id').val();
		var added = [];
		var item = {
			id:id,
			name:name,
			price:price
		};

		if(this.checked){
			added = $.grep(items,function(it) {
				return it.id === item.id;
			});

			if(added.length === 0){
				items.push(item);
			}
		}else{
			items = $.grep(items,function(it) {
				return it.id !== item.id;
			});
		}
	});
	
	/*Add product option items*/
	$(document).on('click','#modal-products-option-items-add',function(){
		var temporaryOptionId = $('#temporay-option-id').val();
		var $optionId = '.option-' + $('#temporay-option-id').val();
		var $option = $($optionId);
		var toAppend = '';
		var now;

		for(var it of items){
			now = Date.now();
			toAppend += 
				'<tr data-product-id="'+it.id+'">'+
					'<td style="vertical-align:middle">'+it.name+'</td>'+
					'<td style="vertical-align:middle">'+it.price+'</td>'+
					'<td><input type="text" value="1" /></td>'+
					'<td><input type="text" value="0" /></td>'+
					'<td class="text-center"><input type="radio" name="is_default_'+$('#temporay-option-id').val()+'"/></td>'+
					'<td><button class="btn btn-danger btn-xs" data-delete-selection><i class="fa fa-trash"></i></button></td>'+
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
			$($optionId + ' .option-table-items').append(toAppend);
		}

		$('#modal-products').modal('hide');
	});

	$(document).on('click','[data-delete-selection]', function(){
		var $tr = $(this).parent().parent();

		if($tr.parent().children().length === 1){
			$tr.parent().parent().parent().remove();
		}else{
			$tr.remove();
		}
	})

	/*Submit product form*/
	$submitForm.on('click',function(){
		var $optionObjects = $('.option-object');
		var options = [];

		if(!$productType.val() && !$productId && !$productId.val()){
			return;
		}

		$optionObjects.each(function(key,optionObject){
			var $titleContainer = $($(optionObject).children()[0]);
			var $extraContainer = $($(optionObject).children()[1]);
			var $tableContainer = $($(optionObject).children()[2]);
			var option = {};
			var optionItems = [];

			option.id = '';
			option.title = $($titleContainer.children().children()[1]).val();
			option.type = $($($($extraContainer).children()[0]).children()[1]).val();
			option.is_required = $($($($extraContainer).children()[1]).children()[1]).val();
			option.position = $($($($extraContainer).children()[2]).children()[1]).val();

			if($productId && $productId.val() && $(this).data('option-id')){
				option.id = $(this).data('option-id');
			}

			if($tableContainer){
				$($tableContainer.children().children()[1]).children().each(function(k,row){
					var optionItem = {};

					optionItem.id = '';
					optionItem.product_id = $(row).data('product-id');
					optionItem.name   = $($(row).children()[0]).text();
					optionItem.price  = $($(row).children()[1]).text();
					optionItem.qty    = $($(row).children()[2]).children().val();
					optionItem.position   = $($(row).children()[3]).children().val();
					optionItem.is_default = $($(row).children()[4]).children().is(':checked')?1:0;

					if($productId && $productId.val() && $(row).data('selection-id')){
						optionItem.id = $(row).data('selection-id');
					}

					optionItems.push(optionItem);
				});
			}

			option.selections = optionItems;
			options.push(option);
		});

		$button = $(this);
		$button.prop('disabled',true);
		$button.attr('disabled',true);

		data = new FormData($form[0]);
		data.append('categories',JSON.stringify(categories));
		data.append('options',JSON.stringify(options));

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