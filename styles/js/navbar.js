const homeIcon = document.querySelector('.menuMobile');
const desktopNav = document.querySelector('#navBar');
const container = document.querySelector(".container");

const menuClicked = () => {
  console.log(desktopNav.classList)
  // change the style of the navbar for mobile (fullsize)
  container.classList.add('mobileNav')
  
  if(desktopNav.classList.contains("navSlideIn")){
    desktopNav.classList.add('navSlideOut')
    desktopNav.classList.remove('navSlideIn')
  }
  else {
    desktopNav.classList.add('navSlideIn')
    desktopNav.classList.remove('navSlideOut')
  }
  desktopNav.classList.remove("desktopNavDisplayNone"); 
}

// hamburger and navbar animation section

window.onresize = function(event) {
    resize();
};

document.addEventListener("DOMContentLoaded", function(event) { 
  resize();
});


window.resize = function() {
  // console.log(window.innerWidth);
  if (window.innerWidth <= 620) {
    // check if the the menu is open in mobile
    if(!container.classList.contains("mobileNav")){
       // make the animation for the icon in
      homeIcon.classList.remove("menuIconDisplayNone");
      homeIcon.classList.add("menuIconDisplayOn");
      // make the animation for the desktop nav
      desktopNav.classList.add("desktopNavDisplayNone");
      desktopNav.classList.remove("desktopNavDisplayOn");  
       }  
  }
  else {
    // make the animation for the icon out
    homeIcon.classList.add("menuIconDisplayNone");
    homeIcon.classList.remove("menuIconDisplayOn");
    // make the animation for the desktop nav
    desktopNav.classList.remove("desktopNavDisplayNone");
    desktopNav.classList.add("desktopNavDisplayOn");
    // remove the mobile navbar style
    container.classList.remove('mobileNav')
    desktopNav.classList.remove('navSlideIn')
    desktopNav.classList.remove('navSlideOut')
  }
};
