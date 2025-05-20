<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>

<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<meta name="p:domain_verify" content="cdc6861554d64a285810169775cf758c"/>


<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>

<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium-thumb' ); ?>

<meta property="og:image" content="<?php echo $thumb['0']; ?>" />

<?php } ?>



<title><?php wp_title( '-', true, 'right' ); ?></title>



<?php if(get_option('mvp_favicon')) { ?><link rel="shortcut icon" href="<?php echo get_option('mvp_favicon'); ?>" /><?php } ?>

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />

<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>



<?php $analytics = get_option('mvp_tracking'); if ($analytics) { echo stripslashes($analytics); } ?>


<?php wp_head(); ?>

<?php // Smart AdServer Setup ?>
<script src='https://www5.smartadserver.com/config.js?nwid=2098' type="text/javascript"></script>
<script type="text/javascript">
    sas.setup({ domain: 'https://www5.smartadserver.com'});
</script>
<?php 
$currentid = get_queried_object();
if (is_category()) {
	$thisid = $currentid->term_id;
	$category = get_category($thisid);
	$taxonomy = 'category';
	if ($category->category_parent > 0){
		$catancestors = get_ancestors( $thisid, 'category' );
		$topancestor = $catancestors[0];
		$topancestorname = get_cat_name($topancestor);
		$pageid = get_field('sas_pageid', $taxonomy . '_' . $topancestor);
	} else {
		$pageid = get_field('sas_pageid', $taxonomy . '_' . $thisid);
	}
} else if (is_page()) {
	$pageid = get_field('sas_pageid');
} else if ( is_post_type_archive('events') || is_singular( 'events' ) ) {
	$pageid = '778335';
} else if ( is_singular( 'magazine' ) ) {
	$pageid = '778335';
} else if (is_single()) {
	$categories = get_the_category();
	$taxonomy = 'category';
	$catid = $categories[0]->term_id;
	$topparent = pa_category_top_parent_id($catid);
	$pageid = get_field('sas_pageid', $taxonomy . '_' . $topparent);
	$targettag = 'articleid=' . get_the_id() ;
}
// 53147 THF_Bottom_MREC 300x250
// 53145 THF_Magazine_Bottom 970x90
// 53144 THF_Top_Banner (970x360) 970x360
// 53146 THF_Top_MREC 300x250
?>

<script type="text/javascript">
	sas.call("onecall", {
	<?php 
	$code = 'siteId: 	149086,
	pageId: 	' . $pageid . ',
	formatId:	\'53147,53144,53146,53145\',
	target: 	\''. $targettag . '\'
	';
	echo $code;
	?>
	});
</script>

<style type="text/css">

<?php $customcss = get_option('mvp_customcss'); if ($customcss) { echo stripslashes($customcss); } ?>

</style>


<script type='text/javascript' src='https://www.tnhomeandfarm.com/wp-content/themes/thf-child/js/libs/modernizr.custom.min.js'></script>

<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'none')
          e.style.display = 'block';
          e.style.height = '50px';
       else
          e.style.display = 'none';
    }
//-->
</script>

<?php if (is_mobile()) { ?>
	<style>
	.woobox-offer {
		max-width:280px !important;
		margin-left:0px !important;
	}
	</style>
<?php } ?>

</head>

<body <?php body_class(); ?>>
<div id="site">
	<?php get_template_part('fly-menu'); ?>
	<div id="nav-wrapper">
		<div class="nav-wrap-out">
		<div class="nav-wrap-in">
			<div id="nav-inner">
				<div class="fly-but-wrap left relative" style="margin-top:4px;">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div><!--fly-but-wrap-->
			<?php $mvp_logo_loc = get_option('mvp_logo_loc'); if($mvp_logo_loc == 'Left of leaderboard' || $mvp_logo_loc == 'Wide below leaderboard') { ?>
				<div class="logo-small-fade" itemscope itemtype="http://schema.org/Organization">
					<?php if(get_option('mvp_logo')) { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('mvp_logo_nav'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } else { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-small.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } ?>
				</div><!--logo-small-fade-->
			<?php } else { ?>
				<div id="logo-small" itemscope itemtype="http://schema.org/Organization">
					<?php if(get_option('mvp_logo')) { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('mvp_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } else { ?>
						<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-small.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php } ?>
				</div><!--logo-small-->
			<?php } ?>
			<div id="main-nav">
				<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
			</div><!--main-nav-->
			<div id="search-button">
				<img src="<?php echo get_template_directory_uri(); ?>/images/search-icon.png" />
			</div><!--search-button-->
			<div id="search-bar">
				<?php get_search_form(); ?>
			</div><!--search-bar-->
			</div><!--nav-inner-->
		</div><!--nav-wrap-in-->
		</div><!--nav-wrap-out-->
	</div><!--nav-wrapper-->	
	<div id="body-wrapper">

		<?php if ( is_home() || is_front_page() ) { ?>
		<?php if(get_option('mvp_wall_ad')) { ?>
		<div id="wallpaper">
			<?php if(get_option('mvp_wall_url')) { ?>
			<a href="<?php echo get_option('mvp_wall_url'); ?>" class="wallpaper-link" target="_blank"></a>
			<?php } ?>
		</div><!--wallpaper-->
		<?php } ?>
		<?php } ?>

		<div id="main-wrapper">
		
				<img id="print-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/thf-print-logo.jpg" />

				<div id="leaderboard-wrapper" class="logo-header">

<div id="sas_53144"></div>
<script>
    sas.cmd.push(function() {
        sas.render("53144");  // Format : THF_Top_Banner (970x360) 970x360
    });
</script>

				</div><!--leaderboard-wrapper-->
