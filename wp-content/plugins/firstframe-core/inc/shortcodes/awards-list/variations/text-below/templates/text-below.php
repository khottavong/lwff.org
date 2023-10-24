<div <?php qode_framework_class_attribute($holder_classes); ?>>
    <div class="qodef-grid-inner clear">
        <?php foreach ($items

        as $item) { ?>
        <article class="qodef-e qodef-grid-item">
            <div class="qodef-e-inner">

                <div class="qodef-e-text">
                    <div class="qodef-e-text-first">
                        <span><?php echo esc_html($item['text_1']); ?></span>

                    </div>
                    <div class="qodef-e-text-second">
                        <span><?php echo esc_html($item['text_2']); ?></span>

                    </div>
                </div>
                <div class="qodef-e-separator">

                </div>

                <div class="qodef-e-title-wrapper">
                    <<?php echo esc_attr($title_tag); ?> class="qodef-e-title">
                    <?php if (!empty($item['link'])) { ?>
                        <a itemprop="url" href="<?php echo esc_url($item['link']); ?>"
                           target="<?php echo esc_attr($link_target); ?>">
                            <?php echo esc_html($item['title']); ?>
                        </a>
                    <?php } else { ?>
                        <?php echo esc_html($item['title']); ?>
                    <?php } ?>
                </<?php echo esc_attr($title_tag); ?>>
                <div class="qodef-e-descirption">
                    <span><?php echo esc_html($item['text_description']); ?></span>
                </div>
                <div class="qodef-e-image">
                    <?php if (!empty($item['link'])) { ?>
                        <a itemprop="url" href="<?php echo esc_url($item['link']); ?>"
                           target="<?php echo esc_attr($link_target); ?>">
                            <?php echo wp_get_attachment_image($item['image'], 'full'); ?>
                        </a>
                    <?php } else { ?>
                        <?php echo wp_get_attachment_image($item['image'], 'full'); ?>
                    <?php } ?>
                </div>
            </div>
            <?php if (($right_button == 'yes')) { ?>
                <div class="qodef-e-button">
                    <a itemprop="url" href="<?php echo esc_url($item['link']); ?>"
                       target="<?php echo esc_attr($link_target); ?>">


                        <?php if (!empty($item['image_right'])) {
                            echo wp_get_attachment_image($item['image_right'], 'full');
                        } else {

                            firstframe_core_render_svg_icon('arrow-button');
                        } ?>

                    </a>

                </div>
            <?php } ?>

    </div>
    </article>
    <?php } ?>
</div>
</div>
