jQuery(document).ready(function($){
	
	var selectedScheme = 'disabled';
	
	if ($('#_az_header_settings').hasClass('disabled')){
		$('.form-table.az-metabox-table tr:not(:first-child)').hide();
	}
       
   $('#_az_header_settings').on('change', function(){
		$(this).removeClass(selectedScheme).addClass($(this).val());
		selectedScheme = $(this).val();
		
		if ($('#_az_header_settings').hasClass('disabled')){
			$('.form-table.az-metabox-table.az-metabox-page-header tr:not(:first-child)').fadeOut("slow");
			$('.form-table.az-metabox-table.az-metabox-post-header tr:not(:first-child)').fadeOut("slow");
		} else {
			$('.form-table.az-metabox-table.az-metabox-page-header tr:not(:first-child)').fadeIn("slow");
			$('.form-table.az-metabox-table.az-metabox-post-header tr:not(:first-child)').fadeIn("slow");
		}
	
	});
	
	$('#post-formats-select input').change(checkFormat);
	
	function checkFormat(){
		var format = $('#post-formats-select input:checked').attr('value');
		
		if(typeof format != 'undefined'){
			
			if(format == 'gallery'){
				$('#poststuff div[id$=slide][id^=post]').stop(true,true).fadeIn(500);
			}
			
			else {
				$('#poststuff div[id$=slide][id^=post]').stop(true,true).fadeOut(500);
			}
			
			$('#post-body div[id^=az-metabox-post-]').hide();
			$('#post-body div[id^=az-metabox-post-header]').show();
			$('#post-body #az-metabox-post-'+format+'').stop(true,true).fadeIn(500);
					
		}
	
	}
	
	$(window).load(function(){
		checkFormat();
	})
	
	$('#poststuff div[id$=slide][id^=post]').hide();
});


