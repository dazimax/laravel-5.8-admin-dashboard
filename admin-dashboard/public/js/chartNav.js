$(document).ready(function() {

    $("#departmentChooser").imagepicker({
        show_label : true,
        clicked:function (option) {
            var clickingDepartment = this.val();
            window.location.href = "/department/" + clickingDepartment + "/viewDatasets/";
        }
    });

    $("#datasetChooser").imagepicker({
        show_label : true,
        clicked:function (option) {
            var clickingDataset = this.val();
            var selectedDepartmentId = $('input[name="departmentId"]').val();
            window.location.href = "/department/" + selectedDepartmentId + "/dataset/"+clickingDataset+"/viewcharts";
        }
    });

    $("#chartTypeChooser").imagepicker({
        show_label : true,
        clicked:function (option) {
            var clickingChartTypeId = this.val();
            var selectedDepartmentId = $('input[name="departmentId"]').val();
            var selectedDatasetId = $('input[name="datasetId"]').val();

            window.location.href = "/department/" + selectedDepartmentId + "/dataset/"+selectedDatasetId+"/chartType/"+clickingChartTypeId+"/viewcharts/";
        }
    });

    $("#chartChooser").imagepicker({
        show_label : true,
    });

    $(".chartListReset").on('click',function () {
        $('#chartChooser :selected').each(function(){
            $(this).prop("selected", false);
        });
        $("#chartChooser").data('picker').sync_picker_with_select();
    });
    $("div#deleteChartsModal").on('click','.deleteChartsYes',function () {
        var deletingCharts = [];
        $('#chartChooser :selected').each(function(){
            if($(this).val() != 'datatable'){
                deletingCharts.push($(this).val());
            }
        });

        if(deletingCharts.length == 0 ){
            new PNotify({
                title: 'Error!',
                text: "No charts selected to deleted.",
                type: 'error'
            });
            return false;
        }
        var token = $('input[name="_token"]').val();

        $.each(deletingCharts,function (i, val) {
            $('#chartChooser option[value='+val+']').remove();
        });
        $("#chartChooser").imagepicker();
        po.ajax({
            type: 'POST',
            url: '/chart/deleteCharts',
            data: {'_token' : token,'deleteCharts' : deletingCharts },
            success: function(respond) {
                if (respond.status == false) {
                    $('#deleteChartsModal').modal('hide');
                    new PNotify({
                        title: 'Error!',
                        text: respond.msg,
                        type: 'error'
                    });
                }else if(respond.status == true) {
                      $('#deleteChartsModal').modal('hide');
                    new PNotify({
                        title: 'Success!',
                        text: respond.msg,
                        type: 'success'
                    });
                    $.each(deletingCharts,function () {
                         $('#chartChooser option[value=""]').remove();

                    });
                }else{
                    $('#deleteChartsModal').modal('hide');
                    new PNotify({
                        title: 'Error!',
                        text: 'Something went wrong..!',
                        type: 'error'
                    });
                }
            }
        });
    });

    $(".chartListEdit").on('click',function () {
        var selectedCharts = [];
        $('#chartChooser :selected').each(function(){
            selectedCharts.push($(this).val());
        });
        if(selectedCharts.length == 0){
            new PNotify({
                title: 'Error!',
                text: 'Please select a chart to edit..!',
                type: 'error'
            });
        }else if(selectedCharts.length == 1){
            if(selectedCharts[0] == 'datatable'){
                var selectedDatasetId = $('input[name="datasetId"]').val();
                var url = '/dataset/view/'+selectedDatasetId;
            }else{
                var url = '/chart/edit/'+selectedCharts[0];
            }
            window.open(url);
        }else{
            new PNotify({
                title: 'Error!',
                text: 'Please select only one chart to edit..!',
                type: 'error'
            });
        }
    });

    $(".chartListView").on('click',function () {
        var selectedCharts = [];
        $('#chartChooser :selected').each(function(){
            selectedCharts.push($(this).val());
        });
        if(selectedCharts.length == 0){
            new PNotify({
                title: 'Error!',
                text: 'Please select a chart to view..!',
                type: 'error'
            });
        }else if(selectedCharts.length == 1){
            if(selectedCharts[0] == 'datatable'){
                var selectedDatasetId = $('input[name="datasetId"]').val();
                var url = '/dataset/view/'+selectedDatasetId;
            }else{
                var url = '/chart/view/'+selectedCharts[0];
            }
            window.open(url);
        }else{
            if(selectedCharts.indexOf('datatable') >= 0){
                // selectedCharts.splice(selectedCharts.indexOf('datatable'),1);
                new PNotify({
                    title: 'Error!',
                    text: 'You cannot view datatable in multiview. Please deselect it',
                    type: 'error'
                });

                return false;
            }
            var link = '/chart/viewMultiple?charts='+JSON.stringify(selectedCharts);
            window.open(link);
        }
    });
});