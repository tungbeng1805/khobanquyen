<?php
if ($settings['show_share']  == 'true'){
    ?>
    <div class="pxl-share post-tags-share d-flex">
        <div class="post-share-wrap "><?php maiko()->blog->get_post_share(); ?></div>
    </div>
    <?php
}
?>