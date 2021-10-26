<?php

/**
 * Field Widget
 *
 * Shows content of an ACF field as a widget
 *
 * Title field can be ACF field name (or will be displayed as-is if no data found for field name)
 * Data field should be an ACF field name
 *
 * If page is not singular (or data field yields nothing) the widget will not show
 */

class FieldWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'field',
			'Field',
			array( 'description' => __( 'Field widget', 'emuzone' ), )
		);
	}

	/**
     * Retrieves data from ACF field with name $field
     *
	 * @param string $field Data field name
	 *
	 * @return mixed|null Yields data (should be string) or null if not found
	 */
    public function get_acf_data ( string $field ) {
        // First attempt to get data from current post/page
        $post = get_the_ID();
        $data = get_field ( $field, $post );
        if ( !empty( $data ) )
            return $data;

        // If above failed, try to get data from parent post/page
        $parent = wp_get_post_parent_id( $post );
        if ( !empty($parent) ) {
            $data = get_field ( $field, $parent );
            if ( !empty( $data ) )
                return $data;
        }

        // Nothing found
        return null;
    }

	/**
     * Displays wiget output
     *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$title_field =  $instance['title'] ?? null;
        $data_field = $instance[ 'field' ] ?? null;
        // "title" value is required (will cause errors if empty)
		if ( empty( $title_field ) ) {
			echo '<div class="alert alert-danger" role="alert">title field cannot be empty</div>';
			return;
		}
        // "field" value is required (will cause errors if empty)
        if ( empty( $data_field ) ) {
            echo '<div class="alert alert-danger" role="alert">data field cannot be empty</div>';
            return;
        }

        // This widget should not return anything if not a singular post or page (hide on category pages)
        if ( !is_singular() )
            return;

        // Get title/data fields
        $title = $this->get_acf_data( $title_field );
        $data = $this->get_acf_data( $data_field );
        // If "data" field is empty, don't show anything
        if ( empty( $data ) )
            return;
        // If "title" field returns no data, assume it is not a field but a literal string
        if ( empty($title) )
            $title = $title_field;

        ?>
            <h2 class="widget-title"><?php echo $title; ?></h2>
            <?php echo $data; ?>
        <?php
	}

	/**
     * Widget options form
     *
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		$title = '';
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		$field = '';
		if ( isset( $instance[ 'field' ] ) ) {
			$field = $instance[ 'field' ];
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title Field:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_name( 'field' ); ?>"><?php _e( 'Data Field:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'field' ); ?>" name="<?php echo $this->get_field_name( 'field' ); ?>" type="text" value="<?php echo esc_attr( $field ); ?>" />
		</p>
		<?php
	}

	/**
     * Widget options form validation/sanitation
     *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( isset( $new_instance [ 'title' ] ) && !empty( $new_instance [ 'title' ] ) )
		{
			$instance[ 'title' ] = trim( $new_instance[ 'title' ] );
		}
		if ( isset( $new_instance [ 'field' ] ) && !empty( $new_instance [ 'field' ] ) )
		{
			$instance[ 'field' ] = strtolower( trim( $new_instance[ 'field' ] ) );
		}
		return $instance;
	}
}
