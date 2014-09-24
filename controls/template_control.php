<?php namespace cahnrswp\cahnrs\easter_egg;

class template_control {


	public function __construct() {

		\add_action( 'wp_footer', array( $this, 'templates' ), 1 );

	}

	public function templates() {

		if ( \wp_is_mobile() == false )
			include( DIR . 'views/single.php' ); // not sure the best way to do this

	}
}