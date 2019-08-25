	var addedCustomFilters = [];
$(document).ready(function(){

	var chartConfigData;

    $("#sortable1, #sortable3, #sortable4, #sortable5 ").sortable({
      connectWith: ".connectedSortable",
      receive: function( event, ui ) {
		  if ($('#sortable3').children().length > 1) {
			  $(ui.sender).sortable('cancel');
		  }
		  if ($('#sortable4').children().length > 1) {
			  $(ui.sender).sortable('cancel');
		  }
		  if ($('#sortable5').children().length > 1) {
			  $(ui.sender).sortable('cancel');
		  }
	  }
    }).disableSelection();


	$('form#createChart').submit(function(e){
		e.preventDefault();

		if($('ul#sortable3').find('li').length == 0){
        	new PNotify({
			    title: 'Error!',
			    text: 'You have to select atleast one column for the graph',
			    type: 'error'
			});
			return false;
		}

		if($('ul#sortable4').find('li').length == 0){
			new PNotify({
				title: 'Error!',
				text: 'You have to select atleast one column for the graph',
				type: 'error'
			});
			return false;
		}

		if($('ul#sortable5').find('li').length == 0){
			new PNotify({
				title: 'Error!',
				text: 'You have to select atleast one column for the graph',
				type: 'error'
			});
			return false;
		}
		var lineColumns = {};

		var xAxis = $(this).find('ul#sortable3').find('li').data('id');
		var yAxis = $(this).find('ul#sortable4').find('li').data('id');
		var zAxis = $(this).find('ul#sortable5').find('li').data('id');


		//collect dynamic filters
		var dynamicFiltersList = [];
		$('div.dynamicFiltersDiv').find('select.customFilterSelect').each(function(){
			var columnName = $(this).data('name');
			var columnId = columnName.slice(-1);
			if($(this).find(":selected").val() != 0){
				dynamicFiltersList.push({name : columnName, value: $(this).find(":selected").val()});
			}
		});
		
		var params = $('form#createChart').serializeArray();
		params.push({name: 'xAxis', value: xAxis });
		params.push({name: 'yAxis', value: yAxis });
		params.push({name: 'zAxis', value: zAxis });
		params.push({name: 'dynamicFilters', value: JSON.stringify(dynamicFiltersList) });
		chartConfigData = params;

	    po.ajax({
	        type: 'POST',
	        url: '/chart/filteredView',
	        data: params,
	        success: function(respond) {
	            if (respond.status == false) {
	            	new PNotify({
					    title: 'Error!',
					    text: respond.msg,
					    type: 'error'
					});
	            } else if(respond.status == true) {
					$('#chartContainer').remove()	;
					$('#chartContainer').empty();
					$('div.chartViewDiv').html('');	            	
					$('div.chartViewDiv').html(respond.data.view);
				    $('html, body').animate({
				        scrollTop: $('div.chartViewDiv').offset().top
				    }, 1200);					
	            }else{
	            	new PNotify({
					    title: 'Error!',
					    text: 'Something went wrong..!',
					    type: 'error'
					});
	            }
	        }
	    });
	});

	// line basic add column
	$('form#createChart').on('click','a.addLineColumnBtn',function(){
		$addLineChartColumnHtml = $('div#linebasicColumns').clone();
		$addLineChartColumnHtml.attr('id',null);
		$addLineChartColumnHtml.find('input[name="lineColumnName"]').val('');
		$addLineChartColumnHtml.insertAfter($(this).closest('div.linebasicColumns'));
	});

	//line basic delete column
	$('form#createChart').on('click','a.removeLineColumnBtn',function(){
		if($('div.linebasicColumns').length == 1){
        	new PNotify({
			    title: 'Error!',
			    text: 'You have to keep at least one column..!',
			    type: 'error'
			});			
		}else{
			$(this).closest('div.linebasicColumns').remove();
		}
	});


	$('div.chartWrapperDiv').on('click','a.chartViewBackBtn',function(){
		window.history.back();
	});

	$('div.chartWrapperDiv').on('click','a.chartViewSaveBtn',function(){

		$('form#createChart').trigger('submit');

		var chartName = $('input[name="chartName"]').val();
		var chartDesc = $('textarea[name="chartDesc"]').val();
		if($('div.chartViewDiv').html() == '' || $('div.chartViewDiv').html() == "CHART PREVIEW HERE" ){
        	new PNotify({
			    title: 'Error!',
			    text: 'You have to draw a chart first..!',
			    type: 'error'
				});			
        	return false;			
		}else if(chartName == ''){
        	new PNotify({
			    title: 'Error!',
			    text: 'You have to enter a chart name..!',
			    type: 'error'
				});			
        	return false;
		}else{
			var saveChartParams = chartConfigData;
			saveChartParams.push({name: 'chartName', value: chartName });
			saveChartParams.push({name: 'chartDesc', value: chartDesc });

			if($('input[name="saveType"]').val() == 'edit'){
				var url = '/chart/edit';
			}else{
				var url = '/chart/save';
			}

		    po.ajax({
		        type: 'POST',
		        url: url,
		        data: saveChartParams ,
		        success: function(respond) {
		            if (respond.status == false) {
		            	new PNotify({
						    title: 'Error!',
						    text: respond.msg,
						    type: 'error'
						});
		            } else if(respond.status == true) {
		            	window.location.href = "/chart/select/";
		            }else{
		            	new PNotify({
						    title: 'Error!',
						    text: 'Something went wrong..!',
						    type: 'error'
						});
		            }
		        }
		    });
		}
	});

	$('div.dynamicFiltersDiv').on('click','a.filterDeletebtn',function () {
		var deletingFilterName = $(this).attr('name');
		$(this).parent().remove();
		addedCustomFilters.splice(addedCustomFilters.indexOf(deletingFilterName),1)
	});
	
	$('div.chartConfigDiv').on('click','a#addNewChartFilter',function(e){
		e.preventDefault();
		var selectedCustomFilter = $('select[name="dynamicFilterSelect"] :selected').val();
		var selectedCustomFilterName = $('select[name="dynamicFilterSelect"] :selected').text();
		var chartId = $('div.chartConfigDiv').find('input[name="chartId"]').val();
		var datasetId = $('div.chartConfigDiv').find('input[name="datasetId"]').val();
		var token = $('input[name="_token"]').val();
		if(selectedCustomFilter == 0){
        	new PNotify({
			    title: 'Error!',
			    text: 'Please select a column to create the filter',
			    type: 'error'
			});
			return false;			
		}else if(addedCustomFilters.indexOf(selectedCustomFilter) > -1){
        	new PNotify({
			    title: 'Error!',
			    text: 'You already have this column as a filter',
			    type: 'error'
			});
			return false;				
		}else{
		    po.ajax({
		        type: 'POST',
		        url: '/chart/dataset/'+datasetId+'/filter/'+selectedCustomFilter+'/getValues',
		        data: {'_token' : token},
		        success: function(respond) {
		            if (respond.status == false) {
		            	new PNotify({
						    title: 'Error!',
						    text: respond.msg,
						    type: 'error'
						});
		            } else if(respond.status == true) {
		            	addedCustomFilters.push(selectedCustomFilter);
		            	if(respond.data.length > 0){
			            	var filterValues = respond.data;
			            	$defaultCustomFilter = $('div.chartConfigDiv').find('div.customFilterDefaultDiv').clone();
			            	$defaultFilterSelect = $defaultCustomFilter.find('select[name="customFilterDefaultSelect"]');
		            		for (var i = 0; i <= filterValues.length-1; i++) {
		            			var optionHtml = "<option class='filterValues' value='"+filterValues[i]+"'>"+filterValues[i]+"</option>";
		            			$(optionHtml).insertAfter($defaultFilterSelect.find('option[name="filterDefaultOption"]'));	
		            		}

		            		$defaultFilterSelect.attr('name',selectedCustomFilter+'-filterSelect');
		            		$defaultFilterSelect.addClass('customFilterSelect');
		            		$defaultFilterSelect.data('name',selectedCustomFilter);
		            		$defaultCustomFilter.find('label.filterLabel').html(selectedCustomFilterName);
		            		$defaultCustomFilter.removeClass('hidden');
		            		$defaultCustomFilter.removeClass('customFilterDefaultDiv');
		            		$defaultCustomFilter.insertBefore($('div.chartConfigDiv').find('div.customFilterDefaultDiv'));
		            		$('select[name="dynamicFilterSelect"]').prop('selectedIndex',0);
		            	}
		            	

		            }else{
		            	new PNotify({
						    title: 'Error!',
						    text: 'Something went wrong..!',
						    type: 'error'
						});
		            }
		        }
		    });		
		}				

	});	

});