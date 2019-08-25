

$(document).ready(function(){
	var files;
	var  selectedDatasetTr;
	$('form#datasetImport').submit(function(e){
		e.preventDefault();
		if($(this).find('input[name="dataImport"]').val() == ''){
        	new PNotify({
			    title: 'Error!',
			    text: 'Please select a file first',
			    type: 'error'
			});	
			return false;
		}else if($(this).find('select[name="departmentSelect"]').val() == 0 ){
			new PNotify({
				title: 'Error!',
				text: 'Please select a department for the dataset',
				type: 'error'
			});
			return false;
		}else if($(this).find('input[name="dataSetName"]').val() == ''){
        	new PNotify({
			    title: 'Error!',
			    text: 'Please enter a name for the Dataset',
			    type: 'error'
			});	
			return false;		
		}else if($(this).find('textarea[name="contentDescription"]').val() == ''){
			new PNotify({
				title: 'Error!',
				text: 'Description cannot be empty',
				type: 'error'
			});
			return false;
		}
		var token = $('input[name="_token"]').val();
		// var data = $(this).serialize();
		var data = new FormData();
	    $.each(files, function(key, value)
	    {
	        data.append(key, value);
	    });
	    data.append('_token',token);
	    data.append('hasHeader',$(this).find('input[name="hasHeader"]').is(':checked'));
	    data.append('dataSetName',$(this).find('input[name="dataSetName"]').val());
		data.append('dataEncoding', $('select[name="dataEncoding"] :selected').val());
	    data.append('department',$(this).find('select[name="departmentSelect"]').val());
	    data.append('contentDescription',$(this).find('textarea[name="contentDescription"]').val());
	    po.ajax({
	        type: 'POST',
	        url: $(this).attr('action'),
	        data: data,
	        dataType: 'json',
	        processData: false,
	        contentType: false,	        
	        success: function(respond) {
	            if (respond.status == false) {
	            	new PNotify({
					    title: 'Error!',
					    text: respond.msg,
					    type: 'error'
					});
	            } else if(respond.status == true) {
	            	new PNotify({
					    title: 'Success!',
					    text: respond.msg,
					    type: 'success'
					});
					$('form#datasetImport')[0].reset();	            	
	            	$('div.sucessButtonList').removeClass('hidden');
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

	$('form#datasetImport').on('change','input[name="dataImport"]',function(e){
	 	files = e.target.files;
	});


	// $('#updateDatasetRowModal').on('show.bs.modal', function (event) {
	// 	if($('table#datasetViewTable').find('tr.selected').length == 0 ){
	// 		new PNotify({
	// 			title: 'Error!',
	// 			text: 'Please select a row to edit',
	// 			type: 'error'
	// 		});
	// 		return false;
	// 	}else{
	// 		var $tr = $('table#datasetViewTable').find('tr.selected');
	// 		selectedDatasetTr = $tr.data('id');
	// 		$tr.find('td').each(function () {
	// 			var currentColumnId = $(this).data('id');
	// 			$('#updateDatasetRowModal').find('input[name="'+currentColumnId+'"]').val($(this).html());
	// 		});
	// 	}
	// });

	$('td.editRow').on('click',function () {
        var $tr = $(this).parent();
        selectedDatasetTr = $(this).parent().data('id');
        $tr.find('td').each(function () {
            var currentColumnId = $(this).data('id');
            $('#updateDatasetRowModal').find('input[name="'+currentColumnId+'"]').val($(this).html());
        });
        $('#updateDatasetRowModal').modal('show');
    });

	$('#updateDatasetRowModal').on('click','a.updateURL',function (e) {
		e.preventDefault();
		var datasetId = $('input[name="datasetId"]').val();
		var token = $('input[name="_token"]').val();
		var formData  = [];
		var columns  = $('#updateDatasetRowModal').find('form#datasetRowEdit').serializeArray();
		formData.push({name: 'columns', value: JSON.stringify(columns) });
		formData.push({name: 'datasetId', value: datasetId });
		formData.push({name: 'datasetRow', value: selectedDatasetTr });
		formData.push({name: '_token', value: token });
		po.ajax({
			type: 'POST',
			url: '/dataset/updateRow',
			data: formData,
			success: function(respond) {
				if (respond.status == false) {
					new PNotify({
						title: 'Error!',
						text: respond.msg,
						type: 'error'
					});
				} else if(respond.status == true) {
					new PNotify({
						title: 'Success!',
						text: respond.msg,
						type: 'success'
					});
					$('#updateDatasetRowModal').find('form#datasetRowEdit')[0].reset();
					setTimeout(function () {
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
	});
});