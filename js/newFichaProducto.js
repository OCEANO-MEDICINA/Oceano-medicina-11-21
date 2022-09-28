jQuery(document).ready(function ($) {
   $("#temario_accordion").accordionjs({
      // Allow self close.(data-close-able)
      closeAble: true,

      // Close other sections.(data-close-other)
      closeOther: true,

      // Animation Speed.(data-slide-speed)
      slideSpeed: 300,
   });
});

document.getElementById("paginationTrigger").onclick = function () {
   this.classList.toggle("invisible");
   document.getElementById("paginationModules").classList.toggle("invisible");
   document.getElementById("paginationControl").classList.toggle("invisible");
};
