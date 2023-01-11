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

/* Sidebar */
function toggleSidebar() {
	$(".sidebar").toggleClass("open");
}

/* Login form */
function openLoginForm() {
	$("#loginForm").addClass("active");
}
function closeLoginForm() {
	$("#loginForm").removeClass("active");
}

/* Register form */
function openRegisterForm() {
	$("#registerForm").addClass("active");
	$("#loginForm").removeClass("active");
}
function closeRegisterForm() {
	$("#registerForm").removeClass("active");
	$("#loginForm").addClass("active");
}

// let sidebar = document.querySelector(".sidebar");
// let closeBtn = document.querySelector("#open-btn");

// closeBtn.addEventListener("click", () => {
// 	sidebar.classList.add("open");
// 	menuBtnChange(); //calling the function
// });

// following are the code to change sidebar button
// function menuBtnChange() {
// 	if (sidebar.classList.contains("open")) {
// 		closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the icon class
// 	} else {
// 		closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the icon class
// 	}
// }
