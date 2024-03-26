const searchIcon = document.getElementById("search-icon");
const searchPopup = document.getElementById("search-popup");
const closeSearch = document.getElementById("close-search");
const burgerMenu = document.getElementById("mobile-nav-toggler");

const closeBtn = document.getElementById("close-btn");
let body = document.querySelector("body");
const dropBtn = document.getElementById("drop-btn");
const dropMenu = document.getElementById("drop-menu");

burgerMenu.addEventListener('click', ()=> {
   body.classList.add("mobile-menu-visible");
})
searchIcon.addEventListener('click', ()=> {
   searchPopup.classList.add("popup-visible");
})
closeSearch.addEventListener('click', ()=> {
   searchPopup.classList.remove("popup-visible");
})

dropBtn.addEventListener('click', ()=> {
   if(dropMenu.style.display == "block"){
      dropMenu.style.display = "none"
   }
   else{
      dropMenu.style.display = "block"
   }
})

closeBtn.addEventListener('click', ()=> {
   body.classList.remove("mobile-menu-visible");
})

$ = jQuery.noConflict();


$(function () {
	// Owl Carousel
	var owl = $(".testimonial-area");
	owl.owlCarousel({
		items: 1,
		margin: 20,
		loop: true,
		dots: true,
		nav: true,
		autoplay: true,
		autoplayTimeout: 2000,
		autoplayHoverPause: false,
		navText: [
			"<i class='fa fa-long-arrow-left'></i>",
			"<i class='fa fa-long-arrow-right'></i>"
		 ],
		 "responsive": {
			"0": {
				"items": 1
			},
			"768": {
				"items": 2
			},
			"992": {
				"items": 1
			},
			"1200": {
				"items": 1
			}
		}

	});
});
