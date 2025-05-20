<?php 
$featured = get_field('featured_article');
$left = get_field('left_article');

$right = get_field('right_article');

$background = get_field('hero_background');
// print_r($featured);
?>
<div class="hp-hero" style=" background-image: url('<?php echo $background ? $background['url'] : '' ; ?>')">

    <div class="container">
    <?php if ($featured): 
            $featured_cat = get_the_category($featured->ID); 
            $primary_featured_cat = get_post_meta($featured->ID ,'_yoast_wpseo_primary_category', TRUE ); 
            $featured_cat_name = $primary_featured_cat ? get_the_category_by_ID($primary_featured_cat) : $featured_cat[0]->name;
            $featured_cat_link = $primary_featured_cat ? get_category_link( $primary_featured_cat ) : get_category_link($featured_cat[0]->term_id);
        ?>
        <div class="hp-hero__item featured">
            <div class="hp-hero__img-container">
                <a class="object-fit-image" href="<?php echo get_the_permalink( $featured->ID); ?>">
                <?php echo get_the_post_thumbnail( $featured->ID, 'full' ); ?>
                </a>
            </div>
            <div class="hp-hero__text-container">
                <p class="fff-category"><?php echo '<a class="unstyle-link" href="'.$featured_cat_link.'">'.$featured_cat_name.'</a>'; ?></p>
                <h2><a class="unstyle-link" href="<?php echo get_the_permalink( $featured->ID); ?>"><?php echo $featured->post_title;  ?></a></h2>
                <p class="hp-hero__excerpt"><?php echo get_the_excerpt( $featured->ID ); ?></p>
                <a href="<?php echo get_the_permalink( $featured->ID); ?>"><button>Read More</button></a>
            </div>
        </div>
        <?php  endif; // if featured ?>
        <div class="row">
            <?php 
                 if ($left): 
                    $left_cat = get_the_category($left->ID); 
                    $primary_left_cat = get_post_meta($left->ID ,'_yoast_wpseo_primary_category', TRUE ); 
                    $left_cat_name = $primary_left_cat ? get_the_category_by_ID($primary_left_cat) : $left_cat[0]->name;
                    $left_cat_link = $primary_left_cat ? get_category_link( $primary_left_cat ) : get_category_link($left_cat[0]->term_id);
            ?>
            <div class="col-12 l-col-6">
                <div class="hp-hero__item">
                    <div class="hp-hero__img-container">
                        <a class="object-fit-image" href="<?php echo get_the_permalink( $left->ID); ?>">
                        <?php echo get_the_post_thumbnail( $left->ID, 'full' ); ?>
                        </a>
                    </div>
                    <div class="hp-hero__text-container">
                        <p class="fff-category"><?php echo '<a class="unstyle-link" href="'.$left_cat_link.'">'.$left_cat_name.'</a>'; ?></p>
                        <h3><a class="unstyle-link" href="<?php echo get_the_permalink( $left->ID); ?>"><?php echo $left->post_title;  ?></a></h3>
                    </div>
                </div>
            </div>
            <?php endif; //end left
            if ($right):
                $right_cat = get_the_category($right->ID); 
                $primary_right_cat = get_post_meta($right->ID ,'_yoast_wpseo_primary_category', TRUE ); 
                $right_cat_name = $primary_right_cat ? get_the_category_by_ID($primary_right_cat) : $right_cat[0]->name;
                $right_cat_link = $primary_right_cat ? get_category_link( $primary_right_cat ) : get_category_link($right_cat[0]->term_id);
            ?>
            <div class="col-12 l-col-6">
                <div class="hp-hero__item">
                    <div class="hp-hero__img-container">
                        <a class="object-fit-image" href="<?php echo get_the_permalink( $right->ID); ?>">
                        <?php echo get_the_post_thumbnail( $right->ID, 'full' ); ?>
                        </a>
                    </div>
                    <div class="hp-hero__text-container">
                        <p class="fff-category"><?php echo '<a class="unstyle-link" href="'.$right_cat_link.'">'.$right_cat_name.'</a>'; ?></p>
                        <h3><a class="unstyle-link" href="<?php echo get_the_permalink( $right->ID); ?>"><?php echo $right->post_title;  ?></a></h3>
                    </div>
                </div>
            </div>
            <?php endif; //end right ?>
        </div>
    </div>
</div> 