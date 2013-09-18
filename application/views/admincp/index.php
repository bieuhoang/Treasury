<div class="row-fluid">
	<div class="span4">
		<h2 class="box-title">Users statistic</h2>
		<div class="content mt20">
			<div class="tabbable"> <!-- Only required for left/right tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#user-tab1" data-toggle="tab">24 h</a></li>
					<li><a href="#user-tab2" data-toggle="tab">7 days</a></li>
					<li><a href="#user-tab3" data-toggle="tab">31 days</a></li>
					<li><a href="#user-tab4" data-toggle="tab">This month</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="user-tab1">
						<p>Total: <strong class="pull-right"><?php echo isset($total_users_24h) ? $total_users_24h : 0 ?> users</strong></p>
					</div>
					<div class="tab-pane" id="user-tab2">
						<p>Total: <strong class="pull-right"><?php echo isset($total_users_7days) ? $total_users_7days : 0 ?> users</strong></p>
					</div>
					<div class="tab-pane" id="user-tab3">
						<p>Total: <strong class="pull-right"><?php echo isset($total_users_31days) ? $total_users_31days : 0 ?> users</strong></p>
					</div>
					<div class="tab-pane" id="user-tab4">
						<p>Total: <strong class="pull-right"><?php echo isset($total_users_this_month) ? $total_users_this_month : 0 ?> users</strong></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span4">
		<h2 class="box-title">Promotions statistic</h2>
		<div class="content mt20">
			<div class="tabbable"> <!-- Only required for left/right tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#promotion-tab1" data-toggle="tab">24 h</a></li>
					<li><a href="#promotion-tab2" data-toggle="tab">7 days</a></li>
					<li><a href="#promotion-tab3" data-toggle="tab">31 days</a></li>
					<li><a href="#promotion-tab4" data-toggle="tab">This month</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="promotion-tab1">
						<p>Total: <strong class="pull-right"><?php echo isset($total_promotions_24h) ? $total_promotions_24h : 0 ?> promotions</strong></p>
					</div>
					<div class="tab-pane" id="promotion-tab2">
						<p>Total: <strong class="pull-right"><?php echo isset($total_promotions_7days) ? $total_promotions_7days : 0 ?> promotions</strong></p>
					</div>
					<div class="tab-pane" id="promotion-tab3">
						<p>Total: <strong class="pull-right"><?php echo isset($total_promotions_31days) ? $total_promotions_31days : 0 ?> promotions</strong></p>
					</div>
					<div class="tab-pane" id="promotion-tab4">
						<p>Total: <strong class="pull-right"><?php echo isset($total_promotions_this_month) ? $total_promotions_this_month : 0 ?> promotions</strong></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span4">
		<h2 class="box-title">Store Owners statistic</h2>
		<div class="content mt20">
			<div class="tabbable"> <!-- Only required for left/right tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#owner-tab1" data-toggle="tab">24 h</a></li>
					<li><a href="#owner-tab2" data-toggle="tab">7 days</a></li>
					<li><a href="#owner-tab3" data-toggle="tab">31 days</a></li>
					<li><a href="#owner-tab4" data-toggle="tab">This month</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="owner-tab1">
						<p>Total: <strong class="pull-right"><?php echo isset($total_owners_24h) ? $total_owners_24h : 0 ?> owners</strong></p>
					</div>
					<div class="tab-pane" id="owner-tab2">
						<p>Total: <strong class="pull-right"><?php echo isset($total_owners_7days) ? $total_owners_7days : 0 ?> owners</strong></p>
					</div>
					<div class="tab-pane" id="owner-tab3">
						<p>Total: <strong class="pull-right"><?php echo isset($total_owners_31days) ? $total_owners_31days : 0 ?> owners</strong></p>
					</div>
					<div class="tab-pane" id="owner-tab4">
						<p>Total: <strong class="pull-right"><?php echo isset($total_owners_this_month) ? $total_owners_this_month : 0 ?> owners</strong></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>