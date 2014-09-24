<?php
/**
 * Template for Easter Egg quizzes
 */

$easter_egg_query = new \WP_Query( 'post_type=easter-egg&posts_per_page=1' );
if ( $easter_egg_query->have_posts() ) :
	while ( $easter_egg_query->have_posts() ) :
		$easter_egg_query->the_post();
		if( \has_post_thumbnail() ) :
		?>
<a href="#easter-egg"><img src="<?php echo plugins_url( 'cahnrs-easter-egg' ); ?>/images/icon.png" alt="You found the CAHNRS easter egg" width="16" height="16" /></a>
<!--[if (IE 8)|(IE 7)]><div id="cahnrs-ee-ie"><?php
if( has_post_thumbnail() ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	echo '<img src="' . $image[0] . '" />';
}
?></div><![endif]-->
<!-- easteregg -->
<div id="easter-egg" data-title="<?php the_title(); ?>">
<?php
	$data = get_post_meta( get_the_ID(), '_cahnrs_ee', true );
	
	if( $data['question'] ) echo '<p>' . esc_html( $data['question'] ) . '</p>';
	
	if( $data['answer'] ) :
		$answers = array();
		$i = 1;
		foreach ( $data['answer'] as $answer ) {
    	$answers[] =  '<li><label><input type="radio" name="quiz-answer" value="' . $i . '" /> ' . esc_html( $answer ) . '</label></li>';
			$i++;
		}
		shuffle( $answers );
		echo '<ul>';
		foreach ( $answers as $answer ) {
			echo $answer;
		}
		echo '</ul>';
  endif;
?>
	<div id="easter-egg-note">
		<h4 class="answer correct">Correct!</h4>
		<h4 class="answer incorrect">Incorrect</h4>
		<?php the_content(); ?>
	</div>
</div>
<!-- easteregg -->
		<?php
		endif;
	endwhile;
endif;

?>
