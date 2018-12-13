<?php
/**
 * Template: `Featured Properties - Homepage'
 *
 * @package RH/classic
 * @since   2.6.4
 */


/* Featured Properties Query Arguments */
$featured_properties_args = array(
    'post_type'         => 'property',
    'posts_per_page'    => 12,
    'meta_query'        => array(
        array(
            'key'       => 'REAL_HOMES_featured',
            'value'     => 1,
            'compare'   => '=',
            'type'      => 'NUMERIC'
        )
    )
);

$featured_properties_query      = new WP_Query($featured_properties_args);

$featured_properties_variation  = get_option('inspiry_featured_properties_variation');

/* For demo purpose only */
if (isset($_GET[ 'featured_variation' ])) {
    $featured_properties_variation  = $_GET[ 'featured_variation' ];
}

$featured_properties_variation  = (! empty($featured_properties_variation)) ? $featured_properties_variation : false;

if ($featured_properties_query->have_posts()) :

    if (! empty($featured_properties_variation) && 'one_property_slide' == $featured_properties_variation) :

    ?>

        <div class="container">

            <div class="row">

                <div class="span12">

                    <section id="rh_featured_properties" class="clearfix">

                        <?php
                        $featured_prop_title    = get_option('theme_featured_prop_title');
                        $featured_prop_text     = get_option('theme_featured_prop_text');

                        if (! empty($featured_prop_title)) {
                            ?>
                            <div class="narrative">
                               <h3><?php echo esc_html($featured_prop_title); ?></h3>
                                <?php
                                if (! empty($featured_prop_text)) {
                                    ?><p><?php echo esc_html($featured_prop_text); ?></p><?php

                                } ?>
                            </div>
                            <?php

                        }

                        ?>

                        <div class="rh_featured_properties__slider loading">

                            <ul class="slides">

                                <?php
                                while ($featured_properties_query->have_posts()) :
                                    $featured_properties_query->the_post();
                                    ?>
                                    <li class="rh_featured_properties__slide">

                                        <div class="rh_slide__container clearfix">

                                            <figure class="span6 rh_slide__image">
                                                <div class="wrapper">
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                        <?php
                                                        if (has_post_thumbnail()) {
                                                            the_post_thumbnail('property-detail-slider-image-two');
                                                        } else {
                                                            inspiry_image_placeholder('property-detail-slider-image-two');
                                                        }
                                                        ?>
                                                    </a>
                                                    <?php
                                                    $statuses = inspiry_get_property_status($post->ID);
                                                    if (! empty($statuses)) : ?>
                                                        <div class="statuses">
                                                            <?php echo $statuses; ?>
                                                        </div>
                                                        <!-- /.statuses -->
                                                        <?php
                                                    endif;
                                                    ?>
                                                </div>
                                                <!-- /.wrapper -->
                                            </figure>
                                            <!-- /.rh_slide__image -->

                                            <div class="span5 rh_slide__details">

                                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                                <div class="rh_prop_details clearfix">
                                                    <div class="rh_prop_details__price">
                                                        <p class="price"><?php echo get_property_price(); ?></p>
                                                        <p class="type"><?php echo inspiry_get_property_types_string(get_the_id()); ?></p>
                                                    </div>
                                                    <!-- /.rh_prop_details__price -->
                                                    <div class="rh_prop_details__buttons">
                                                        <a href="<?php the_permalink() ?>"><?php _e('More Details', 'framework'); ?></a>
                                                        <?php
                                                        $images_count   = inspiry_get_number_of_photos(get_the_id());
                                                        $images_count   = (! empty($images_count)) ? intval($images_count) : false;
                                                        $images_str     = (1 < $images_count) ? __('Photos', 'framework') : __('Photo', 'framework');
                                                        ?>

                                                        <?php if (! empty($images_count)) : ?>
                                                            <p class="photos">
                                                                <span class="fa fa-camera"></span>
                                                                <span><?php echo $images_count . ' ' . $images_str; ?></span>
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <!-- /.rh_prop_details__buttons -->
                                                </div>
                                                <!-- /.rh_prop_details -->

                                                <p class="excerpt"><?php framework_excerpt(20); ?></p>

                                                <div class="rh_prop_meta">

                                                    <?php
                                                    $post_meta_data = get_post_custom(get_the_id()); // Get post meta
                                                    $prop_size      = (isset($post_meta_data[ 'REAL_HOMES_property_size' ][0])) ? $post_meta_data[ 'REAL_HOMES_property_size' ][0] : false; // Property Size
                                                    $prop_bedrooms  = (isset($post_meta_data[ 'REAL_HOMES_property_bedrooms' ][0])) ? $post_meta_data[ 'REAL_HOMES_property_bedrooms' ][0] : false; // Property Bedrooms
                                                    $prop_bathrooms = (isset($post_meta_data[ 'REAL_HOMES_property_bathrooms' ][0])) ? $post_meta_data[ 'REAL_HOMES_property_bathrooms' ][0] : false; // Property Bathrooms

                                                    $prop_size      = (! empty($prop_size)) ? floatval($prop_size) : false;
                                                    $prop_bedrooms  = (! empty($prop_bedrooms)) ? floatval($prop_bedrooms) : false;
                                                    $prop_bathrooms = (! empty($prop_bathrooms)) ? floatval($prop_bathrooms) : false;
                                                    ?>

                                                    <?php if (! empty($prop_size)) : ?>
                                                        <div class="rh_prop_meta__single">
                                                            <span class="icon">
                                                                <?php include( INSPIRY_THEME_DIR . '/images/icon-area.svg' ); ?>
                                                            </span>
                                                            <p class="details">
                                                                <span class="number"> <?php echo esc_html( $prop_size ); ?> </span>
                                                                <?php if (! empty($post_meta_data[ 'REAL_HOMES_property_size_postfix' ][0])) : ?>
                                                                    <span>
                                                                        <?php echo esc_html( $post_meta_data[ 'REAL_HOMES_property_size_postfix' ][0] ); ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </p>
                                                            <!-- /.details Area -->
                                                        </div>
                                                        <!-- /.rh_prop_meta__single -->
                                                    <?php endif; ?>

                                                    <?php if (! empty($prop_bedrooms)) : ?>
                                                        <div class="rh_prop_meta__single">
                                                            <span class="icon">
                                                                <?php include( INSPIRY_THEME_DIR . '/images/icon-bed.svg' ); ?>
                                                            </span>
                                                            <p class="details">
                                                                <span class="number"> <?php echo esc_html( $prop_bedrooms ); ?> </span>
                                                                <span>
                                                                    <?php ($prop_bedrooms > 1) ? _e('Bedrooms', 'framework') : _e('Bedroom', 'framework'); ?>
                                                                </span>
                                                            </p>
                                                            <!-- /.details Bedroom -->
                                                        </div>
                                                        <!-- /.rh_prop_meta__single -->
                                                    <?php endif; ?>

                                                    <?php if (! empty($prop_bathrooms)) : ?>
                                                        <div class="rh_prop_meta__single">
                                                            <span class="icon">
                                                                <?php include( INSPIRY_THEME_DIR . '/images/icon-bath.svg' ); ?>
                                                            </span>
                                                            <p class="details">
                                                                <span class="number"> <?php echo esc_html( $prop_bathrooms ); ?> </span>
                                                                <span>
                                                                    <?php ($prop_bathrooms > 1) ? _e('Bathrooms', 'framework') : _e('Bathroom', 'framework'); ?>
                                                                </span>
                                                            </p>
                                                            <!-- /.details Bathroom -->
                                                        </div>
                                                        <!-- /.rh_prop_meta__single -->
                                                    <?php endif; ?>

                                                </div>
                                                <!-- /.rh_prop_meta -->

                                            </div>
                                            <!-- /.rh_slide__details -->

                                        </div>
                                        <!-- /.rh_slide__container -->

                                    </li>
                                    <!-- /.rh_featured_properties__slide -->
                                    <?php
                                endwhile;
                                ?>

                            </ul>
                            <!-- /.slides -->

                        </div>
                        <!-- /.rh_featured_properties__slider loading -->

                    </section>
                    <!-- /#rh_featured_properties.clearfix -->

                </div>
                <!-- /.span12 -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    <?php else : ?>

        <div class="container">

            <div class="row">

                <div class="span12">

                    <div class="main">

                        <section class="featured-properties-carousel clearfix">

                            <?php
                            $featured_prop_title    = get_option('theme_featured_prop_title');
                            $featured_prop_text     = get_option('theme_featured_prop_text');

                            if (! empty($featured_prop_title)) {
                                ?>
                                <div class="narrative">
                                   <h3><?php echo esc_html($featured_prop_title); ?></h3>
                                    <?php
                                    if (! empty($featured_prop_text)) {
                                        global $inspiry_allowed_tags;
                                        ?><p><?php echo wp_kses( $featured_prop_text, $inspiry_allowed_tags ); ?></p><?php

                                    } ?>
                                </div>
                                <?php

                            }

                            ?>
                            <div class="carousel es-carousel-wrapper">
                                <div class="es-carousel">
                                    <ul class="clearfix">
                                        <?php
                                        while ($featured_properties_query->have_posts()) :
                                            $featured_properties_query->the_post();
                                            ?>
                                            <li>
                                                <figure>
                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                        <?php
                                                        if (has_post_thumbnail()) {
                                                            the_post_thumbnail('property-thumb-image');
                                                        } else {
                                                            inspiry_image_placeholder('property-thumb-image');
                                                        }
                                                        ?>
                                                    </a>
                                                </figure>
                                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                <p>
                                                    <?php
                                                        framework_excerpt(8);
                                                        $button_label = get_option( 'inspiry_string_know_more',  __('Know More', 'framework') );
                                                    ?> <a href="<?php the_permalink() ?>"> <?php echo esc_html( $button_label ); ?> </a>
                                                </p>
                                                <?php
                                                $price = get_property_price();
                                                if ($price) {
                                                    echo '<span class="price">'.$price.'</span>';
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        endwhile;
                                        wp_reset_query();
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </section>

                    </div>
                    <!-- /.main -->

                </div>
                <!-- /.span12 -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    <?php

    endif;

endif;
?>
