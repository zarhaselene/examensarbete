// Scroll
$(window).scroll(function () {
	if ($(this).scrollTop() > 10) {
		$(".navigation").addClass("show-nav");
	} else {
		$(".navigation").removeClass("show-nav");
	}
});

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

// Sidebar
function toggleSidebar() {
	$(".sidebar").toggleClass("open");
	menuBtnChange(); //calling the function
}
// Function to change sidebar button
function menuBtnChange() {
	if ($(".sidebar").hasClass("open")) {
		$(".sb-icon").addClass("bx-x").removeClass("bx-menu"); //replacing the icon class
	} else if (!$(".sidebar").hasClass("open")) {
		$(".sb-icon").removeClass("bx-x").addClass("bx-menu"); //replacing the icon class
	}
}

// Login form
function openLoginForm() {
	$("#loginForm").addClass("active");
}
function closeLoginForm() {
	$("#loginForm").removeClass("active");
}

// Register form
function openRegisterForm() {
	$("#registerForm").addClass("active");
	$("#loginForm").removeClass("active");
}
function closeRegisterForm() {
	$("#registerForm").removeClass("active");
	$("#loginForm").addClass("active");
}
