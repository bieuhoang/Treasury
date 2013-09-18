<script>
	var SHOP_ID = <?php echo $this->shop->id ?>;
</script>
<div class="container">
	<div class="row-fluid">
		<div class="span4">
			<div class="box-content">
				<div class="row-fluid">
					<h2 class="box-title"><?php echo $this->shop->fullname() ?></h2>
					<div class="span12 mt10">
						<p>- Address: <?php echo $this->shop->address ?></p>
						<p>- Email: <a href="mailto:<?php echo $this->shop->email ?>" title=""><?php echo $this->shop->email ?></a></p>
						<p>- Phone: <?php echo $this->shop->phone ?></p>
						<p>- Zip: <?php echo $this->shop->zip ?></p>
						<p>- City: <?php echo $this->shop->city ?></p>
						<p>- Shop category: </p>
					</div>
					<?php if(ci()->auth->in_group(array(2))): ?>
					<div class="add-button pull-right">
						<a href="#" data-id="<?php echo $this->shop->id ?>" id="add-to-treasury" class="btn btn-small"><span class="icon-heart"></span> Add</a>
					</div>
					<?php endif ?>
				</div>
				<?php if($this->shop->has_avatar()): ?>
				<div class="row-fluid">	
					<div class="span12">
						<h4 class="box-title">Logo</h4>
						<div class="mt10"><?php echo $this->shop->avatar(340) ?></div>
					</div>
				</div>
				<?php endif ?>
				<?php if($this->shop->has_map()): ?>
				<script>
					var SHOP_LATITUDE = <?php echo $this->shop->latitude ?>;
					var SHOP_LONGITUDE = <?php echo $this->shop->longitude ?>;
				</script>
				<div class="row-fluid">
					<div class="span12">
						<h4 class="box-title">Map</h4>
						<div id="map-<?php echo $this->shop->id ?>"></div>
					</div>
				</div>
				<?php endif ?>
			</div>
			<div class="box-content">
				<div class="page-header">
					<h2>Current Promotions</h2>
				</div>
				<div>
					<?php if($this->shop->current_promotions()): ?>
					<ul class="unstyled">
						<?php foreach($this->shop->current_promotions() as $promotion): ?>
						<li>
							<div class="promotion-detail">
								<h3><a href="<?php echo $promotion->url() ?>" title="<?php echo $promotion->title ?>"><?php echo $promotion->title ?></a></h3>
								<div class="content">
									<div class="meta">
										<span>Date From: <?php echo $promotion->date_from('d/m/Y') ?></span> - <span>Date To: <?php echo $promotion->date_to('d/m/Y') ?></span>
										<div class="">
											<?php echo $promotion->content(20) ?>
										</div>
									</div>
								</div>
							</div>
						</li>
						<?php endforeach ?>
					</ul>
					<?php else: ?>
					No promotion not found
					<?php endif ?>
				</div>
			</div>
			<div class="box-content">
				<div class="page-header">
					<h2>Past Promotions</h2>
				</div>
				<div>
					<?php if($this->shop->past_promotions()): ?>
					<ul class="unstyled">
						<?php foreach($this->shop->past_promotions() as $promotion): ?>
						<li>
							<div class="promotion-detail mt20">
								<h3><a href="<?php echo $promotion->url() ?>" title="<?php echo $promotion->title ?>"><?php echo $promotion->title ?></a></h3>
								<div class="content">
									<div class="meta">
										<span>Ended: <?php echo $promotion->date_to('d/m/Y') ?></span>
									</div>
									<div class="detail"><?php echo $promotion->content(20) ?></div>
								</div>
							</div>
						</li>
						<?php endforeach ?>
					</ul>
					<?php else: ?>
					No promotion not found
					<?php endif ?>
				</div>
			</div>
		</div>

		<div class="span8">
			<div class="box-content">
				<h2 class="box-title">Public text</h2>
				<div class="content">
					<div class="mt10" id="public_text_content">
					<?php echo $this->shop->public_text ?>
					</div>

					<?php if($this->auth->logged_in() and $this->auth->in_group(3)): ?>
					<div class="edit-page pull-right mt20">	
						<a href="#" class="edit-public-page"><span class="icon-edit"></span>Edit</a>
					</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>