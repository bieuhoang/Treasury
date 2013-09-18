$(function() {

	cms.extend(cms.modules, {
		user: {
			mytreasury: {
				init: function() {
					this.initEvents();
				},
				initEvents: function() {
					var _this = this;
					
				}
			}
		}
	});

	cms.modules.run('user.mytreasury');
});