jQuery( document ).ready( function ( e ) {
	jQuery('#upload_transcript_file_button').click(function( event ){
		event.preventDefault();
		jQuery.fn.ssp_upload_media_file( jQuery(this), false );
	});
});