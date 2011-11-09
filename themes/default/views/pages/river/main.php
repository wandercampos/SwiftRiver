<article>
	<div class="cf center page_title">
		<hgroup class="edit">
			<h1><span class="edit_trigger" onclick="">River 1</span></h1>
		</hgroup>
		<?php
		if (isset($droplets))
		{
			?>
			<section class="meter">
				<p style="padding-left:<?php echo $meter; ?>%;"><strong><?php echo $droplets; ?></strong> droplets</p>
				<div><span style="width:<?php echo $meter; ?>%;"></span></div>
			</section>
			<?php
		}
		?>
	</div>
	
	<div class="center canvas">
		<section class="panel">		
			<nav class="cf">
				<ul class="views">
					<li class="droplets active"><a href="#"><?php echo __('Droplets');?></a></li>
					<li><a href="#">Map</a></li>
					<li><a href="#">Tags</a></li>
					<li><a href="#">Links</a></li>
					<li><a href="#">Sources</a></li>
				</ul>
				<ul class="actions">
					<li class="view_panel"><a href="<?php echo $channels; ?>" class="channels"><span class="icon"></span>Edit channels</a></li>
					<li class="view_panel"><a href="<?php echo $filters; ?>" class="filter"><span class="icon"></span>Edit filter</a></li>
				</ul>
			</nav>
			<div class="panel_body"></div>
		</section>

		<?php

		?>
		<div class="page_buttons">
		<p class="button_view"><a href="/droplet">View more</a></p>
		</div>
	</div>
</article>	