<div class="container">
	<div class="row-fluid">
		<div class="span3">
			
			<div class="content">
				<div class="page-header">
					<h3><?php echo $this->shop->fullname() ?></h3>
				</div>
				<div class="row-fluid">
					<div class="span12 mt10">
						<p>- Address: <?php echo $this->shop->address ?></p>
						<p>- Email: <a href="mailto:<?php echo $this->shop->email ?>" title=""><?php echo $this->shop->email ?></a></p>
						<p>- Phone: <?php echo $this->shop->phone ?></p>
					</div>
				</div>
				<?php if($this->shop->has_avatar()): ?>
				<div class="row-fluid">	
					<div class="span12">
						<h4 class="box-title">Logo</h4>
						<div class="mt10"><?php echo $this->shop->avatar(340) ?></div>
					</div>
				</div>
				<?php endif ?>
			</div>
		
			<div class="content mt40">
				<div class="page-header">
					<h3>Promotions of store</h3>
				</div>
				<div class="content">
					<?php if( isset($other_promotions) and count($other_promotions) ): ?>
					<ul class="unstyled">
						<?php foreach($other_promotions as $item): ?>
						<li>
							<div class="promotion-detail">
								<h3><a href="<?php echo $item->url() ?>" title="<?php echo $item->title ?>"><?php echo $item->title ?></a></h3>
								<div class="content">
									<div class="meta">
										<span>Date From: </span>
										<?php if($item->gender_limit != ''): ?>
										<br><span>Genders: <?php echo $item->gender_limit ?></span>
										<?php endif ?>
										<?php if($item->age_limit): ?>
										<br><span>Ages: <?php echo $item->age_limit ?></span>
										<?php endif ?>
									</div>
								</div>
							</div>
						</li>
						<?php endforeach ?>
					</ul>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="span9">
			<div class="page-header">
				<h3><?php echo $promotion->title ?> (<?php echo $promotion->date_from() .' - '. $promotion->date_to() ?>)</h3>
			</div>
			<?php if($promotion->gender_limit != '' or $promotion->age_limit != ''): ?>
			<div class="promotion-meta">
				<?php if($promotion->gender_limit != ''): ?>
				<p>Gender: <?php echo $promotion->gender_limit ?></p>
				<?php endif ?>
				<?php if($promotion->age_limit != ''): ?>
				<p>Ages: <?php echo $promotion->age_limit ?></p>
				<?php endif ?>
			</div>
			<hr>
			<?php endif ?>
			<div class="content">
				<?php echo $promotion->content ?>
			</div>
		</div>
	</div>
</div>