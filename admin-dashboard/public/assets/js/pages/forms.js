$(function() {
	$('.summernote').summernote({
	  height: 500
	});
});

$(document).ready(function(){
   $("#visiblecheckbox").click(function(){
      var checkboxval = $("#visiblecheckbox").val();
      if(checkboxval == 0){
          $("#visiblecheckbox").val(1);
      }
       else{
          $("#visiblecheckbox").val(0);
      }
   });

   var currentroutename = $("#currentroutename").val();
   $('.leftlink-'+currentroutename).click();
   $('.sub-leftlink').removeClass('sidebar-menu-item-hover');
   $('.sub-leftlink-'+currentroutename).addClass('sidebar-menu-item-hover');


});