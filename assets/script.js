// Scroll
$(window).scroll(function () {
	// Check if the window has been scrolled down more than 10 pixels
	if ($(this).scrollTop() > 10) {
		// Add class "show-nav" to the element with class "navigation"
		$(".navigation").addClass("show-nav");
	} else {
		// Remove class "show-nav" from the element with class "navigation"
		$(".navigation").removeClass("show-nav");
	}
});

//Place order btn tooltip (shows when user ain't logged in)
$(document).ready(function () {
	// select the tooltip element
	let tooltip = $(".tool-tip");
	// set the initial opacity to 0
	tooltip.css("opacity", "0");
	// bind the hover event to the element with the class "grey-cart-button"
	$(".grey-cart-button").hover(
		function () {
			// on hover, set the tooltip's opacity to 1 and translate it to the Y-axis by 0
			tooltip.css({
				opacity: "1",
				transform: "translateY(0)",
			});
		},
		function () {
			// on hover out, set the tooltip's opacity to 0
			tooltip.css("opacity", "0");
		}
	);
});

//Add to cart
function addToCart(event) {
	// Prevent default form submission behavior
	event.preventDefault();
	// Get the form data from the form with ID "form-add-to-cart"
	const form = document.getElementById("form-add-to-cart");
	const formData = new FormData(form);

	// Send the form data to the server using a POST request to the specified URL
	fetch("/exa/scripts/add-to-cart.php", {
		method: "POST",
		body: formData,
	})
		.then(function (response) {
			// Convert the server response to JSON format
			return response.json();
		})
		.then(function (data) {
			// If the request was successful
			if (data.success) {
				// Add the "active" class to the element with ID "circle"
				document.getElementById("circle").classList.add("active");
				// Update the cart count
				document.getElementById("cart-count").innerHTML = data.cartCount;
				// Update the message
				document.getElementById("message").innerHTML = data.message;
				// Add the "active" class to the message
				document.getElementById("message").classList.add("active");
				// Remove the "active" class from the message after 1000ms
				setTimeout(() => {
					document.getElementById("message").classList.remove("active");
				}, 1000);
			} else {
				// Update the message
				document.getElementById("message").innerHTML = data.message;
			}
		});
}
function sendMessage(event) {
	// Prevent default form submission behavior
	event.preventDefault();
	// Get the form data from the form with ID "form-send-message"
	const form = document.getElementById("form-send-message");
	const formData = new FormData(form);

	// Send the form data to the server using a POST request to the specified URL
	fetch("/exa/scripts/post-create-message.php", {
		method: "POST",
		body: formData,
	})
		.then(function (response) {
			// Convert the server response to JSON format
			return response.json();
		})
		.then(function (data) {
			// If the request was successful
			if (data.success) {
				// Update the confirmation
				document.getElementById("confirmation").innerHTML = data.confirmation;
				// Add the "active" class to the confirmation
				document.getElementById("confirmation").classList.add("active");
				// Reset the form
				form.reset();
				// Remove the "active" class from the confirmation after 1000ms
				setTimeout(() => {
					document.getElementById("confirmation").classList.remove("active");
				}, 2000);
			} else {
				// Update the confirmation
				document.getElementById("confirmation").innerHTML = data.confirmation;
			}
		});
}

// Sliders
const swiperContainers = document.querySelectorAll(".slider");
// Iterate through each element with class "slider"
for (const swiperContainer of swiperContainers) {
	// Select the first element with class "swiper" within the current slider container
	const swiper = swiperContainer.querySelector(".swiper");
	// Initialize a new instance of the Swiper object for the current swiper element
	new Swiper(swiper, {
		// Enable loop mode
		loop: true,
		// Add pagination element
		pagination: {
			el: ".swiper-pagination",
		},
		// Add navigation arrows
		navigation: {
			// Select the next button element within the current slider container
			nextEl: swiperContainer.querySelector(".swiper-button-next"),
			// Select the prev button element within the current slider container
			prevEl: swiperContainer.querySelector(".swiper-button-prev"),
		},
	});
}

// Sidebar
function toggleSidebar() {
	//Toggle the open class on sidebar element
	$(".sidebar").toggleClass("open");
	// Call the function to change the sidebar button
	menuBtnChange();
}

// Function to change sidebar button
function menuBtnChange() {
	// Check if sidebar has open class
	if ($(".sidebar").hasClass("open")) {
		// Replace the icon class with "bx-x" and remove "bx-menu"
		$(".sb-icon").addClass("bx-x").removeClass("bx-menu");
	} else if (!$(".sidebar").hasClass("open")) {
		// Replace the icon class with "bx-menu" and remove "bx-x"
		$(".sb-icon").removeClass("bx-x").addClass("bx-menu");
	}
}

//Allows the selected image file to be previewed in the "imgPreview" element.
$(document).ready(() => {
	// Bind an event listener to the change event of input element with ID "photo"
	$("#photo").change(function () {
		// Get the first file from the input element
		const file = this.files[0];
		if (file) {
			// Create a new instance of the FileReader object
			let reader = new FileReader();
			// Assign a callback function to the onload event of the reader
			reader.onload = function (event) {
				// Log the result of the file read to the console
				console.log(event.target.result);
				// Set the src attribute of an image element with ID "imgPreview" to the result
				$("#imgPreview").attr("src", event.target.result);
			};
			// Start reading the file as a DataURL
			reader.readAsDataURL(file);
		}
	});
});

// Discount message in cart
$(document).ready(function () {
	// Add a click event listener to the button with class "discount-btn"
	$(".discount-btn").click(function () {
		// Get the value of the input with class "dcode"
		var inputValue = $(".dcode").val();
		// Check if inputValue is not an empty string
		if (inputValue) {
			$("#discount-message").text(
				'The discount code "' +
					inputValue +
					'" is unfortunately not in our system.'
			);
			// Remove the class "hide" from the element with id "discount-message"
			$("#discount-message").toggleClass("hide", false);
			// Add the class "show" to the element with id "discount-message"
			$("#discount-message").toggleClass("show", true);
		} else {
			$("#discount-message").toggleClass("show", false);
			$("#discount-message").toggleClass("hide", true);
		}
	});
});

//Stripe
const stripe = Stripe(
	"pk_test_51Lhw5LFTqC3gmBoBORalC2bvcmn7BuJOTK02v3KHhpbeMmEDlsxdwj3Z8l89RDLenlgAMySP8LcY48x3hbu48yTW004JYNb8Xg"
);

// Initialize Stripe Elements with the locale set to "auto"
var elements = stripe.elements({
	locale: "auto",
});

// Create a card element
var card = elements.create("card", {
	// Set the icon style to "solid"
	iconStyle: "solid",
	style: {
		base: {
			// Set the icon color
			iconColor: "#fe9aae",
			// Set the text color
			color: "#1a1a1a",
			// Set the font weight
			fontWeight: 500,
			// Set the font family
			fontFamily: "Lato, sans-serif",
			// Set the font size
			fontSize: "16px",
			// Enable font smoothing
			fontSmoothing: "antialiased",
		},
	},
});

// Mount the card element to the element with ID "card"
card.mount("#card");
