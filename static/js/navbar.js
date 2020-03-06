let navbarToggle = document.querySelector("#navbarToggle");
let smallNav = document.querySelector("#smallNav");

let dropdownToggle = document.querySelectorAll(".nav-item.dropdown");

let body = document.body;

body.onresize = function() {
	console.log(body.offsetWidth);
	if(body.offsetWidth > 850) {
		// Göm länkar om webbläsaren är 900px eller större.
		if(smallNav.style.display == "block") {
			smallNav.style.display = "none";
		}
	}
};

navbarToggle.addEventListener("click", function() {
	if(smallNav.style.display != "block") {
		smallNav.style.display = "block";
	}
	else {
		smallNav.style.display = "none";
	}
});

dropdownToggle.forEach(function(dropToggle) {
	let link = dropToggle.querySelectorAll(".nav-link")[0];
	link.addEventListener("click", function() {
		let dropdownMenu = dropToggle.querySelectorAll(".nav-dropdown")[0];
		if(dropdownMenu.style.display != "block") {
			dropdownMenu.style.display = "block";
		}
		else {
			dropdownMenu.style.display = "none";
		}
	});
});