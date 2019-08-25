var addedCustomFilters = [];
$(document).ready(function(){
	$('form#chartSelect').submit(function(e){
		e.preventDefault();
		var selectedChartId = $('select[name="chartType"] :selected').val();
		var selectedDatasetId = $('select[name="chartDataSet"] :selected').val();
		if(selectedDatasetId == 0){
			new PNotify({
				title: 'Error!',
				text: 'Please select a Dataset',
				type: 'error'
			});
		}else{
			window.location.href = "/chart/create/"+selectedChartId+"/dataset/"+selectedDatasetId;
		}
	});

	$('a.chartViewBack').on('click',function(e){
		e.preventDefault();
		window.history.back();
	});

	$('div#chartViewDiv').on('click','button#chartViewFilter',function(){
		var mainFilter = $('select[name="mainFilterSelect"]').find(":selected").val();
		var monthFilter = $('select[name="monthFilterSelect"]').find(":selected").val();
		var yearFilter = $('select[name="yearFilterSelect"]').find(":selected").val();
		var token = $('input[name="_token"]').val();
		var chartId = $('div#chartViewDiv').find('input[name="chartId"]').val();
		var datasetId = $('div#chartViewDiv').find('input[name="datasetId"]').val();

		//collect dynamic filters
		var dynamicFiltersList = [];
		$('div.dynamicFiltersDiv').find('select.customFilterSelect').each(function(){
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
            			// $('#chartContainer').remove();
						$('#chartContainer').empty();
						$('#chartContainer').html('');
						$('#chartContainer').html(respond.data.view);

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

	$('div#chartViewDiv').on('click','button#chartViewReset',function(){
		$('select[name="mainFilterSelect"]').prop('selectedIndex',0);
		$('select[name="monthFilterSelect"]').prop('selectedIndex',0);
		$('select[name="yearFilterSelect"]').prop('selectedIndex',0);
		$('button#chartViewFilter').trigger('click');
	});

	$('div.dynamicFiltersDiv').on('click','a.filterDeletebtn',function () {
		var deletingFilterName = $(this).attr('name');
		$(this).parent().remove();
		addedCustomFilters.splice(addedCustomFilters.indexOf(deletingFilterName),1)
	});
	
	$('div#chartViewDiv').on('click','button#addNewChartFilter',function(e){
		e.preventDefault();
		var selectedCustomFilter = $('select[name="dynamicFilterSelect"] :selected').val();
		var selectedCustomFilterName = $('select[name="dynamicFilterSelect"] :selected').text();
		var chartId = $('div#chartViewDiv').find('input[name="chartId"]').val();
		var datasetId = $('div#chartViewDiv').find('input[name="datasetId"]').val();
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
			            	$defaultCustomFilter = $('div#chartViewDiv').find('div.customFilterDefaultDiv').clone();
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
		            		$defaultCustomFilter.insertBefore($('div#chartViewDiv').find('div.customFilterDefaultDiv'));
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
	
	$('.chartListViewButton').on('click',function (e) {
		e.preventDefault();
		var link = $(this).attr('href');
		window.open(link);
	});

	$('#multipleChartOpen').on('click',function(){
		var selectedCharts = [];
		$('#chartListTable').find('.chartSelectMulti:checkbox:checked').each(function(){
			selectedCharts.push($(this).data('chart'));
		});
		if(selectedCharts.length == 0){
			new PNotify({
				title: 'Error!',
				text: 'You have to select at lease one chart to go to multiple chart view..!',
				type: 'error'
			});
		}else{
			// console.log(JSON.stringify(selectedCharts));
			var link = '/chart/viewMultiple?charts='+JSON.stringify(selectedCharts);
			window.open(link);
		}
	});
});