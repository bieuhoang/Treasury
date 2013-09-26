cms.extend(cms, {
	user: {
		register: {
			popup: function(callback) {
				var _this = this;

				// fancybox login
				cms.load('jquery.fancybox.css');
				cms.load('ui/jquery.fancybox.js', function() {
					cms.run(function() {
						$.fancybox({
							content: _this.getHTML(),
							afterShow: function() {

								cms.load('jqueryui-themes/ui-lightness/jquery-ui.min.css');
								cms.load('jquery-ui.min.js', function() {
									$('.datepicker').datepicker();
								});

								$('#tab-register-form a').click(function(e) {
									e.preventDefault();
									$(this).tab('show');
								});

								var configForm = {
									validate: {
										rules: {
											'form[username]': 'required',
											'form[password]': 'required',
											'form[repassword]': {
												equalTo: '#password'
											},
											'form[email]': {
												required: true,
												email: true
											}
										}
									},
									beforeSubmit: function() {
										$('button.submit').text('Submiting...').attr('disabled', 'disabled');
									},
									success: function(resp) {
										if($.isFunction(callback)) {
											callback(resp);
										}
									}
								}

								cms.form('#store-form', configForm);
								cms.form('#normal-form', configForm);
							}
						});
					}, 50);
				});
			},
			closePopup: function() {
				$.fancybox.close();
			},
			getHTML: function() {
				return cms.join
						('<div class="row">')
							('<div class="span6">')
								// ('<ul id="tab-register-form" class="nav nav-tabs">')
								// 	('<li class="active"><a href="#form-1" data-toggle="tab">For Shop Owner</a></li>')
								// 	('<li><a href="#form-2" data-toggle="tab">For Normal User</a></li>')
								// ('</ul>')
								// ('<div id="myTabContent" class="tab-content">')
									// ('<div class="tab-pane fade in active" id="form-1">')
									// 	('<form class="form-horizontal" id="store-form" method="post" action="'+cms.helper.url.siteUrl('register-shop')+'">')
									// 		('<fieldset>')
									// 			('<div class="control-group">')
									// 				('<label for="form-username" class="control-label">Username</label>')
									// 				('<div class="controls">')
									// 					('<input type="text" name="form[username]" value="" placeholder="Username">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form-password" class="control-label">Password</label>')
									// 				('<div class="controls">')
									// 					('<input type="password" id="password" name="form[password]" value="" placeholder="Password">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form-re-password" class="control-label">Retype password</label>')
									// 				('<div class="controls">')
									// 					('<input type="password" name="form[repassword]" value="" placeholder="Retype password">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form-email" class="control-label">Email address</label>')
									// 				('<div class="controls">')
									// 					('<input type="email" name="form[email]" value="" placeholder="name@domain.com">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form-first_name" class="control-label">First name</label>')
									// 				('<div class="controls">')
									// 					('<input type="text" name="form[first_name]" value="" placeholder="First name">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form-last_name" class="control-label">Last name</label>')
									// 				('<div class="controls">')
									// 					('<input type="text" name="form[last_name]" value="" placeholder="Last name">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form-address" class="control-label">Address</label>')
									// 				('<div class="controls">')
									// 					('<input type="text" name="form[address]" value="" placeholder="Address">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form-zip" class="control-label">Zip</label>')
									// 				('<div class="controls">')
									// 					('<input type="text" name="form[zip]" value="" placeholder="Zip">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form-city" class="control-label">City</label>')
									// 				('<div class="controls">')
									// 					('<input type="text" name="form[city]" value="" placeholder="City">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form-logo" class="control-label">Logo</label>')
									// 				('<div class="controls">')
									// 					('<input type="file" name="userfile" value="" placeholder="Logo">')
									// 				('</div>')
									// 			('</div>')
									// 			('<div class="control-group">')
									// 				('<label for="form" class="control-label"></label>')
									// 				('<div class="controls">')
									// 					('<button type="submit" class="btn btn-primary">Register</button>')
									// 				('</div>')
									// 			('</div>')
									// 		('</fieldset>')
									// 	('</form>')
									// ('</div>')
									// ('<div class="tab-pane fade" id="form-2">')
										('<form class="form-horizontal" id="normal-form" method="post" action="'+cms.helper.url.siteUrl('register')+'">')
											('<fieldset>')
												('<div class="control-group">')
													('<label for="form-username" class="control-label">Username</label>')
													('<div class="controls">')
														('<input type="text" name="form[username]" value="" placeholder="Username">')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form-password" class="control-label">Password</label>')
													('<div class="controls">')
														('<input type="password" id="password" name="form[password]" value="" placeholder="Password">')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form-re-password" class="control-label">Retype password</label>')
													('<div class="controls">')
														('<input type="password" name="form[repassword]" value="" placeholder="Retype password">')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form-email" class="control-label">Email address</label>')
													('<div class="controls">')
														('<input type="email" name="form[email]" value="" placeholder="name@domain.com">')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form-first_name" class="control-label">First name</label>')
													('<div class="controls">')
														('<input type="text" name="form[first_name]" value="" placeholder="First name">')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form-last_name" class="control-label">Last name</label>')
													('<div class="controls">')
														('<input type="text" name="form[last_name]" value="" placeholder="Last name">')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form-gender" class="control-label">Gender</label>')
													('<div class="controls">')
														('<select name="form[gender]">')
															('<option value="Male">Male</option>')
															('<option value="Female">Female</option>')
														('</select>')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form-birthday" class="control-label">Birthday</label>')
													('<div class="controls">')
														('<input type="text" name="form[birthday]" class="datepicker" value="" placeholder="dd/mm/yyyy">')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form-company" class="control-label">Company</label>')
													('<div class="controls">')
														('<input type="text" name="form[company]" value="" placeholder="Company">')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form-phone" class="control-label">Phone</label>')
													('<div class="controls">')
														('<input type="text" name="form[phone]" value="" placeholder="Phone">')
													('</div>')
												('</div>')
												('<div class="control-group">')
													('<label for="form" class="control-label"></label>')
													('<div class="controls">')
														('<button type="submit" class="btn btn-primary submit">Register</button>')
													('</div>')
												('</div>')
											('</fieldset>')
										('</form>')
									// ('</div>')
								// ('</div>')
							('</div>')
						('</div>')();
			}
		}
	}
});