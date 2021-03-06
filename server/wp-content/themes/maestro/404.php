<?php get_header(); ?>

	<div id="content" class="page page-404">

		<div id="inner-content" class="wrap cf">

			<div id="main" class="cf" role="main">

				<article id="post-not-found" class="hentry cf">

					<header class="article-header">

						<h1 class="h1"><?php _e( 'Epic 404 - Article Not Found', 'bonestheme' ); ?></h1>

					</header>

					<section class="entry-content">

						<p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'bonestheme' ); ?></p>

					</section>

					<section class="search">

						<p><?php get_search_form(); ?></p>

					</section>

					<footer class="article-footer">

						<p><a href="/" title="<?php _e( 'Back to home.', 'bonestheme' ); ?>"><?php _e( 'Back to home.', 'bonestheme' ); ?></a></p>

					</footer>

				</article>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
