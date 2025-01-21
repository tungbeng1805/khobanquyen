<?php 
	extract($settings);
	$wrap_cls = [
		'pxl-divider',
		$style,
		$div_animated,
		$div_animation_duration
	];
?>
<div class="<?php echo implode(' ', $wrap_cls) ?>"><div class="pxl-divider-separator"></div></div>