<?php

get_header(null, ['type_header' => 'magazine']); ?>
<section id="hero" class="hero">
    <article class="hero-cont contenedor mx-auto">
        <h1>Información, datos y testimonios de
            calidad formativa para tu crecimiento</h1>
        <h2>Da tu primer paso hacia nuevos conocimientos.
            <span class="salto-de-linea">Cursos 100% online para profesionales de la salud.</span>
        </h2>
    </article>
</section>

<?php

while (have_posts()) : the_post();
    $titulo = get_the_title();
    $categorias_array = get_the_category();
    $contenido_exclusivo = get_field('contenido_exclusivo');
    $excerpt = get_the_excerpt();
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $autor_id = get_the_author_meta('ID');
    $autor_name = get_the_author_meta('display_name');
    $autor_description = get_the_author_meta('description');
    $autor_image = get_avatar_url($autor_id);

    $imagen = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
    $fuentes = get_field('fuentes');
    $tags_array = get_the_tags();
    $articulos_relacionados = get_field('articulos_relacionados');
    $cursos_relacionados = get_field('cursos_recomendados');

    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $mesName = $meses[get_post_time('n') - 1];
    $fecha = get_post_time('j') . ' de ' . $mesName . ' de ' . get_post_time('Y');
    $fechaNoFormat = get_post_time('d') . '-' . get_post_time('m') . '-' . get_post_time('Y');
    $banners_promocionales = get_postType('banner-home', 1);
    $camposBanners = get_field('banner_home', $banners_promocionales->ID);

?>




<section id="post" class="post <?= $contenido_exclusivo ? 'exclusive' : '' ?>" exc='<?= $contenido_exclusivo ?>'>
    <div class="solapa-sup"></div>
    <article class="post-cont contenedor mx-auto cont-w-side-r">
        <div class="post-cont-header">
            <div class="post-cont-header-tags">
                <?php foreach ($categorias_array as $categoria) :
                        switch (true) {
                            case stristr($categoria->name, 'Actualidad'):
                                echo "<a href='/magazine/resultados-de-busqueda/?category=" . $categoria->slug . "'  class='tags  post-cont-header-tag background-actualidad'>ACTUALIDAD</a>";
                                break;
                            case stristr($categoria->name, 'e-Health'):
                                echo "<a href='/magazine/resultados-de-busqueda/?category=" . $categoria->slug . "'  class='tags post-cont-header-tag  background-e-health'>E-HEALTH</a>";
                                break;
                            case stristr($categoria->name, 'Enfermería'):
                                echo "<a href='/magazine/resultados-de-busqueda/?category=" . $categoria->slug . "' class='tags  post-cont-header-tag background-enfermeria'>ENFERMERÍA</a>";
                                break;
                            case stristr($categoria->name, 'Fuera de Guardia'):
                                echo "<a href='/magazine/resultados-de-busqueda/?category=" . $categoria->slug . "' class='tags post-cont-header-tag  background-f-d-guardia'>FUERA DE GUARDIA</a>";
                                break;
                            case stristr($categoria->name, 'Uncategorized'):
                                break;
                            default:
                                echo "<a href='/magazine/resultados-de-busqueda/?category=" . $categoria->slug . "' class='tags post-cont-header-tag background-primary'>" . $categoria->name . "</a>";
                                break;
                        }
                    endforeach;

                    if (get_field('contenido_exclusivo')) :
                        echo "<a href='/magazine/resultados-de-busqueda/?tags=exclusivo' class='tags post-cont-header-tag  tags-bibliografia'><i class='mdi mdi-star'></i> Exclusivo</a>";
                    endif; ?>
            </div>

            <h1 class="post-cont-header-title"><?= $titulo ?></h1>

            <p class="post-cont-header-bajada"><?= $excerpt ?></p>
            <div id="single-post-meta" class="post-meta">
                <a href="/magazine/resultados-de-busqueda/?fecha=<?= $fechaNoFormat ?>~<?= $fechaNoFormat ?>"><span
                        class="post-meta-date"><?= $fecha ?></span></a>

                <div class="author-meta single-author with-avatars">
                    <div class="meta-item meta-author-wrapper meta-author-11">
                        <div class="meta-author-avatar">
                            <a href="/magazine/resultados-de-busqueda/?autor=<?= $autor_id ?>">
                                <img alt="Foto de <?= $autor_name ?>" src="<?= $autor_image ?>"
                                    class="avatar avatar-140 photo" height="140" width="140">
                            </a>
                        </div>
                        <div class="meta-author">
                            <a href="/magazine/resultados-de-busqueda/?autor=<?= $autor_id ?>"
                                class="author-name tie-icon" title="<?= $autor_name ?>"><?= $autor_name ?>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <?php if ($imagen) : ?>
            <div class="post-cont-header-img">
                <img src="<?= $imagen[0] ?>" alt="Imagen del articulo">
            </div>
            <?php endif; ?>
        </div>
        <div class="post-cont-body">

            <?php if (have_rows('aspectos_relevantes')) : ?>
            <div class="mas-relevantes">
                <div class="mas-relevantes-cont">
                    <h4>Los aspectos más relevantes del artículo</h4>
                    <ul>
                        <?php while (have_rows('aspectos_relevantes')) : the_row(); ?>
                        <li><?= get_sub_field('item'); ?></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <?php the_content(); ?>

            <div class="recomended <?= get_field('contenido_legado') ? 'apaisado' : '' ?>">
                <h5>¡ALCANZÁ TU MÁXIMO POTENCIAL!</h5>
                <h4>Te recomendamos estos cursos</h4>
                <div class="recomended-cont">

                    <?php if (!$cursos_relacionados) :
                            // get_field('aparece_en_magazine');

                            $args_productos = array(
                                'post_type'      => 'course',
                                'posts_per_page' => -1,
                                'meta_query' => array(
                                    array(
                                        'key'     => 'aparece_en_magazine',
                                        'value'   => true,
                                        'compare' => '='
                                    ),
                                ),
                                'orderby' => 'rand'
                            );

                            $array_productos = get_cursos($args_productos);

                            foreach ($array_productos as $product) : ?>

                    <div class="card c-hover">
                        <div class="card-img"
                            style="background: url(<?= $product->img ?>), linear-gradient(transparent 75%, #00000035 100%);">

                            <?php foreach ($product->product_profession_array as $profesion) :
                                            if ($profesion->name == 'medicos') : ?>
                            <a href="/tienda/#filter=.medicos" class="tags tags-medicina">Medicina</a>
                            <?php elseif ($profesion->name == 'enfermeros-auxiliares') : ?>
                            <a href="/tienda/#filter=.enfermeros-auxiliares" class="tags tags-enfermeria">Enfermería</a>
                            <?php endif; ?>

                            <?php break;
                                        endforeach; ?>

                        </div>
                        <div class="card-info">
                            <div class="card-info-sup">

                                <?php if ($product->product_categories != 'Uncategorized') : ?>
                                <p class="area"><?= $product->product_categories ?></p>
                                <?php endif; ?>

                                <?php if ($product->duracion != 0) : ?>
                                <span class="horas"><i class="mdi mdi-clock-outline"></i><?= $product->duracion ?>
                                    horas</span>
                                <?php endif; ?>

                            </div>
                            <div class="card-info-title"><?= $product->title ?></div>
                            <div class="card-info-footer">
                                <div class="card-info-footer-precio">
                                    <?php if ($product->ribbon || !$product->base_old_price) : ?>
                                    <p class="cuotas"><?= get_max_installments(); ?> <?= get_installments_string(); ?>
                                    </p>
                                    <p class="price">Sin interés</p>
                                    <?php else : ?>
                                    <p class="cuotas"><?= get_max_installments(); ?> <?= get_installments_string() ?> de
                                    </p>
                                    <p class="price"><?= get_currency_symbol(); ?><?= $product->precio ?></p>
                                    <?php endif; ?>
                                </div>
                                <a href="<?= $product->link ?>" class="card-info-footer-boton btn btn-mid">Descubrir</a>
                            </div>
                        </div>
                    </div>
                    <?php
                            endforeach;

                        else :
                            shuffle($cursos_relacionados);
                            foreach ($cursos_relacionados as $key => $curso) :

                                if ($key == 2) continue;

                                $product_related = get_product_data($curso);
                                $imagen = wp_get_attachment_image_src(get_post_thumbnail_id($curso->ID), 'single-post-thumbnail');
                            ?>
                    <div class="card c-hover">
                        <div class="card-img"
                            style="background: url(<?= $imagen['0'] ?>), linear-gradient(transparent 75%, #00000035 100%);">

                            <?php foreach ($product_related[0]->product_profession_array as $profesion) :
                                            if ($profesion->name == 'medicos') : ?>
                            <a href="/tienda/#filter=.medicos" class="tags tags-medicina">Medicina</a>
                            <?php elseif ($profesion->name == 'enfermeros-auxiliares') : ?>
                            <a href="/tienda/#filter=.enfermeros-auxiliares" class="tags tags-enfermeria">Enfermería</a>
                            <?php endif; ?>

                            <?php 
                                        endforeach; ?>

                        </div>
                        <div class="card-info">
                            <div class="card-info-sup">

                                <?php if ($product_related[0]->product_categories != 'Uncategorized') : ?>
                                <p class="area"><?= $product_related[0]->product_categories ?></p>
                                <?php endif; ?>

                                <?php if ($product_related[0]->duracion != 0) : ?>
                                <span class="horas"><i
                                        class="mdi mdi-clock-outline"></i><?= $product_related[0]->duracion ?>
                                    horas</span>
                                <?php endif; ?>

                            </div>
                            <div class="card-info-title"><?= $curso->post_title ?></div>
                            <div class="card-info-footer">
                                <div class="card-info-footer-precio">
                                    <?php if ($product_related[0]->ribbon || !$product_related[0]->base_old_price) : ?>
                                    <p class="cuotas"><?= get_max_installments(); ?> <?= get_installments_string(); ?>
                                    </p>
                                    <p class="price">Sin interés</p>
                                    <?php else : ?>
                                    <p class="cuotas"><?= get_max_installments(); ?> <?= get_installments_string() ?> de
                                    </p>
                                    <p class="price"><?= get_currency_symbol(); ?><?= $product_related[0]->precio ?></p>
                                    <?php endif; ?>
                                </div>
                                <a href="<?= get_the_permalink($curso->ID) ?>"
                                    class="card-info-footer-boton btn btn-mid">Descubrir</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;
                        endif; ?>

                </div>
            </div>

        </div>

        <div class="exclusive">
            <div class="exclusive-cont">
                <img src="<?= get_template_directory_uri() ?>/assets/media/icon/file-lock-outline.svg" alt="">
                <h5>SEGUÍ ESPECIALIZANDOTE</h5>
                <h6>Contenido exclusivo incluido
                    en nuestros planes de
                    estudio para enfermeros</h6>
                <span>Conocé mas sobre todo lo que incluyen nuestras membresias</span>
                <a href="" class="btn btn-big button">QUIERO SABER MÁS</a>
            </div>
        </div>

        <?php if (have_rows('fuentes')) : ?>
        <div class="source">
            <h6 class="source-title">Fuente/s:</h6>
            <?php while (have_rows('fuentes')) : the_row(); ?>
            <p class="source-body">
                <?= get_sub_field('fuente'); ?>
            </p>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <div class="share">
            <div class="tags-cont">

                <?php foreach ($tags_array as $tag) : ?>
                <a href="/magazine/resultados-de-busqueda/?tag=<?= $tag->slug ?>" class="btn btn-mid">
                    <?= $tag->name ?>
                </a>
                <?php endforeach; ?>
            </div>

            <div class="share-buttons">
                <a class="share-btn" href="https://www.facebook.com/sharer.php?u=<?= $actual_link ?>"
                    rel="external noopener nofollow" title="Facebook" target="_blank"
                    data-raw="https://www.facebook.com/sharer.php?u={post_link}">
                    <img src="<?= get_template_directory_uri() ?>/assets/media/icon/share/share-facebook.svg"
                        alt="icono de facebook" class="share-img"></a>

                <a class="share-btn"
                    href="https://twitter.com/intent/tweet?text=<?= $titulo ?>&amp;url=<?= $actual_link ?>"
                    rel="external noopener nofollow" title="Twitter" target="_blank"
                    data-raw="https://twitter.com/intent/tweet?text={post_title}&amp;url={post_link}">
                    <img src="<?= get_template_directory_uri() ?>/assets/media/icon/share/share-twitter.svg"
                        alt="Icono de Twitter" class="share-img"></a>

                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?= $actual_link ?>&amp;title=<?= $titulo ?>
                    rel=" external noopener nofollow" title="LinkedIn" target="_blank"
                    data-raw="https://www.linkedin.com/shareArticle?mini=true&amp;url={post_full_link}&amp;title={post_title}"
                    class="share-btn">
                    <img src="<?= get_template_directory_uri() ?>/assets/media/icon/share/share-linkedin.svg"
                        alt="Icono de Linkedin" class="share-img"></a>

                <a href="https://api.whatsapp.com/send?text=<?= $titulo ?>%20<?= $actual_link ?>"
                    rel="external noopener nofollow" title="WhatsApp" target="_blank" class="share-btn"
                    data-raw="https://api.whatsapp.com/send?text={post_title}%20{post_link}">
                    <img src="<?= get_template_directory_uri() ?>/assets/media/icon/share/share-whatsapp.svg"
                        alt="Icono de WhatsApp" class="share-img"></a>

                <a href="mailto:?subject=<?= $titulo ?>&amp;body=<?= $actual_link ?>" rel="external noopener nofollow"
                    title="Compartir vía correo electrónico" target="_blank" class="email-share-btn"
                    data-raw="mailto:?subject={post_title}&amp;body={post_link}">
                    <img src="<?= get_template_directory_uri() ?>/assets/media/icon/share/share-email.svg"
                        alt="Icono de Mail" class="share-img"></a>

                <a href="javascript:  window.print(); ">
                    <img src="<?= get_template_directory_uri() ?>/assets/media/icon/share/share-print.svg"
                        alt="Icono de Impresora" class="share-img"></a>

            </div>
        </div>

        <div id="related" class="related">
            <article class="related-cont">
                <div class="related-cont-body">
                    <div class="related-cont-top">
                        <h3 class="related-cont-title">ARTICULOS RELACIONADOS</h3>
                    </div>
                    <div class="related-cont-body-grid">

                        <?php foreach ($articulos_relacionados as $articulo) :
                                $imagen = wp_get_attachment_image_src(get_post_thumbnail_id($articulo->ID), 'single-post-thumbnail');
                            ?>
                        <a href="<?= get_the_permalink($articulo->ID) ?>" class="post-item">
                            <div class="post-item-img" style="background: center/cover url(<?= $imagen['0'] ?>);">
                            </div>

                            <h4 class="post-item-title"><?= $articulo->post_title ?></h4>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </article>
        </div>

        <div id="coments" class="coments">
            <div class="coments-cont">
                <div class="coments-cont-top">
                    <h3 class="coments-cont-title">COMENTARIOS</h3>
                </div>
                <div class="coments-cont-body">

                    <?php
                        // If comments are open or there is at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
                        scandir ?>
                </div>
            </div>
        </div>



        <div class="post-cont-side">

            <style>
            .probox {
                border: unset !important;
                background-color: #fdfdfd00 !important;
            }

            .proinput {
                z-index: 2 !important;
                padding-left: 1rem !important;
                -webkit-box-flex: 1 !important;
                -ms-flex-positive: 1 !important;
                flex-grow: 1 !important;
                border: 1px solid #acacac !important;
                border-radius: 50px !important;
                background-color: #fff !important;
                margin: 0 !important;

            }

            .proinput input {

                font-size: 13px !important;
            }

            #ajaxsearchlite1 .probox,
            div.asl_w .probox {
                padding: 10px 0 !important;
                ;
            }
            </style>

            <div class="searchbar">
                <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
            </div>
            <div class="mas-leidas">
                <div class="mas-leidas-cont">
                    <h3 class="mas-leidas-title">LAS MÁS LEÍDAS</h3>

                    <?php
                        $args = array(
                            'post_type'      => 'post',
                            'posts_per_page' => 3,
                            'category_name' => 'Actualidad',
                        );

                        $latest_posts = new WP_Query($args);
                        while ($latest_posts->have_posts()) : $latest_posts->the_post();
                        ?>


                    <div class="card-leida">
                        <span class="card-leida-tag">ACTUALIDAD</span>
                        <a href="<?= get_permalink() ?>">
                            <h4 class="card-leida-title"><?= the_title() ?></h4>
                        </a>
                    </div>

                    <?php endwhile;
                        wp_reset_postdata(); ?>

                </div>
            </div>

            <?php //if(!empty($camposBanners[0]['imagen_magazine']['url'])): 
                ?>
            <?php if (sizeof($camposBanners)) : ?>
            <div id="banner" class="banner">
                <div class="banner-cont">
                    <div class="swiper-banner">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->

                            <?php
                                    foreach ($camposBanners as $banner) :
                                        $imgBanner_Small = $banner['imagen_magazine']['url'];
                                        $imgBanner_mobile = $banner['imagen_mobile']['url'];

                                        if (!$imgBanner_Small) {
                                            continue;
                                        }
                                    ?>
                            <a href="<?= $banner['url_banner'] ?>" class="swiper-slide">
                                <picture>
                                    <source media="(max-width: 480px)" srcset="<?= $imgBanner_mobile ?>">
                                    <source media="(max-width: 768px)" srcset="<?= $imgBanner_mobile ?>">
                                    <source media="(max-width: 1920px)" srcset="<?= $imgBanner_Small ?>">
                                    <img src="<?= $imgBanner_Small ?>" alt="">
                                </picture>
                            </a>
                            <?php endforeach; ?>
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="newsletter">
                <h5>Suscríbete a nuestro newsletter</h5>
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
                                            class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-control"
                                            aria-required="true" aria-invalid="false" placeholder="Ingresá tu email">
                                    </span>
                                    <br>
                                    <button type="submit" class="js-modal-trigger" data-target="modal-newsletter">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </button>

                                </p>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>

<?php
endwhile; // end of the loop. 

get_footer(null, ['type_footer' => 'full']);

?>