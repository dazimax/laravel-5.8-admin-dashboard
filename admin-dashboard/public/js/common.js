function showLoader() {
    $("#ajax-loader").removeClass('hidden');
}

function hideLoader() {
    $("#ajax-loader").addClass('hidden');
}


var po = {
    defaults: {
        complete: function(xhr, statusText)
        {
            switch (xhr.status) {
                case 403:
	            	new PNotify({
					    title: 'Error!',
					    text: 'Sorry you don\'t have permission to perform this task',
					    type: 'error'
					});
            }
        }
    },
};

po.ajax = function(options){
	showLoader();
    $.extend(options, po.defaults);
    var request = $.ajax(options)
            .always(function() {
                hideLoader();
            });
    return request;
}
