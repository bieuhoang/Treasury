jQuery(function($) {
	
	cms.extend(cms.modules, {
		promotion: {
			edit: {
				init: function() {
					// load jquery ui
					cms.load('jqueryui-themes/flick/jquery-ui.min.css', 'jquery-ui.min.js', 'ui/jquery-ui-timepicker.js');

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
							$( "#date_to-date" ).datepicker( "option", "minDate", selectedDate );
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
				}
			}
		}
	});

	cms.modules.run('promotion.edit');

});