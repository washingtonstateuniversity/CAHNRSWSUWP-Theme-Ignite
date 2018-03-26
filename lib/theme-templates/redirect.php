<?php

$id = get_the_ID();

$redirect = get_post_meta( $id, '_article_redirect_url', true );

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo esc_html( get_the_title() ); ?> | Washington State University</title>
<script>

	var redirect = '<?php echo esc_url( $redirect ); ?>';

	function cahnrs_analytics_callback() {

		// similar behavior as clicking on a link
		window.location.href = "<?php echo esc_url( $redirect ); ?>";

		return false;

	}
</script>
<?php do_action( 'cahnrs_analytics_trakcer' ); ?>
</head>
<body class="ignite-redirect">
</body>
</html>
