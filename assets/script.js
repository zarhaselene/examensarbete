// Sliders
const swiperContainers = document.querySelectorAll(".slider");

for (const swiperContainer of swiperContainers) {
	const swiper = swiperContainer.querySelector(".swiper");

	new Swiper(swiper, {
		loop: true,
		pagination: {
			el: ".swiper-pagination",
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

/* Login form */
function openLoginForm() {
	document.getElementById("loginForm").style.display = "block";
}
function closeLoginForm() {
	document.getElementById("loginForm").style.display = "none";
}

/* Register form */
function openRegisterForm() {
	document.getElementById("registerForm").style.display = "block";
	document.getElementById("loginForm").style.display = "none";
}
function closeRegisterForm() {
	document.getElementById("registerForm").style.display = "none";
	document.getElementById("loginForm").style.display = "block";
}
