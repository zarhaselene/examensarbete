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

//Preview image before upload on edit single product page
$(document).ready(() => {
	$("#photo").change(function () {
		const file = this.files[0];
		if (file) {
			let reader = new FileReader();
			reader.onload = function (event) {
				console.log(event.target.result);
				$("#imgPreview").attr("src", event.target.result);
			};
			reader.readAsDataURL(file);
		}
	});
});

//Stripe
const stripe = Stripe(
	"pk_test_51Lhw5LFTqC3gmBoBORalC2bvcmn7BuJOTK02v3KHhpbeMmEDlsxdwj3Z8l89RDLenlgAMySP8LcY48x3hbu48yTW004JYNb8Xg"
);

var elements = stripe.elements({
	locale: "auto",
});

var card = elements.create("card", {
	iconStyle: "solid",
	style: {
		base: {
			iconColor: "#fe9aae",
			color: "#1a1a1a",
			fontWeight: 500,
			fontFamily: "Lato, sans-serif",
			fontSize: "16px",
			fontSmoothing: "antialiased",
		},
	},
});
card.mount("#card");
