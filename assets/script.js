// Sliders
const swiperContainers = document.querySelectorAll(".slider");

for (const swiperContainer of swiperContainers) {
	const swiper = swiperContainer.querySelector(".swiper");

	new Swiper(swiper, {
		loop: true,
		pagination: {
			el: ".swiper-pagination",
			dynamicBullets: true,
		},
		// Navigation arrows
		navigation: {
			nextEl: swiperContainer.querySelector(".swiper-button-next"),
			prevEl: swiperContainer.querySelector(".swiper-button-prev"),
		},
	});
}

// Scroll
$(window).scroll(function () {
	if ($(this).scrollTop() > 10) {
		$(".navigation").addClass("show");
	} else {
		$(".navigation").removeClass("show");
	}
});
