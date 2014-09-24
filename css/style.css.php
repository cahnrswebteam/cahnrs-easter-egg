<?php
header( 'Content-type: text/css' );

// The Query
$easter_egg_query = new WP_Query( 'post_type=easter-egg&posts_per_page=1' );

// The Loop
if ( $easter_egg_query->have_posts() ) :
	while ( $easter_egg_query->have_posts() ) :
		$easter_egg_query->the_post();
		if( has_post_thumbnail() ) :
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		?>html {
  background: url(<?php echo $image[0]; ?>) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size:    cover;
  -o-background-size:      cover;
  background-size:         cover;
  /*
	-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $image[0]; ?>', sizingMethod='scale')";
	filter:     progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $image[0]; ?>', sizingMethod='scale');
  */
}
body {
	background: none;
}
#cahnrs-global-header sub span,
h1.article-title,
h1.archive-title {
	color: #fff;
}
.pagebuilder-row .pagebuilder-column aside.widget_page_title h1,
.cahrns-dynamic-page-load-wrapper > h2 {
	color: #fff;
}
@media only screen and (min-width: 693px) {

}<?php
		endif;
	endwhile;
endif;
wp_reset_postdata();
?>