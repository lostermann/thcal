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

	$('#searchveranst').keydown(function(e) {
		if ((e.metaKey === false) && (e.ctrlKey === false) && (e.altKey === false) && (e.shiftKey === false)) {
			$('#searchip').css('display', 'block');
		}
	});

	$('#searchveranst').keyup(function() {
		$('#searchveranstresults').load('/searchveranst', {searchveranst: $('#searchveranst').val()}, function() {
		$('#searchip').css('display', 'none'); });
	});
	
	$('#searchveranstresults').on('click', '#selectveranst', function() {
			$('#veranst_link').val($(this).data('id'));
			$('#veranst_link2').val($(this).data('id'));
			$('#veranst').val($(this).data('text'));
			$('#veranst2').val($(this).data('text'));
			$('#select').modal('hide');
	});
	
	$('#veranst_delete').click(function() {
		$('#veranst_link').val('');
			$('#veranst_link2').val('');
			$('#veranst').val('');
			$('#veranst2').val('');
	});
	
	$('#veranst_delete2').click(function() {
		$('#veranst_link').val('');
			$('#veranst_link2').val('');
			$('#veranst').val('');
			$('#veranst2').val('');
	});
	
	$('#select').on('shown.bs.modal', function () {
  $('#searchveranst').focus();
})
});

$(document).keypress(function(e){
    if (e.which == 13){
        if ($('#backbutton').length > 0) {
        $('#backbutton').click();
      }
    }
});


