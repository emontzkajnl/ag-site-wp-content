<?php 
// mag-footer
$magPost = get_posts(array(
    'number_posts'      => 1,
    'post_type'         => 'magazine',
    'post_status'       => 'publish'
));
$magPost = $magPost[0];



?>
<div class="mag-footer">
    <div class="container mag-footer__container">

        <?php echo '<a href="'.site_url( 'magazine').'">'.get_the_post_thumbnail( $magPost->ID, 'post-thumbnail' ,array('style' => 'width: auto; height: 150px;')).'</a>'; ?>
        <div class="mag-footer__mag-text">
            <h3 class="handwritten">Read the Magazine</h3>
            <p><em>Mississippi Farm Country</em> is a magazine for Mississippi Farm Bureau Members.</p>
            <a href="<?php echo site_url( 'magazine'); ?>"><button class="mag-footer__cta">Check out the latest issue</button></a>
        </div>

    </div>
</div>