<?php $this->load->view('header') ?>
<div class="col hero">
	
    <h2 class="my-5">Cocobox</h2>
	<img src="<?php echo base_url('img/promo.png') ?>">
	
	<?php if ($this->user): ?>
		<h1>Visit Your Island</h1>
		<p class="mb-4">Your island awaits! Cocobox is a social browser game. Dress your pet, interact with your pet, explore various maps, and more.</p>
		<a href="<?php echo base_url('world') ?>" class="btn btn-primary btn-lg">Visit island</a>
	<?php else: ?>
		<h1>Adopt your pet today!</h1>
		<p class="mb-4">Your island awaits! Cocobox is a social browser game. Dress your pet, interact with your pet, explore various maps, and more.</p>
		<a href="<?php echo base_url('user/signup') ?>" class="btn btn-primary btn-lg">Get my pet</a>
	<?php endif ?>
	<form method="post" action="<?php echo base_url('mailing') ?>" class="m-5 p-5">
		<h6 class="text-center mb-3">Sign up for updates!</h6>
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