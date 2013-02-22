<!DOCTYPE html>
<html>
	<head>
		<title><? wp_title( '|', true, 'right' ); ?></title>
		<link rel="stylesheet" href="/wp-content/themes/improve/style.min.css?v=2" />
		<script src="/wp-content/themes/improve/combined.js"></script>
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<meta charset="UTF-8" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="http://improve.dk/xmlrpc.php" />
		<link rel="alternate" type="application/rss+xml" title="Mark S. Rasmussen - improve.dk" href="http://feeds.feedburner.com/Improvedk" />
		<? wp_head() ?>
	</head>
	<body>
	
		<div id="headerline"></div>
	
		<header>
			<div class="wrapper">
				<div id="title">
					<a href="/">Mark S. Rasmussen</a> <span>improve.dk</span>
				</div>
				
				<nav>
					<ul class="normal">
						<li class="navicon"><img src="/wp-content/themes/improve/images/navicon.png" /></li>
						<? wp_list_pages(array('title_li' => '')) ?>
					</ul>
				</nav>
				
				<ul id="sharing">
					<li><a href="mailto:mark@improve.dk"><img src="/wp-content/themes/improve/images/at.png" /></a></li>
					<li><a href="http://feeds.feedburner.com/Improvedk"><img src="/wp-content/themes/improve/images/rss.png" /></a></li>
					<li><a href="https://www.linkedin.com/in/markrasmussen/"><img src="/wp-content/themes/improve/images/linkedin.png" /></a></li>
					<li><a href="https://twitter.com/improvedk"><img src="/wp-content/themes/improve/images/twitter.png" /></a></li>
				</ul>

				<div class="clear"></div>
				
				<div id="naviconcontent">
					<ul class="mobile">
						<li>
							Pages
							<ul class="pages"></ul>
						</li>
						<li>
							Categories
							<ul class="categories"></ul>
						</li>
						<li>
							Archive
							<ul class="archive"></ul>
						</li>
					</ul>
				</div>
			</div>
		</header>

		<div id="mainwrapper">
			<div id="contentwrapper">
				<div id="content">
				
					<? if ( have_posts() ) :
						   while ( have_posts() ) :
							   the_post(); ?>
						<article <? if (is_page()) : ?>class="page"<? endif ?>>
							<? if (!is_page()) : ?>
								<div class="datebox">
									<div class="upper">
										<span class="month"><? the_time('M') ?></span>
										<span class="day"><? the_time('d') ?></span>
									</div>
									<div class="lower"><? the_time('Y') ?></div>
								</div>
							<? endif ?>

							<div class="title">
								<h1><a href="<? the_permalink() ?>" title="<? the_title_attribute() ?>" rel="bookmark"><? the_title(); ?></a></h1>
								<? if (!is_page()) : ?>
									<div class="categories"><? the_category(', ') ?></div>
									<div class="comments"><? comments_popup_link() ?></div>
									<? edit_post_link('Edit', '<div class="edit">', '</div>'); ?>
								<? endif ?>
								<div class="clear"></div>
							</div>
							
							<div id="bodywrapper" <? if (is_single()) : ?>class="single"<? endif ?>>
								<? if (is_category() or is_archive()) : ?>
									<div class="body"><? the_excerpt() ?></div>
								<? else : ?>
									<div class="body">
										<? the_content() ?>
									
										<div style="clear: both"></div>
										
										<? if (is_single()) : ?>
											<div id="postsharing">
												<a href="https://twitter.com/home?status=<?= urlencode(get_the_title() . " " . get_permalink() . " via @improvedk") ?>" target="_blank"><img src="/wp-content/themes/improve/images/twitter_64x64.png" /></a>
												<a href="https://www.facebook.com/sharer.php?u=<?= urlencode(get_permalink()) . "&t=" . urlencode(get_the_title()) ?>" target="_blank"><img src="/wp-content/themes/improve/images/facebook_64x64.png" /></a>
												<a href="http://reddit.com/submit?url=<?= urlencode(get_permalink()) . "&title=" . urlencode(get_the_title()) ?>" target="_blank"><img src="/wp-content/themes/improve/images/reddit_64x64.png" /></a>
											</div>
											
											<div id="bio">
												<img src="/wp-content/themes/improve/images/avatar.jpg" class="avatar avatar-96 photo" height="96" width="96">
												<div class="wrapper">
													<div class="name"><? the_author_meta('display_name') ?></div>
													<div class="description"><? the_author_meta('description') ?></div>
												</div>
												<div class="clear"></div>
											</div>
										<? endif ?>
									</div>
								<? endif ?>
							
								<? if (is_single()) : ?>
									<? comments_template() ?>
								<? endif ?>
							</div>
							
						</article>
					<? endwhile;
					   endif; ?>

					<? if (!is_single() and (get_next_posts_link() || get_previous_posts_link())) : ?>
						<div class="paging">
							<? next_posts_link('<div class="past">&laquo; Past</div>') ?>
							<? previous_posts_link('<div class="future">Future &raquo;</div>') ?>
							<div class="clear"></div>
						</div>
					<? endif ?>
				</div>
			</div>

			<div id="asides">
				<div class="categories aside">
					<span class="sectiontitle">CATEGORIES</span>
					<ul><? wp_list_categories(array('title_li' => '')) ?></ul>
				</div>

				<div class="archive aside">
					<span class="sectiontitle">ARCHIVE</span>
					<ul><? wp_get_archives() ?></ul>
				</div>
			</div>

			<div class="clear"></div>
		</div>
		
		<footer>
			<div class="wrapper">Copyright &copy; <? echo date("Y") ?> Mark S. Rasmussen</div>
		</footer>
		
		<script>
			$("li.navicon").click(function() {
				if ($("header ul.mobile a").length == 0) {
					// Pages
					$mobilePages = $("div#naviconcontent ul.pages");
					$("header nav ul.normal > li").not(".navicon").each(function(i, el) {
						$mobilePages.append($(el).clone());
					});
		
					// Categories
					$mobileCategories = $("div#naviconcontent ul.categories");
					$("div#asides div.categories > ul > li").each(function(i, el) {
						$mobileCategories.append($(el).clone());
					});
				
					// Archive
					$mobileArchive = $("div#naviconcontent ul.archive");
					$("div#asides div.archive > ul > li").each(function(i, el) {
						$mobileArchive.append($(el).clone());
					});
				};
			
				$("header ul.mobile").toggle();
			});

			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-2479580-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		
		<? wp_footer() ?>
	</body>
</html>