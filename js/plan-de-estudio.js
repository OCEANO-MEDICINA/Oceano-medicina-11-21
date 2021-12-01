function paso1() {

    var title1 = document.getElementById("plan-title-1");
    title1.classList.toggle("invisible");
    var title2 = document.getElementById("plan-title-2");
    title2.classList.toggle("invisible");
    var paso1 = document.getElementById("paso-1");
    paso1.classList.toggle("invisible");
    var paso2 = document.getElementById("paso-2");
    paso2.classList.toggle("invisible");
    var progress2 = document.getElementById("progress-2");
    progress2.classList.toggle("active");
    document.getElementById("progress").style.width = "30%";
    
 };
 function paso2next() {

    var title2 = document.getElementById("plan-title-2");
    title2.classList.toggle("invisible");
    var title3 = document.getElementById("plan-title-3");
    title3.classList.toggle("invisible");
    var paso2 = document.getElementById("paso-2");
    paso2.classList.toggle("invisible");
    var paso3 = document.getElementById("paso-3");
    paso3.classList.toggle("invisible");
    var progress3 = document.getElementById("progress-3");
    progress3.classList.toggle("active");
    document.getElementById("progress").style.width = "60%";
    
 };
 function paso2back() {

   var title1 = document.getElementById("plan-title-1");
    title1.classList.toggle("invisible");
    var title2 = document.getElementById("plan-title-2");
    title2.classList.toggle("invisible");
    var paso2 = document.getElementById("paso-2");
    paso2.classList.toggle("invisible");
    var paso1 = document.getElementById("paso-1");
    paso1.classList.toggle("invisible");
    var progress2 = document.getElementById("progress-2");
    progress2.classList.toggle("active");
    document.getElementById("progress").style.width = "0%";
    
    
 };

  function paso3next() {

    var title3 = document.getElementById("plan-title-3");
    title3.classList.toggle("invisible");
    var title4 = document.getElementById("plan-title-4");
    title4.classList.toggle("invisible");
    var paso3 = document.getElementById("paso-3");
    paso3.classList.toggle("invisible");
    var paso4 = document.getElementById("paso-4");
    paso4.classList.toggle("invisible");
    var progress4 = document.getElementById("progress-4");
    progress4.classList.toggle("active");
    document.getElementById("progress").style.width = "100%";
    
 };
 function paso3back() {

    var title2 = document.getElementById("plan-title-2");
    title2.classList.toggle("invisible");
    var title3 = document.getElementById("plan-title-3");
    title3.classList.toggle("invisible");
    var paso3 = document.getElementById("paso-3");
    paso3.classList.toggle("invisible");
    var paso2 = document.getElementById("paso-2");
    paso2.classList.toggle("invisible");
    var progress3 = document.getElementById("progress-3");
    progress3.classList.toggle("active");
    document.getElementById("progress").style.width = "30%";
    
 };
 
 function paso4back() {

    var title3 = document.getElementById("plan-title-3");
    title3.classList.toggle("invisible");
    var title4 = document.getElementById("plan-title-4");
    title4.classList.toggle("invisible");
    var paso4 = document.getElementById("paso-4");
    paso4.classList.toggle("invisible");
    var paso3 = document.getElementById("paso-3");
    paso3.classList.toggle("invisible");
    var progress4 = document.getElementById("progress-4");
    progress4.classList.toggle("active");
    document.getElementById("progress").style.width = "60%";
    
 };