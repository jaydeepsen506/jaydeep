
	$(document).ready(function() {
		
		// select-box
        //$('.selectpicker').selectpicker();
        
        
		
	 });
	 
	 
	
	//Footer fixed	
	$(window).bind("load", function() {        
       var footerHeight = 0,
           footerTop = 0,
           $footer = $(".footer");           
       positionFooter();       
       function positionFooter() {       
            footerHeight = $footer.height();
            footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";       
           if ( ($(document.body).height()+footerHeight) < $(window).height()) {
               $footer.css({
                    position: "fixed",
                    bottom: "0px", 
                    left: "0", 
                    right: "0"
               })
           } else {
               $footer.css({
                    position: "relative",
                    display: "block"
               })
           }               
       }
       $(window)
	       .scroll(positionFooter)
	       .resize(positionFooter)
               
	});
	

	//
	// $(window).bind("load", function() {
		// scrollStop();       
			// function scrollStop() {       
				// $('.side-nav').mouseenter(function(){
					// //alert('mouseenter');
			        // $('body').on('mousewheel DOMMouseScroll', function() {
			            // return false
			        // });
			        // $(this).on('mousewheel DOMMouseScroll', function() {
			            // return true
			        // });
			    // });
			    // $('.side-nav').mouseleave(function(){
			    	// //alert('mouseleave');
			        // $('body').on('mousewheel DOMMouseScroll', function() {
			            // return true
			        // });
				// });                   
			// }
			// $(window)
		       // .load(scrollStop)
		       // .resize(scrollStop)
		       // .scroll(scrollStop)		
	// });









