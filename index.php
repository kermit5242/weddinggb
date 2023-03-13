<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Gemstones&family=Rubik:wght@300&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body data-actionurl="<?php echo admin_url('admin-ajax.php?action=get_search'); ?>" <?php body_class(); ?>>
<div id="wrppaer">
<header class="page-header wz_slideshow_holder">
    <?php echo do_shortcode('[smartslider3 slider="2"]'); ?>
</header>
<!-- Portfolio Newspaper Filter -->
<div class="otw_portfolio_manager-portfolio-newspaper-filter otw-row">
    <ul class="option-set otw_portfolio_manager-portfolio-filter clearfix">
        <li><a href="#" data-filter=".getting-ready">מתכוננים</a></li>
        <li><a href="#" data-filter=".huppah">הופה - חופה!</a></li>
        <li><a href="#" data-filter=".white-night">לילה לבן</a></li>
        <li><a href="#" data-filter="*" class="selected">תראה לי הכל</a></li>
    </ul>
</div>
<!-- End Portfolio Newspaper Filter -->


<!-- End Portfolio Newspaper Sort -->
<article <?php post_class(); ?>>
    <div class="otw-row">
            <!-- Only Images (without space) - 2 columns - Newspaper Layout -->
            <div class="otw-row otw_portfolio_manager-portfolio-items-holder otw_portfolio_manager-portfolio-newspaper without-space otw_portfolio_manager-infinite-scroll">
<?php while (have_posts()) : the_post(); ?>
    
    <?php
    $gallery = get_post_gallery( get_the_ID(), false );
    if (is_array($gallery) && !empty($gallery)) {
        ?>
        
        <?php
        $gallery_ids = explode(',',$gallery['ids']);
        foreach($gallery_ids as $img_id) {
            $img_src = wp_get_attachment_image_src($img_id, 'medium');
            $img_thumb = wp_get_attachment_image_src($img_id, 'medium');
            $img_full = wp_get_attachment_image_src($img_id, 'fullsize');
            $img_title = get_post_meta($img_id,'_wp_attachment_image_alt',true);
            $cssclass = $post -> post_name;
            ?>
            <!--
                2 columns - otw-twelve
                3 columns - otw-eight
                4 columns - otw-six
             -->
            <div class="otw-six otw-columns otw_portfolio_manager-portfolio-newspaper-item cat1 cat3 <?php echo $cssclass; ?>" data-title="Portfolio Title 1" data-date="2013-07-28">
                <div class="otw_portfolio_manager-portfolio-full only-media otw_portfolio_manager-hover-effect-6">
					<!-- Portfolio Media -->
					<figure class="otw_portfolio_manager-portfolio-media otw_portfolio_manager-format-image">
						<a rel="<?php echo $cssclass; ?>" href="<?php echo $img_full[0]; ?>" class="otw_portfolio_manager-fancybox-img"><img src="<?php echo $img_thumb[0]; ?>" width="500" height="380" alt="" data-item="media"></a>
							<!-- Portfolio Overlay -->
							<div class="otw_portfolio_manager-portfolio-overlay">
								<div class="otw_portfolio_manager-valign-middle">
									<!-- End Portfolio Icons -->
									<!-- Portfolio Title & Info -->
									<div class="otw_portfolio_manager-portfolio-text">
										<h3 class="otw_portfolio_manager-portfolio-title"><?php echo $img_title; ?></h3>
										<!--<div class="otw_portfolio_manager-portfolio-meta-item">
											<a href="#" rel="tag">Category 1</a>
										</div>-->
									</div>
									<!-- End Portfolio Title & Info -->
								</div>
							</div>
							<!-- End Portfolio Overlay -->
						</figure>
						<!-- End Portfolio Media -->
					</div>
				</div>
            <?php
        }
        ?>
           
        <?php
    }
    else {
        the_content();
    }
    ?> 
<?php endwhile; ?>
</div>
    </div>
    </article>
</div>
<footer class="content-info site_footer">
    <div class="container">
        <div class="widget_holder">
            <?php dynamic_sidebar('sidebar-footer'); ?>
        </div>
    </div>
    <p class="credits"><?php _e('עיצוב והקמה'); ?>: ZOOG Interactive <a href="http://www.wwz.co.il" target="_blank">בניית אתרים</a></p>
</footer>
<?php wp_footer(); ?>
</div>
</body>
</html>