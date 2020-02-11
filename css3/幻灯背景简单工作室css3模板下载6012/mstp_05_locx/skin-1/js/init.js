$(document).ready(function(){

				$.supersized({
				
					// Functionality
                                        autoplay				:	1,			// Slideshow starts playing automatically
                    
                    					slide_interval          :   3500,		// Length between transitions
                    
                     					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                    
                    					transition_speed		:	1000,		// Speed of transition
					
																			   
					slides 					:  	[			// Slideshow Images
                    
                       {image : "images/pic1.jpg", title : "", thumb : "", url : ""},
					   {image : "images/pic2.jpg", title : "", thumb : "", url : ""}, 
					   {image : "images/pic3.jpg", title : "", thumb : "", url : ""} 	
                                                     
												]
					
				});

});