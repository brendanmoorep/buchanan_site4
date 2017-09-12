			<?php do_action('cpotheme_after_main'); ?>
			
			<?php get_sidebar('footer'); ?>
			
			<?php do_action('cpotheme_before_footer'); ?>
			<footer id="footer" class="footer bg-white">
				<div class="container">
                    <div class="row">
                        <div class="footer-logo col col-xs-1 col-sm-3">
                            <?php cpotheme_logo(); ?>
                        </div>
                        <div class="footer-contact-info colcol-xs-1 col-sm-3">
                            <h3>Contact Information</h3>
                            <ul>
                                <li><strong>Telephone </strong>603.978.3117</li>
                                <li><strong>Email </strong>info@buchananpartners.com</li>
                                <li><strong>Address</strong>
                                    9841 Washingtonian Boulevard Suite 300 Gaithersburg, MD 20878
                                </li>
                            </ul>
                        </div>
                        <div class="col col-xs-1 col-sm-5">
                            <?php cpotheme_menu(); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <p class="footer-tagline color-blue">Copyright &copy; Buchanan Partners 2017, All Rights Reserved</p>
                    </div>
					<?php //do_action('cpotheme_footer'); ?>
				</div>
			</footer>
			<?php //do_action('cpotheme_after_footer'); ?>
			
			<div class="clear"></div>
		</div><!-- wrapper -->
		<?php do_action('cpotheme_after_wrapper'); ?>
	</div><!-- outer -->
	<?php wp_footer(); ?>
</body>
</html>
