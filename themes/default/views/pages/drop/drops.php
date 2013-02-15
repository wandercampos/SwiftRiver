<div id="stream" class="col_9">
</div>

<script type="text/template" id="drop-listing-template">
<div id="drops-view"></div>
</script>

<script type="text/template" id="drop-drops-view-template">
	<% if (image != null) { %>
		<a href="/markup/drop" class="drop-image-wrap zoom-trigger"><img src="<%= image.thumbnails[0].url %>" class="drop-image" /></a>
	<% } %>
	<h1>
		<a href="#" class="zoom-trigger"><%= title %></a>
	</h1>
	<div class="drop-actions cf">
		<ul class="dual-buttons drop-move">
			<li class="share">
				<a href="#" class="button-primary modal-trigger"><span class="icon-share"></span></a>
			</li>
			<li class="bucket">
				<a href="#" class="button-primary modal-trigger">
					<span class="icon-add-to-bucket"></span>
					<% if (buckets != null && buckets.length > 0) { %>
					<span class="bucket-total"><%= buckets.length %></a>
					<% } %>
				</a>
			</li>	
		</ul>
		<span class="drop-score"><a href="#" class="button-white"><span class="icon-star"></span></a>
		<ul class="drop-status cf">
			<li class="drop-status-read">
				<a href="#"><span class="icon-checkmark"></span></a>
			</li>
			<li class="drop-status-remove">
				<a href="#"><span class="icon-cancel"></span></a>
			</li>
		</ul>
	</div>
	<section class="drop-source cf">
		<a href="#" class="avatar-wrap"><img src="<%= source.avatar %>" /></a>
		<div class="byline">
			<h2><%= source.name %></h2>
			<p class="drop-source-channel">
				<a href="#">
					<span class="icon-<%= channel %>"></span>
					<?php echo __("via "); ?> <%= channel %>
				</a>
			</p>
		</div>
	</section>
</script>

<script type="text/template" id="drop-list-view-template">
	<section class="drop-source cf">
		<a href="#" class="avatar-wrap"><img src="<%= source.avatar %>" /></a>
		<div class="byline">
			<h2><%= source.name %></h2>
			<p class="drop-source-channel">
				<a href="#">
					<span class="icon-<%= channel %>"></span>
					<?php echo __("via"); ?> <%= channel %>
				</a>
			</p>
		</div>
	</section>
	<div class="drop-body">
		<div class="drop-content">
			<h1><a href="#" class="zoom-trigger"><%= title %></a>
		</div>
		<div class="drop-details">
			<p class="metadata">
				<%= date_published %>
				<a href="#">
					<i class="icon-comment"></i>
					<strong><%= comment_count %></strong> <?php echo __("comments"); ?>
				</a>
			</p>
			<div class="drop-actions cf">
				<ul class="dual-buttons drop-move">
					<li class="share">
						<a href="#" class="button-primary modal-trigger"><span class="icon-share"></span></a>
					</li>
					<li class="bucket">
						<a href="#" class="button-primary modal-trigger">
							<span class="icon-add-to-bucket"></span>
							<% if (buckets != null && buckets.length > 0) { %>
								<span class="bucket-total"><%= buckets.length %></span>
							<% } %>
						</a>
					</li>
				</ul>
				<span class="drop-score">
					<a href="#" class="button-white">
						<span class="icon-star"></span>
					</a>
				</span>
				<ul class="drop-status cf">
					<li class="drop-status-read"><a href="#"><span class="icon-checkmark"></span></a></li>
					<li class="drop-status-remove"><a href="#"><span class="icon-cancel"></span></a><li>
				</ul>
			</div>
		</div>
	</div>
</script>

<script type="text/template" id="metadata-template">
	<span class="toggle-filters-display">
		<span class="total"><%= count %></span>
		<span class="icon-arrow-down"></span>
		<span class="icon-arrow-up"></span>	
	</span>
	<span class="filters-type-settings">
		<a href="#" class="modal-trigger">
			<span class="icon-cog"></span>
		</a>
	</span>
	<h2><%= label %></h2>
	<div class="filters-type-details">
		<ul></ul>
	</div>
</script>

<script type="text/template" id="metadata-item-template">
	<a href="#" title="<%= metadataText %>">
	<% if (metadataText.length > 20) { %>
		<%= metadataText.substring(0, 20) + "..." %>
	<% } else { %>
		<%= metadataText %>
	<% } %>
	</a>
</script>

<script type="text/template" id="drop-full-view-template">
</script>

<script type="text/template" id="drop-detail-template">
	<div class="center cf">
		<div class="page-action">
			<a href="#" class="button button-primary">
				<i class="icon-full-screen"></i>
				<?php echo __("View full-screen"); ?>
			</a>
			<a href="#" class="button button-white zoom-close">
				<i class="icon-cancel"></i>
				<?php echo __("Close"); ?>
			</a>
		</div>
	</div>
	<div id="drop-content-container" class="center cf">
		<div class="col_9">
			<div class="base">
				<section class="drop-source">
					<p class="metadata"><%= date_published %></p>
					<a href="#" class="avatar-wrap"><img src="<%= source.avatar %>" /></a>
					<div class="byline">
						<h2><%= title %></h2>
						<p class="drop-source-channel">
							<a href="#">
								<span class="icon-<%= channel %>"></span>
								<?php echo __("via"); ?> <%= channel %>
							</a>
						</p>
					</div>
				</section>

				<div class="drop-body">
					<h1><%= title %></h1>
				</div>

				<div class="drop-actions cf">
					<ul class="dual-buttons drop-move">
						<li class="share">
							<a href="#" class="button-primary modal-trigger"><span class="icon-share"></span></a>
						</li>
						<li class="bucket">
							<a href="#" class="button-primary modal-trigger">
								<span class="icon-add-to-bucket"></span>
								<% if (buckets != null && buckets.length > 0) { %>
									<span class="bucket-total"><%= buckets.length %></span>
								<% } %>
							</a>
						</li>
					</ul>
					<span class="drop-score">
						<a href="#" class="button-white">
							<span class="icon-star"></span>
						</a>
					</span>
				</div>
				<h2 class="label attach"><?php echo __("Full Story"); ?></h2>
				<article class="drop-fullstory">
					<h1><a href="#"><%= title %></a></h1>
					<%= content %>
				</article>
			</div>

			<h2 class="label"><?php echo __("Related discussion"); ?></h2>
			<section class="drop-discussion list">
				<!-- TODO: Fetch the comments for the current drop via the API -->
				<article class="drop base cf">
					<section class="drop-source cf">
						<a href="#" class="avatar-wrap">
							<img src="<?php echo Swiftriver_Users::gravatar($user['owner']['email'], 55); ?>" />
						</a>
						<div class="byline">
							<h2><?php echo __($user['owner']['name']); ?></h2>
						</div>
					</section>
					<div class="drop-body" id="add-comment">
						<div class="drop-content">
							<textarea name="drop_comment"></textarea>
						</div>
						<div class="drop-details">
							<div class="drop-actions cf">
								<a href="#" id="add-comment" class="button-primary"><?php echo __("Publish"); ?></a>
							</div>
						</div>
					</div>
				</article>
			</section>

		</div>

		<div id="metadata" class="col_3"></div>
	</div>
</script>

<script type="text/template" id="discussion-template">
	<section class="drop-source">
		<a href="#" class="avatar-wrap">
			<img src="<%= account.avatar %>" />
		</a>
		<div class="byline"><h2><%= account.name %></h2></div>
	</section>
	<div class="drop-body">
		<div class="drop-content">
			<h1><%= comment_text %></h1>
		</div>
		<div class="drop-details">
			<p class="metadata"><%= date_added %></p>
			<!-- TODO: Review the action buttons for this section -->
			<div class="drop-actions cf"></div>
		</div>
	</div>
</script>

<script type="text/template" id="edit-metadata-template">
	<div id="modal-viewport">
		<div id="modal-primary" class="modal-view">
			<div class="modal-title cf">
				<a href="#" class="modal-close button-white">
					<i class="icon-cancel"></i><?php echo __("Close"); ?>
				</a>
				<h1>
					<a href="#group-name" class="modal-transition">
						<?php echo __("Edit"); ?> <%= label %>
					</a>
				</h1>
			</div>
			<div class="modal-body">
				<div class="view-table base">
					<ul>
						<li class="add">
							<a href="#" class="modal-transition"><?php echo __("Add"); ?> <%= label %></a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div id="modal-secondary" class="modal-view">
			<div class="modal-segment">
				<div class="modal-title cf">
					<a href="#" class="modal-back button-white"><span class="icon-arrow-left"></span></a>
					<h1><?php echo __("Add"); ?> <%= label.substring(0, label.length-1) %></h1>
				</div>
				<div class="modal-body modal-tabs-container">
					<!-- Input fields for adding metadata go here-->
					<div class="modal-toolbar">
						<a href="#" class="button-submit button-primary modal-close"><?php echo __("Done"); ?></a>
					</div>
				</div>
			</div>
		</div>

	</div>
</script>

<script type="text/template" id="edit-metadata-item-template">
	<a href="#" title="<%= label %>">
		<span class="remove icon-cancel"></span>
		<% if (label.length > 50) { %>
			<%= label.substring(0, 50) + " ..." %>
		<% }  else { %>
			<%= label %>
		<% } %>
	</a>
</script>

<script type="text/template" id="add-link-template">
	<div class="base">
		<div class="modal-field">
			<input type="text" name="new_metadata" placeholder="<?php echo  __("Enter a URL"); ?>"/>
		</div>
	</div>
</script>

<script type="text/template" id="add-tag-template">
	<div class="base">
		<div class="modal-field">
			<input type="text" name="new_metadata" placeholder="<?php echo __("Enter a name"); ?>"/>
		</div>
		<div class="modal-field">
			<h3 class="label"><?php echo __("Type of Tag"); ?></h3>
			<?php 
				echo Form::select('tag_type', array(
					'organization' => __('Organization'),
					'person' => __('Person'),
					'general' => __('General'))); 
			?>
		</div>
	</div>
</script>

<script type="text/template" id="share-drop-template">
	<div id="modal-viewport">
		<div id="modal-primary" class="modal-view">
			<div class="modal-title cf">
				<a href="#" class="modal-close button-white">
					<i class="icon-cancel"></i><?php echo __("Close"); ?>
				</a>
				<h1><?php echo __("Share"); ?></h1>
			</div>
			<div class="modal-body">
				<div class="base">
					<ul class="view-table">
						<li>
							<a href="https://twitter.com/share?url=<%= encodeURIComponent(drop_url) %>&text=<%= encodeURIComponent(title) %>"
								onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"
								target="_blank">
								<span class="transition icon-arrow-right"></span>
								<i class="channel-icon icon-twitter"></i>
								<?php echo __("Twitter"); ?>
							</a>
						</li>
						<li>
							<% var FBShareURL = encodeURIComponent(drop_url) + '&t' + encodeURIComponent(title); %>
							<a href="http://www.facebook.com/share.php?u=<%= FBShareURL %"
								onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"
								target="_blank">
								<span class="transition icon-arrow-right"></span>
								<i class="channel-icon icon-facebook"></i>
								<?php echo __("Facebook"); ?>
							</a>
						</li>
						<li>
							<a href="#email" id="share-email" class="modal-transition">
								<span class="transition icon-arrow-right"></span>
								<?php echo __("Email"); ?>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		<div id="modal-secondary" class="modal-view"></div>

	</div>
</script>

<script type="text/template" id="email-share-template">
	<div class="modal-title cf">
		<a href="#" class="modal-back button-white">
			<span class="icon-arrow-left"></span>
		</a>
		<h1><?php echo __("Share via Email"); ?></h1>
	</div>

	<?php
	/*
	<div id="success" style="display: none;">
		<p><?php echo __("The drop has been successfully shared via email!"); ?></p>
	</div>
	*/
	?>

	<?php echo Form::open(); ?>
		<div class="modal-body">
			<div class="base">
				<div class="modal-field">
					<h3 class="label">
						<img class="avatar" src="<%= source.avatar %>"/>
						<%= source.name %>
					</h3>
					<textarea readonly="true" rows="4"><%= title %></textarea>
				</div>
				<div class="modal-field">
					<h3 class="label"><?php echo __("Send To"); ?></h3>
					<?php echo Form::input('recipient', '', array('placeholder' => __('me@example.com'))); ?>
				</div>
				<div class="modal-field">
					<h3 class="label"><?php echo __("Security Image"); ?></h3>
					<h3 class="label"><?php echo Captcha::instance()->render(); ?></h3>
					<?php echo Form::input('security_code', '', array('placeholder' => __('Enter the text in the image above'))); ?>
				</div>
			</div>
			<div class="modal-toolbar">
				<a href="#" class="button-submit button-primary modal-close">
					<?php echo __("Send"); ?>
				</a>
			</div>
		</div>
	<?php echo Form::close(); ?>

</script>

<?php echo $droplet_js; ?>
