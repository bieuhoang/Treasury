$(function() {
	cms.extend(cms.modules, {
		user: {
			myPromotion: {
				init: function() {
					// active side link
					$('#user-sidebar-item-my-promotion').addClass('active');

					// call init events
					this.initEvents();
				},
				initEvents: function() {

				}
			}
		}
	});

	cms.modules.run('user.myPromotion');
});