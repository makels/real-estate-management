<?php

/**
 * Real Estate Management Filter class
 */
class REMFilter {

    /**
     * Rendering filter form
     * @param $data
     */
    public static function render(array $data) {
        $args = self::make_filter_params($data);
        $objects = query_posts($args);
        include REM_TEMLATES_DIR . '/template-rem-filter.php';
    }

    /**
     * Rendering filter form
     * @param $data
     */
    public static function renderAjax(array $data) {
        $args = self::make_filter_params($data);
        $objects = query_posts($args);
        include REM_TEMLATES_DIR . '/template-rem-filter-ajax.php';
    }

    /**
     * Make filter parameters
     * @param array $data
     * @return array
     */
    private static function make_filter_params(array $data): array {
        $meta_query = self::get_meta_query_params($data);
        $tax_query = self::get_tax_query_params($data);
        return [
            'posts_per_page'     => get_option('posts_per_page'),
            'post_type'          => 'real_estate',
            'post_status'        => 'publish',
            'paged'              => $_GET['paged'] ?? 1,
            'orderby'            => 'date',
            'order'              => 'ASC',
            'suppress_filters'   => true,
            'meta_query'         => $meta_query,
            'tax_query'          => $tax_query
        ];
    }

    /**
     * Filtering real estate objects by advanced custom fields
     * @param array $data
     * @return array
     */
    private static function get_meta_query_params(array $data): array {
        $meta_query = [];
        if(!empty($data['object_name'])) {
            $meta_query[] = [
                'key'     => 'object_name',
                'value'   => $data['object_name'],
                'compare' => 'LIKE'
            ];
        }
        if(!empty($data['floors']) && $data['floors'] != "-1") {
            $meta_query[] = [
                'key'     => 'floors',
                'value'   => $data['floors'],
                'compare' => '='
            ];
        }
        if(!empty($data['build_type']) && $data['build_type'] != 'Все') {
            $meta_query[] = [
                'key'     => 'build_type',
                'value'   => $data['build_type'],
                'compare' => '='
            ];
        }
        return $meta_query;
    }

    /**
     * Filtering real estate objects by taxonomy value
     * @param array $data
     * @return array
     */
    private static function get_tax_query_params(array $data): array {
        $tax_query = [];
        if(!empty($data['object_area']) && $data['object_area'] != '-1' ) {
            array_push($tax_query, [
                'taxonomy' => 'rem_area',
                'terms'    => $data['object_area'],
                'field'    => 'name',
                'operator' => 'IN',
            ]);
        }
        return $tax_query;
    }

}
