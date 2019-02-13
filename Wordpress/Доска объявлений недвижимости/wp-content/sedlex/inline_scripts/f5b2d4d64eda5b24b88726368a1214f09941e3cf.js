		jQuery(document).ready(function () {	
		
			jQuery(window).resize(function () { 
				jQuery('a.gallery_colorbox').colorbox({
									maxWidth: Math.min(370, Math.floor(0.95*jQuery(window).width())-80), 
					maxHeight: Math.min(400, Math.floor(0.95*jQuery(window).height())-80)
				
				}) ; 
			});
				
			jQuery('a.gallery_colorbox').colorbox({ 
				slideshow: true,
								title: false,
								slideshowAuto:false,
								slideshowSpeed: 5000 ,
				slideshowStart: 'Play',
				slideshowStop :  'Pause',
				current : 'Image {current} of {total}', 
				scalePhotos : true , 
				previous: 'Previous',	
				next:'Next',
				close:'Close',
													maxWidth: Math.min(370, Math.floor(0.95*jQuery(window).width())-80), 
					maxHeight: Math.min(400, Math.floor(0.95*jQuery(window).height())-80),
												
				
				opacity:0.8 , 
				onComplete : function(){ 
					jQuery("#cboxLoadedContent").css({overflow:'hidden'});
					jQuery("#colorbox").css({overflow:'visible'});
								},
				rel:'group1' 
			});
		});	
						
		