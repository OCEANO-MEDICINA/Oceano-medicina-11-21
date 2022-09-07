const $ = jQuery;
let current_step = 0;
let paisSelect = undefined;
let metPagoSelect = undefined;
let medPagoSelect = undefined;
let modPagoSelect = undefined;
let tipoSuscripcionSelect = undefined;

let list_Paises = [
   { input_value: "Argentina", abbr: "arg" },
   { input_value: "Bolivia", abbr: "bol" },
   { input_value: "Chile", abbr: "chi" },
   { input_value: "Colombia", abbr: "col" },
   { input_value: "Costa Rica", abbr: "cos" },
   { input_value: "Ecuador", abbr: "ecu" },
   { input_value: "El Salvador", abbr: "sal" },
   { input_value: "Guatemala", abbr: "gua" },
   { input_value: "Honduras", abbr: "hon" },
   { input_value: "México", abbr: "mex" },
   { input_value: "Nicaragua", abbr: "nic" },
   { input_value: "Panamá", abbr: "pan" },
   { input_value: "Paraguay", abbr: "par" },
   { input_value: "Perú", abbr: "per" },
   { input_value: "Uruguay", abbr: "uru" },
   {
      input_value: "Estados Unidos",
      abbr: "usa",
      img_name: "datafast.jpg",
   },
];
let list_MetPago = [
   { input_value: "Mercado Pago", abbr: "mp", img_name: "mp.svg" },
   { input_value: "Stripe", abbr: "st", img_name: "stripe.svg" },
   { input_value: "PayPal", abbr: "pp", img_name: "paypal.svg" },
   { input_value: "Banorte", abbr: "ba", img_name: "banorte.svg" },
   { input_value: "Datafast", abbr: "df", img_name: "datafast.jpg" },
];
let list_medPago = [
   {
      input_value: "Tarjeta",
      id: "tarjeta",
      text: "Pago con tarjeta",
      step: "medPago_",
   },
   {
      input_value: "Link",
      id: "link",
      text: "Compartir link",
      step: "medPago_",
   },
];
let list_modPago = [
   {
      input_value: "Tradicional",
      id: "tradicional",
      text: "Tradicional",
      step: "modPago_",
   },
   {
      input_value: "Suscripción",
      id: "suscripcion",
      text: "Suscripción",
      step: "modPago_",
   },
];

// Construccion de inputs
$.each(list_Paises, function () {
   let pais_id = "pais_" + this.abbr;
   let pais_label = `#pais_${this.abbr}_label`;
   let pais_img = this.input_value
      .toLowerCase()
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .replace(" ", "-");
   $("<label>", {
      id: `pais_${this.abbr}_label`,
      for: `pais_${this.abbr}`,
      class: "gridCuartos-item button is-outlined animate__animated animate__fadeIn",
   }).appendTo("#pais-grid");

   $("<input>", {
      id: `${pais_id}`,
      class: "paisSelect",
      type: "radio",
      name: "pais",
      value: `${this.input_value}`,
   }).appendTo(pais_label);
   $("<img>", {
      src: `./public/img/country-flags/${pais_img}.svg`,
   }).appendTo(pais_label);
   $("<h4>", {
      text: this.input_value.replace("-", " "),
      class: `paisSelect_title`,
   }).appendTo(pais_label);

   if (this.input_value === "Salvador") {
      //this.input_value.prepend("El ");
      $("#pais_sal_label h4").prepend("El ");
      //console.log(value);
   }
});
$.each(list_MetPago, function () {
   //console.log(index + " " + value);
   let metPago_id = "metPago_" + this.abbr;
   let metPago_label = `#metPago_${this.abbr}_label`;

   $("<label>", {
      id: `metPago_${this.abbr}_label`,
      for: `metPago_${this.abbr}`,
      class: "gridCuartos-item button is-outlined animate__animated animate__fadeIn",
   }).appendTo("#metPago_grid");

   $("<input>", {
      id: `${metPago_id}`,
      class: "metPagoSelect ",
      type: "radio",
      name: "metPago",
      value: `${this.input_value}`,
   }).appendTo(metPago_label);
   $("<img>", {
      src: `./public/img/metPago/${this.img_name}`,
   }).appendTo(metPago_label);
});
$.each(list_medPago, function () {
   //console.log(index + " " + value);
   let medPago_id = this.step + this.id;
   let medPago_label = `${this.step}` + `${this.id}_label`;

   $("<label>", {
      id: medPago_label,
      for: `${this.step}${this.id}`,
      class: "gridCuartos-item button is-outlined animate__animated animate__fadeIn",
   }).appendTo(`#${this.step}grid`);

   $("<input>", {
      id: `${medPago_id}`,
      class: "medModPagoSelect medPagoSelect",
      type: "radio",
      name: "medPago",
      value: `${this.input_value}`,
      text: `${this.text}`,
   }).appendTo(`#${medPago_label}`);
   $("<h4>", {
      text: this.text,
      class: `${this.id}_title`,
   }).appendTo(`#${medPago_label}`);
});
$.each(list_modPago, function () {
   //console.log(index + " " + value);
   let modPago_id = this.step + this.id;
   let modPago_label = `${this.step}` + `${this.id}_label`;

   $("<label>", {
      id: modPago_label,
      for: `${this.step}${this.id}`,
      class: "gridCuartos-item button is-outlined animate__animated animate__fadeIn",
   }).appendTo(`#${this.step}grid`);

   $("<input>", {
      id: `${modPago_id}`,
      class: "medModPagoSelect modPagoSelect",
      type: "radio",
      name: "modPago",
      value: `${this.input_value}`,
      text: `${this.text}`,
   }).appendTo(`#${modPago_label}`);
   $("<h4>", {
      text: this.text,
      class: `${this.id}_title`,
   }).appendTo(`#${modPago_label}`);
});

function delegateSwitch(etapa, valueSelected) {
   //console.group("delegateSwitch() ", etapa, valueSelected);

   switch (etapa) {
      case 'input[name="pais"]':
         metPagoSwitch(etapa, valueSelected);
         break;
      case 'input[name="metPago"]':
         medModPagoSwitch(etapa, valueSelected);
         break;
   }
   console.groupEnd();
}

//Definición de Método de Pago visibles según País seleccionado
function metPagoSwitch(nextStep, value, id) {
   switch (value) {
      case "Argentina":
         id = {
            metPago_mp: "Mercado Pago",
         };
         break;

      case "Bolivia":
         id = {
            metPago_st: "Stripe",
         };
         break;
      case "Chile":
         id = {
            metPago_mp: "Mercado Pago",
            metPago_st: "Stripe",
         };
         break;
      case "Colombia":
         id = {
            metPago_mp: "Mercado Pago",
         };
         break;
      case "Costa Rica":
         id = {
            metPago_st: "Stripe",
         };
         break;
      case "Ecuador":
         id = {
            metPago_st: "Stripe",
         };
         break;
      case "El Salvador":
         id = {
            metPago_st: "Stripe",
         };
         break;
      case "Guatemala":
         id = {
            metPago_st: "Stripe",
         };
         break;
      case "Honduras":
         id = {
            metPago_st: "Stripe",
         };
         break;
      case "México":
         id = {
            metPago_mp: "Mercado Pago",
            metPago_st: "Stripe",
            metPago_pp: "PayPal",
         };
         break;
      case "Nicaragua":
         id = {
            metPago_st: "Stripe",
         };
         break;
      case "Guatemala":
         id = {
            metPago_st: "Stripe",
         };
         break;
      case "Guatemala":
         id = {
            metPago_st: "Stripe",
         };
         break;
   }

   //Envío de info a setNexStep
   setNextStep('input[name="metPago"]', value, id);
}
//Definición de Medio y Modo de Pago visibles según País seleccionado
function medModPagoSwitch(nextStep, value, id) {
   switch (value) {
      case "Mercado Pago":
         id = {
            medPago_tarjeta: "Tarjeta",
            medPago_link: "Link",
            modPago_tradicional: "Tradicional",
            modPago_suscripcion: "Suscrición",
         };
         break;
      case "Stripe":
         id = {
            medPago_tarjeta: "Tarjeta",
            medPago_link: "Link",
         };
         break;
      case "PayPal":
         id = {
            medPago_tarjeta: "Tarjeta",
         };
         break;
   }

   //Envío de info a setNexStep
   setNextStep(".medModPagoSelect", value, id);
}

function setNextStep(nextStepInput, valueSelected, options) {
   // Oculta todos los campos

   $(nextStepInput).each((i, e) => {
      $(e).parent().addClass("invisible");
   });

   //Comparación de info recibida de metPagoSwitch para visualizar campos
   $.each(options, function (i, value) {
      //console.log("index: " + i + "   " + "value: " + value);
      values = [
         "metPago_mp",
         "metPago_st",
         "metPago_pp",
         "metPago_ba",
         "metPago_df",
         "medPago_tarjeta",
         "medPago_link",
         "modPago_tradicional",
         "modPago_suscripcion",
      ];
      $.each(values, function (a, id) {
         if (i === id) {
            $(`#${id}`).parent().removeClass("invisible");
            console.log("nextstep item: " + id);
         }
      });
   });
}

// Oculta la UI
function Hide() {
   // Oculta las etapas
   $(".pasarela-1, .pasarela-2, .pasarela-3, .pasarela-4, .pasarela-5")
      .removeClass("invisible")
      .addClass("invisible");
   //.fadeOut()
   // resetea info input
   $(
      ".infoPasarela-1, .infoPasarela-2, .infoPasarela-3, .infoPasarela-4, .infoPasarela-5"
   ).removeClass("card current completed");
   // oculta controladores
   $("#stepControls").removeClass("invisible").addClass("invisible");

   // .hasClass("class")
}

// TRIGGER ingresar al flow de Asesor Comercial
$(document).on("click", "#ctaAsesorComercial", startGatewayAsesor);

// INICIO FLOW - Asesor Comercial
// 1. Seleccionar País
function startGatewayAsesor() {
   current_step++;
   console.log(current_step + " - Seleccione país");
   ///Muestra el resúmen lateral
   $("#infoView").removeClass("invisible");
   $("#infoView").addClass("animate__animated animate__fadeIn");
   //Oculta la selección de rol
   $("#seleccion_rol").addClass("invisible");
   //Muestra la selección de país y los controles del flow

   RenderStep_UI(current_step);
   allowContinue(false);
}

// Renderiza la UI del PASO ACTUAL
function RenderStep_UI(current_step) {
   let num = current_step;
   $(".infoPasarela-" + num).removeClass("invisible");
   $(".pasarela-" + num).removeClass("invisible");
   $(".pasarela-" + num).addClass("animate__animated animate__fadeIn");

   if (num > 5) {
      $(".pasarela-5").removeClass("invisible");
      $(".overlay-left").removeClass("invisible");
      $("#finalResume").removeClass("invisible");
      $("#finalResume_title").removeClass("invisible");
      $("#buttonGenPayment").removeClass("invisible");
      $("#BackToFlow").removeClass("invisible");
   } else {
      $(".overlay-left").addClass("invisible");
      $("#buttonGenPayment").addClass("invisible");
      $("#BackToFlow").addClass("invisible");
      $("#finalResume_title").addClass("invisible");
      $("#finalResume").addClass("invisible");
   }
   if (
      (current_step === 6 && medPagoSelect === "Link") ||
      (current_step === 6 && metPagoSelect === "PayPal")
   ) {
      $("#buttonGenPayment").text("Generar Link");
   }

   // Info - Paso actual / current step
   for (let a = 0; a < num + 1; a++) {
      $(".infoPasarela-" + a).addClass("card current");
   }
   // Info - Paso Completo correctamente
   for (let a = 0; a < num; a++) {
      $(".infoPasarela-" + a).removeClass("current");
      $(".infoPasarela-" + a).addClass("completed");
   }
   $("#stepControls").removeClass("invisible");
   $("#stepControls").addClass("animate__animated animate__fadeIn");
}

// SELECCIÓN PAÍS
$(document).on("click", ".paisSelect", function (e) {
   //reseteo de input
   $("input[name='pais']").each((i, e) => {
      $(e).attr("checked", false).parent().removeClass("is-link is-light");
   });
   //Definición de selección
   paisSelect = $('input[name="pais"]:checked').val();
   //Agrega checked y asigna valor
   $(e.target)
      .attr({
         checked: true,
         disabled: false,
         value: paisSelect,
      })
      .parent()
      .addClass("is-link is-light");
   //Imprime la selección en el resúmen

   $("#paisSeleccionado").text($(this).val());
   console.log("País seleccionado: " + paisSelect);
   allowContinue();
   delegateSwitch('input[name="pais"]', paisSelect);
});
// SELECCIÓN MÉTODO DE PAGO
$(document).on("click", ".metPagoSelect ", function (e) {
   $("input[name='metPago']").each((i, e) => {
      $(e).attr("checked", false).parent().removeClass("is-link is-light");
   });
   metPagoSelect = $('input[name="metPago"]:checked').val();
   $(e.target)
      .attr({
         checked: true,
         disabled: false,
         value: metPagoSelect,
      })
      .parent()
      .addClass("is-link is-light");
   $("#metPagoSeleccionado").text(metPagoSelect);

   console.log("Método de pago seleccionado: " + metPagoSelect);
   allowContinue();
   delegateSwitch('input[name="metPago"]', metPagoSelect);
});
// SELECCIÓN MEDIO DE PAGO
$(document).on("click", ".medPagoSelect", function (e) {
   $("input[name='medPago']").each((i, e) => {
      $(e).attr("checked", false).parent().removeClass("is-link is-light");
   });
   medPagoSelect = $('input[name="medPago"]:checked').val();
   $(e.target)
      .attr({
         checked: true,
         disabled: false,
         value: medPagoSelect,
      })
      .parent()
      .addClass("is-link is-light");
   console.log("Medio de pago seleccionado: " + medPagoSelect);
   allowContinue();
   if (
      (current_step === 3 &&
         metPagoSelect == "Stripe" &&
         medPagoSelect == "Link") ||
      (current_step === 3 &&
         metPagoSelect == "PayPal" &&
         medPagoSelect == "Tarjeta")
   ) {
      $(".infoPasarela-5").addClass("invisible");
      console.log("hola");
   }
   $("#medPagoSeleccionado").text($(this).val());
});
// SELECCIÓN MODO DE PAGO
$(document).on("click", ".modPagoSelect", function (e) {
   $("input[name='modPago']").each((i, e) => {
      $(e).attr("checked", false).parent().removeClass("is-link is-light");
   });
   modPagoSelect = $('input[name="modPago"]:checked').val();
   $(e.target)
      .attr({
         checked: true,
         disabled: false,
         value: modPagoSelect,
      })
      .parent()
      .addClass("is-link is-light");
   console.log("Modo de pago seleccionado: " + modPagoSelect);
   allowContinue();

   $("#modPagoSeleccionado").text(" - " + $(this).val());
});
// SELECCIÓN TIPO DE SUSCRIPCIÓN
$(document).on("click", ".dataPerson_tipoSuscricion", function (e) {
   $("input[name='tipoSuscripcion']").each((i, e) => {
      $(e).attr("checked", false).parent().removeClass("is-link is-light");
   });
   tipoSuscripcionSelect = $('input[name="tipoSuscripcion"]:checked').val();

   console.log("Tipo de suscripción seleccionada: " + tipoSuscripcionSelect);
   $(e.target)
      .attr({
         checked: true,
         disabled: false,
         value: tipoSuscripcionSelect,
      })
      .parent()
      .addClass("is-link is-light");

   if ($("#tipoSuscripcion_modificar").attr("checked") === "checked") {
      $("#form_datosPersonales .field").addClass("invisible");
      $("#numeroContrato").removeClass("invisible");
   }
   if (
      $("#tipoSuscripcion_agregar").attr("checked") === "checked" ||
      $("#tipoSuscripcion_simple").attr("checked") === "checked"
   ) {
      $("#form_datosPersonales .field").addClass("invisible");
      $("#numeroContrato").removeClass("invisible");
      $("#emailCliente").removeClass("invisible");
      $("#montoPagarMes").removeClass("invisible");
      $("#montoTotal_contrato").removeClass("invisible");
      $("#mesesTotales").removeClass("invisible");
   }
   if (current_step === 4 && medPagoSelect == "Link") {
      $("#compartirLinkPor").removeClass("invisible");
   }

   $("#tipoSuscripcion").removeClass("invisible");
});
// SELECCIÓN TIPO DE TARJETA
$(document).on("click", ".tipoTarjeta", function (e) {
   $("input[name='tipoTarjeta']").each((i, e) => {
      $(e).attr("checked", false);
   });
   //Definición de selección
   tipoTarjetaSelect = $('input[name="tipoTarjeta"]:checked').val();
   //Agrega checked y asigna valor
   $(e.target)
      .attr({
         checked: true,
         disabled: false,
         value: tipoTarjetaSelect,
      })
      .parent()
      .addClass("is-link is-light");
   console.log("Tipo de tarjeta seleccionada: " + tipoTarjetaSelect);
   //Imprime la selección en el resúmen

   if (
      current_step === 5 &&
      $("#tipoTarjeta_credito").attr("checked") === "checked"
   ) {
      $("#cuotas").removeClass("invisible");
   } else {
      $("#cuotas").addClass("invisible");
   }
});
// SELECCIÓN COMPARTIR LINK POR
$(document).on("click", ".compartirLinkPor-item", function (e) {
   $("input[name='compartirLinkPor']").each((i, e) => {
      $(e).attr("checked", false).parent().removeClass("is-active");
   });

   $(e.target)
      .attr({
         checked: true,
         disabled: false,
      })
      .parent()
      .addClass("is-active");

   if ($("#compartirLinkPor_wpp").attr("checked") === "checked") {
      $("#inputCompartirLinkPorEmail").addClass("invisible");
   }
   if ($("#compartirLinkPor_email").attr("checked") === "checked") {
      $("#inputCompartirLinkPorEmail").removeClass("invisible");
   }
});

// GENERAR PAGO
$(document).on("click", "#buttonGenPayment", function (e) {
   $("#buttonGenPayment").addClass("is-loading");
   genPayment = true;
   RenderFinal();

   console.log("generar pago");
});

// PAGO GENERADO
function RenderFinal() {
   if (current_step === 6 && genPayment === true) {
      setTimeout(function () {
         $("#finalResume_title").addClass("invisible");
         $("#finalResume").addClass("invisible");
         $("#buttonGenPayment").removeClass("is-primary is-loading");
         $("#buttonGenPayment").addClass("is-success");
         $("#buttonGenPayment").text("¡Pago generado!");
         $("#BackToFlow").addClass("invisible");
      }, 2000);
      setTimeout(function () {
         $("#buttonGenPayment").addClass("invisible");
         $(".infoPasarela").addClass("invisible");
         $("#infoView-decision").removeClass("invisible");
      }, 4000);
   }
   if (
      (current_step === 6 && genPayment === true && medPagoSelect === "Link") ||
      (current_step === 6 && genPayment === true && metPagoSelect === "PayPal")
   ) {
      setTimeout(function () {
         $("#finalResume_title").addClass("invisible");
         $("#finalResume").addClass("invisible");
         $("#buttonGenPayment").removeClass("is-primary is-loading");
         $("#buttonGenPayment").addClass("is-success");
         $("#buttonGenPayment").text("¡Link de pago generado!");
         $("#fieldLinkPago").removeClass("invisible");
         $("#BackToFlow").addClass("invisible");
      }, 2000);
      setTimeout(function () {
         $("#buttonGenPayment").addClass("invisible");
         $(".infoPasarela").addClass("invisible");
         $("#infoView-decision").removeClass("invisible");
         $("#fieldLinkPago").addClass("invisible");
      }, 4000);
   }
}
// VOLVER AL FLOW DESDE EL RESUMEN
$(document).on("click", "#BackToFlow", function (e) {
   previousStep();
});

// EDITAR PASO TRIGGER
$(".editStep").click(function () {
   // en caso de quere editar un paso en pantalla de resumen
   // oculto su UI
   if (current_step === 6) {
      $(".overlay-left").addClass("invisible");
      $("#buttonGenPayment").addClass("invisible");
      $("#BackToFlow").addClass("invisible");
      $("#finalResume_title").addClass("invisible");
      $("#finalResume").addClass("invisible");
      $(".pasarela-5").addClass("invisible");
   }
   // oculto el paso actual
   $(".pasarela-" + current_step).addClass("invisible");
   // obtengo el numero del paso que quiero editar
   let id = $(this).attr("id").slice(-1);
   id_pars = parseInt(id);
   // le asigno al currentstep el numero del paso a editar seleccionado
   current_step = id_pars;
   console.log(current_step);
   // muestro el paso a editar
   $(".pasarela-" + current_step).removeClass("invisible");
   $(".pasarela-" + current_step).addClass("animate__animated animate__fadeIn");
   allowContinue();
   RenderSteps();
   /* 
        if (id_pars != 1) {
            $("#stepControls").addClass("invisible");
            $("#edit_stepControls").removeClass("invisible");
        }
        // Si se queire editar el paso 1
        // Resetea la UI
        if (id_pars === 1) {
            console.log("Editar paso 1");

            RenderSteps();
        }
        if (id_pars === 3 || id_pars === 4) {
            RenderSteps();
            $("#stepControls").removeClass("invisible");
            $("#edit_stepControls").addClass("invisible");
        } */
});
// VOLVER A LA ELECCION DE PAISES DESPUES DE GENERAR UN PAGO
$("#backTo_Country").click(function () {
   $(".overlay-left").addClass("invisible");
   $(".pasarela-5").addClass("invisible");
   $("#buttonGenPayment").addClass("invisible");
   $("#BackToFlow").addClass("invisible");
   $("#infoView-decision").addClass("invisible");
   $(".infoPasarela").removeClass("invisible");
   $(".pasarela-1").addClass("invisible");
   current_step = 1;
   allowContinue();
   RenderSteps();
});
// GENERAR NUEVO PAGO EN EL MISMO PAIS
$("#generate_newPayment").click(function () {
   $(".overlay-left").addClass("invisible");
   $(".pasarela-5").addClass("invisible");
   $("#buttonGenPayment").addClass("invisible");
   $("#BackToFlow").addClass("invisible");
   $("#infoView-decision").addClass("invisible");
   $(".infoPasarela").removeClass("invisible");
   $(".pasarela-1").addClass("invisible");
   current_step = 2;
   allowContinue();
   RenderSteps();
});
// AVANZAR Y RETROCEDER EDITAR - BETA
/* 
    $(document).on("click", "#edit_stepControls_prev", previousStep);
    $(document).on("click", "#edit_stepControls_next", finishEdit);

    function finishEdit() {
        $(".pasarela-" + current_step).addClass("invisible");
        ++current_step;
        console.log(current_step);
        $(".pasarela-" + current_step).removeClass("invisible");
        $(".pasarela-" + current_step).addClass(
            "animate__animated animate__fadeIn"
        );
        $("#stepControls").removeClass("invisible");
        $("#edit_stepControls").addClass("invisible");
        let mensajeError = "";
        console.log("EDICIÓN TERMINADA -->");
        if (current_step === id_pars) {
          
            console.log(current_step);
           
            $("#stepControls").removeClass("invisible");
            $("#edit_stepControls").addClass("invisible");
        }

    } */

// TRIGGER de avanzar y retroceder en los pasos
$(document).on("click", "#stepControls_prev", previousStep);
$(document).on("click", "#stepControls_next", nextStep);

//NAVEGACIÓN DE LA PASARELA
function nextStep() {
   let mensajeError = "";
   console.log("NEXT -->");

   if (current_step < 6 && conditionMet === true) {
      current_step++;
      RenderSteps();
   }
   if (
      (current_step === 5 &&
         metPagoSelect === "Stripe" &&
         medPagoSelect === "Link") ||
      (current_step === 5 &&
         metPagoSelect === "PayPal" &&
         medPagoSelect === "Tarjeta")
   ) {
      $(".infoPasarela-5").addClass("invisible");
      $(".pasarela-5").addClass("invisible");

      current_step = 6;
      RenderSteps();
   }
}

function previousStep() {
   console.log("<-- BACK", { current_step });
   if (current_step === 3) {
      $("input[name='medPago']").each((i, e) => {
         $(e).attr("checked", false).parent().removeClass("is-link is-light");
      });
      $("input[name='modPago']").each((i, e) => {
         $(e).attr("checked", false).parent().removeClass("is-link is-light");
      });
      $("#medModPagoSeleccionado").text("Sin Seleccionar");
      console.log("limpia paso 3");
   }
   if (current_step > 1) {
      --current_step;
      RenderSteps();
   }

   if (current_step > 0 && current_step < 4 && conditionMet != true) {
      $("input").each((i, e) => {
         $(e).attr("checked", false).parent().removeClass("is-link is-light");
      });
      $(".current .infoView-item-info .title").text("Sin Seleccionar");
      console.log("Atrás y formatea");
   }
   if (
      current_step === 5 &&
      metPagoSelect === "Stripe" &&
      medPagoSelect === "Link"
   ) {
      $(".infoPasarela-5").addClass("invisible");
      current_step = 4;
      RenderSteps();
   }
}
function allowContinue() {
   conditionMet = false;

   let condicion1 = $(
      '.gridCuartos-item:not(".invisible") input[name="pais"]:checked'
   ).length;
   let condicion2 = $(
      '.gridCuartos-item:not(".invisible") input[name="metPago"]:checked'
   ).length;
   let condicion3 = $(
      '.gridCuartos-item:not(".invisible") input[name="medPago"]:checked'
   ).length;
   let condicion4 = $(
      '.gridCuartos-item:not(".invisible") input[name="modPago"]:checked'
   ).length;

   console.log({ condicion1, condicion2, condicion3, condicion4 });

   let condicion5 = true;

   if (current_step === 1 && condicion1 === 1) {
      conditionMet = true;
      console.log("cumple con 1er codición");
   }
   if (current_step === 2 && condicion2 === 1) {
      conditionMet = true;
      console.log("cumple con 2da condición");
   }
   let a = $(
      '.gridCuartos-item:not(".invisible") input[name="modPago"]'
   ).length;
   if (
      (metPagoSelect === "Mercado Pago" &&
         current_step === 3 &&
         condicion3 === 1 &&
         condicion4 === 1) ||
      (metPagoSelect === "Stripe" && current_step === 3 && condicion3 === 1) ||
      (metPagoSelect === "PayPal" && current_step === 3 && condicion3 === 1)
   ) {
      conditionMet = true;
      console.log("cumple con 3er y 4ta condición");
   }

   if (current_step === 4 && condicion5 === true) {
      conditionMet = true;
      console.log("cumple con 5ta codición");
   }
   if (current_step === 5 && condicion5 === true) {
      conditionMet = true;
      console.log("cumple con 6ta codición");
   }

   let cantOpciones = $(
      '#metPago_grid .gridCuartos-item:not(".invisible")'
   ).length;

   let opcionUnicaDefault = $(
      '#metPago_grid .gridCuartos-item:not(".invisible") .metPagoSelect '
   ).val();

   if (current_step === 2 && cantOpciones === 1) {
      $("#metPagoSeleccionado").text(opcionUnicaDefault);
      $('input[name="metPago"]:not(".invisible")')
         .attr("checked", true)
         .parent()
         .addClass("is-link is-light");
      conditionMet = true;
      console.log("marca la opcion unica");
   }
   if (current_step === 2 && cantOpciones > 1 && conditionMet === false) {
      $("#metPagoSeleccionado").text("Sin seleccionar");
      $('input[name="metPago"]:not(".invisible")')
         .attr("checked", false)
         .parent()
         .removeClass("is-link is-light");
      conditionMet = false;
      console.log("desmarca las opciones");
   }

   if (conditionMet === false) {
      $("#stepControls_next").prop("disabled", true);
   } else {
      $("#stepControls_next").prop("disabled", false);
   }
   //console.log("condición = " + conditionMet);
   //console.log(condicion1);
}

function RenderSteps() {
   Hide();
   allowContinue();

   RenderStep_UI(current_step);
   console.log("Paso " + current_step + " Renderizado");

   //Control volver atrás
   if (current_step > 1) {
      $("#stepControls_prev").prop("disabled", false);
   }

   if (current_step < 2) {
      $("#stepControls_prev").prop("disabled", true);
   }

   if (current_step >= 3) {
      $("#pasarela-body").removeClass("invisible");
   } else {
      $("#pasarela-body").addClass("invisible");
   }
   if (current_step === 4 || current_step === 5) {
      $(".form-item").each((i, e) => {
         $(e).addClass("invisible");
      });
   }
   if (
      current_step === 4 &&
      metPagoSelect == "Stripe" &&
      medPagoSelect == "Tarjeta"
   ) {
      $("#numeroContrato").removeClass("invisible");
      $("#emailCliente").removeClass("invisible");
      $("#montoPagarMes").removeClass("invisible");
   }
   if (
      current_step === 4 &&
      metPagoSelect == "PayPal" &&
      medPagoSelect == "Tarjeta"
   ) {
      $("#numeroContrato").removeClass("invisible");
      $("#mesesTotales").removeClass("invisible");
      $("#montoPagarMes").removeClass("invisible");
      $("#compartirLinkPor").removeClass("invisible");
   }
   if (
      current_step === 4 &&
      metPagoSelect == "Stripe" &&
      medPagoSelect == "Link"
   ) {
      $("#numeroContrato").removeClass("invisible");
      $("#porcentajeDescuento").removeClass("invisible");
   }

   if (
      current_step === 4 &&
      medPagoSelect == "Tarjeta" &&
      modPagoSelect == "Tradicional"
   ) {
      $("#numeroContrato").removeClass("invisible");
      $("#emailCliente").removeClass("invisible");
      $("#montoPagarMes").removeClass("invisible");

      console.log(
         "medio y modo seleccionados " + medPagoSelect + " " + modPagoSelect
      );
   }

   if (
      (current_step === 4 &&
         medPagoSelect == "Tarjeta" &&
         modPagoSelect == "Suscripción" &&
         $("#tipoSuscripcion_agregar").attr("checked") === "checked") ||
      (current_step === 4 &&
         medPagoSelect == "Tarjeta" &&
         modPagoSelect == "Suscripción" &&
         $("#tipoSuscripcion_simple").attr("checked") === "checked")
   ) {
      $("#numeroContrato").removeClass("invisible");
      $("#emailCliente").removeClass("invisible");
      $("#montoPagarMes").removeClass("invisible");
      $("#montoTotal_contrato").removeClass("invisible");
      $("#mesesTotales").removeClass("invisible");

      console.log(
         "medio y modo seleccionados " + medPagoSelect + " " + modPagoSelect
      );
   }
   if (
      current_step === 4 &&
      medPagoSelect == "Tarjeta" &&
      modPagoSelect == "Suscripción" &&
      $("#tipoSuscripcion_modificar").attr("checked") === "checked"
   ) {
      $("#form_datosPersonales .field").addClass("invisible");
      $("#numeroContrato").removeClass("invisible");

      console.log(
         "medio y modo seleccionados " + medPagoSelect + " " + modPagoSelect
      );
   }
   if (current_step === 4 && modPagoSelect == "Suscripción") {
      $("#tipoSuscripcion").removeClass("invisible");
   }
   if (current_step === 4 && medPagoSelect == "Link") {
      $("#compartirLinkPor").removeClass("invisible");
   }
   if ($("#compartirLinkPor_email").attr("checked", true)) {
      $("#inputCompartirLinkPorEmail").removeClass("invisible");
   } else {
      $("#inputCompartirLinkPorEmail").addClass("invisible");
   }

   if (
      current_step === 4 &&
      medPagoSelect == "Link" &&
      modPagoSelect == "Tradicional"
   ) {
      $("#numeroContrato").removeClass("invisible");
      $("#montoTotal_contrato").removeClass("invisible");
      $("#mesesTotales").removeClass("invisible");

      console.log(
         "medio y modo seleccionados " + medPagoSelect + " " + modPagoSelect
      );
   }
   if (
      current_step === 4 &&
      medPagoSelect == "Link" &&
      modPagoSelect == "Suscripción"
   ) {
      $("#tipoSuscripcion").removeClass("invisible");
      $("#numeroContrato").removeClass("invisible");
      $("#montoTotal_contrato").removeClass("invisible");

      console.log(
         "medio y modo seleccionados " + medPagoSelect + " " + modPagoSelect
      );
   }
   if (current_step === 5) {
      $("#tipoTarjerta").removeClass("invisible");
      $("#tipoTarjeta_credito").attr("checked", true);
      $("#cuotas").removeClass("invisible");
      $("#numeroTarjeta").removeClass("invisible");
      $("#fechaVencimiento").removeClass("invisible");
      $("#cvv").removeClass("invisible");
      $("#nombreTitular").removeClass("invisible");
      $("#documento").removeClass("invisible");
      $("#cuilCuit").removeClass("invisible");
      $("#razonSocial").removeClass("invisible");
      $("#direccionTitular").removeClass("invisible");
   }
   if (current_step === 5 && tipoSuscripcionSelect === "Simple") {
      $("#tipoTarjerta").addClass("invisible");
      $(".tipoTarjeta").attr("checked", false);
      $("#cuotas").addClass("invisible");
      $("#numeroTarjeta").addClass("invisible");
      $("#fechaVencimiento").addClass("invisible");
      $("#cvv").addClass("invisible");
      $("#nombreTitular").addClass("invisible");
      $("#direccionTitular").removeClass("invisible");
      console.log(tipoSuscripcionSelect);
   }
   if (
      current_step === 5 &&
      metPagoSelect === "Stripe" &&
      medPagoSelect === "Tarjeta"
   ) {
      $("#tipoTarjerta").addClass("invisible");
      $("#documento").addClass("invisible");
      $("#cuilCuit").addClass("invisible");
      $("#razonSocial").addClass("invisible");
      $("#direccionTitular").addClass("invisible");

      console.log(tipoSuscripcionSelect);
   }
   if (current_step === 6) {
      // Graba los datos en la hoja de resumen
      // Datos de cliente
      $("#emailCliente_resume h4").text($("#emailCliente_value").val());

      //$("#todayDate_resume h4").text($(todayDate).val());
      $("#numeroContrato_resume h4").text($("#numeroContrato_value").val());
      $("#montoTotalContrato_resume h4").text(
         $("#montoTotalContrato_value").val()
      );
      $("#mesesTotales_resume h4").text($("#mesesTotales_value").val());
      $("#montoTotalMes_resume h4").text($("#montoTotalMes_value").val());

      // Datos de tarjeta
      $("#tipoTarjeta_resume h4").text($(".tipoTarjeta").val());
      $("#numeroTarjeta_resume h4").text($("#numeroTarjeta_value").val());
      $("#fechaVencimiento_resume h4").text(
         $(fechaVencimiento_mes).val() + "/" + $(fechaVencimiento_ano).val()
      );
      $("#cvv_resume h4").text($(cvv_value).val());
      $("#cuotas_resume h4").text($(cuotas_value).val());
      $("#nombreTitular_resume h4").text($(nombreTitular_value).val());
      $("#tipoNumDocumento_resume h4").text(
         $("#tipoDocumento_value").val() + "" + $(numDocumento).val()
      );
      $("#cuilCuit_resume h4").text($(cuilCuit_value).val());
      $("#razonSocial_resume h4").text($(razonSocial_value).val());
      $("#direccionTitular_resume h4").text($(direccionTitular_value).val());
   }
   if (
      (current_step === 6 &&
         metPagoSelect === "Stripe" &&
         medPagoSelect === "Link") ||
      (current_step === 6 &&
         metPagoSelect === "PayPal" &&
         medPagoSelect === "Tarjeta")
   ) {
      $(".infoPasarela-5").addClass("invisible");
      $(".pasarela-5").addClass("invisible");
   }
}

/* const date = new Date();
const [day, month, year] = [
    String(date.getDate()).padStart(2, "0"),
    String(date.getMonth() + 1).padStart(2, "0"),
    date.getFullYear(),
];
const todayDate = `${day} + "/" + ${month} + "/" + ${year}`; */
