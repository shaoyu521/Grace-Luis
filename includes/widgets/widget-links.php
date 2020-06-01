<?php
add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_Theme_Links");'));

class WP_Widget_Theme_Links extends WP_Widget {

	public function __construct() {
		$widget_ops = array('description' => '显示友情链接' );
		parent::__construct('links', '友情链接', $widget_ops);
	}

	public function widget( $args, $instance ) {
		$category = isset($instance['category']) ? $instance['category'] : false;
		$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : 'name';
		$order = $orderby == 'rating' ? 'DESC' : 'ASC';
		$limit = isset( $instance['limit'] ) ? $instance['limit'] : -1;
		$title = isset($instance['title']) ? $instance['title'] : '友情链接';

		$before_widget = preg_replace( '/id="[^"]*"/', 'id="%id"', $args['before_widget'] );

		$widget_links_args = array(
			'title_before'     => $args['before_title'],
			'title_after'      => $args['after_title'],
			'category_before'  => $before_widget,
			'category_after'   => $args['after_widget'],
			'category'         => $category,
			'show_images'      => false,
			'categorize'       => 0,
			'class'            => 'linkcat widget',
			'orderby'          => $orderby,
			'order'            => $order,
			'limit'            => $limit,
			'title_li'         =>$title,
		);

		wp_list_bookmarks( $widget_links_args );
	}

	public function update( $new_instance, $old_instance ) {
		$new_instance = (array) $new_instance;
		$instance = array();
		foreach ( $instance as $field => $val ) {
			if ( isset($new_instance[$field]) )
				$instance[$field] = 1;
		}

		$instance['orderby'] = 'name';
		if ( in_array( $new_instance['orderby'], array( 'name', 'rating', 'id', 'rand' ) ) )
			$instance['orderby'] = $new_instance['orderby'];

		$instance['category'] = intval( $new_instance['category'] );
		$instance['limit'] = ! empty( $new_instance['limit'] ) ? intval( $new_instance['limit'] ) : -1;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	public function form( $instance ) {

		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title'=>'友情链接','images' => true, 'name' => true, 'description' => false, 'rating' => false, 'category' => false, 'orderby' => 'name', 'limit' => -1 ) );
		$title = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '友情链接';
		$link_cats = get_terms( 'link_category' );
		if ( ! $limit = intval( $instance['limit'] ) )
			$limit = -1;
			?>
		<p>
			<label>标题：
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</label>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e( '选择链接分类目录：' ); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>">
		<option value=""><?php _ex('All Links', 'links widget'); ?></option>
		<?php
		foreach ( $link_cats as $link_cat ) {
			echo '<option value="' . intval( $link_cat->term_id ) . '"'
				. selected( $instance['category'], $link_cat->term_id, false )
				. '>' . $link_cat->name . "</option>\n";
		}
		?>
		</select>
		<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e( '排序依据：' ); ?></label>
		<select name="<?php echo $this->get_field_name('orderby'); ?>" id="<?php echo $this->get_field_id('orderby'); ?>" class="widefat">
			<option value="name"<?php selected( $instance['orderby'], 'name' ); ?>><?php _e( 'Link title' ); ?></option>
			<option value="rating"<?php selected( $instance['orderby'], 'rating' ); ?>><?php _e( 'Link rating' ); ?></option>
			<option value="id"<?php selected( $instance['orderby'], 'id' ); ?>><?php _e( 'Link ID' ); ?></option>
			<option value="rand"<?php selected( $instance['orderby'], 'rand' ); ?>><?php _ex( 'Random', 'Links widget' ); ?></option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( '显示链接数：' ); ?></label>
		<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $limit == -1 ? '' : intval( $limit ); ?>" size="3" />
		</p>
		<?php
	}
}
