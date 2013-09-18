$(function() {
	cms.extend(cms.modules, {
		user: {
			changePassword: {
				init: function() {
					$('#user-sidebar-item-change-password').addClass('active');
					this.initEvents();
				},
				initEvents: function() {
					var _this = this;

					cms.form('form#user-change-password-form', {
						validate: {
							rules: {
								'current_password': 'required',
								'password': 'required',
								'repassword': {
									required: true,
									equalTo: '#password'
								}
							},
							invalidHandler: function(event, validator) {
								var errors = validator.numberOfInvalids();
								if(errors) {
									validator.currentElements.parent().parent().addClass('error');
								}
							},
							errorElement: 'span',
							showErrors: function(errorMap, errorList) {
								this.defaultShowErrors();
								$('span.error').addClass('help-inline');
							},
							success: function(label) {
								label.parent().parent().removeClass('error');
							}
						},
						success: function(resp) {
							if(resp.status) {
								cms.notif.success(resp.msg);
							} else {
								cms.notif.error(resp.msg);
							}
						}
					});
				}
			}
		}
	});

	// run modules
	cms.modules.run('user.changePassword');

});