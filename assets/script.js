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

let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#open-btn");

closeBtn.addEventListener("click", () => {
	sidebar.classList.toggle("open");
	menuBtnChange(); //calling the function
});

// following are the code to change sidebar button
function menuBtnChange() {
	if (sidebar.classList.contains("open")) {
		closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the icon class
	} else {
		closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the icon class
	}
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
