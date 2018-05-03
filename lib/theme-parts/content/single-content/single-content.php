<?php do_action( 'cahnrs_ignite_before_content', 'single-content' ); ?>
<article class="site-article">
	<header>
		<?php if ( 'remove' !== $show_title ) : ?><h1 class="<?php if ( 'hide' === $show_title ) { echo ' hidden-element'; } ?>"><?php the_title() ?></h1><?php endif ?>
        <?php do_action( 'cahnrs_ignite_after_title', 'single-content' ); ?>
	</header>
	<div class="article-content">
			<?php the_content() ?>
	</div>
	<footer></footer>
</article>
<?php do_action( 'cahnrs_ignite_after_content', 'single-content' ); ?>
