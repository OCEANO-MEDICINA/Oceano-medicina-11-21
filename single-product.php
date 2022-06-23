<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$producto2 = null;
get_header(null, ['type_header' => 'translucent']); ?>

<?php while (have_posts()) : the_post();
    global $product;
    $producto2 = $product;
    $post_id = $product->ID;
    $father_post_id = get_field('father_post_id', $post_id);

    $post_type = get_post_type($father_post_id);
    $product_categories = (get_field("main_category", $father_post_id)) ? get_field("main_category", $father_post_id) : null;
    $product_categories = ($product_categories) ? $product_categories->name : "";
    $category = (get_field("main_category", $father_post_id)) ? get_field("main_category", $father_post_id) : null;

    $category_name = ($category) ? $category->name : "";
    $category_slug = ($category) ? $category->slug : "";

    $disponibilidad_meses = get_field('material_provision', $father_post_id);

    $related_products = get_field('related_products');
    $ebook_id = get_field('recommended_ebook', get_the_id()) ? get_field('recommended_ebook', get_the_id()) : get_field('recommended_ebook', $father_post_id);

    $product_profession_array = get_professions_list($father_post_id);
    $is_enfermeria = false;
    foreach ($product_profession_array as $profesion) {
        if ($profesion->name == 'enfermeros-auxiliares') :
            $is_enfermeria = true;
        endif;
    }
    $purchase_option = (get_field('purchase_option', get_the_ID())) ? get_field('purchase_option', get_the_ID()) : get_field('purchase_option', $father_post_id);
    $ribbon = ($purchase_option == 'catalogo') ? true : false;
    $currency_code = get_field('currency_3_digits_code', 'options');

    $isbn = get_field('isbn', $father_post_id);
    $codigo_curso = get_field('codigo_unico', $father_post_id);
    $title = get_the_title($father_post_id);
    $why_course = get_field('why_course', $father_post_id);
    $authors = get_field('authors_list', $father_post_id);
    $endorsments = get_field('endorsments_list', get_the_ID());
    $methodology_id = get_field('methodology', $father_post_id);

    //Checks if the woocommerce product has highlight text
    $highlighted_text = get_field('highlighted_text', get_the_ID()) ?: $highlighted_text = get_field('highlighted_text', $father_post_id);
    $planEstudioInCart =  ($_SESSION['plan_de_estudio']) ? 1 : 0;

?>


<!-- TODO: Cambiar esto -->

<style>
.notification {
    padding: 0;
    position: fixed;
    z-index: 10;
    background: transparent;
    width: min(100% - 32px, 646px);
    top: 14vh;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
}

.notification.success .notification-cont {
    border: 1px solid #32bea6;
}

.notification.error .notification-cont {
    border: 1px solid #e04f5f;
}

.notification-cont {
    width: 100%;
    padding: 1rem 1rem;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    background: #ffffff;
    -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    border-radius: 4px;
}

.notification-cont .info {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-column-gap: 1rem;
    column-gap: 1rem;
}

.notification-cont .info i {
    line-height: 1;
}

.notification-cont .info h5 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #02204d;
}

.notification-cont button {
    cursor: pointer;
}
</style>

<section id="notification-success-compra" class="notification success" style="display:none;">
    <article class="notification-cont">
        <div class="info">
            <i class="mdi mdi-check-circle is-size-1 has-text-success"></i>
            <div class="info-text">
                <h5>Producto agregado exitosamente al carrito</h5>
                <br>
                <a class="btn btn-mid button " href="/carrito">Ir al carrito</a>
            </div>
        </div>
        <button id="close-notif"><i class="mdi mdi-close is-size-5"></i></button>
    </article>
</section>


<!------------------------------->
<!------------ HERO ------------->
<!------------------------------->

<section id="hero" class="hero">
    <article class="hero-cont contenedor mx-auto">
        <h1 class="is-uppercase">Cursos 100% Online</h1>
        <h2 class="is-uppercase">La herramienta de hoy para <span class="salto-de-linea">impulsar tu futuro</span>
        </h2>
    </article>
</section>

<!------------------------------->
<!----------- FICHA ------------->
<!------------------------------->

<section id="ficha" class="ficha mx-auto">
    <div class="solapa-sup"></div>
    <article class="ficha-cont contenedor mx-auto">
        <div class="ficha-cont-header">
            <div class="ficha-cont-header-bloque">
                <div class="ficha-cont-header-info">
                    <div class="">
                        <div class="tag-cont">
                            <?php if (get_field("novedad", $father_post_id)) : ?>
                            <a class="tags tags-bibliografia ficha-cont-header-tag">Lanzamiento</a>
                            <?php endif; ?>
                            <h5><?= $product_categories ?></h5>
                        </div>
                        <h3 class="ficha-cont-header-title"><?= $title ?></h3>
                    </div>
                    <div class="ficha-cont-header-img">
                        <img src="<?= get_the_post_thumbnail_url($father_post_id) ?>"
                            alt="Imagen del curso <?= $title ?>">
                    </div>
                </div>

                <!----------- PRECIO Y PAGOS ------------->

                <!-- No Mostrar precio si es un descargable -->
                <?php if ($post_type !== 'downloadable'  && !$ribbon) : ?>
                <div class="ficha-cont-header-price">
                    <div class="ficha-cont-header-price-info">
                        <span><?= get_max_installments(); ?> <?= get_installments_string(); ?> sin interés</span>
                        <div>
                            <h4 class="precio">
                                <?= get_currency_symbol(); ?><?= format_number(get_product_price_installments($product, get_max_installments())); ?>
                                <span><?= $currency_code ?></span>
                            </h4>
                            <h6 class="unpago">Total: 1 pago de
                                <?= get_currency_symbol(); ?><?= format_number(get_product_price_installments($product, 1)); ?>
                            </h6>
                        </div>
                    </div>
                    <div class="ficha-cont-header-price-metodos">
                        <h5>Métodos de pago</h5>
                        <div class="metodos-de-pago">
                            <?php if (get_country_code_from_subdomain() == 'ar' || get_country_code_from_subdomain() == 'mx') : ?>
                            <img src="<?= get_template_directory_uri() . '/assets/media/icon/payment-methods/mercado-pago.svg' ?>"
                                alt="imagen de mercado pago">
                            <?php else : ?>
                            <img src="<?= get_template_directory_uri() . '/assets/media/icon/payment-methods/stripe.svg' ?>"
                                alt="imagen de stripe">
                            <?php endif; ?>
                            <img src="<?= get_template_directory_uri() . '/assets/media/icon/payment-methods/Visa.svg' ?>"
                                alt="imagen de visa">
                            <img src="<?= get_template_directory_uri() . '/assets/media/icon/payment-methods/mastercard.svg' ?>"
                                alt="imagen de mastercard">
                            <img src="<?= get_template_directory_uri() . '/assets/media/icon/payment-methods/amex.svg' ?>"
                                alt="imagen de amex">

                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!----------- CODIGO DE CURSO Y DESCRIPCION ------------->

                <div class="ficha-cont-header-description">
                    <div class="ficha-cont-header-description-codigos">
                        <?php if ($codigo_curso) : ?>
                        <h6>Código de curso: <span class="codigo"><?= $codigo_curso ?></span></h6>
                        <?php endif; ?>
                        <?php if ((ICL_LANGUAGE_CODE == 'co') && ($isbn)) : ?>
                        <h6>Código ISBN: <span class="isbn"><?= $isbn ?></span></h6>
                        <?php endif; ?>
                    </div>

                    <?php if ($post_type == 'bibliography') : ?>
                    <?= get_field("description", $father_post_id) ?>
                    <?php elseif ($post_type == 'downloadable') : ?>
                    <?= wpautop($why_course['description_box']['description']); ?>
                    <?php else : ?>
                    <?= wpautop($why_course['first_box']['description']); ?>
                    <?php endif; ?>

                </div>
            </div>

            <!----------- CODIGO DE CURSO E IMAGEN ------------->

            <div class="ficha-cont-header-img">
                <img src="<?= get_the_post_thumbnail_url($father_post_id) ?>" alt="Imagen del curso <?= $title ?>">
                <div class="ficha-cont-header-img-codigos">
                    <?php if ($codigo_curso) : ?>
                    <h6>Código de curso: <span class="codigo"><?= $codigo_curso ?></span></h6>
                    <?php endif; ?>
                    <?php if ((ICL_LANGUAGE_CODE == 'co') && ($isbn)) : ?>
                    <h6>Código ISBN: <span class="isbn"><?= $isbn ?></span></h6>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!----------- FICHAS DE DETALLES ------------->

        <div class="ficha-cont-details">
            <div class="ficha-cont-details-top">
                <div class="details-card">

                    <!----------- FICHA 1 ------------->

                    <?php if ($post_type == 'course') : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-1.svg' ?>"
                        alt="icono de horas">
                    <p><?= get_field("duration", $father_post_id); ?> horas estimadas de lectura</p>
                    <?php elseif ($post_type == 'bibliography') : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-envio.svg' ?>"
                        alt="icono de envios">
                    <p>envíos a todo el país</p>
                    <?php else : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-ebook.svg' ?>"
                        alt="icono de ebook gratutio">
                    <p>EBOOK GRATUITO</p>
                    <?php endif; ?>
                </div>

                <!----------- FICHA 2 ------------->

                <div class="details-card">
                    <?php if ($post_type == 'course') : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-2.svg' ?>"
                        alt="icono de computadora">
                    <p>modalidad online las 24 horas</p>
                    <?php elseif ($post_type == 'bibliography') : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-tarjeta.svg' ?>"
                        alt="icono de Tarjeta">
                    <p>PAGÁ EN HASTA 6 CUOTAS SIN INTERESES</p>
                    <?php else : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-tablet.svg' ?>"
                        alt="icono de tablet">
                    <p>DISPONIBLE PARA PC, TABLET Y SMARTPHONE</p>
                    <?php endif; ?>
                </div>

                <!----------- FICHA 3 ------------->

                <div class="details-card">
                    <?php if ($post_type == 'course') : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-3.svg' ?>"
                        alt="icono de calendario">
                    <p>inicio en cualquier momento del año</p>
                    <?php elseif ($post_type == 'bibliography') : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-pen.svg' ?>"
                        alt="icono de lapicera">
                    <p>contenido de autoaprendizaje</p>
                    <?php else : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-info.svg' ?>"
                        alt="icono de Info">
                    <p>contenido DE NIVEL FORMATIVO</p>
                    <?php endif; ?>
                </div>

                <!----------- FICHA 4 ------------->

                <div class="details-card">
                    <?php if ($post_type == 'course') : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-4.svg' ?>"
                        alt="icono de disponibilidad">
                    <p>Material digital disponible <?= $disponibilidad_meses ?> meses</p>
                    <?php elseif ($post_type == 'bibliography') : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-check.svg' ?>"
                        alt="icono de Check de stock">
                    <p>STOCK DISPONIBLE</p>
                    <?php else : ?>
                    <img src="<?= get_template_directory_uri() . '/assets/media/icon/detail-product-new.svg' ?>"
                        alt="icono de Info">
                    <p>Acceso a newsletters océano medicina</p>
                    <?php endif; ?>
                </div>

            </div>

            <!----------- DIRIGIDO Y REQUISITOS ------------>

            <div class="ficha-cont-details-info">

                <!----------- DETALLES | Bibliografia ------------>

                <?php if (have_rows('product_details', $father_post_id) && $post_type == 'bibliography') : ?>
                <div class="detalles dirigido sombra">
                    <div class="detalles-title">
                        <h4>Detalles</h4>
                    </div>
                    <div class="detalles-list">
                        <ul>
                            <?php while (have_rows('product_details', $father_post_id)) : the_row(); ?>
                            <li><?= get_sub_field('title'); ?> <?= get_sub_field('value'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <!----------- RECOMENDADO PARA | Bibliografia ------------>

                <?php if (have_rows('recommendations', $father_post_id) && $post_type == 'bibliography') : ?>
                <div class="detalles dirigido sombra">
                    <div class="detalles-title">
                        <h4>RECOMENDADO PARA</h4>
                    </div>
                    <div class="detalles-list">
                        <ul>
                            <?php while (have_rows('recommendations', $father_post_id)) : the_row(); ?>
                            <li><?= get_sub_field('subject'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <!----------- OBJETIVOS | Ebook  ------------>
                <?php if ($why_course['objectives_box']['description'] && $post_type == 'downloadable') : ?>
                <div class="detalles dirigido sombra">
                    <div class="detalles-title">
                        <h4>OBJETIVOS</h4>
                    </div>
                    <div class="detalles-list">
                        <ul>
                            <?= wpautop($why_course['objectives_box']['description']); ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <!----------- DIRIGIDO A ------------>

                <?php if (have_rows('aimed_at_list', $father_post_id)) : ?>
                <div class="detalles dirigido sombra">
                    <div class="detalles-title">
                        <h4>Dirigido a</h4>
                    </div>
                    <div class="detalles-list">
                        <ul>
                            <?php while (have_rows('aimed_at_list', $father_post_id)) : the_row(); ?>
                            <li><?= get_sub_field('aimed_at'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <!----------- REQUISITOS ------------->

                <?php if (have_rows('requirements', $father_post_id)) : ?>
                <div class="detalles requisitos sombra">
                    <div class="detalles-title">
                        <h4>Requisitos</h4>
                    </div>
                    <div class="detalles-list">
                        <ul>
                            <?php while (have_rows('requirements', $father_post_id)) : the_row(); ?>
                            <li><?= get_sub_field('description'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!----------- TARJETA DE PLAN DE ESTUDIO DE ENFERMERIA  ------------->

            <?php if ($show_plan_estudio && $is_enfermeria && $post_type == 'course') : ?>
            <div class="detalles ficha-cont-exclusive sombra">
                <img src="<?= get_template_directory_uri() . '/assets/media/exclusive-enf.png' ?>" alt="">
                <div class="ficha-cont-exclusive-info">
                    <span>exclusivo para el personal de enfermería</span>
                    <h4 class="ficha-cont-exclusive-info-title">Planes formativos a tu medida</h4>
                    <p>Elegí hasta cinco cursos de tu interés para realizar en 12, 18 o 24 meses,
                        de acuerdo a tus expectativas de crecimiento profesional.</p>
                    <a id="plan-enf" href="/plan-de-estudio" class="btn btn-mid button boton">ME INTERESA</a>
                </div>
            </div>
            <?php endif; ?>

        </div>


        <!----------- ANUCIO DE DESCUENTOS Y EXTRAS  ------------->

        <?php if ($highlighted_text && (strtotime('-24 hours') <= strtotime(get_field('fecha_de_vencimiento_texto_destacado')))) : ?>
        <div class="ficha-cont-promo">
            <div class="detalles-list">
                <ul>
                    <li><?= $highlighted_text; ?></li>
                </ul>
            </div>
        </div>
        <?php endif; ?>

    </article>
</section>

<!------------------------------->
<!----------- AVALES ------------>
<!------------------------------->

<?php if (!$endorsments) {
        $endorsments = get_field('endorsments_list', $father_post_id);
    }
    if ($endorsments && $post_type == 'course') : ?>
<section id="aval" class="aval">
    <article class="aval-cont contenedor mx-auto">
        <div class="aval-cont-title">
            <h3> <i class="mdi mdi-certificate-outline"></i>
                Avalan este curso</h3>
        </div>
        <div class="aval-cont-mobile">
            <div class="swiper-avales">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php $contador_aval = 0;
                            foreach ($endorsments as $endorsment) :

                                $endorsment_id = $endorsment['endorsment'][0]->ID;
                                $contador_aval++;
                                if ($endorsment['endorsment'][0]->ID == null) continue;

                            ?>
                    <div class="swiper-slide">
                        <div class="aval-card">
                            <a class="aval-card-img" onclick="">
                                <img class="imagen-aval" src="<?= get_the_post_thumbnail_url($endorsment_id); ?>"
                                    alt="imagen de aval">

                                <?php if ($endorsment['endorsment'][0]->descripcion) : ?>
                                <div class="info info-<?= $contador_aval ?>"></div>
                                <?php endif; ?>
                            </a>
                            <div class="aval-card-title">
                                <?php if (get_the_title($endorsment_id)) : ?>
                                <h5><?= get_the_title($endorsment_id) ?></h5>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="aval-cont-desktop">
            <?php $contador_aval = 0;
                    foreach ($endorsments as $endorsment) {
                        $contador_aval++;
                        $endorsment_id = $endorsment['endorsment'][0]->ID;
                        if ($endorsment['endorsment'][0]->ID == null) continue;
                    ?>
            <div class="aval-card">
                <div class="aval-card-img">
                    <img class="imagen-aval" src="<?= get_the_post_thumbnail_url($endorsment_id); ?>"
                        alt="Imagen de aval">

                    <?php if ($endorsment['endorsment'][0]->descripcion) : ?>
                    <style>
                    .aval-card-img .info-<?=$contador_aval ?>::before {
                        content: "<?= $endorsment['endorsment'][0]->descripcion ?>";
                    }
                    </style>
                    <div class="info info-<?= $contador_aval ?>"></div>
                    <?php endif; ?>
                </div>
                <div class="aval-card-title">
                    <?php if (get_the_title($endorsment_id)) : ?>
                    <h5><?= get_the_title($endorsment_id) ?></h5>
                    <?php endif; ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </article>
</section>
<?php endif; ?>

<!------------------------------->
<!------- RECONOCIMIENTO -------->
<!------------------------------->

<?php if ($post_type == 'course' && get_field('reconocimiento')['titulo']) : ?>
<section id="r-mex" class="r-mex">
    <article class="r-mex-cont contenedor mx-auto">
        <div class="r-mex-cont-download sombra">
            <div class="is-flex is-align-items-center">
                <img src="<?= get_template_directory_uri() . '/assets/media/icon/diploma-mex.svg' ?>"
                    alt="icono de diploma" class="mr-4">
                <h6><?= get_field('reconocimiento')['titulo'] ?>
                </h6>
            </div>
            <!-- TODO: esto cambiarlo al modal -->
            <a data-target="modal-reconocimiento" class="btn btn-mid button boton js-modal-trigger">VER
                RECONOCIMIENTO</a>
        </div>
    </article>
</section>
<?php endif; ?>


<!------------------------------->
<!---------- TEMARIO ------------>
<!------------------------------->

<?php if ($post_type == 'course') : ?>
<section id="temario" class="temario">
    <article class="temario-cont contenedor mx-auto">

        <div class="temario-cont-title">
            <h3><i class="mdi mdi-file-document-outline"></i>Temario</h3>
        </div>

        <!----------- DESCARGA DE TEMARIO  ------------->

        <div class="temario-cont-download sombra">
            <h6><span class="salto-de-linea">Los módulos pueden cursarse</span>
                <span class="salto-de-linea"> en el orden que desee.</span>
                <span class="salto-de-linea"> Para recibir la certificación, el curso debe completarse al
                    100%.</span>
            </h6>
            <a class="btn btn-mid button boton js-modal-trigger" data-target="modal-temario">Descargar temario</a>

        </div>

        <!----------- LISTADO DE TEMARIO  ------------->

        <div class="temario-cont-info sombra">
            <?php if (have_rows('cards', $father_post_id)) :
                        $rowCount = count(get_field('cards', $father_post_id)); ?>
            <article class="temario-cont-info-grid">

                <nav class="temario-tabs">
                    <ul>

                        <?php $contador_modulos_nav == 0;
                                    while (have_rows('cards', $father_post_id) &&  $contador_modulos_nav < 10 && $contador_modulos_nav < $rowCount) :
                                        $contador_modulos_nav++;
                                        if ($contador_modulos_nav == 10) {
                                            $limite_de_10 = true;
                                        }

                                    ?>
                        <li class="tab <?= $contador_modulos_nav == 1 ? 'is-active' : '' ?>"
                            onclick="openTab(event,'modulo-<?= $contador_modulos_nav ?>')"><a><span
                                    class=""><?= $post_type == 'course' ? 'Módulo' : 'Tomo' ?></span>
                                <?= $contador_modulos_nav ?></a> </li>

                        <?php wp_reset_postdata();
                                    endwhile; ?>

                    </ul>
                </nav>

                <?php $contador_modulos == 0;
                            while (have_rows('cards', $father_post_id) &&  $contador_modulos < 10) : the_row();
                                $contador_modulos++; ?>

                <div id="modulo-<?= $contador_modulos ?>" class="content-tab"
                    style="display: <?= $contador_modulos == 1 ? 'block' : 'none' ?>;">
                    <h5><?php the_sub_field('card_title'); ?></h5>
                    <?= wpautop(get_sub_field('card_body')); ?>

                </div>
                <?php wp_reset_postdata();
                            endwhile; ?>

            </article>
            <?php endif; ?>

        </div>
        <?php if ($limite_de_10) {
                    echo '<h4>Descargar temario para ver más<h4>';
                } ?>
    </article>

</section>
<?php endif; ?>




<!------------------------------->
<!-------- EVALUACION ----------->
<!------------------------------->

<?php if ($methodology_id && $post_type == 'course') :
        $methodology_list = get_field('methodologies_list', $methodology_id);
        if ($methodology_list) : ?>
<section id="evaluacion" class="evaluacion">
    <article class="evaluacion-cont contenedor mx-auto">
        <div class="detalles evaluacion sombra">
            <div class="detalles-title">
                <h4>Evaluación</h4>
            </div>
            <div class="detalles-list">
                <ul>
                    <?php foreach ($methodology_list as $item) :
                                ?>
                    <li><?= $item['methodology'] ?></li>
                    <?php endforeach; ?>
            </div>
        </div>
    </article>
</section>
<?php endif; ?>
<?php endif; ?>

<!------------------------------->
<!--------- OPCIONES ------------>
<!------------------------------->



<?php if ($post_type == 'course') : ?>
<section id="options" class="options">
    <article class="options-cont contenedor mx-auto">

        <div class="options-cont-ebooks">
            <div class="options-cont-ebooks-title">
                <h3><i class="mdi mdi-file-download-outline"></i>E-Books</h3>
            </div>
            <div class="options-cont-ebooks-grid">

                <?php
                        $ebooks = get_similar_ebook($category, $is_enfermeria, $ebook_id);
                        foreach ($ebooks as $ebook) : ?>

                <div class="card c-hover">
                    <div class="card-img"
                        style="background: url(<?= $ebook->img; ?>), linear-gradient(transparent 75%, #00000035 100%);">
                    </div>
                    <div class="card-info">
                        <div class="card-info-sup">
                            <?php if (in_array(34028, $ebook->product_profession)) : ?>
                            <a href="/#filter=.enfermeros-auxiliares" class="tags tags-enfermeria">Enfermeria</a>
                            <?php elseif (in_array(34009, $ebook->product_profession)) : ?>
                            <a href="/tienda/#filter=.medicos" class="tags tags-medicina">Medicina</a>
                            <?php endif; ?>
                            <?php if ($ebook->product_category !== 'Desconocido') : ?>
                            <p class="area"><?= $ebook->product_category ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="card-info-title"><?= $ebook->title; ?></div>
                        <div class="card-info-footer">
                            <a href="<?= $ebook->link ?>" class="card-info-footer-boton btn btn-mid">Descarga
                                gratuita</a>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>


                <!-- Traer un ebook relacionado a esta Categoria, sino existe profession, y si no exite el ultimo -->
            </div>
        </div>

        <!-- Crear funcion que traiga los ultimos dos publicaciones del magazine relacioandos con la especialidad, 
			si no encuentra nada que traiga los ultimos dos relacionados a la profession -->

        <!-- publicacion_magazine_recomendada -->

        <div class="options-cont-related">
            <div class="options-cont-related-title">
                <h3> <i class="mdi mdi-file-compare"></i>
                    Notas relacionadas</h3>
            </div>
            <div class="options-cont-related-grid">

                <?php
                        $magazine_selected = (get_field('publicacion_magazine_recomendada'));

                        $publicaciones_magazine = get_post_similar_magazine($is_enfermeria, $magazine_selected);


                        foreach ($publicaciones_magazine as $publication) :  ?>

                <div class="card c-hover">
                    <div class="card-img"
                        style="background: url(<?= $publication->img[0] ?>), linear-gradient(transparent 75%, #00000035 100%);">
                    </div>
                    <div class="card-info">
                        <?php foreach ($publication->category_array as $category) :
                                        echo '<div class="card-info-sup"><p class="area">' . $category->name . '</p></div>';
                                    endforeach; ?>

                        <div class="card-info-title"><?= $publication->title ?></div>
                        <div class="card-info-footer">
                            <a href="<?= $publication->link ?>" class="card-info-footer-boton btn btn-mid">Leer</a>
                        </div>
                    </div>
                </div>

                <?php endforeach;  ?>
            </div>
        </div>


    </article>
</section>
<?php endif; ?>



<!------------------------------->
<!---------- DIPLOMA ------------>
<!------------------------------->
<?php if ($post_type == 'course' && (get_field('diploma_local', $post_id)['imagen']['url'] || get_field('diploma_global', $father_post_id)['imagen']['url'] || get_field('diploma_local', $post_id)['archivo']['url'] || get_field('diploma_global', $father_post_id)['archivo']['url'])) : ?>
<section id="diploma" class="diploma">
    <article class="diploma-cont contenedor mx-auto">
        <h4>Al finalizar tu formación habiendo aprobado, recibirás un diploma de Océano Medicina en formato impreso
            y digital, con la firma del autor del curso que certifica la aprobación.</h4>
        <div class="diploma-cont-modelo">
            <img src="<?= get_template_directory_uri() . '/assets/media/icon/diploma.svg' ?>" alt="Icono de diploma">
            <a class="btn btn-mid button boton js-modal-trigger" data-target="modal-diploma">VER MODELO DE DIPLOMA</a>
        </div>
    </article>
</section>
<?php endif; ?>




<!------------------------------->
<!---------- AUTORES ------------>
<!------------------------------->

<?php if ($authors && is_array($authors) && $post_type == 'course') : ?>
<section id="autor" class="autor">
    <article class="autor-cont contenedor mx-auto">
        <div class="autor-cont-title">
            <h3> <i class="mdi mdi-file-account-outline"></i>
                Autores del curso</h3>
        </div>
        <div class="autor-cont-grid">

            <?php while (have_rows('authors_list', $father_post_id)) : the_row();
                        $count_author++;
                        $author_id = get_sub_field('author');
                        $author_image = get_the_post_thumbnail_url($author_id); ?>

            <div class="post-item autor-first <?= $count_author > 3 ? '' : 'first-items-author' ?>"
                style="display: <?= $count_author > 3 ? 'none' : '' ?>">
                <?php if ($author_image) : ?>
                <div class="post-item-img" style="background: center/cover url(<?= $author_image ?>);">
                </div>
                <?php else : ?>
                <div class="post-item-img"
                    style="background: center/cover url(<?= get_template_directory_uri() . '/assets/media/user-default.png' ?>);">
                </div>
                <?php endif; ?>
                <div class="post-item-info">
                    <h4 class="post-item-title"><?= get_the_title($author_id); ?></h4>
                    <h5><?= get_field('description', $author_id); ?></h5>
                    <a class="accordion-trigger">Ver biografía</a>

                    <div class="accordion-panel">

                        <?php if (have_rows('specialties', $author_id)) : ?>
                        <h6><i class="mdi mdi-briefcase"></i>Especialidad:</h6>
                        <ul>
                            <?php while (have_rows('specialties', $author_id)) : the_row(); ?>
                            <li><i class="mdi mdi-circle-medium"></i><?= get_sub_field('specialty'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (have_rows('centres', $author_id)) : ?>
                        <h6><i class="mdi mdi-hospital-building"></i>Hospitales / Centros:</h6>
                        <ul>
                            <?php while (have_rows('centres', $author_id)) : the_row(); ?>
                            <li><i class="mdi mdi-circle-medium"></i><?= get_sub_field('centre'); ?></li>
                            <?php endwhile; ?>
                        </ul>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <?php endwhile; ?>
            <?php if ($count_author > 3) : ?>
            <a id="btn-ver-mas-autores" class="btn btn-mid button boton">Ver más</a>
            <?php endif; ?>
        </div>
    </article>
</section>
<?php endif; ?>

<!------------------------------->
<!--------- CTA ASESOR ---------->
<!------------------------------->
<?php
    $pid = $producto2->id;

    ?>
<?php if ($post_type == 'course' || $post_type == 'downloadable') : ?>
<section id="cta-asesor" class="cta-asesor <?= $post_type == 'downloadable' ? 'ebook' : '' ?>">

    <?php if ($post_type == 'course') : ?>
    <article class="cta-asesor-cont contenedor mx-auto">
        <div class="cta-asesor-cont-info">
            <div class="cta-asesor-cont-info-img"
                style="background: center/cover url(<?= get_template_directory_uri() . '/assets/media/asesor.png' ?>);">
            </div>
            <div>
                <h4 class="cta-asesor-cont-title">Consulta con un asesor</h4>
                <h5>Escribenos y en breve un
                    asesor te estará contactando</h5>
            </div>
        </div>
        <?php if (!$ribbon) : ?>
        <button id="displayed-add-cart" type="submit" name="add-to-cart" data-pl="<?= $planEstudioInCart ?>"
            value="<?= $producto2->id ?>" class="btn btn-mid button boton single_add_to_cart_button">AGREGAR AL
            CARRITO</button>
        <?php endif; ?>

    </article>
    <?php else : ?>

    <article class="cta-asesor-cont contenedor mx-auto">
        <h5 class="cta-asesor-cont-title">Completa el formulario para descargar automáticamente el material</h5>
        <!-- <h5></h5> -->
    </article>


    <?php endif; ?>

</section>
<?php endif; ?>

<!------------------------------->
<!--------- FORM ASESOR --------->
<!------------------------------->

<?php if ($post_type == 'course' || $post_type == 'downloadable') : ?>
<section id="form-asesor-<?= $post_type ?>" class="form-asesor contact__form__data"
    data-downloadable="<?= get_field('topics_file', $father_post_id); ?>"
    data-post-title="<?= get_the_title($father_post_id) ?>" data-pais="<?= ICL_LANGUAGE_CODE ?>"
    <?php if ($post_type == 'downloadable') {
                                                                                                                                                                                                                                                                    echo 'style="padding-top: 4 rem; margin-top: 0rem;"';
                                                                                                                                                                                                                                                                } ?>>
    <!-- TODO: aca poner que primero revise si tiene link de ebook en producto, sino traerlo de ebook -->
    <article class="form-asesor-cont contenedor mx-auto">

        <?php

                $contactForm_isTech = $isTestEnv ? 117065 : 122763;
                $contact_form_id = $post_type == 'downloadable' ? $contactForm_isTech : 93781;
                echo  do_shortcode('[contact-form-7 html_class="formulario" id="' . $contact_form_id . '"]');
                ?>

    </article>
</section>
<?php endif; ?>

<!------------------------------->
<!----- CURSOS RELACIONADOS ----->
<!------------------------------->

<?php if ($related_products) :
        if ($related_products[0]['product']) : ?>
<section id="related" class="related">
    <article class="related-cont contenedor mx-auto">
        <div class="related-cont-title contenedor mx-auto">
            <h3> ESPECIALISTAS COMO TÚ
                TOMARON ESTOS CURSOS</h3>
        </div>
        <div class="related-cont-grid">
            <div class="swiper">
                <div class="swiper-wrapper">

                    <!-- Slides -->

                    <?php
                                $count = 1;
                                foreach ($related_products as $related_product) :

                                    if ($cout > 4) {
                                        break;
                                    }
                                    $post = $related_product['product'];
                                    setup_postdata($post);
                                    $product_related = get_product_data($post); ?>
                    <div class="swiper-slide">
                        <div class="card c-hover">
                            <div class="card-img"
                                style="background: url(<?= $product_related[0]->img ?>), linear-gradient(transparent 75%, #00000035 100%);">
                                <?php
                                                foreach ($product_related[0]->product_profession_array as $profesion) {
                                                    if ($profesion->name == 'medicos') : ?>
                                <a href="/tienda/#filter=.medicos" class="tags tags-medicina">Medicina</a>
                                <?php elseif ($profesion->name == 'enfermeros-auxiliares') : ?>
                                <a href="/tienda/#filter=.enfermeros-auxiliares"
                                    class="tags tags-enfermeria">Enfermería</a>
                                <?php endif; ?>

                                <?php } ?>
                            </div>
                            <div class="card-info">
                                <div class="card-info-sup">
                                    <p class="area"><?= $product_related[0]->product_categories ?></p>
                                    <span class="horas"><i
                                            class="mdi mdi-clock-outline"></i><?= $product_related[0]->duracion ?>
                                        horas</span>
                                </div>
                                <div class="card-info-title"><?= $product_related[0]->title ?></div>
                                <div class="card-info-footer">
                                    <div class="card-info-footer-precio">

                                        <?php if ($product_related[0]->ribbon || !$product_related[0]->base_old_price) : ?>
                                        <p class="cuotas"><?= get_max_installments(); ?>
                                            <?= get_installments_string(); ?></p>
                                        <p class="price">Sin interés</p>
                                        <?php else : ?>
                                        <p class="cuotas"><?= get_max_installments(); ?>
                                            <?= get_installments_string() ?> de</p>
                                        <p class="price"><?= get_currency_symbol(); ?><?= $product_related[0]->precio ?>
                                        </p>
                                        <?php endif; ?>

                                    </div>
                                    <a href="<?= $product_related[0]->link ?> " target="_blank"
                                        class="card-info-footer-boton btn btn-mid">Descubrir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                                endforeach;
                                ?>
                </div>
            </div>
        </div>
    </article>
</section>
<?php endif; ?>
<?php endif; ?>
<!------------------------------->
<!--------- CTA SCROLL ---------->
<!------------------------------->

<?php if ($post_type == 'course' || $post_type == 'bibliography') : ?>
<section id="cta-scroll" class="cta-scroll">
    <article class="cta-scroll-cont contenedor mx-auto">
        <div class="cta-scroll-cont-info">
            <?php if ($post_type == 'course') : ?>
            <div class="cta-scroll-cont-info-img"
                style="background: center/cover url(<?= get_template_directory_uri() . '/assets/media/asesor.png' ?>;">
            </div>
            <?php else : ?>
            <div class="cta-scroll-cont-info-img"
                style="background: center/cover url(<?= get_template_directory_uri() . '/assets/media/libros.png' ?>;">
            </div>
            <?php endif; ?>
            <div>
                <h4 class="cta-scroll-cont-title">
                    <?= $post_type == 'bibliography' ? '¡Hacé lugar en tu biblioteca!' : 'Consulta con un asesor' ?>
                </h4>
                <h5>
                    <?= $post_type == 'bibliography' ? 'Tenemos esta bibliografía lista para llevártela hasta donde estés' : 'Escribenos y en breve un asesor te estará contactando' ?>
                </h5>
            </div>
        </div>
        <div class="botones">
            <?php if (!$ribbon) : ?>

            <button id="add-to-cart-scroll displayed-add-cart" type="submit" name="add-to-cart"
                data-pl="<?= $planEstudioInCart ?>" value="<?= $producto2->id ?>"
                class="btn btn-mid button boton displayed-add-cart  single_add_to_cart_button">AGREGAR AL
                CARRITO</button>

            <?php endif; ?>

            <?php if ($post_type == 'course') : ?>
            <a id="contact-me" href="#cta-asesor" class="btn btn-mid button boton">QUIERO QUE ME CONTACTEN</a>
            <?php endif; ?>
        </div>
    </article>
</section>
<?php endif; ?>


<!-- MODAL DIPLOMA -->

<div id="modal-diploma" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <section class="modal-card-body">
            <div class="swiper-diploma" style="overflow: hidden;">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php if (get_field('diploma_local', $post_id)['imagen']['url']) : ?>
                    <div class="swiper-slide">
                        <div>
                            <a target="_blank" href="<?= get_field('diploma_local', $post_id)['imagen']['url'] ?>">
                                <img src="<?= get_field('diploma_local', $post_id)['imagen']['url'] ?>"
                                    alt="Diploma Por pais ">
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (get_field('diploma_local', $post_id)['archivo']) : ?>
                    <div class="swiper-slide">
                        <div>
                            <iframe src="<?= get_field('diploma_local', $post_id)['archivo']['url'] ?>#toolbar=0"
                                type="application/pdf" width="500" height="375"> </iframe>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (get_field('diploma_global', $father_post_id)['archivo']) : ?>
                    <div class="swiper-slide">
                        <div>
                            <iframe
                                src="<?= get_field('diploma_global', $father_post_id)['archivo']['url'] ?>#toolbar=0"
                                type="application/pdf" width="500" height="375"> </iframe>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (get_field('diploma_global', $father_post_id)['imagen']['url']) : ?>
                    <div class="swiper-slide">
                        <div>
                            <a target="_blank"
                                href="<?= get_field('diploma_global', $father_post_id)['imagen']['url'] ?>">
                                <img src="<?= get_field('diploma_global', $father_post_id)['imagen']['url'] ?>"
                                    alt="Diploma Global ">
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <footer class="modal-card-foot">
            <button class="ml-auto btn btn-big button ">Cerrar</button>
        </footer>
    </div>
</div>

<div id="modal-temario" class="modal contact__form__data"
    data-downloadable="<?= get_field('topics_file', $father_post_id); ?>"
    data-post-title="<?= get_the_title($father_post_id) ?>" data-pais="<?= ICL_LANGUAGE_CODE ?>">
    <div class="modal-background"></div>
    <div class="modal-card" id="contact-temario" data-post-title="<?= get_the_title($father_post_id) ?>">
        <header class="modal-card-head">
            <div class="modal-card-head-info">
                <h3 class="modal-card-title"> Descargar temario </h3>

            </div>
            <button class="delete" aria-label="close"></button>
        </header>
        <?php echo  do_shortcode('[contact-form-7 id="75045" title="Contacto Temario" ]'); ?>
    </div>
</div>


<div id="modal-reconocimiento" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <section class="modal-card-body">
            <?php if (get_field('reconocimiento')['imagen']) : ?>

            <img src="<?= get_field('reconocimiento')['imagen'] ?>"
                alt="imagen del reconocimiento del <?= get_field('reconocimiento')['titulo'] ?>">

            <?php endif; ?>
            <?php if (get_field('reconocimiento')['archivo']) : ?>
            <iframe src="<?= get_field('reconocimiento')['archivo'] ?>#toolbar=0" type="application/pdf" width="500"
                height="375"> </iframe>
            <?php endif; ?>

        </section>
        <footer class="modal-card-foot">
            <button class="ml-auto btn btn-big button">CERRAR</button>
        </footer>
    </div>
</div>


<div id="modal-addcart-validation-planEnCart" class="modal modal-addcart-validation ">
    <div class="modal-background"></div>
    <div class="modal-card">
        <div class="modal-card-body">
            <img src="<?= get_template_directory_uri() ?>/assets/media/icon/addcart-error.svg" alt=""
                style="width: 48px;">
            <div class="info">
                <p class="info-msj"><span class="br-desktop">Ya tenés un plan personalizado en tu carrito.</span> <span
                        class="br-desktop">¿Te gustaría continuar la inscripción con </span> el programa que armaste a
                    tu manera?</p>
            </div>
            <div class="botones">
                <button name="btn-adquire-plan" class="btn btn-big button">QUIERO ADQUIRIR EL PLAN</button>
                <button name="btn-adquire-cursos" class="btn btn-big simple button">QUIERO ADQUIRIR LOS CURSOS</button>
            </div>
        </div>
    </div>
</div>



<?php endwhile; // end of the loop. 
?>

<?php get_footer(null, ['type_footer' => 'full']);