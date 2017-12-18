<?php // introduction header ?>
<section class="section-header-default">
    <?php $intro = get_field('introduction_header'); ?>
    <?php echo header_fading('d-fading','Learn' ,$intro);?>
</section>
<?php // content ?>
<?php echo call_post('learn'); // function call_post => ../lib/func_post.php ?>