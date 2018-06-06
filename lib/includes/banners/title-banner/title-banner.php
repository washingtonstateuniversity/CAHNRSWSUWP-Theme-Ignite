<style>
	#ignite-feature-banner.ignite-title-banner .ignite-banner-background,
	#ignite-feature-banner.ignite-title-banner .ignite-banner-content {
		position: relative;
	}
	#ignite-feature-banner.ignite-title-banner .ignite-banner-background {
		position: absolute;
		left: 0;
		right: 0;
		width: 100%;
		background-color: #000;
		background-size: cover;
		background-position: center center;
	}
	#ignite-feature-banner.ignite-title-banner .ignite-banner-content {
		display: table;
		width: 100%;
	}
	#ignite-feature-banner.ignite-title-banner .gnite-banner-content-inner {
		display: table-row;
	}
	#ignite-feature-banner.ignite-title-banner .ignite-banner-content-text {
		display: table-cell;
		vertical-align: middle;
		text-align: center;
		padding: 50px 30px;
		box-sizing: border-box;
	}
	#ignite-feature-banner.ignite-title-banner .ignite-banner-title {
		display: block;
		font-size: 40px;
		color: #fff;
		margin-bottom: 20px;
	}
	#ignite-feature-banner.ignite-title-banner .ignite-banner-caption {
		display: block;
		font-size: 20px;
		color: #fff;
	}
</style>
<div id="ignite-feature-banner" class="ignite-title-banner">
	<div class="ignite-banner-background" style="height:<?php echo esc_attr( $height ); ?>;background-image:url('<?php echo esc_attr( $img ); ?>');">
	</div>
	<div class="ignite-banner-content">
		<div class="ignite-banner-content-inner">
			<div class="ignite-banner-content-text" style="height:<?php echo esc_attr( $height ); ?>;">
				<span class="ignite-banner-title"><?php echo esc_html( $title ); ?></span>
				<span class="ignite-banner-caption"><?php echo esc_html( $caption ); ?></span>
			</div>
		</div>
	</div>
</div>