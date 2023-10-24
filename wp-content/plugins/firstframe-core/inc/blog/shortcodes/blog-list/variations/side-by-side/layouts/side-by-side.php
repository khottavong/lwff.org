<article <?php post_class($item_classes); ?>>
    <div class="qodef-e-inner">
        <?php
        // Include post media
        firstframe_core_template_part('blog/shortcodes/blog-list', 'templates/post-info/media', 'image', $params);
        ?>
        <div class="qodef-e-content">
            <div class="qodef-e-top-holder">
                <div class="qodef-e-info">
                    <?php
                    // Include post category info
                    firstframe_core_theme_template_part('blog', 'templates/parts/post-info/categories');
                    // Include post category info
                    firstframe_core_theme_template_part('blog', 'templates/parts/post-info/date');

                    ?>
                </div>
                <div class="qodef-e-text">
                    <?php
                    // Include post title
                    firstframe_core_template_part('blog/shortcodes/blog-list', 'templates/post-info/title', '', $params);

                    ?>
                </div>
            </div>

            <div class="qodef-e-bottom-holder">
                <?php
                // Include post excerpt
                firstframe_core_theme_template_part('blog', 'templates/parts/post-info/excerpt', '', $params);
                ?>
            </div>
        </div>
    </div>
</article>
