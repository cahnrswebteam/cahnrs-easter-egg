<?php namespace cahnrswp\cahnrs\easter_egg;

class scripts_control {


	public function __construct() {

		\add_action( 'wp_enqueue_scripts',         array( $this, 'public_queues' ), 9999 );
		\add_action( 'wp_ajax_dynamic_css',        array( $this, 'dynamic_css'   )       );
		\add_action( 'wp_ajax_nopriv_dynamic_css', array( $this, 'dynamic_css'   )       );

	}


	public function public_queues() {

		\wp_enqueue_style( 'cahnrs-ee',         URL . 'css/style.css'                                        );
		\wp_enqueue_style( 'cahnrs-dynamic-ee', admin_url('admin-ajax.php') . '?action=dynamic_css', array() );
		\wp_enqueue_script( 'ui-dialog',        URL . 'js/scripts.js', array( 'jquery', 'jquery-ui-dialog' ) );

	}


	public function dynamic_css() {

		require_once( DIR . '/css/style.css.php' );
		exit;

	}


}