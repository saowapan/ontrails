<?php // introduction header ?>
<section class="section-header-default">
    <?php $intro = get_field('introduction_header'); ?>
    <?php echo header_fading('d-fading','Travel Stories' ,$intro); // function header_fading => ../lib/func_header_fadding.php ?>
</section>
<?php // content ?>
<?php echo call_post('stories'); // function call_post => ../lib/func_post.php ?>