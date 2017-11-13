			<?php do_action('cpotheme_after_main'); ?>
			
			<?php get_sidebar('footer'); ?>
			
			<?php do_action('cpotheme_before_footer'); ?>
			<footer id="footer" class="footer">
				<div class="container">
                    <div class="row">
                        <div class="footer-logo col col-xs-1 col-sm-3">
                            <?php cpotheme_logo(); ?>
                        </div>
                        <div class="footer-contact-info colcol-xs-1 col-sm-3">
                            <h3>Contact Information</h3>
                            <ul>
                                <li><strong>Telephone </strong><?php the_cfc_field('contact_information', 'phone', 3579); ?></li>
                                <li><strong>Email </strong><?php the_cfc_field('contact_information', 'email', 3579); ?></li>
                                <li><strong>Address</strong>
                                    <?php the_cfc_field('contact_information', 'address', 3579); ?>
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
