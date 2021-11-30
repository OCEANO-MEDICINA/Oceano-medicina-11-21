document.addEventListener('DOMContentLoaded', () => {

  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {

        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById("navbar-oceano");
        const $target1 = document.getElementById("navbar-overlay");

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');
        $target1.classList.toggle('is-active');
        
      });
    });
  }

});

function btnSearch() {
   var burger = document.getElementById("navbar-burger");
   burger.classList.toggle("invisible");
   var icons = document.getElementById("icons");
   icons.classList.toggle("is-flex-grow-1");
    var logo = document.getElementById("logo");
   logo.classList.toggle("invisible");
    var cart = document.getElementById("cart");
   cart.classList.toggle("invisible");
    var lupa = document.getElementById("lupa");
   lupa.classList.toggle("invisible");
    var lupa = document.getElementById("search-close");
   lupa.classList.toggle("invisible");
    var searchBar = document.getElementById("dgwt-wcas-search-input-1");
   searchBar.classList.toggle("invisible");
   searchBar.classList.toggle("searchbar-visible");
};

function btnSearchDesktop() {

   var icons = document.getElementById("icons");
   icons.classList.toggle("is-flex-grow-1");
    var lupa = document.getElementById("lupa-desktop");
   lupa.classList.toggle("invisible");
    var lupa = document.getElementById("search-close-desktop");
   lupa.classList.toggle("invisible");
    var navMedicina = document.getElementById("nav-medicina");
   navMedicina.classList.toggle("invisible");
    var navEnfermeria = document.getElementById("nav-enfermeria");
   navEnfermeria.classList.toggle("invisible");
    var navComunidad = document.getElementById("nav-comunidad");
   navComunidad.classList.toggle("invisible");
    var campusLogin = document.getElementById("login-campus");
   campusLogin.classList.toggle("invisible");
    var searchCont = document.getElementById("search-desktop");
   searchCont.classList.toggle("search-desktop-open");
    var searchBar = document.getElementById("dgwt-wcas-search-input-1-desktop");
   searchBar.classList.toggle("invisible");
   searchBar.classList.toggle("searchbar-visible");
   
};
