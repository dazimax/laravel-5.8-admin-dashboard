$(document).ready(function(){
    $('.form_datetime').datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        startDate: "2017-01-01 10:00",
        minuteStep: 10
    });


    $('form#saveChartPlan').on('click','a.createChartPlanResetBtn',function () {
        // window.history.back();
        $('div.clientSelectDiv').removeClass('hidden');
        $('form#saveChartPlan')[0].reset();
    });


    $('select[name="clientSelect"]').on('change',function () {
        if($(this).val() == 0){
            $('div.planDatasets').html('');
        }else{
            var params = [];
            params.push({name: 'clientId', value: $(this).val() });
            params.push({name: '_token', value: $('input[name="_token"]').val()  });

            po.ajax({
                type: 'POST',
                url: '/chartPlan/getCustomerDatasets',
                data: params,
                success: function(respond) {
                    if (respond.status == false) {
                        new PNotify({
                            title: 'Error!',
                            text: respond.msg,
                            type: 'error'
                        });
                    }else if(respond.status == true){
                        $('div.planDatasets').html('');
                        $('div.planDatasets').html(respond.data);
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

    $('form#saveChartPlan').on('click','a.createChartPlanSaveBtn',function () {
        if($('select[name="isDefault"]').val() == 0 && $('select[name="clientSelect"]').val() == 0 ){
            new PNotify({
                title: 'Error!',
                text: 'Please select a Client for the Chart Plan',
                type: 'error'
            });
            return false;
        }else if($('input[name="planExpireDate"]').val() == ''){
            new PNotify({
                title: 'Error!',
                text: 'Please select a Expire date for the Chart Plan',
                type: 'error'
            });
            return false;
        }else if($('input[name="datasetCheck"]:checked').length == 0){
            new PNotify({
                title: 'Error!',
                text: 'Please select atlease one dataset for the Chart Plan',
                type: 'error'
            });
            return false;
        }else{
            var selectedDatasets = [];
            $('input[name="datasetCheck"]:checked').each(function(){
                selectedDatasets.push($(this).data('id'));
            });

            var params = [];
            params.push({name: 'clientId', value: $('select[name="clientSelect"]').val() });
            params.push({name: 'isActive', value: $('select[name="isActive"]').val() });
            params.push({name: 'isDefault', value: $('select[name="isDefault"]').val() });
            params.push({name: 'expireDate', value: $('input[name="planExpireDate"]').val() });
            params.push({name: 'planDescription', value: $('textarea[name="planDescription"]').val() });
            params.push({name: 'selectedDatasets', value: JSON.stringify(selectedDatasets) });
            params.push({name: '_token', value: $('input[name="_token"]').val()  });

            po.ajax({
                type: 'POST',
                url: '/chartPlan/save',
                data: params,
                success: function(respond) {
                    if (respond.status == false) {
                        new PNotify({
                            title: 'Error!',
                            text: respond.msg,
                            type: 'error'
                        });
                    }else if(respond.status == true){
                        new PNotify({
                            title: 'Success!',
                            text: respond.msg,
                            type: 'success'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        },2000);
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

    $('select[name="isDefault"]').on('change',function () {
        if($(this).val() == 1){
            $('div.clientSelectDiv').addClass('hidden');
            $('select[name="clientSelect"]').val('0');
            var params = [];
            params.push({name: 'forDefaultCustomer', value: '' });
            params.push({name: '_token', value: $('input[name="_token"]').val()  });

            po.ajax({
                type: 'POST',
                url: '/chartPlan/getCustomerDatasets',
                data: params,
                success: function(respond) {
                    if (respond.status == false) {
                        new PNotify({
                            title: 'Error!',
                            text: respond.msg,
                            type: 'error'
                        });
                    }else if(respond.status == true){
                        $('div.planDatasets').html('');
                        $('div.planDatasets').html(respond.data);
                    }else{
                        new PNotify({
                            title: 'Error!',
                            text: 'Something went wrong..!',
                            type: 'error'
                        });
                    }
                }
            });
        }else{
            $('select[name="clientSelect"]').val('0');
            $('div.planDatasets').html('');
            $('div.clientSelectDiv').removeClass('hidden');
        }
    });


    if($('form#editChartPlan').length > 0 ){

        var params = [];
        params.push({name: 'editPlanId', value: $('input[name="editPlanId"]').val() });
        params.push({name: '_token', value: $('input[name="_token"]').val()  });

        po.ajax({
            type: 'POST',
            url: '/chartPlan/getCustomerDatasets',
            data: params,
            success: function(respond) {
                if (respond.status == false) {
                    new PNotify({
                        title: 'Error!',
                        text: respond.msg,
                        type: 'error'
                    });
                }else if(respond.status == true){
                    $('div.planDatasets').html('');
                    $('div.planDatasets').html(respond.data);
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

    $('form#editChartPlan').on('click','a.editChartPlanResetBtn',function () {
        window.location.reload();
    });

    $('form#editChartPlan').on('click','a.editChartPlanSaveBtn',function () {
        if($('input[name="planExpireDate"]').val() == ''){
            new PNotify({
                title: 'Error!',
                text: 'Please select a Expire date for the Chart Plan',
                type: 'error'
            });
            return false;
        }else if($('input[name="datasetCheck"]:checked').length == 0){
            new PNotify({
                title: 'Error!',
                text: 'Please select atlease one dataset for the Chart Plan',
                type: 'error'
            });
            return false;
        }else{
            var selectedDatasets = [];
            $('input[name="datasetCheck"]:checked').each(function(){
                selectedDatasets.push($(this).data('id'));
            });

            var params = [];
            params.push({name: 'planId', value: $('input[name="editPlanId"]').val() });
            params.push({name: 'isActive', value: $('select[name="isActive"]').val() });
            params.push({name: 'expireDate', value: $('input[name="planExpireDate"]').val() });
            params.push({name: 'planDescription', value: $('textarea[name="planDescription"]').val() });
            params.push({name: 'selectedDatasets', value: JSON.stringify(selectedDatasets) });
            params.push({name: '_token', value: $('input[name="_token"]').val()  });

            po.ajax({
                type: 'POST',
                url: '/chartPlan/update',
                data: params,
                success: function(respond) {
                    if (respond.status == false) {
                        new PNotify({
                            title: 'Error!',
                            text: respond.msg,
                            type: 'error'
                        });
                    }else if(respond.status == true){
                        new PNotify({
                            title: 'Success!',
                            text: respond.msg,
                            type: 'success'
                        });
                        setTimeout(function() {
                            window.location.reload();
                        },2000);
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