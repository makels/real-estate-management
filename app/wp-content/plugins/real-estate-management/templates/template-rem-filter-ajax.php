<h3>Результаты поиска:</h3>
<?php if ( count($objects) > 0 ) { ?>
    <?php
    /** @var WP_Post $rem_item */
    foreach($objects as $rem_item) { ?>
        <div class="rem-item">
            <?php if (has_post_thumbnail( $rem_item->ID ) ): ?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $rem_item->ID ), 'single-post-thumbnail' ); ?>
                <div class="custom-bg" style="background-image: url('<?php echo $image[0]; ?>')"></div>
            <?php endif; ?>
            <div class="object_wrapper">
                <?= get_field('object_name', $rem_item); ?>
                <div class="rem-props">
                    <?php
                    $areas = [];
                    $terms = get_the_terms( $rem_item->ID, 'rem_area' );
                    foreach ($terms as $term) $areas[] = $term->name;
                    $areas = implode(', ', $areas);
                    $floor = get_field('floors', $rem_item);
                    $build_type = get_field('build_type', $rem_item);
                    $lat = get_field('location_lat', $rem_item);
                    $lng = get_field('location_lng', $rem_item);
                    echo sprintf("Район обьекта: %s, Кол-во этажей: %s,<br>Tип строения: %s, Широта: %s, Долгота: %s",
                        $areas, $floor, $build_type, $lat, $lng);
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="paginate">
        <?php
            echo paginate_links([
                'onclick' => "document.rem.setFilter();return false;"
            ]);
        ?>
    </div>
<?php } else { ?>
    <p>Не найдено ни одного объекта</p>
<?php } ?>
