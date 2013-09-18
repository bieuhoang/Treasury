<div class="container">
	<div class="row-fluid">
		<div class="span3 mt30">
			<?php echo $this->template->block('user_sidebar') ?>
		</div>
		<div class="span9 box">
			<div class="box-content">
				<div class="page-header">
					<h2>My treasury</h2>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<fieldset>
							<legend>Statistic Members</legend>
							<div class="row-fluid">
								<div class="span5">Total Registered</div>
								<div class="span7"><?php echo isset($total_user_registered) ? $total_user_registered : 0 ?></div>
							</div>
						</fieldset>
					</div>
					<div class="span4">
						<fieldset>
							<legend>Impressions</legend>
							<div class="row-fluid">
								<div class="span5">Total Favorites</div>
								<div class="span7"><?php echo isset($total_favorites) ? $total_favorites : 0 ?></div>
							</div>
						</fieldset>
					</div>
					<div class="span4">
						<fieldset>
							<legend>Statistic Promotions</legend>
							<div class="row-fluid">
								<div class="span5">Total</div>
								<div class="span7"><?php echo isset($total_promotions) ? $total_promotions : 0 ?></div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>