$(function() {

	cms.extend(cms.modules, {
		user: {
			register: {
				init: function() {
					this.initEvents();
				},
				initEvents: function() {
					var _this = this;

					cms.load('jqueryui-themes/ui-lightness/jquery-ui.min.css');
					cms.load('jquery-ui.min.js', function() {
						$('.datepicker').datepicker();
					});

					cms.form('#form-register', {
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
							$('button[type=submit]').text('Submiting...').attr('disabled', 'disabled');
						},
						success: function(resp) {
							eval('cms.notif.'+(resp.status?'success':'error')+'(resp.msg);');
							if(resp.status) {
								cms.notif.info('Redirecting to dashboard after 2s...');
								if(typeof resp.redirect != 'undefined')
								{
									cms.run(function() {
										cms.redirect(resp.redirect);
									}, 2000);
								}
							}
						}
					});
				}
			}
		}
	});

	cms.modules.run('user.register');

});