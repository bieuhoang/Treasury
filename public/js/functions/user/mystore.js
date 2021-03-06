$(function() {

	cms.extend(cms.modules, {
		user: {
			mystore: {
				init: function() {
					// active sidebar
					$('#user-sidebar-item-my-store').addClass('active');

					// init tooltip
					$('a[data-toggle="tooltip"]').tooltip();

					// init events
					this.initEvents();
				},
				initEvents: function() {
					var _this = this;

					// action
					$('.actions').click(function() {
						var _id = $(this).data('id'), _action = $(this).data('action');
						eval('_this.'+_action+'('+_id+', this);');
					});
				},
				delete: function(id, obj) {
					cms.confirm('Are you sure you want to delete: #'+id, function() {
						cms.model('user/delete_promotion', {id: id}, function(resp) {
							if(resp.status) {
								cms.notif.success(resp.msg);
								$(obj).parent().parent().remove();
							} else {
								cms.notif.error(resp.msg);
							}
						});
					});
				},
				block: function(id, obj) {
					cms.model('user/block_promotion', {id: id}, function(resp) {
						if(resp.status) {
							cms.notif.success(resp.msg);
							$(obj).data('action', 'active').html('<span class="icon-random"></span>');
						} else {
							cms.notif.error(resp.msg);
						}
					});
				},
				active: function(id, obj) {
					cms.model('user/active_promotion', {id: id}, function(resp) {
						if(resp.status) {
							cms.notif.success(resp.msg);
							$(obj).data('action', 'block').html('<span class="icon-ban-circle"></span>');
						} else {
							cms.notif.error(resp.msg);
						}
					});
				},
				edit: function(id, obj) {
					cms.helper.url.redirect('user/edit_promotion/'+id);
				}
			}
		}
	});

	cms.modules.run('user.mystore');
});