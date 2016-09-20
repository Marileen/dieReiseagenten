<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package unite
 */
?>
            </div><!-- row -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<!-- Widget 1 -->
					<div class="widget">
						<h4>Über uns</h4>
						<p>
							Die Reiseagenten - individuelle Urlaubsberatung.<br>
							Sie erreichen uns jederzeit per Email <a href="mailto:tk@diereiseagenten.de">tk@diereiseagenten.de</a>
							<br>Wir rufen Sie gern zurück.
						</p>
						<p>
						<ul>
							<li>
								<i class="fa fa-angle-right"></i> <a href="/ueber-uns">Mehr über uns</a>

							</li>
						</ul>
						</p>
						<!--&lt;!&ndash; Social Media &ndash;&gt;-->
						<!--<div class="social">-->
						<!--<a href="#"><i class="fa fa-twitter twitter"></i></a>-->
						<!--<a href="#"><i class="fa fa-pinterest pinterest"></i></a>-->
						<!--<a href="#"><i class="fa fa-facebook facebook"></i></a>-->
						<!--<a href="#"><i class="fa fa-google-plus google-plus"></i></a>-->
						<!--<a href="#"><i class="fa fa-linkedin linkedin"></i></a>-->
						<!--</div>-->
					</div>
				</div>
				<div class="col-md-4">
					<!-- widget 2 -->
					<div class="widget">
						<h4>Informationen</h4>
						<?php unite_footer_links(); ?>
						<ul>
							<li><i class="fa fa-angle-right"></i> <a href="/kontakt">Kontakt</a></li>
							<li><i class="fa fa-angle-right"></i> <a href="/impressum">Impressum</a></li>
							<li><i class="fa fa-angle-right"></i> <a href="/datenschutz">Datenschutz</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<!-- Widget 3 -->
					<div class="widget">

					</div>
				</div>
			</div>
			<div class="row">
				<hr />
				<div class="col-md-12"><p class="copy pull-left">
						Copyright &copy; Die Reiseagenten
				</div>
			</div>
		</div>

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>