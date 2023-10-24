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

            <div class="qodef-e-button qodef-e-button-left">
                <?php
                $button_params = array(
                    'button_layout' => 'textual',
                    'link' => $item['link_2'],
                    'target' => $link_target,
                    'text' => 'View more'
                );
                echo FirstFrameCore_Button_Shortcode::call_shortcode($button_params); ?>
            </div>
            <div class="qodef-e-button qodef-e-button-right">
                <?php
                $button_params = array(
                    'button_layout' => 'outlined',
                    'link' => $item['link'],
                    'target' => $link_target,
                    'text' => 'Get tickets'
                );
                echo FirstFrameCore_Button_Shortcode::call_shortcode($button_params); ?>
            </div>
    </div>
    </article>
    <?php } ?>
</div>
</div>
