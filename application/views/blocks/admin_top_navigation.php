<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<div class="row">
				<ul class="nav" role="navigation">
					<li id="nav-item-dashboard"><?php echo anchor('admin', 'Dashboard') ?></li>
					<li id="nav-item-promotion" class="dropdown">
						<a id="nav-item-sub-item-promotion" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Promotions <b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="nav-item-sub-item-promotion">
							<li role="presentation"><?php echo anchor('admin/promotion', 'Promotions Management', 'role="menuitem" tabindex="-1"') ?></li>
							<li class="divider"></li>
							<li role="presentation"><?php echo anchor('admin/promotion/edit', 'Add new promotion', 'role="menuitem" tabindex="-1"') ?></li>
						</ul>
					</li>
					<li id="nav-item-category" class="dropdown">
						<a id="nav-item-sub-item-category" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="nav-item-sub-item-category">
							<li role="presentation"><?php echo anchor('admin/category', 'Categories Management', 'role="menuitem" tabindex="-1"') ?></li>
						</ul>
					</li>
					<li id="nav-item-user" class="dropdown">
						<a id="nav-item-sub-item-user" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="nav-item-sub-item-user">
							<li role="presentation"><?php echo anchor('admin/user', 'Users Management', 'role="menuitem" tabindex="-1"') ?></li>
							<li class="divider"></li>
							<li role="presentation"><?php echo anchor('admin/user/edit', 'Add new user', 'role="menuitem" tabindex="-1"') ?></li>
						</ul>
					</li>
					<li id="nav-item-setting"><?php echo anchor('admin/setting', 'Settings', 'role="button"') ?></li>
					<li id="nav-item-homepage"><?php echo anchor('', 'Homepage') ?></li>
				</ul>
				<ul class="nav pull-right">
					<li id="nav-item-user-logged-in" class="dropdown">
						<a id="nav-item-sub-item-user-logged-in" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->current_user->email ?> <b class="caret"></b></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="nav-item-sub-item-user-logged-in">
							<li role="presentation"><?php echo anchor('my-profile', 'Profile', 'role="menuitem" tabindex="-1"') ?></li>
							<li class="divider"></li>
							<li role="presentation"><?php echo anchor('logout', 'Logout', 'role="menuitem" tabindex="-1"') ?></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>