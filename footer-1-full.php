</body>


<!-- MODAL SUCCESS -->

<div id="modal-success" class="modal modal-success success-subnewsletter">
    <div class="modal-background"></div>
    <div class="modal-card">
        <div class="modal-card-body">
            <img src="<?= get_template_directory_uri()?>/assets/media/icon/success.svg" alt="">
            <div class="info">
                <p class="info-title">Suscripción exitosa</p>
                <p class="info-msj">
                    ¡Muchas gracias por suscribirte
                    <br>
                    a nuestro newsletter!</p>
            </div>
            <button class="btn btn-big button close_success_modal">VOLVER AL SITIO</button>
        </div>
    </div>
</div>

<!-- MODAL NEWSLETTER -->
<div id="modal-newsletter"
    class="modal contact__form__data"
    data-downloadable="<?= get_field('topics_file', $father_post_id); ?>" 
    data-post-title="<?=get_the_title($father_post_id)?>"
    data-pais="<?= ICL_LANGUAGE_CODE ?>">

        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <div class="modal-card-head-info">
                    <h3 class="modal-card-title"> <?= ICL_LANGUAGE_CODE == 'arg' ? 'Suscribite' : 'Suscríbete'?>  a <span class="salto-de-linea">nuestro
                            newsletter</span>
                    </h3>
                    <p class="modal-card-subtitle"> <?= ICL_LANGUAGE_CODE == 'arg' ? 'Compartinos' : 'Compártenos'?>   tus datos para que te enviemos <br> contenidos
                        orientados a tu profesión y tus áreas de interés.
                    </p>
                </div>
                <button class="delete" aria-label="close"></button>
            </header>
            <?php echo do_shortcode( '[contact-form-7 id="123864" ]')?>

        </div>
    </div>


<footer id="footer" class="footer" <?php if (is_product()) {echo 'style="margin-top:6rem"';} ?>>
    <article class="footer-cont contenedor mx-auto">
        <div class="footer-cont-first">
            <div class="footer-info">
        
                <img src="<?= get_template_directory_uri().'/assets/media/logo-footer.png'; ?>" alt="Logo De Oceano medicina" class="footer-info-logo">
                <address class="footer-info-contact">
                    <a href="tel:<?= the_field('telefono', 'option'); ?>"><i class="mdi mdi-phone" target="_blank"></i><?= the_field('telefono', 'option'); ?></a>
                    <a href="mailto:<?= the_field('email', 'option'); ?>"><i class="mdi mdi-email-outline" target="_blank"></i><?= the_field('email', 'option'); ?>
                    </a>
                    <a href="http://maps.google.com/?q=<?= the_field('direccion', 'option'); ?>" target="_blank"><i class="mdi mdi-map-marker"></i><?= the_field('direccion', 'option'); ?>
                    </a>
                </address>
            </div>
            <div class="footer-menu">
            <?php
                wp_nav_menu( array( 
                    'theme_location' => 'footer-columna-1', 
                    'menu_class' => '',
                    'menu_id' => '',
                    'container' => 'ul',
                ));
                wp_nav_menu( array( 
                    'theme_location' => 'footer-columna-2', 
                    'menu_class' => '',
                    'menu_id' => '',
                    'container' => 'ul',
                )); ?>

            </div>
        </div>

        


        <div class="footer-cont-second">
            <div class="footer-newsletter">
                <h5>SUSCRÍBITE A NUESTRO NEWSLETTER</h5>
                <p>Información, novedades y ofertas, directamente en tu mail.</p>

                <div class="mail-form">
                    <div class="mail_input_container">
                        <div role="form" class="wpcf7" id="wpcf7-f4958-o1" lang="es-AR" dir="ltr">
                            <div class="screen-reader-response">
                                <p role="status" aria-live="polite" aria-atomic="true"></p>
                                <ul></ul>
                            </div>
                            <form class="wpcf7-form init">
                                <p>
                                    <span class="wpcf7-form-control-wrap email-367">
                                        <input type="email" name="email-367" value="" size="40"
                                            class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email newsletter form-control"
                                            aria-required="true" aria-invalid="false"
                                            placeholder="Ingresá tu dirección de email">
                                    </span>
                                    <br>
                                    <button class="js-modal-trigger" data-target="modal-newsletter">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </button>
                                </p>
                                <div class="wpcf7-response-output" aria-hidden="true"></div>
                            </form>
                        </div>
                    </div>
                    <br>

                </div>

            </div>
            <div class="footer-redes">
                <a target="_blank" href="<?= the_field('facebook', 'option'); ?>" class="footer-redes-lik">
             
                    <!-- Generator: Adobe Illustrator 25.4.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 37 37"
                        style="enable-background:new 0 0 37 37;" xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                fill: #FFFFFF;
                            }
                        </style>
                        <path class="st0"
                            d="M37,18.5C37,8.3,28.7,0,18.5,0C8.3,0,0,8.3,0,18.5C0,28.7,8.3,37,18.5,37c0.1,0,0.2,0,0.3,0V22.6h-4V18h4v-3.4
	c0-4,2.4-6.1,5.9-6.1c1.7,0,3.1,0.1,3.6,0.2v4.1h-2.4c-1.9,0-2.3,0.9-2.3,2.2V18h4.6l-0.6,4.6h-4v13.7C31.3,34.1,37,26.9,37,18.5z" />
                    </svg>
                </a>
                <a target="_blank" href="<?= the_field('twitter', 'option'); ?>" class="footer-redes-lik">
                   
                    <!-- Generator: Adobe Illustrator 25.4.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 37 37"
                        style="enable-background:new 0 0 37 37;" xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                fill: #FFFFFF;
                            }
                        </style>
                        <path class="st0"
                            d="M18.5,0C8.3,0,0,8.3,0,18.5S8.3,37,18.5,37S37,28.7,37,18.5S28.7,0,18.5,0z M26.9,14.4c0,0.2,0,0.4,0,0.5
	c0,5.6-4.3,12.1-12.1,12.1c-2.4,0-4.6-0.7-6.5-1.9c0.3,0,0.7,0.1,1,0.1c2,0,3.8-0.7,5.3-1.8c-1.9,0-3.4-1.3-4-2.9
	c0.3,0,0.5,0.1,0.8,0.1c0.4,0,0.8-0.1,1.1-0.1c-1.9-0.4-3.4-2.1-3.4-4.2c0,0,0,0,0-0.1c0.6,0.3,1.2,0.5,1.9,0.5
	c-1.1-0.8-1.9-2.1-1.9-3.5c0-0.8,0.2-1.5,0.6-2.1c2.1,2.6,5.2,4.3,8.8,4.4c-0.1-0.3-0.1-0.6-0.1-1c0-2.3,1.9-4.2,4.2-4.2
	c1.2,0,2.3,0.5,3.1,1.3c1-0.2,1.9-0.5,2.7-1c-0.3,1-1,1.8-1.9,2.3c0.9-0.1,1.7-0.3,2.4-0.7C28.5,13.1,27.8,13.8,26.9,14.4z" />
                    </svg>

                </a>
                <a target="_blank" href="<?= the_field('youtube', 'option'); ?>" class="footer-redes-lik">
                  
                    <!-- Generator: Adobe Illustrator 25.4.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 37 37"
                        style="enable-background:new 0 0 37 37;" xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                fill: #FFFFFF;
                            }
                        </style>
                        <g>
                            <path class="st0" d="M16.2,21.7l6-3.4l-6-3.4V21.7z" />
                            <path class="st0" d="M18.5,0C8.3,0,0.1,8.2,0.1,18.3s8.2,18.3,18.4,18.3c10.2,0,18.4-8.2,18.4-18.3S28.7,0,18.5,0z M30,18.3
		c0,0,0,3.7-0.5,5.5c-0.3,1-1,1.8-2,2c-1.8,0.5-9,0.5-9,0.5s-7.2,0-9-0.5c-1-0.3-1.8-1-2-2C7,22,7,18.3,7,18.3s0-3.7,0.5-5.5
		c0.3-1,1.1-1.8,2-2c1.8-0.5,9-0.5,9-0.5s7.2,0,9,0.5c1,0.3,1.8,1,2,2C30,14.6,30,18.3,30,18.3z" />
                        </g>
                    </svg>
                </a>
                <a target="_blank" href="<?= the_field('instragram', 'option'); ?>" class="footer-redes-lik">
                
                    <!-- Generator: Adobe Illustrator 25.4.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 37 37"
                        style="enable-background:new 0 0 37 37;" xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                fill: #FFFFFF;
                            }
                        </style>
                        <g>
                            <path class="st0"
                                d="M22,18.3c0,1.9-1.6,3.5-3.5,3.5S15,20.2,15,18.3c0-1.9,1.6-3.5,3.5-3.5S22,16.4,22,18.3z" />
                            <path class="st0" d="M26.8,12.1c-0.2-0.5-0.4-0.9-0.8-1.2c-0.3-0.3-0.8-0.6-1.2-0.8c-0.4-0.1-0.9-0.3-2-0.4
		c-1.1-0.1-1.4-0.1-4.3-0.1c-2.8,0-3.2,0-4.3,0.1c-1,0-1.6,0.2-2,0.4c-0.5,0.2-0.9,0.4-1.2,0.8c-0.4,0.3-0.6,0.8-0.8,1.2
		c-0.1,0.4-0.3,0.9-0.4,2c-0.1,1.1-0.1,1.4-0.1,4.2c0,2.8,0,3.1,0.1,4.2c0,1,0.2,1.6,0.4,2c0.2,0.5,0.4,0.9,0.8,1.2
		c0.3,0.3,0.8,0.6,1.2,0.8c0.4,0.1,0.9,0.3,2,0.4c1.1,0.1,1.4,0.1,4.3,0.1c2.8,0,3.2,0,4.3-0.1c1,0,1.6-0.2,2-0.4
		c0.9-0.4,1.7-1.1,2-2c0.1-0.4,0.3-0.9,0.4-2c0.1-1.1,0.1-1.4,0.1-4.2c0-2.8,0-3.1-0.1-4.2C27.1,13,26.9,12.5,26.8,12.1z M18.5,23.7
		c-3,0-5.4-2.4-5.4-5.4c0-3,2.4-5.4,5.4-5.4c3,0,5.4,2.4,5.4,5.4C23.9,21.3,21.5,23.7,18.5,23.7z M24.2,13.9c-0.7,0-1.3-0.6-1.3-1.3
		c0-0.7,0.6-1.3,1.3-1.3c0.7,0,1.3,0.6,1.3,1.3C25.4,13.4,24.9,13.9,24.2,13.9z" />
                            <path class="st0" d="M18.5,0C8.3,0,0.1,8.2,0.1,18.3s8.2,18.3,18.4,18.3c10.2,0,18.4-8.2,18.4-18.3S28.7,0,18.5,0z M29,22.6
		c-0.1,1.1-0.2,1.9-0.5,2.6c-0.5,1.4-1.7,2.5-3.1,3.1c-0.7,0.3-1.4,0.4-2.6,0.5c-1.1,0.1-1.5,0.1-4.4,0.1c-2.9,0-3.2,0-4.4-0.1
		c-1.1-0.1-1.9-0.2-2.6-0.5c-0.7-0.3-1.3-0.7-1.9-1.2c-0.5-0.5-1-1.2-1.2-1.9c-0.3-0.7-0.4-1.4-0.5-2.5c-0.1-1.1-0.1-1.5-0.1-4.3
		S8,15.1,8,14c0.1-1.1,0.2-1.9,0.5-2.6c0.3-0.7,0.7-1.3,1.2-1.9c0.5-0.5,1.2-0.9,1.9-1.2c0.7-0.3,1.4-0.4,2.6-0.5
		c1.1-0.1,1.5-0.1,4.4-0.1c2.9,0,3.2,0,4.4,0.1c1.1,0.1,1.9,0.2,2.6,0.5c0.7,0.3,1.3,0.7,1.9,1.2c0.5,0.5,1,1.2,1.2,1.9
		c0.3,0.7,0.4,1.4,0.5,2.6c0.1,1.1,0.1,1.5,0.1,4.3S29.1,21.5,29,22.6z" />
                        </g>
                    </svg>
                </a>
                <a target="_blank" href="<?= the_field('linkedin', 'option'); ?>" class="footer-redes-lik">
                    
                    <!-- Generator: Adobe Illustrator 25.4.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 37 37"
                        style="enable-background:new 0 0 37 37;" xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                fill: #FFFFFF;
                            }
                        </style>
                        <path class="st0" d="M18.5,0C8.3,0,0,8.3,0,18.5S8.3,37,18.5,37S37,28.7,37,18.5S28.7,0,18.5,0z M13.1,28H8.6V14.4h4.5V28z
	 M10.9,12.6L10.9,12.6c-1.5,0-2.5-1-2.5-2.3c0-1.3,1-2.3,2.5-2.3c1.5,0,2.5,1,2.5,2.3C13.4,11.5,12.4,12.6,10.9,12.6z M29.4,28h-4.5
	v-7.3c0-1.8-0.7-3.1-2.3-3.1c-1.2,0-2,0.8-2.3,1.6c-0.1,0.3-0.1,0.7-0.1,1.1V28h-4.5c0,0,0.1-12.3,0-13.6h4.5v1.9
	c0.6-0.9,1.7-2.2,4.1-2.2c3,0,5.2,1.9,5.2,6.1V28z" />
                    </svg>
                </a>
                <a target="_blank" href="<?= the_field('whatsapp', 'option'); ?>" class="footer-redes-lik paste-whatsapp-link">
                   
                    <!-- Generator: Adobe Illustrator 25.4.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 37 37"
                        style="enable-background:new 0 0 37 37;" xml:space="preserve">
                        <style type="text/css">
                            .st0 {
                                fill: #FFFFFF;
                            }
                        </style>
                        <g>
                            <path class="st0" d="M18.6,0C8.4,0,0.2,8.2,0.2,18.3s8.2,18.3,18.4,18.3c10.2,0,18.4-8.2,18.4-18.3S28.8,0,18.6,0z M19,28.9
		C19,28.9,19,28.9,19,28.9L19,28.9c-1.8,0-3.7-0.5-5.3-1.3l-5.8,1.5l1.6-5.7c-1-1.7-1.5-3.5-1.5-5.5C8,12,12.9,7,19,7
		c2.9,0,5.7,1.1,7.8,3.2c2.1,2.1,3.2,4.8,3.2,7.7C30,24,25,28.9,19,28.9z" />
                            <path class="st0" d="M19,8.9c-5.1,0-9.2,4.1-9.2,9.1c0,1.7,0.5,3.4,1.4,4.8l0.2,0.3l-0.9,3.4l3.5-0.9l0.3,0.2
		c1.4,0.8,3,1.3,4.7,1.3h0c5.1,0,9.2-4.1,9.2-9.1c0-2.4-1-4.7-2.7-6.4C23.7,9.8,21.4,8.9,19,8.9z M24.4,21.9
		c-0.2,0.6-1.3,1.2-1.9,1.3c-0.5,0.1-1.1,0.1-1.7-0.1c-0.4-0.1-0.9-0.3-1.6-0.6c-2.8-1.2-4.6-3.9-4.7-4.1s-1.1-1.5-1.1-2.8
		c0-1.3,0.7-2,1-2.3c0.3-0.3,0.6-0.3,0.7-0.3s0.4,0,0.5,0c0.2,0,0.4-0.1,0.6,0.5c0.2,0.5,0.8,1.9,0.8,2c0.1,0.1,0.1,0.3,0,0.5
		c-0.1,0.2-0.4,0.6-0.7,0.9c-0.1,0.2-0.3,0.3-0.1,0.6c0.2,0.3,0.7,1.2,1.5,1.9c1.1,0.9,1.9,1.2,2.2,1.4c0.3,0.1,0.4,0.1,0.6-0.1
		c0.2-0.2,0.7-0.8,0.9-1.1c0.2-0.3,0.4-0.2,0.6-0.1c0.3,0.1,1.6,0.8,1.9,0.9c0.3,0.1,0.5,0.2,0.5,0.3C24.6,20.7,24.6,21.3,24.4,21.9
		z" />
                        </g>
                    </svg>
                </a>
            </div>
        </div>
        <div class="footer-cont-third">
            <p>© <?php $dateYear = date('Y');
echo $dateYear;?> • Editorial Océano S.L • Todos los derechos reservados.</p>
            <div class="footer-certificados-cont">

                <?php if(ICL_LANGUAGE_CODE=='co'):?>
                    <div>
                    <h6>MEDIOS DE PAGO</h6>
                    <div class="footer-certificados co">
                         <a href="https://www.psepagos.co/PSEHostingUI/ShowTicketOffice.aspx?ID=1220">
                            <img src="<?= get_template_directory_uri().'/assets/media/co/pse.svg'; ?>" alt="pse">
                        </a>
                        
                        <a class="link-pago-co" href="https://colombia.recaudoexpress.com/bt/botonPago.xhtml?boton=MjU1MQ">
                            <img src="<?= get_template_directory_uri().'/assets/media/co/efecty.svg'; ?>" alt="efecty">
                            <img src="<?= get_template_directory_uri().'/assets/media/co/ath.svg'; ?>" alt="ath">
                            <img src="<?= get_template_directory_uri().'/assets/media/co/exito.svg'; ?>" alt="exito">
                        </a>
                    </div>
                </div>

                <?php endif;?>
                <div class="footer-certificados">
                    <img src="<?= get_template_directory_uri().'/assets/media/img_sitio-seguro.png'; ?>" alt="certificado sitio seguro">
                    <img src="<?= get_template_directory_uri().'/assets/media/img_sello-cace.png'; ?>" alt="imagen sello cace">
                    <img src="<?= get_template_directory_uri().'/assets/media/img_iso-bg.png'; ?>" alt="imagen ley iso">
                    <a target="_blank" href="">
                        <img src="<?= get_template_directory_uri().'/assets/media/img_data-fiscal.jpg'; ?>" alt="imagen data fiscal">
                    </a>
                </div>
            </div>
        </div>
    </article>
</footer>