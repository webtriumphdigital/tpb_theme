<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Dashboard_Messages_List extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_dashboard_messages_list';
	}

	public function get_title() {
		return esc_html__( 'Dashboard:: Messages List', 'justhome' );
	}
	
	public function get_categories() {
		return [ 'justhome-dashboard-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Settings', 'justhome' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'justhome' ),
				'type' => Elementor\Controls_Manager::TEXT,
				'default' => 'Recent Messages',
			]
		);

		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'justhome' ),
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );


        $args = array(
			'post_per_page' => 5,
			'author' => get_current_user_id(),
		);
		$loop = WP_Private_Message_Message::get_list_messages($args);
		if ( $loop->have_posts() ) {
			?>
			<div class="box-white-dashboard <?php echo esc_attr($el_class); ?>">
				<?php if ( $title ) { ?>
					<h4 class="title"><?php echo esc_html($title); ?></h4>
				<?php } ?>
				<ul class="list-message-small">
					<?php
					$dashboard_id = wp_private_message_get_option('message_dashboard_page_id');
					$dashboard_link = get_permalink($dashboard_id);

					while ( $loop->have_posts() ) : $loop->the_post();
						global $post;
						$args = array(
							'post_per_page' => 1,
							'paged' => 1,
							'parent' => $post->ID,
						);
						$reply_messages = WP_Private_Message_Message::get_list_reply_messages($args);
						$read = get_post_meta($post->ID, '_read_'.get_current_user_id(), true);
						$yourself_id = get_current_user_id();
						$sender = get_post_meta($post->ID, '_sender', true);
						$recipient = get_post_meta($post->ID, '_recipient', true);
						if ( $yourself_id == $sender ) {
							$recipient_id = $recipient;
						} else {
							$recipient_id = $sender;
						}
						if ( $read ) {
							$classes = ' read';
						} else {
							$classes = ' unread';
						}
						$url_link = add_query_arg( 'id', $post->ID, $dashboard_link );
						?>
						<li id="message-id-<?php echo esc_attr($post->ID); ?>" class="<?php echo esc_attr($classes); ?>">
							<a class="message-item-small" href="<?php echo esc_url($url_link); ?>">
								<div class="avatar">
									<?php justhome_private_message_user_avatar( $recipient_id ); ?>
								</div>
								<div class="content">
									<h4 class="user-name"><?php echo esc_html( get_the_author_meta('display_name', $recipient_id)); ?>
										<span class="message-time"> -
											<?php if ( $reply_messages->have_posts() ) { ?>
												<?php foreach ($reply_messages->posts as $rpost) {?>
														<?php echo human_time_diff(get_the_time('U', $rpost), current_time('timestamp')); ?>
												<?php } ?>
											<?php } else { ?>
													<?php echo human_time_diff(get_the_time('U', $post), current_time('timestamp')); ?>
											<?php } ?>
										</span>
									</h4>
									<div class="message-title"><?php echo esc_html($post->post_title); ?></div>
								</div>
							</a>
						</li>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
				</ul>
			</div>
			<?php
		}

	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Dashboard_Messages_List );
