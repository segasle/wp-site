// JavaScript Document
jQuery(document).ready(function() {
	
	var moxasaViewPortWidth = '',
		moxasaViewPortHeight = '';

	function moxasaViewport(){

		moxasaViewPortWidth = jQuery(window).width(),
		moxasaViewPortHeight = jQuery(window).outerHeight(true);	
		
		if( moxasaViewPortWidth > 1200 ){
			
			jQuery('.main-navigation').removeAttr('style');
			
			var moxasaSiteHeaderHeight = jQuery('.site-header').outerHeight();
			var moxasaSiteHeaderWidth = jQuery('.site-header').width();
			var moxasaSiteHeaderPadding = ( moxasaSiteHeaderWidth * 2 )/100;
			var moxasaMenuHeight = jQuery('.menu-container').height();
			
			var moxasaMenuButtonsHeight = jQuery('.site-buttons').height();
			
			var moxasaMenuPadding = ( moxasaSiteHeaderHeight - ( (moxasaSiteHeaderPadding * 2) + moxasaMenuHeight ) )/2;
			var moxasaMenuButtonsPadding = ( moxasaSiteHeaderHeight - ( (moxasaSiteHeaderPadding * 2) + moxasaMenuButtonsHeight ) )/2;
		
			
			jQuery('.menu-container').css({'padding-top':moxasaMenuPadding});
			jQuery('.site-buttons').css({'padding-top':moxasaMenuButtonsPadding});
			
			
		}else{

			jQuery('.menu-container, .site-buttons, .header-container-overlay, .site-header').removeAttr('style');

		}	
	
	}

	jQuery(window).on("resize",function(){
		
		moxasaViewport();
		
	});
	
	moxasaViewport();


	jQuery('.site-branding .menu-button').on('click', function(){
				
		if( moxasaViewPortWidth > 1200 ){

		}else{
			jQuery('.main-navigation').slideToggle();
		}				
		
				
	});	

    var owl = jQuery("#moxasa-owl-basic");
         
    owl.owlCarousel({
             
      	slideSpeed : 300,
      	paginationSpeed : 400,
      	singleItem:true,
		navigation : true,
      	pagination : false,
      	navigationText : false,
         
    });			
	
});		