<div class="row-fluid">
	<div class="span12">
		<div id="map-canvas" class="google-map-loading">Google Map is loading...</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="search-bar-home">
					<?php echo form_open('', 'class="form-horizontal" id="form-search-map-homepage"') ?>
					<div class="container">
						<div class="row-fluid">
							<div class="span7 mt20">
								<input type="text" id="search-input-homepage" class="input-search search-query span12" placeholder="Enter your location at here..." name="s">
							</div>
							<div class="span3">
								<button type="submit" class="btn-search-primary w100 medium red">Search</button>
							</div>
							<div class="span2">
								<button class="btn-search-primary medium red join-now">Join now</button>
							</div>
						</div>
					</div>
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row-fluid">
		<div class="span9 mt20">
			<?php if(config_item('page_home_content_1') !== '' or config_item('page_home_content_2') !== '' or config_item('page_home_content_3') !== ''): ?>
			<div class="row-fluid mb20">
				<?php foreach(array(1,2,3) as $num): ?>
					<?php if(config_item('page_home_content_'.$num) != '' and config_item('page_home_title_'.$num) != ''): ?>
					<div class="span4">
						<h2 class="box-title text-center"><?php echo config_item('page_home_title_'.$num) ?></h2>
						<div class="content mt10 homepage-content">
							<p><?php echo word_limiter(config_item('page_home_content_'.$num), 30) ?></p>
						</div>
						<a href="<?php echo site_url('detail-'.$num.'-'.url_title(config_item('page_home_title_'.$num))) ?>" class="pull-right mt5">Detail...</a>
					</div>
					<?php endif ?>					
				<?php endforeach ?>
			</div>
			<?php endif ?>
			<div class="row-fluid">
				<h2 class="box-title">Newest promotions</h2>
				<div class="list-newest-shops promotions">
					<div class="row-fluid line mb10">
					<?php foreach($this->promotions as $index => $promotion): ?>
						<div class="span4 mb20">
							<h3 class="mb10"><a href="<?php echo $promotion->url() ?>"><?php echo $promotion->title ?></a></h3>
							<?php if($promotion->image != ''): ?>
								<?php echo img(array('src' => $promotion->image(300), 'class' => 'avatar promotion-image mb10')) ?>
							<?php endif ?>
							<div class="meta mb10">
								Time: <?php echo $promotion->date_from() ?> - <?php echo $promotion->date_to() ?>
								<?php if($promotion->gender_limit != ''): ?>
								<br>Genders: <?php echo $promotion->gender_limit ?>
								<?php endif ?>
								<?php if($promotion->age_limit != ''): ?>
								<br>Ages: <?php echo $promotion->age_limit ?>
								<?php endif ?>
							</div>
							<div class="body">
								<?php echo word_limiter($promotion->content, 20) ?>
							</div>
						</div>
					<?php if($index == 2 or ($index > 2 and $index%3 == 2)): ?></div><div class="row-fluid"><?php endif ?>
					<?php endforeach ?>
					</div>
				</div>
				<div id="pagination">
					<?php echo $this->pagination->create_links() ?>
				</div>
			</div>
		</div>
		<div class="span3">
			<div class="mt30">
				<h2 class="box-title">Newest shop</h2>
				<div class="list-newest-shops">
					<ul class="unstyled">
						<?php foreach($this->newest_shops as $shop): ?>
						<li>
							<div class="newest-shop-item">
								<div class="row-fluid">
									<div class="span12">
										<?php echo user_avatar($shop->avatar, 230) ?>
									</div>
								</div>
								<div class="row-fluid mt10">
									<div class="span12">												
										<h4><?php echo anchor('store/'.$shop->id, implode(' ', array($shop->first_name, $shop->last_name))) ?></h4>
										<p>
											Address: <?php echo $shop->address ?><br>
											Email: <?php echo mailto($shop->email, $shop->email) ?><br>
											Phone: <?php echo $shop->phone ?><br>
											Website: <?php echo auto_link($shop->website) ?><br>
										</p>
									</div>
								</div>
							</div>
						</li>
						<?php endforeach ?>
					</ul>							
				</div>
			</div>
		</div>
	</div>
</div>