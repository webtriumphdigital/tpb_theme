<?php

function justhome_agent_display_image($post, $size = 'thumbnail') {
	?>
    <div class="agent-logo-wrapper">
        <a class="agent-logo" href="<?php echo esc_url( get_permalink($post) ); ?>">
            <?php if ( has_post_thumbnail($post->ID) ) { ?>
            	<?php
                $post_thumbnail_id = get_post_thumbnail_id($post->ID);
                echo justhome_get_attachment_thumbnail( $post_thumbnail_id, $size );
                ?>
            <?php } ?>
        </a>
    </div>
    <?php
}

function justhome_agent_display_full_location($post, $display_type = 'normal', $echo = true) {
	ob_start();
	$location = WP_RealEstate_Agent::get_post_meta( $post->ID, 'address', true );
	if ( empty($location) ) {
		$location = WP_RealEstate_Agent::get_post_meta( $post->ID, 'map_location_address', true );
	}
	if( $display_type == 'icon' ){
		$prefix = '<i class="flaticon-location-pin"></i>';
	} elseif( $display_type == 'title' ) {
		$prefix = '<span class="with-title">'.esc_html__('Location', 'justhome').'</span>';
	} else {
		$prefix = '';
	}
	if ( $location ) {
		?>
		<div class="property-location"><?php echo trim($prefix); ?> <a href="<?php echo esc_url( '//maps.google.com/maps?q=' . urlencode( strip_tags( $location ) ) . '&zoom=14&size=512x512&maptype=roadmap&sensor=false' ); ?>" target="_blank"><?php echo esc_html($location); ?></a></div>
		<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function justhome_agent_display_nb_properties($post) {
	$user_id = WP_RealEstate_User::get_user_by_agent_id($post->ID);
	$args = array(
	        'post_type' => 'property',
	        'post_per_page' => -1,
	        'post_status' => 'publish',
	        'fields' => 'ids',
	        'author' => $user_id
	    );
	$properties = WP_RealEstate_Query::get_posts($args);
	$count_properties = $properties->found_posts;
	
	?>
	<div class="nb-property">
        <?php echo sprintf(_n('%d Property', '%d Properties', intval($count_properties), 'justhome'), intval($count_properties)); ?>
    </div>
    <?php
}

function justhome_agent_display_nb_views($post) {
	$agent_id = $post->ID;
	$views = WP_RealEstate_Agent::get_post_meta($agent_id, 'views_count', true);
	$views_display = $views ? WP_RealEstate_Mixes::format_number($views) : 0;
	?>
	<div class="nb_views">
        <?php echo sprintf(_n('<span class="text-blue">%d</span> <span class="text">View</span>', '<span class="text-blue">%d</span> <span class="text">Views</span>', intval($views), 'justhome'), $views_display); ?>
    </div>
    <?php
}

function justhome_agent_display_featured_icon($post) {
	$featured = WP_RealEstate_Agent::get_post_meta( $post->ID, 'featured', true );
	if ( $featured ) { ?>
        <span class="featured-icon" data-toggle="tooltip" title="<?php esc_attr_e('featured', 'justhome'); ?>"><i class="fas fa-star"></i></span>
    <?php }
}

function justhome_agent_display_phone($post, $display_type = 'no-title', $echo = true, $always_show_phone = false) {
	$phone = WP_RealEstate_Agent::get_post_meta( $post->ID, 'phone' );
	ob_start();
	if ( $phone ) {
        $show_full = justhome_get_config('listing_show_full_phone', false);
        $hide_phone = $show_full ? false : true;
        $hide_phone = apply_filters('justhome_phone_hide_number', $hide_phone );
        if ( $always_show_phone ) {
            $hide_phone = false;
        }
        
        $add_class = '';
        if ( $hide_phone ) {
            $add_class = 'phone-hide';
        }
		if ( $display_type == 'title' ) {
            ?>
            <div class="phone-wrapper agent-phone <?php echo esc_attr($add_class); ?>">
                <span class="with-title"><?php esc_html_e('Phone ', 'justhome'); ?></span><span class="inner">
            <?php
        } elseif ($display_type == 'icon') {
            ?>
            <div class="phone-wrapper agent-phone <?php echo esc_attr($add_class); ?>">
                <span class="with-icon">
                    <i class="flaticon-phone"></i>
                </span><span class="inner">
        <?php
        } elseif ($display_type == 'all') {
            ?>
            <div class="phone-wrapper type-show-all agent-phone <?php echo esc_attr($add_class); ?>">
                <span class="with-icon">
                    <i class="flaticon-phone"></i>
                </span><span class="inner">
                <span class="with-title"><?php esc_html_e('Phone ', 'justhome'); ?></span>
        <?php
        } else {
            ?>
            <div class="phone-wrapper agent-phone <?php echo esc_attr($add_class); ?>">
                <span class="inner">
            <?php
        }

        ?>
                <a class="phone" href="tel:<?php echo trim($phone); ?>"><?php echo trim($phone); ?></a>
                <?php if ( $hide_phone ) {
                    $dispnum = substr($phone, 0, (strlen($phone)-3) ) . str_repeat("*", 3);
                ?>
                    <span class="phone-show" onclick="this.parentNode.classList.add('show');"><?php echo trim($dispnum); ?> <span><?php esc_html_e('show', 'justhome'); ?></span></span>
                <?php } ?>
        </span></div>
		<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function justhome_agent_display_fax($post, $display_type = 'no-title', $echo = true) {
    $fax = WP_RealEstate_Agent::get_post_meta( $post->ID, 'fax' );
    ob_start();
    if ( $fax ) {        
        if ( $display_type == 'title' ) {
            ?>
            <div class="phone-wrapper agent-fax">
                <span class="with-title"><?php esc_html_e('Fax ', 'justhome'); ?></span><span class="inner">
            <?php
        } elseif ($display_type == 'icon') {
            ?>
            <div class="phone-wrapper agent-fax">
                <span class="with-icon">
                    <i class="flaticon-tools-and-utensils"></i>
                </span><span class="inner">
        <?php
        } elseif ($display_type == 'all') {
            ?>
            <div class="phone-wrapper type-show-all agent-fax">
                <span class="with-icon">
                    <i class="flaticon-tools-and-utensils"></i>
                </span><span class="inner">
                <span class="with-title"><?php esc_html_e('Fax ', 'justhome'); ?></span>
        <?php
        } else {
            ?>
            <div class="phone-wrapper agent-fax">
                <span class="inner">
            <?php
        }
        ?>
            <span class="value"><?php echo trim($fax); ?></span>
        </span></div>
        <?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
        echo trim($output);
    } else {
        return $output;
    }
}

function justhome_agent_display_email($post, $display_type = 'no-title', $echo = true) {
	$email = WP_RealEstate_Agent::get_post_meta( $post->ID, 'email' );
	ob_start();
	if ( $email ) {
		if ( $display_type == 'title' ) {
            ?>
            <div class="agent-email">
                <span class="with-title"><?php esc_html_e('Email ', 'justhome'); ?></span><span class="inner">
            <?php
        } elseif ($display_type == 'icon') {
            ?>
            <div class="agent-email">
                <span class="with-icon">
                    <i class="ti-email"></i>
                </span><span class="inner">
        <?php
        } elseif ($display_type == 'all') {
            ?>
            <div class="agent-email type-show-all">
                <span class="with-icon">
                    <i class="ti-email"></i>
                </span><span class="inner">
                <span class="with-title"><?php esc_html_e('Email ', 'justhome'); ?></span>
        <?php
        } else {
            ?>
            <div class="agent-email">
                <span class="inner">
            <?php
        }
        ?>
            <a href="mailto:<?php echo trim($email); ?>"><?php echo trim($email); ?></a>
        </span>
        </div>
		<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function justhome_agent_display_website($post, $display_type = 'no-title', $echo = true) {
	$website = WP_RealEstate_Agent::get_post_meta( $post->ID, 'website' );
	ob_start();
	if ( $website ) {
        if ( $display_type == 'title' ) {
            ?>
            <div class="agent-website">
                <span class="with-title"><?php esc_html_e('Website', 'justhome'); ?></span>
            <?php
        } elseif ($display_type == 'icon') {
            ?>
            <div class="agent-website">
                <i class="ti-world"></i>
        <?php
        } else {
            ?>
            <div class="agent-website">
            <?php
        }
        ?>
            <a href="<?php echo esc_url($website); ?>" target="_blank"><?php echo trim($website); ?></a>
        </div>
		<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function justhome_agent_display_member_since($post, $display_type = 'no-title', $echo = true) {
    $date = get_the_date(get_option('date_format'), $post);
    ob_start();
    if ( $date ) {
        if ( $display_type == 'title' ) {
            ?>
            <div class="agent-date">
                <span class="with-title"><?php esc_html_e('Member since', 'justhome'); ?></span>
            <?php
        } elseif ($display_type == 'icon') {
            ?>
            <div class="agent-date">
                <i class="ti-world"></i>
        <?php
        } else {
            ?>
            <div class="agent-date">
            <?php
        }
        ?>
            <?php echo trim($date); ?>
        </div>
        <?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
        echo trim($output);
    } else {
        return $output;
    }
}

function justhome_agent_display_job($post, $echo = true) {
	$job = WP_RealEstate_Agent::get_post_meta( $post->ID, 'job' );
	ob_start();
	if ( $job ) {
		?>
		<div class="agent-job"><?php echo esc_html($job); ?></div>
		<?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
    	echo trim($output);
    } else {
    	return $output;
    }
}

function justhome_agent_display_meta_data($post, $meta_key, $title = '', $icon = '', $echo = true) {
    $meta_value = WP_RealEstate_Agent::get_post_meta( $post->ID, $meta_key );
    ob_start();
    if ( $meta_value ) {
        ?>
        <div class="agent-meta">
            <?php
            if ( $title ) {
                ?>
                    <span class="with-title"><?php echo trim($title); ?></span>
                <?php
            }
            if ( $icon ) {
                ?>
                <span class="with-icon">
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                </span>
            <?php } ?>
            <span class="inner">
                <?php echo trim($meta_value); ?>
            </span>
        </div>
        <?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
        echo trim($output);
    } else {
        return $output;
    }
}

function justhome_agent_display_socials($post, $display_type = 'no-title', $echo = true) {
	$socials = WP_RealEstate_Agent::get_post_meta( $post->ID, 'socials' );
	$output = '';
    if ( $socials ) {
        foreach ($socials as $social) {
            if ( !empty($social['network']) && !empty($social['url']) ) {
                $output .= '<a href="'.esc_url($social['url']).'" target="_blank"><i class="'.esc_attr($social['network']).'"></i></a>';
            }
        }
    }
    if ( $output ) {
        ob_start();
        if ( $display_type == 'title' ) {
            ?>
            <div class="agency-socials">
                <span class="with-title"><?php esc_html_e('Socials:', 'justhome'); ?></span>
            <?php
        } else {
            ?>
            <div class="agency-socials">
            <?php
        }
        ?>
            <?php echo trim($output); ?>
        </div>
        <?php
        $output = ob_get_clean();
    }

    if ( $echo ) {
        echo trim($output);
    } else {
        return $output;
    }
}

function justhome_agent_display_rating($post) {
    if ( WP_RealEstate_Review::review_enable($post->ID) ) {
        $average_rating = get_post_meta( $post->ID, '_average_rating', true );
        $nb_reviews = WP_RealEstate_Review::get_total_reviews($post->ID);
        ?>
        <?php if($average_rating > 0) { ?>
            <div class="review-author d-flex align-items-center">
                <i class="fas fa-star"></i>
                <span class="nb-pre-review"><?php echo number_format($average_rating, 1, ".",""); ?></span>
                <span class="space">•</span>
                <?php echo sprintf(esc_html__('%d Reviews', 'justhome'), $nb_reviews); ?>
            </div>
        <?php } ?>
        <?php
    }
}