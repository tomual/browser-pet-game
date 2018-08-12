<?php $this->load->view('header') ?>
<div class="col hero">
	
    <h2 class="my-5">Cocobox</h2>
	<img src="<?php echo base_url('img/promo.png') ?>">
	<!-- <h1>Adopt your pet today!</h1> -->
	<!-- <p class="mb-4">Your island awaits! Pick one of our starting pets to get started. Dress your pet, interact with your pet, explore various maps, and more!</p> -->
	<!-- <a href="" class="btn btn-primary btn-lg">Pick a pet</a> -->
	<form method="post" action="<?php echo base_url('mailing') ?>">
		<h1>Sign up for updates!</h1>
		<p class="mb-4">Cocobox is a social idle pet game. You can pick your pet, own your own island, dress your pet and decorate your island. Cocobox is a browser game. We'll let you know when the alpha version of the game is up. <span class="text-muted">(Last updated June 9 2018)</span></p>
		<div class="form-group mb-3">
			<?php alerts() ?>
			<label class="form-label sr-only">Email</label>
			<input type="email" name="email" class="form-control" placeholder="myemail@gmail.com">
			<small class="form-text text-muted">We'll only use your email to send you updates</small>
		</div>
		<div class="form-group">
			<input type="submit" value="Be notified" class="btn btn-primary btn-lg">
		</div>
	</form>
</div>
<?php $this->load->view('footer') ?>