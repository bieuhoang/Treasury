<div class="container mt30">
	<div class="row-fluid">
		<div class="span3">
			<div class="page-header">
				<h2>My shops list</h2>
			</div>
			<div class="content">
				<?php if(isset($my_shops) and count($my_shops)): ?>
				<ul class="unstyled">
					<?php foreach($my_shops as $shop): ?>
					<li>
						<div class="newest-shop-item">
							<a href="<?php echo $shop->url() ?>" title="<?php echo $shop->fullname() ?>"><?php echo user_avatar($shop->avatar, 300) ?></a>
						</div>
					</li>
					<?php endforeach ?>
				</ul>
				<?php else: ?>
				<p>It seems you have not yet subscribed to one of our retailers special offers. Find your favourite retailer now</p>
				<?php endif ?>
				<hr>
				<button class="btn" onclick="window.location.href='<?php echo site_url('search') ?>';">Subscribe to a new store</button>
			</div>
		</div>
		<div class="span6">
			<div class="page-header">
				<h2>Offering</h2>
			</div>
			<div class="content offer">
				<?php if(isset($offerings) and count($offerings)): ?>
					<div class="row-fluid">
						
						<?php foreach($offerings as $offer): ?>
						<div class="span4">
							<h4><?php echo $offer->title ?></h4>
							<div class="store">
								<a href="<?php echo $offer->owner()->url() ?>" title="<?php echo $offer->owner()->fullname() ?>"><?php echo $offer->owner()->avatar(100) ?></a>
								<h5><a href="<?php echo $offer->owner()->url() ?>" title="<?php echo $offer->owner()->fullname() ?>"><?php echo $offer->owner()->fullname() ?></a></h5>
							</div>
							<hr>
							<div class="info">
								<p>From: <?php echo $offer->date_from() ?><p>
								<p>To: <?php echo $offer->date_to() ?></p>
								<?php if($offer->gender_limit != ''): ?>
								<p>Gender: <?php echo $offer->gender_limit ?></p>
								<?php endif ?>
								<?php if($offer->age_limit != ''): ?>
								<p>Ages: <?php echo $offer->age_limit ?></p>
								<?php endif ?>
							</div>
						</div>
						<?php endforeach; ?>

					</div>
				<?php else: ?>
				<p>No special offers from your favourite retailers, perhaps you should subscribe to more retailers?</p>
				<div class="mt10">
					<button class="btn" onclick="window.location.href='<?php echo site_url('search') ?>';">Find new store</button>
				</div>
				<?php endif ?>
			</div>
		</div>
		<div class="span3">
			<div class="page-header">
				<h2>Offers missed</h2>
			</div>
			<div class="content">
				<?php if(isset($missed_offerings) and count($missed_offerings)): ?>
					<div class="row-fluid">
						
						<?php foreach($missed_offerings as $offer): ?>
						<div class="span6">
							<a href="<?php echo $offer->url() ?>" title="<?php echo $offer->title ?>"><h4><?php echo $offer->title ?></h4></a>
							<div class="store">
								<a href="<?php echo $offer->owner()->url() ?>" title="<?php echo $offer->owner()->fullname() ?>"><?php echo $offer->owner()->avatar(100) ?></a>
								<h5><a href="<?php echo $offer->owner()->url() ?>" title="<?php echo $offer->owner()->fullname() ?>"><?php echo $offer->owner()->fullname() ?></a></h5>
							</div>
							<hr>
						</div>
						<?php endforeach; ?>

					</div>
				<?php else: ?>
				<p>No special offers from your favourite retailers, perhaps you should subscribe to more retailers?</p>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>