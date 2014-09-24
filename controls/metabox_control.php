<?php namespace cahnrswp\cahnrs\easter_egg;
/**
 * Custom meta data inputs
 */

class metabox_control {


	public $field_array;


	public function __construct(){

		\add_action( 'load-post.php',     array( $this, 'metabox_handler' ) );
		\add_action( 'load-post-new.php', array( $this, 'metabox_handler' ) );

	}


	public function metabox_handler(){

		$this->field_array  = $this->define_fields();

		\add_action( 'add_meta_boxes',         array( $this, 'add_meta_box'                ) );
		\add_action( 'edit_form_after_title',  array( $this, 'advanced_meta_box_placement' ) );
		\add_action( 'save_post',              array( $this, 'save'                        ) );

	}


	// Add the meta box containers
	public function add_meta_box( $post_type ) {

		add_meta_box(
			'easter_egg_fields',
			'Easter Egg Info',
			array( $this, 'fields_meta_content' ),
			'easter-egg',
			'advanced',
			'high'
		);

	}


	// Define metabox fields
	public function define_fields() {

		$fields = array(
			'[question]' => 'Question',
			'[answer][0]' => 'Correct Answer',
			'[answer][1]' => 'False Answer',
			'[answer][2]' => 'False Answer',
		);

		return $fields;

	}


	// Add the fields
	public function fields_meta_content( $post ) {

		wp_nonce_field( 'easter_egg_custom_box', 'easter_egg_custom_box_nonce' );

		$value = get_post_meta( $post->ID, '_cahnrs_ee', true );
		$answers = $value['answer'];
		
		echo '<strong><label>Question</label></strong><br />
		<input type="text" name="cahnrs_ee[question]" value="'. esc_attr( $value['question'] ) .'" class="widefat">';

		echo '<strong><label>Correct Answer</label></strong><br />
		<input type="text" name="cahnrs_ee[answer][0]" value="'. esc_attr( $answers[0] ) .'" class="widefat"><br />';

		echo '<strong><label>False Answer</label></strong><br />
		<input type="text" name="cahnrs_ee[answer][1]" value="'. esc_attr( $answers[1] ) .'" class="widefat"><br />';

		echo '<strong><label>False Answer</label></strong><br />
		<input type="text" name="cahnrs_ee[answer][2]" value="'. esc_attr( $answers[2] ) .'" class="widefat"><br />';
/*
		foreach( $this->field_array as $k => $v ) {

			$value = get_post_meta( $post->ID, '_cahnrs_ee' . $k, true );

			echo '<strong><label>' . $v . '</label></strong><br />';
			echo '<input type="text" name="cahnrs_ee' . $k . '" value="'. esc_attr( $value ) .'" class="widefat" /><br />';
			
		}
*/
		echo "<p>Don't forget to add a featured image!</p>";

	}


	// Move all "Advanced" context meta boxes under the Title field
	public function advanced_meta_box_placement() {

    global $post, $wp_meta_boxes;

		if ( $post->post_type == 'easter-egg' ) {

    	do_meta_boxes( get_current_screen(), 'advanced', $post );

    	unset( $wp_meta_boxes['easter-egg']['advanced'] );

		}

	}


	// Save the meta when the post is saved
	public function save( $post_id ) {

		// Verify this came from our screen with proper authorization:

		// Check if our nonce is set
		if ( ! isset( $_POST['easter_egg_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['easter_egg_custom_box_nonce'];

		// Verify that the nonce is valid
		if ( ! wp_verify_nonce( $nonce, 'easter_egg_custom_box' ) )
			return $post_id;

		// If this is an autosave, the form has not been submitted, so don't do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// The user has the capability to edit posts
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		// Sanitize and save the data:
		if ( isset( $_POST['cahnrs_ee'] ) ) {
			$data = $_POST['cahnrs_ee'];
			//update_post_meta( $post_id, '_cahnrs_ee', $data );
			// Until I find something more efficient
			update_post_meta( $post_id, '_cahnrs_ee', array(
				'question' => sanitize_text_field( $data['question'] ),
				'answer'   => array(
					sanitize_text_field( $data['answer'][0] ),
					sanitize_text_field( $data['answer'][1] ),
					sanitize_text_field( $data['answer'][2] ),
				)
			) );
    } else {
			delete_post_meta( $post_id, '_cahnrs_ee' );
    }

	}


}