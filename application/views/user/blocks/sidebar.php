<ul class="nav nav-tabs nav-stacked box user-sidebar">

	<li id="user-sidebar-item-my-profile"><?php echo anchor('profile', 'My Profile') ?></li>
	<li id="user-sidebar-item-my-profile"><?php echo anchor('profile', 'Add new shop') ?></li>
	<li id="user-sidebar-item-change-password"><?php echo anchor('change-password', 'Change password') ?></li>

	<?php if($this->auth->in_group(2)): ?>
	<li id="user-sidebar-item-my-promotion"><?php echo anchor('my-dashboard', 'Dashboard') ?></li>
	<?php endif ?>

	<?php if($this->auth->in_group(3)): ?>
	<li id="user-sidebar-item-my-store"><?php echo anchor('store-promotions', 'My Promotions') ?></li>
	<li id="user-sidebar-item-my-treasury"><?php echo anchor('my-treasury', 'My Treasury') ?></li>
	<li id="user-sidebar-item-new-promotion"><?php echo anchor('user/add-new-promotion', 'Add new promotion') ?></li>
	<li id="user-sidebar-item-view-my-store"><?php echo anchor('user/view_shop/'.$this->current_user->id, 'View my store') ?></li>
	<li id="user-sidebar-item-qr-code"><?php echo anchor('user/qr-code', 'QR Code') ?></li>
	<?php endif ?>
	<li id="user-sidebar-item-my-promotion"><?php echo anchor('user/cancel_account', 'Cancel my account') ?></li>
</ul>