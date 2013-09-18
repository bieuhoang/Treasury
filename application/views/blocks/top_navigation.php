<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<div class="row-fluid">
				<div class="span1">
					<h3 class="logo">LOGO</h3>
				</div>
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="nav-collapse collapse span5">
					<ul class="nav">
						<li id="nav-item-site-index"><?php echo anchor('', 'Home') ?></li>
						<li id="nav-item-site-about-us"><?php echo anchor('about-us', 'About us') ?></li>
						<li id="nav-item-site-terms-and-conditions"><?php echo anchor('terms-and-conditions', 'Terms and Conditions') ?></li>
						<!-- <li id="nav-item-site-contact-us"><?php echo anchor('contact-us', 'Contact us') ?></li> -->
					</ul>
				</div>
				<?php if(current_url() != site_url()): ?>
				<?php echo form_open('search', 'class="navbar-form span4" method="get"') ?>
					<input type="text" class="search-query span12 search-box" name="s" placeholder="Input your location and hit Enter..." value="<?php echo config_item('query_string') ?>">
				<?php echo form_close() ?>
				<?php endif ?>
				<div class="<?php echo current_url() != site_url() ? 'span2' : 'span6' ?>">
					<ul class="nav pull-right">
						<?php if(! $this->auth->logged_in()): ?>
							<li id="nav-item-user-register"><?php echo anchor('register', 'Register') ?></li>
							<li id="nav-item-user-login"><?php echo anchor('login', 'Login') ?></li>
						<?php else: ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo $this->current_user->username ?>"><?php echo $this->current_user->fullname ?><b class="caret"></b></a>
								<ul class="dropdown-menu">
									<?php if($this->auth->is_admin()): ?>
									<li id="nav-item-user-dashboard"><?php echo anchor('admin', 'Dashboard') ?></li>
									<li class="divider"></li>
									<li id="nav-item-user-logout"><?php echo anchor('logout', 'Logout') ?></li>
									<?php else: ?>
									<?php if($this->auth->in_group(3)): ?>
									<li id="nav-item-user-my-page"><?php echo anchor('store/'.$this->current_user->id.'-'.url_title($this->current_user->fullname, '-', true), 'My Store') ?></li>
									<?php endif ?>
									<li id="nav-item-user-my-profile"><?php echo anchor('profile', 'My Account') ?></li>
									<?php if($this->auth->in_group(2)): ?>
									<li id="nav-item-user-my-shop"><?php echo anchor('my-dashboard', 'My shops page') ?></li>
									<li id="nav-item-user-my-shop"><?php echo anchor('my-dashboard', 'Add new shop') ?></li>
									<li id="nav-item-user-my-shop"><?php echo anchor('my-dashboard', 'Dashboard') ?></li>
									<?php endif ?>
									<li class="divider"></li>
									<li id="nav-item-user-logout"><?php echo anchor('logout', 'Logout') ?></li>
									<?php endif ?>
								</ul>
							</li>
						<?php endif ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>