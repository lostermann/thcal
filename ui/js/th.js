$(window).load(function() {
	$('#dp, #dp2').datepicker({
		weekStart: 1
	});
	
	$('#dp').datepicker()
	.on('changeDate', function(e) {
			$('#dp').datepicker('hide');
	});

	$('#dp2').datepicker()
	.on('changeDate', function(e) {
			$('#dp2').datepicker('hide');
	});
	
	$('#showtime, #showtime2').timepicker({
		showMeridian: false
	});

	$('#get_in_band, #get_in_band2').timepicker({
		showMeridian: false
	});

	$('#get_in_local_crew, #get_in_local_crew2').timepicker({
		showMeridian: false
	});
	
	$('body').tooltip({
        selector: "[data-tooltip=tooltip]",
        container: "body"
    });
	
});

$(document).keypress(function(e){
    if (e.which == 13){
        if ($('#backbutton').length > 0) {
        $('#backbutton').click();
      }
    }
});

