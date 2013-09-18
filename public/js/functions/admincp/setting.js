$(function() {
	cms.extend(cms.modules, {
		setting: {
			init: function() {
				// active menu item
				$('#nav-item-setting').addClass('active');
				// init events
				this.initEvents();
			},
			initEvents: function() {
				var _this = this;

				cms.load('redactor.css');
				cms.load('wysiwyg/redactor/redactor.js', function() {
					$('.wysiwyg').redactor({
						minHeight: 300,
						autoresize: false
					});
				});
			}
		}
	});

	cms.modules.run('setting');
});