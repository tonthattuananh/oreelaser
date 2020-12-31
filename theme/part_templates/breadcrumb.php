<?php

if (function_exists('yoast_breadcrumb') && get_option('_use_yoast_breadcrumb') === 'yes') {
	yoast_breadcrumb('<div id="page-breadcrumb">', '</div>');
} else {
	$title = getPageTitle(); ?>
	<div class="page-breadcrumb">
		<nav aria-label="breadcrumb">
			<h1><?php echo $title ?></h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php bloginfo('url') ?>"><?php echo __('Trang chủ', 'gaumap') ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
			</ol>
		</nav>
	</div>
<?php }