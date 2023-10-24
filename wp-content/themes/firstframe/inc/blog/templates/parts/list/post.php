<article <?php post_class('qodef-blog-item qodef-e'); ?>>
    <div class="qodef-e-inner">
        <?php
        // Include post date info
        firstframe_template_part('blog', 'templates/parts/post-info/custom-date');
        // Include post media
        firstframe_template_part('blog', 'templates/parts/post-info/media');
        ?>
        <div class="qodef-e-content">
            <div class="qodef-e-top-holder">
                <div class="qodef-e-info">
                    <?php
                    // Include post date info
                    firstframe_template_part('blog', 'templates/parts/post-info/categories');

                    ?>
                </div>
            </div>
            <div class="qodef-e-text">
                <?php
                // Include post title
                firstframe_template_part('blog', 'templates/parts/post-info/title', '', array('title_tag' => 'h2'));

                // Include post excerpt
                firstframe_template_part('blog', 'templates/parts/post-info/excerpt');

                // Hook to include additional content after blog single content
                do_action('firstframe_action_after_blog_single_content');
                ?>
            </div>
            <div class="qodef-e-bottom-holder">
                <div class="qodef-e-left">
                    <?php
                    // Include post read more
                    firstframe_template_part('blog', 'templates/parts/post-info/read-more');
                    ?>
                </div>
                <div class="qodef-e-right qodef-e-info">

                </div>
            </div>
        </div>
    </div>
</article>
