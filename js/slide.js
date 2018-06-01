$(document).ready(function(){

				$(window).scroll(function() {
					$(".slideanim").each(function(){
						var pos = $(this).offset().top;

						var winTop = $(window).scrollTop();
						if (pos < winTop + 500) {
							$(this).addClass("slide");
						}
					});
				});
			})
		</script>
		<script>
			wow = new WOW(
			{
				animateClass: 'animated',
				offset:       0,
				callback:     function(box) {
					console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
				}
			}
			);
			wow.init();