<?php
	$page_title = "Ushahidi press coverage";
	$template_type = "masonry";
	include $_SERVER['DOCUMENT_ROOT'].'/markup/_includes/header.php';
?>

	<hgroup class="page-title bucket-title cf">
		<div class="center">
			<div class="page-h1 col_8">
				<h1><?php print $page_title; ?></h1>
			</div>
			<div class="page-action col_4">
				<span>
				<ul class="dual-buttons">
					<li class="button-blue"><a href="/markup/bucket/discussion.php"><i class="icon-comment"></i>Discussion</a></li>
					<li class="button-blue"><a href="/markup/bucket/settings-collaborators.php"><i class="icon-settings"></i>Settings</a></li>
				</ul>
				</span>
			</div>
		</div>
	</hgroup>

	<!--section class="rundown bucket cf">
		<div class="center">
			<div class="rundown-totals col_3">
				<ul>
					<li><strong>88</strong> drops</li>
					<li><a href="/markup/bucket/followers.php"><strong>17</strong> followers</a></li>
				</ul>
			</div>
			<div class="rundown-people col_9">
				<h2>Collaborators on this bucket</h2>
				<ul>
					<li><a href="#" class="avatar-wrap"><img src="/markup/images/content/avatar1.png" /></a></li>
					<li><a href="#" class="avatar-wrap"><img src="/markup/images/content/avatar2.png" /></a></li>
				</ul>
			</div>
		</div>
	</section-->

	<nav class="page-navigation cf">
		<div class="center">
			<div id="page-views" class="river touchcarousel col_12">
				<ul class="touchcarousel-container">
					<li class="touchcarousel-item active"><a href="/markup/bucket">Drops</a></li>
					<li class="touchcarousel-item"><a href="/markup/bucket/view-list.php">List</a></li>
					<li class="touchcarousel-item"><a href="/markup/bucket/view-photos.php">Photos</a></li>
					<li class="touchcarousel-item"><a href="/markup/bucket/view-map.php">Map</a></li>
					<li class="touchcarousel-item"><a href="/markup/bucket/view-timeline.php">Timeline</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div id="content" class="bucket drops cf">
		<div class="center">

			<!-- ALTERNATE MESSAGE TO VIEW NEW DROPS //
			<article class="alert-message blue col_12 drop">
				<p><a href="#">13 new drops</a></p>
			</article>
			// END MESSAGE -->

			<article class="drop col_3 base">
				<h1><a href="/markup/drop/" class="zoom-trigger">Saluting @chiefkariuki and what he's doing for Lanet Umoja Location via Twitter. You restore hope in our leadership sir! cc @ushahidi</a></h1>
				<div class="drop-actions cf">
					<ul class="dual-buttons score-drop">
						<li class="button-white like"><a href="#"><span class="icon-thumbs-up"></span></a></li>
						<li class="button-white dislike"><a href="#"><span class="icon-thumbs-down"></span></a></li>
					</ul>
					<ul class="dual-buttons move-drop">
						<li class="button-blue share"><a href="/markup/modal-share.php" class="modal-trigger"><span class="icon-share"></span></a></li>
						<li class="button-blue bucket"><a href="/markup/modal-bucket.php" class="modal-trigger"><span class="icon-add-to-bucket"></span></a></li>
					</ul>
				</div>
				<section class="drop-source cf">
					<a href="#" class="avatar-wrap"><img src="/markup/images/content/avatar1.png" /></a>
					<div class="byline">
						<h2>Nanjira Sambuli</h2>
						<p class="drop-source-channel"><a href="#"><span class="icon-twitter"></span>via Twitter</a></p>
					</div>
				</section>
			</article>
		
			<article class="drop col_3 base">
				<a href="/markup/drop" class="drop-image-wrap zoom-trigger"><img src="/markup/images/content/drop-image.png" class="drop-image" /></a>
				<h1><a href="/markup/drop/" class="zoom-trigger">The Europe Roundup: Cybercrime in the UK, Ushahidi in Serbia, Big Data in Norway</a></h1>
				<div class="drop-actions cf">
					<ul class="dual-buttons score-drop">
						<li class="button-white like"><a href="#"><span class="icon-thumbs-up"></span></a></li>
						<li class="button-white dislike"><a href="#"><span class="icon-thumbs-down"></span></a></li>
					</ul>
					<ul class="dual-buttons move-drop">
						<li class="button-blue share"><a href="/markup/modal-share.php" class="modal-trigger"><span class="icon-share"></span></a></li>
						<li class="button-blue bucket added"><a href="/markup/modal-bucket.php" class="modal-trigger"><span class="icon-add-to-bucket"><strong>4</strong></span></a></li>
					</ul>
				</div>
				<section class="drop-source cf">
					<a href="#" class="avatar-wrap"><img src="/markup/images/content/avatar2.png" /></a>
					<div class="byline">
						<h2>The Global Journal</h2>
						<p class="drop-source-channel"><a href="#"><span class="icon-rss"></span>via RSS</a></p>
					</div>
				</section>
			</article>
		
			<article class="drop col_3 base">
				<h1><a href="/markup/drop/" class="zoom-trigger">Is there any one here in Egypt who can explain to me how could I used USHAHIDI and Crowdmap for an advocacy campaign to fight illiteracy?</a></h1>
				<div class="drop-actions cf">
					<ul class="dual-buttons score-drop">
						<li class="button-white like"><a href="#"><span class="icon-thumbs-up"></span></a></li>
						<li class="button-white dislike"><a href="#"><span class="icon-thumbs-down"></span></a></li>
					</ul>
					<ul class="dual-buttons move-drop">
						<li class="button-blue share"><a href="/markup/modal-share.php" class="modal-trigger"><span class="icon-share"></span></a></li>
						<li class="button-blue bucket"><a href="/markup/modal-bucket.php" class="modal-trigger"><span class="icon-add-to-bucket"></span></a></li>
					</ul>
				</div>
				<section class="drop-source cf">
					<a href="#" class="avatar-wrap"><img src="/markup/images/content/avatar3.png" /></a>
					<div class="byline">
						<h2>The Global Journal</h2>
						<p class="drop-source-channel"><a href="#"><span class="icon-facebook"></span>via Facebook</a></p>
					</div>
				</section>
			</article>

			<article class="drop col_3 base">
				<h1><a href="/markup/drop/" class="zoom-trigger">Saluting @chiefkariuki and what he's doing for Lanet Umoja Location via Twitter. You restore hope in our leadership sir! cc @ushahidi</a></h1>
				<div class="drop-actions cf">
					<ul class="dual-buttons score-drop">
						<li class="button-white like"><a href="#"><span class="icon-thumbs-up"></span></a></li>
						<li class="button-white dislike"><a href="#"><span class="icon-thumbs-down"></span></a></li>
					</ul>
					<ul class="dual-buttons move-drop">
						<li class="button-blue share"><a href="/markup/modal-share.php" class="modal-trigger"><span class="icon-share"></span></a></li>
						<li class="button-blue bucket"><a href="/markup/modal-bucket.php" class="modal-trigger"><span class="icon-add-to-bucket"></span></a></li>
					</ul>
				</div>
				<section class="drop-source cf">
					<a href="#" class="avatar-wrap"><img src="/markup/images/content/avatar1.png" /></a>
					<div class="byline">
						<h2>Nanjira Sambuli</h2>
						<p class="drop-source-channel"><a href="#"><span class="icon-twitter"></span>via Twitter</a></p>
					</div>
				</section>
			</article>
		
			<article class="drop col_3 base">
				<a href="/markup/drop" class="drop-image-wrap zoom-trigger"><img src="/markup/images/content/drop-image.png" class="drop-image" /></a>
				<h1><a href="/markup/drop/" class="zoom-trigger">The Europe Roundup: Cybercrime in the UK, Ushahidi in Serbia, Big Data in Norway</a></h1>
				<div class="drop-actions cf">
					<ul class="dual-buttons score-drop">
						<li class="button-white like"><a href="#"><span class="icon-thumbs-up"></span></a></li>
						<li class="button-white dislike"><a href="#"><span class="icon-thumbs-down"></span></a></li>
					</ul>
					<ul class="dual-buttons move-drop">
						<li class="button-blue share"><a href="/markup/modal-share.php" class="modal-trigger"><span class="icon-share"></span></a></li>
						<li class="button-blue bucket"><a href="/markup/modal-bucket.php" class="modal-trigger"><span class="icon-add-to-bucket"></span></a></li>
					</ul>
				</div>
				<section class="drop-source cf">
					<a href="#" class="avatar-wrap"><img src="/markup/images/content/avatar2.png" /></a>
					<div class="byline">
						<h2>The Global Journal</h2>
						<p class="drop-source-channel"><a href="#"><span class="icon-rss"></span>via RSS</a></p>
					</div>
				</section>
			</article>
		
			<article class="drop col_3 base">
				<h1><a href="/markup/drop/" class="zoom-trigger">Is there any one here in Egypt who can explain to me how could I used USHAHIDI and Crowdmap for an advocacy campaign to fight illiteracy?</a></h1>
				<div class="drop-actions cf">
					<ul class="dual-buttons score-drop">
						<li class="button-white like"><a href="#"><span class="icon-thumbs-up"></span></a></li>
						<li class="button-white dislike"><a href="#"><span class="icon-thumbs-down"></span></a></li>
					</ul>
					<ul class="dual-buttons move-drop">
						<li class="button-blue share"><a href="/markup/modal-share.php" class="modal-trigger"><span class="icon-share"></span></a></li>
						<li class="button-blue bucket"><a href="/markup/modal-bucket.php" class="modal-trigger"><span class="icon-add-to-bucket"></span></a></li>
					</ul>
				</div>
				<section class="drop-source cf">
					<a href="#" class="avatar-wrap"><img src="/markup/images/content/avatar3.png" /></a>
					<div class="byline">
						<h2>The Global Journal</h2>
						<p class="drop-source-channel"><a href="#"><span class="icon-facebook"></span>via Facebook</a></p>
					</div>
				</section>
			</article>
		</div>
	</div>

<div id="zoom-container">
	<div class="modal-window"></div>
</div>

<div id="modal-container">
	<div class="modal-window"></div>
</div>

</body>
</html>