//  Initialize Swiper
var swiper = new Swiper(".mySwiper", {
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
});

// Scroll
$(window).scroll(function () {
	if ($(this).scrollTop() > 10) {
		$(".navigation").addClass("show");
	} else {
		$(".navigation").removeClass("show");
	}
});
