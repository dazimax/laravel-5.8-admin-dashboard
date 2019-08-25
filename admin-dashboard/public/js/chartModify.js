$(document).ready(function(){
    var userChart = JSON.parse($('input[name="userChart"]').val());
    var chartConf = JSON.parse(userChart.chart_config);
    var filters = JSON.parse(chartConf.dynamicFilters);
    if(filters.length){
        if(filters.length > 0){
            $.each(filters,function (key,value) {
                addDynamicFilter(value);
            });
        }
    }

    $('input[name="graphTitle"]').val(chartConf.graphTitle);
    $('input[name="graphSubTitle"]').val(chartConf.graphSubTitle);
    $('input[name="titleXAxis"]').val(chartConf.titleXAxis);
    $('input[name="titleYAxis"]').val(chartConf.titleYAxis);
    $('input[name="tooltipSuffix"]').val(chartConf.tooltipSuffix);
    $('input[name="chartName"]').val(userChart.chart_name);
    $('textarea[name="chartDesc"]').text(userChart.chart_desc);
});

function addDynamicFilter(filterObject) {
    var selectedCustomFilter = filterObject.name;
    var selectedCustomFilterName = $('select[name="dynamicFilterSelect"]').find('option[value="'+filterObject.name+'"]').text();
    var chartId = $('div.chartConfigDiv').find('input[name="chartId"]').val();
    var datasetId = $('div.chartConfigDiv').find('input[name="datasetId"]').val();
    var token = $('input[name="_token"]').val();
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
                        if(filterObject.value == filterValues[i]){
                            var optionHtml = "<option class='filterValues' selected value='"+filterValues[i]+"'>"+filterValues[i]+"</option>";
                        }else{
                            var optionHtml = "<option class='filterValues' value='"+filterValues[i]+"'>"+filterValues[i]+"</option>";
                        }
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
