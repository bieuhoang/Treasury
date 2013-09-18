$(function() {
	cms.extend(cms.modules, {
		admin: {
			dashboard: {
				init: function() {
					$('#nav-item-dashboard').addClass('active');
				}
			}
		}
	});

	cms.modules.run('admin.dashboard');
});