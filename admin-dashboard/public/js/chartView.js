$(document).ready(function(){
    var filters = JSON.parse($('input[name="filters"]').val());
    if(filters.length){
        if(filters.length > 0){
            var count = filters.length;
            $.each(filters,function (key,value) {
                if(key+1 == count){
                    addDynamicFilter(value,function () {
                        triggerChartViews();
                    });
                }else{
                    addDynamicFilter(value);
                }
            });
        }
    }else{
        triggerChartViews();
    }

});

function triggerChartViews()
{
    $('div#chartViewDiv').find('button#chartViewFilter').trigger('click');
}

function addDynamicFilter(filterObject,callback) {
    var selectedCustomFilter = filterObject.name;
    var selectedCustomFilterName = $('select[name="dynamicFilterSelect"]').find('option[value="'+filterObject.name+'"]').text();
    var chartId = $('div#chartViewDiv').find('input[name="chartId"]').val();
    var datasetId = $('div#chartViewDiv').find('input[name="datasetId"]').val();
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
                    $defaultCustomFilter = $('div#chartViewDiv').find('div.customFilterDefaultDiv').clone();
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
                    $defaultCustomFilter.insertBefore($('div#chartViewDiv').find('div.customFilterDefaultDiv'));
                    $('select[name="dynamicFilterSelect"]').prop('selectedIndex',0);
                }
                if(callback != null){
                    callback()
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
