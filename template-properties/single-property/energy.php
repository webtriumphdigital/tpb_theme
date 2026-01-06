<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
if ( $meta_obj->check_post_meta_exist('energy_class') && ($energy_class = $meta_obj->get_post_meta('energy_class')) ) {
    $options = array(
        'A+' => esc_html__('A+', 'justhome'),
        'A' => esc_html__('A', 'justhome'),
        'B' => esc_html__('B', 'justhome'),
        'C' => esc_html__('C', 'justhome'),
        'D' => esc_html__('D', 'justhome'),
        'E' => esc_html__('E', 'justhome'),
        'F' => esc_html__('F', 'justhome'),
        'G' => esc_html__('G', 'justhome'),
        'H' => esc_html__('H', 'justhome'),
    );
?>
    <div class="property-detail-energy">
        <h3 class="title"><?php esc_html_e('Energy', 'justhome'); ?></h3>
        <div class="inner">
            <div class="energy-inner-top">
                <ul class="list">
                    <li>
                        <div class="text"><?php echo esc_html($meta_obj->get_post_meta_title( 'energy_class' )); ?>:</div>
                        <div class="value"><?php echo trim($energy_class); ?></div>
                    </li>
                    <?php if ( $meta_obj->check_post_meta_exist('energy_index') && ($energy_index = $meta_obj->get_post_meta('energy_index')) ) { ?>
                        <li>
                            <div class="text"><?php echo esc_html($meta_obj->get_post_meta_title( 'energy_index' )); ?>:</div>
                            <div class="value"><?php echo trim($energy_index); ?></div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="energy-inner d-flex align-items-center">
                <?php foreach ($options as $key => $title) {
                    $classs = 'energy-'. strtolower($key);
                    if ( $key == 'A+' ) {
                        $classs = 'energy-aplus';
                    }
                ?>
                    <div class="energy-group <?php echo esc_attr($classs); ?>">
                        <?php echo esc_html($title); ?>
                        <?php if ( $energy_class == $key ) {
                            $energy_index = $meta_obj->get_post_meta('energy_index');
                            $energy_index_text = '';
                            if ( !empty($energy_index) ) {
                                $energy_index_text = $energy_index.' '.esc_html__('kWh/m²a', 'justhome'). ' |';
                            }
                        ?>
                            <div class="indicator-energy">
                                <?php echo sprintf(esc_html__('%s Your energy class is %s', 'justhome'), $energy_index_text, $title); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php do_action('wp-realestate-single-property-energy', $post); ?>
    </div>
<?php }