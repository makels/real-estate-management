<?php
class REM_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'rem_widget',
            'Real Estate Management Widget'
        );
    }

    public function widget( $args, $instance ) {
        REMFilter::render($_REQUEST);
    }

    public function form($instance ) {

    }

    public function update( $new_instance, $old_instance ) {

    }
}