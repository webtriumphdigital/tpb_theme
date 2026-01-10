<?php

class Justhome_Widget_Property_List extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'apus_widget_property_list',
            esc_html__('Apus Simple Properties List', 'justhome'),
            array( 'description' => esc_html__( 'Show list of property', 'justhome' ), )
        );
        $this->widgetName = 'property_list';
    }
    
    public function widget( $args, $instance ) {
        get_template_part('widgets/property-list', '', array('args' => $args, 'instance' => $instance));
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Latest Properties',
            'number_post' => '4',
            'orderby' => '',
            'order' => '',
            'get_properties_by' => 'recent',
            'style' => 'grid',
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        // Widget admin form
        $orderbys = array(
            '' => esc_html__('Default', 'justhome'),
            'date' => esc_html__('Date', 'justhome'),
            'ID' => esc_html__('ID', 'justhome'),
            'author' => esc_html__('Author', 'justhome'),
            'title' => esc_html__('Title', 'justhome'),
            'modified' => esc_html__('Modified', 'justhome'),
            'rand' => esc_html__('Random', 'justhome'),
            'comment_count' => esc_html__('Comment count', 'justhome'),
            'menu_order' => esc_html__('Menu order', 'justhome'),
        );
        $orders = array(
            '' => esc_html__('Default', 'justhome'),
            'ASC' => esc_html__('Ascending', 'justhome'),
            'DESC' => esc_html__('Descending', 'justhome'),
        );
        $get_properties_bys = array(
            'featured' => esc_html__('Featured Properties', 'justhome'),
            'urgent' => esc_html__('Urgent Properties', 'justhome'),
            'recent' => esc_html__('Recent Properties', 'justhome'),
        );

        $style = array(
            'grid' => esc_html__('Grid', 'justhome'),
            'list' => esc_html__('List', 'justhome'),
        );

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'justhome' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>">
                <?php echo esc_html__('Order By:', 'justhome' ); ?>
            </label>
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
                <?php foreach ($orderbys as $key => $title) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected($instance['orderby'], $key); ?> ><?php echo esc_html( $title ); ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order')); ?>">
                <?php echo esc_html__('Order:', 'justhome' ); ?>
            </label>
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('order')); ?>" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
                <?php foreach ($orders as $key => $title) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected($instance['order'], $key); ?> ><?php echo esc_html( $title ); ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('get_properties_by')); ?>">
                <?php echo esc_html__('Get properties by:', 'justhome' ); ?>
            </label>
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('get_properties_by')); ?>" name="<?php echo esc_attr($this->get_field_name('get_properties_by')); ?>">
                <?php foreach ($get_properties_bys as $key => $title) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected($instance['get_properties_by'], $key); ?> ><?php echo esc_html( $title ); ?></option>
                <?php } ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('style')); ?>">
                <?php echo esc_html__('Style:', 'justhome' ); ?>
            </label>
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('style')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>">
                <?php foreach ($style as $key => $title) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected($instance['style'], $key); ?> ><?php echo esc_html( $title ); ?></option>
                <?php } ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'number_post' )); ?>"><?php esc_html_e( 'Num Posts:', 'justhome' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_post' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_post' )); ?>" type="text" value="<?php echo esc_attr($instance['number_post']); ?>" />
        </p>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number_post'] = ( ! empty( $new_instance['number_post'] ) ) ? strip_tags( $new_instance['number_post'] ) : '';
        $instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
        $instance['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
        $instance['get_properties_by'] = ( ! empty( $new_instance['get_properties_by'] ) ) ? strip_tags( $new_instance['get_properties_by'] ) : '';
        $instance['style'] = ( ! empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : '';
        return $instance;

    }
}
call_user_func( implode('_', array('register', 'widget') ), 'Justhome_Widget_Property_List' );