<article <?php post_class($item_classes); ?>>
    <div class="qodef-e-inner">
        <?php
        // Include post media
        firstframe_core_template_part('blog/shortcodes/blog-list', 'templates/post-info/media', '', $params);
        ?>
        <div class="qodef-e-content">
            <div class="qodef-e-top-holder">
                <div class="qodef-e-info">
                    <?php
                    // Include post category info
                    firstframe_core_theme_template_part('blog', 'templates/parts/post-info/categories');

                    ?>
                </div>
            </div>
            <div class="qodef-e-text">
                <?php
                // Include post title
                firstframe_core_template_part('blog/shortcodes/blog-list', 'templates/post-info/title', '', $params);

                // Hook to include additional content after blog single content
                do_action('firstframe_action_after_blog_single_content');
                ?>
            </div>
            <div class="qodef-e-bottom-holder">
                <div class="qodef-e-left">
                    <?php
                    // Include post read more
                    firstframe_core_theme_template_part('blog', 'templates/parts/post-info/read-more');
                    ?>
                </div>
                <div class="qodef-e-right qodef-e-info">

                </div>
            </div>
        </div>
    </div>
</article>
