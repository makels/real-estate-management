<section class="rem_filter">
    <div class="rem_filter__content">
        <div class="rem_filter__filter_wrapper">
            <form id="rem_filter" method="get">
                <input type="hidden" name="action" value="set_rem_filter">
                <div class="fieldset">
                    <label for="object_name">Название объекта:</label>
                    <input id="object_name" type="text" name="object_name" value="<?= $data["object_name"] ?? ""; ?>" />
                </div>
                <div class="fieldset">
                    <label for="object_name">Район:</label>
                    <select id="object_area" type="text" name="object_area">
                        <option <?php if(!empty($data["object_area"]) && $data["object_area"] == "-1") echo "selected"; ?> value="-1">Выберите район</option>
                        <option <?php if(!empty($data["object_area"]) && $data["object_area"] == "Дарница") echo "selected"; ?> value="Дарница">Дарница</option>
                        <option <?php if(!empty($data["object_area"]) && $data["object_area"] == "Днепровский") echo "selected"; ?> value="Днепровский">Днепровский</option>
                        <option <?php if(!empty($data["object_area"]) && $data["object_area"] == "Печерский") echo "selected"; ?> value="Печерский">Печерский</option>
                        <option <?php if(!empty($data["object_area"]) && $data["object_area"] == "Шевченковский") echo "selected"; ?> value="Шевченковский">Шевченковский</option>
                    </select>
                </div>
                <div class="fieldset">
                    <label for="floors">Кол-во этажей:</label>
                    <select id="object_name" name="floors">
                        <option <?php if(!empty($data["floors"]) && $data["floors"] == "-1") echo "selected"; ?> value="-1">Выберите кол-во этажей</option>
                        <?php for($i = 1; $i <= 20; $i++) { ?>
                            <option <?php if(!empty($data["floors"]) && $data["floors"] == $i) echo "selected"; ?>  value="<?= $i; ?>">
                                <?= $i; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="fieldset">
                    <label for="build_type">
                        <input name="build_type" type="radio" value="Все"
                            <?php if(empty($data["build_type"]) || $data["build_type"] == "Все") {
                                echo "checked='checked'";
                            }
                            ?>/>
                        <span>Все</span>
                    </label>
                    <label for="build_type">
                        <input name="build_type" type="radio" value="Панель"
                            <?php if(!empty($data["build_type"]) && $data["build_type"] == "Панель") {
                                echo "checked='checked'";
                            } ?>/>
                        <span>Панель</span>
                    </label>
                    <label for="build_type">
                        <input name="build_type" type="radio" value="Кирпич"
                            <?php if(!empty($data["build_type"]) && $data["build_type"] == "Кирпич") {
                                echo "checked='checked'";
                            } ?>/>
                        <span>Кирпич</span>
                    </label>
                    <label for="build_type">
                        <input name="build_type" type="radio" value="Пеноблок"
                            <?php if(!empty($data["build_type"]) && $data["build_type"] == "Пеноблок") {
                                echo "checked='checked'";
                            } ?>/>
                        <span>Пеноблок</span>
                    </label>
                </div>
                <div class="fieldset">
                    <button type="button" onclick="document.rem.setFilter();">Поиск</button>
                </div>
            </form>
        </div>
        <div class="rem_filter__found_result">
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
        </div>
    </div>
</section>
