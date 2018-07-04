<?php snippet('header');
//redirect to home, if user is not login
if(s::get('hasOnlineAccess') === NULL){
	redirect::to(page('home')->url());
} ?>
<!-- ACCOUNT SECTION -->
<section class="account grid-container">

	<!-- profile snippet -->
	<?php snippet('accounts/profile') ?>

	<!-- ACCOUNT MODAL -->

	<?php snippet('accounts/changepass') ?>

	<?php snippet('accounts/editprofile') ?>

	<!-- END OF ACCOUNT MODAL -->

</section>

<!-- END OF ACCOUNT SECTION -->

<!-- PROMO SECTION -->
<?php snippet('promo') ?>
<!-- END PROMO SECTION -->

<!-- COURSE LISTING SECTION -->

<?php snippet('mycourse')?>


<!-- END COURSE LISTING SECTION -->

<!-- CONTACT SECTION -->
<?php snippet('contact')?>
<!-- END CONTACT SECTION -->

<!-- PARTNERS SECTION -->
<?php snippet('partners') ?>
<!-- END PARTNERS SECTION -->

<!-- FOOTER -->
<?php snippet('footer') ?>
