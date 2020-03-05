let navbarToggle = document.querySelector("#navbarToggle");
let smallNav = document.querySelector("#smallNav");

navbarToggle.addEventListener("click", function() {
	if(smallNav.style.display != "block") {
		smallNav.style.display = "block";
	}
	else {
		smallNav.style.display = "none";
	}
});