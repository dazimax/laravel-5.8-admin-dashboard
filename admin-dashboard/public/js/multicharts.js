$(document).ready(function(){
	
	var availableCharts;

	$('div.multichartContainer').on('click','a.addNewChart',function(){
		if($(this).siblings('.chartViewPanel').find('div#chartContainer').is(':empty')){
        	new PNotify({
			    title: 'Error!',
			    text: 'Please Create a chart for the current section',
			    type: 'error'
			});
		}else{
			$defaultWidget = $('div.multichartContainer').find("div#defaultWidget").clone();
			$defaultWidget.removeClass('hidden');
			$defaultWidget.prop('id','');
			$defaultWidget.insertAfter($(this).closest('div.graphWidget'));
		    $('html, body').animate({
		        scrollTop: $defaultWidget.offset().top
		    }, 2000);
			$(this).remove();
		}
		
	});

	//dataset change
	$('div.multichartContainer').on('change','select[name="datasetSelect"]',function(){
		var selectedDataset = $(this).val();
		$currentMultiChartDiv = $(this).closest('div#chartMultiViewDiv');
		var token = $('input[name="_token"]').val();
		if(selectedDataset == 0){
        	new PNotify({
			    title: 'Error!',
			    text: 'You cannot unset the dataset now.But you can change it',
			    type: 'error'
			});			
		}else{

			//retreive charts for dataset
		    po.ajax({
		        type: 'POST',
		        url: '/chart/getChartsForDataset',
		        data: {'dataset' : selectedDataset,'_token' : token},
		        success: function(respond) {
		            if (respond.status == false) {
		            	new PNotify({
						    title: 'Error!',
						    text: respond.msg,
						    type: 'error'
						});
		            } else if(respond.status == true) {
	            		$chartSelect = $currentMultiChartDiv.find('select[name="chartSelect"]');
	            		$chartSelect.prop( "disabled", false );
	            		$chartSelect.find('option.chartOptions').remove();
	            		$chartSelect.find('option[name="chartDefaultOption"]').prop('selected',true);
	            		$currentMultiChartDiv.find('input[name="chartId"]').val('');
	            		$currentMultiChartDiv.find('textarea[name="chartDesc"]').val('');
	            		var charts = respond.data.charts;
	            		availableCharts = charts;
	            		for (var i = 0; i <= charts.length-1; i++) {
	            			var optionHtml = "<option class='chartOptions' value="+charts[i].id+">"+charts[i].chart_name+"</option>";
	            			$(optionHtml).insertAfter($chartSelect.find('option[name="chartDefaultOption"]'));	
	            		}
	            		$currentMultiChartDiv.find('input[name="datasetId"]').val(selectedDataset);
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


		//chart change
	$('div.multichartContainer').on('change','select[name="chartSelect"]',function(){
		var selectedChart = $(this).val();
		var token = $('input[name="_token"]').val();
	    var chart = $.map(availableCharts,function(chart){
			if(chart.id == selectedChart){
				return chart;
			}
		});
	    var chartObj = chart[0];
		$currentMultiChartDiv = $(this).closest('div#chartMultiViewDiv');
		$currentMultiChartDiv.find('textarea[name="chartDesc"]').val(chartObj.chart_desc);
		$currentMultiChartDiv.find('input[name="chartId"]').val(selectedChart);

		//retrieve the filters
	    po.ajax({
	        type: 'POST',
	        url: '/chart/getChartFilterData',
	        data: {'chartId' : selectedChart,'_token' : token},
	        success: function(respond) {
	            if (respond.status == false) {
	            	new PNotify({
					    title: 'Error!',
					    text: respond.msg,
					    type: 'error'
					});
	            } else if(respond.status == true) {

            		$mainFilterSelect = $currentMultiChartDiv.find('select[name="mainFilterSelect"]');
            		$mainFilterSelect.prop( "disabled", false );
            		$mainFilterSelect.find('option.mainFilterOptions').remove();
            		$mainFilterSelect.find('option[name="mainFilterDefaultOption"]').prop('selected',true);

            		$monthFilterSelect = $currentMultiChartDiv.find('select[name="monthFilterSelect"]');
            		$monthFilterSelect.prop( "disabled", false );
            		$monthFilterSelect.find('option.monthFilterOptions').remove();
            		$monthFilterSelect.find('option[name="monthFilterDefaultOption"]').prop('selected',true);

            		$dateFilterSelect = $currentMultiChartDiv.find('select[name="yearFilterSelect"]');
            		$dateFilterSelect.prop( "disabled", false );
            		$dateFilterSelect.find('option.dateFilterOptions').remove();
            		$dateFilterSelect.find('option[name="yearFilterDefaultOption"]').prop('selected',true);
            		
            		$dynamicFilterSelect = $currentMultiChartDiv.find('select[name="dynamicFilterSelect"]');
            		$dynamicFilterSelect.prop( "disabled", false );
            		$dynamicFilterSelect.find('option.dynamicFilterOptions').remove();
            		$dynamicFilterSelect.find('option[name="dynamicFilterDefaultOption"]').prop('selected',true);
            		$currentMultiChartDiv.find('div.customFiltersDiv').remove();            		

            		var mainFilters = respond.data.filters.main;
            		var monthFilters = respond.data.filters.month;
            		var yearFilters = respond.data.filters.year;
            		var headerColumns = respond.data.headerColumns;
            		
            		for (var i = mainFilters.length-1; i >= 0; i--) {
            			var optionHtml = "<option class='mainFilterOptions' value="+mainFilters[i]+">"+mainFilters[i]+"</option>";
            			$(optionHtml).insertAfter($mainFilterSelect.find('option[name="mainFilterDefaultOption"]'));	
            		}

            		for (var i = monthFilters.length-1; i >= 0; i--) {
            			var optionHtml = "<option class='monthFilterOptions' value="+monthFilters[i]+">"+monthFilters[i]+"</option>";
            			$(optionHtml).insertAfter($monthFilterSelect.find('option[name="monthFilterDefaultOption"]'));	
            		}


            		for (var i = yearFilters.length-1; i >= 0; i--) {
            			var optionHtml = "<option class='dateFilterOptions' value="+yearFilters[i]+">"+yearFilters[i]+"</option>";
            			$(optionHtml).insertAfter($dateFilterSelect.find('option[name="yearFilterDefaultOption"]'));	
            		}

        			for (var i in headerColumns) {
            			var optionHtml = "<option class='dynamicFilterOptions' value="+i+">"+headerColumns[i]+"</option>";
            			$(optionHtml).insertAfter($dynamicFilterSelect.find('option[name="dynamicFilterDefaultOption"]'));	
            		}


            		$currentMultiChartDiv.find('button#chartViewFilter').prop('disabled',false);
            		$currentMultiChartDiv.find('button#chartViewReset').prop('disabled',false);
            		$currentMultiChartDiv.find('button#addNewChartFilter').prop('disabled',false);

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

	$('div.multichartContainer').on('click','button#chartViewFilter',function(){
		$currentMultiChartDiv = $(this).closest('div#chartMultiViewDiv');
		var token = $('input[name="_token"]').val();
		var mainFilter = $currentMultiChartDiv.find('select[name="mainFilterSelect"]').find(":selected").val();
		var monthFilter = $currentMultiChartDiv.find('select[name="monthFilterSelect"]').find(":selected").val();
		var yearFilter = $currentMultiChartDiv.find('select[name="yearFilterSelect"]').find(":selected").val();
		var chartId = $currentMultiChartDiv.find('input[name="chartId"]').val();
		var datasetId = $currentMultiChartDiv.find('input[name="datasetId"]').val();


		//collect dynamic filters
		var dynamicFiltersList = [];
		$currentMultiChartDiv.find('select.customFilterSelect').each(function(){
			var columnName = $(this).data('name');
			var columnId = columnName.slice(-1);
			if($(this).find(":selected").val() != 0){
				dynamicFiltersList.push({name : columnName, value: $(this).find(":selected").val()});
			}
		});

	    po.ajax({
	        type: 'POST',
	        url: '/chart/filter',
	        data: {'mainFilter' : mainFilter,'monthFilter':monthFilter, 'yearFilter':yearFilter,'_token' : token,'datasetId':datasetId,'chartId':chartId,'dynamicFilters': dynamicFiltersList},
	        success: function(respond) {
	            if (respond.status == false) {
	            	new PNotify({
					    title: 'Error!',
					    text: respond.msg,
					    type: 'error'
					});
	            } else if(respond.status == true) {
						$currentMultiChartDiv.find('div#singleChartContainer').empty();
						$currentMultiChartDiv.find('div#singleChartContainer').html(respond.data.view);
					    $('html, body').animate({
					        scrollTop: $currentMultiChartDiv.find('div#singleChartContainer').offset().top
					    }, 2000);

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


	$('div.multichartContainer').on('click','button#addNewChartFilter',function(){
		$currentMultiChartDiv = $(this).closest('div#chartMultiViewDiv');
		var selectedCustomFilter = $currentMultiChartDiv.find('select[name="dynamicFilterSelect"] :selected').val();
		var selectedCustomFilterName = $currentMultiChartDiv.find('select[name="dynamicFilterSelect"] :selected').text();
		var chartId = $currentMultiChartDiv.find('input[name="chartId"]').val();
		var datasetId = $currentMultiChartDiv.find('input[name="datasetId"]').val();
		var token = $('input[name="_token"]').val();

		if(selectedCustomFilter == 0){
        	new PNotify({
			    title: 'Error!',
			    text: 'Please select a column to create the filter',
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
		            	if(respond.data.length > 0){
			            	var filterValues = respond.data;
			            	$defaultCustomFilter = $currentMultiChartDiv.find('div.customFilterDefaultDiv').clone();
			            	$defaultFilterSelect = $defaultCustomFilter.find('select[name="customFilterDefaultSelect"]');
		            		for (var i = 0; i <= filterValues.length-1; i++) {
		            			var optionHtml = "<option class='filterValues' value="+filterValues[i]+">"+filterValues[i]+"</option>";
		            			$(optionHtml).insertAfter($defaultFilterSelect.find('option[name="filterDefaultOption"]'));	
		            		}

		            		$defaultFilterSelect.attr('name',selectedCustomFilter+'-filterSelect');
		            		$defaultFilterSelect.addClass('customFilterSelect');
		            		$defaultFilterSelect.data('name',selectedCustomFilter);
		            		$defaultCustomFilter.find('label.filterLabel').html(selectedCustomFilterName);
		            		$defaultCustomFilter.removeClass('hidden');
		            		$defaultCustomFilter.removeClass('customFilterDefaultDiv');
		            		$defaultCustomFilter.addClass('customFiltersDiv');
		            		$defaultCustomFilter.insertBefore($currentMultiChartDiv.find('div.customFilterDefaultDiv'));
		            		$currentMultiChartDiv.find('select[name="dynamicFilterSelect"]').prop('selectedIndex',0);
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


	$('div.multichartContainer').on('click','button#chartViewReset',function(){
		$currentMultiChartDiv = $(this).closest('div#chartMultiViewDiv');

		$currentMultiChartDiv.find('select[name="mainFilterSelect"]').prop('selectedIndex',0);
		$currentMultiChartDiv.find('select[name="monthFilterSelect"]').prop('selectedIndex',0);
		$currentMultiChartDiv.find('select[name="yearFilterSelect"]').prop('selectedIndex',0);

		$currentMultiChartDiv.find('button#chartViewFilter').trigger('click');
	});

});