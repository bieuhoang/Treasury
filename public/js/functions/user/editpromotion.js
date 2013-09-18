$(function() {
	window.onload = function() {
		cms.extend(cms.modules, {
			user: {
				editPromotion: {
					map: null,
					marker: null,
					geocoder: null,
					init: function() {
						// active sidebar link
						$('#user-sidebar-item-new-promotion').addClass('active');

						// load jquery ui
						cms.load('jqueryui-themes/flick/jquery-ui.min.css', 'jquery-ui.min.js', 'ui/jquery-ui-timepicker.js');

						// init events
						this.initEvents();
					},
					initEvents: function() {
						var _this = this;

						cms.load('redactor.css');
						cms.load('wysiwyg/redactor/redactor.js', function() {
							$('#content').redactor({
								minHeight: 200
							});
						});

						// datepicker
						$('#date_from_date').datepicker({
							changeMonth: true,
							changeYear: true,
							minDate: 0,
							onClose: function( selectedDate ) {
								$( "#date_to_date" ).datepicker( "option", "minDate", selectedDate );
							}
						});
						$('#date_from_time').timepicker({
							hourGrid: 4,
							minuteGrid: 10,
							timeFormat: 'hh:mm tt'
						});
						$('#date_to_date').datepicker({
							changeMonth: true,
							changeYear: true,
							onClose: function( selectedDate ) {
								$( "#date_from_date" ).datepicker( "option", "maxDate", selectedDate );
							}
						});
						$('#date_to_time').timepicker({
							hourGrid: 4,
							minuteGrid: 10,
							timeFormat: 'hh:mm tt'
						});

						// validate form
						cms.form('form#form-edit-promotion', {
							validate: {
								rules: {
									'title': 'required',
									'date_from': 'required',
									'date_to': 'required',
									'latitude': 'required',
									'longitude': 'required'
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
							clearForm: false,
							resetForm: false,
							success: function(resp) {
								if(resp.status) {
									cms.notif.success(resp.msg);
									if(resp.img) {
										$('#image-promotion').attr('src', cms.helper.url.baseUrl(resp.img));
									}
								} else {
									cms.notif.error(resp.msg);
								}
							}
						});
					},
					updatePosition: function(location) {
						$('#latitude').val(location.lat());
						$('#longitude').val(location.lng());
					},
					setMarker: function(location) {
						this.marker.setPosition(location);
						this.updatePosition(location);
					}
				}
			}
		});

		cms.modules.run('user.editPromotion');
	}
});