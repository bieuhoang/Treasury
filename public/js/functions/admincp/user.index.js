$(function() {
	cms.extend(cms.modules, {
		user: {
			index: {
				init: function() {
					$('#nav-item-user').addClass('active');
					this.initEvents();
				},
				initEvents: function() {
					var _this = this;

					cms.load('tables/jquery.dataTables.js', function() {
						$('table').dataTable({
							"sPaginationType": "full_numbers"
						});
					});

					// actions
					$('.item-action').click(function() {
						var _action = $(this).data('action'), _id = $(this).data('id');
						eval('_this.'+_action+'(_id, this);');
					});
				},
				block: function(id, obj) {
					cms.confirm('Are you sure you want to block this user?', function() {
						cms.model('admin/user/block', {id: id}, function(resp) {
							if(resp.status) {
								$(obj).data('action', 'active')
									.data('original-title', 'Active')
									.html('<span class="icon-ok-circle"></span>');
								cms.notif.success('Blocked user successfully');
							} else {
								cms.notif.error(resp.msg);
							}
						});
					});
				},
				active: function(id, obj) {
					cms.confirm('Are you sure you want to active this user?', function() {
						cms.model('admin/user/active', {id: id}, function(resp) {
							if(resp.status) {
								$(obj).data('action', 'block')
									.data('original-title', 'Block')
									.html('<span class="icon-ban-circle"></span>');
								cms.notif.success('Actived user successfully');
							} else {
								cms.notif.error(resp.msg);
							}
						});
					});
				},
				remove: function(id, obj) {
					cms.confirm('Are you sure you want to remove this user?', function() {
						cms.model('admin/user/remove', { id: id }, function(resp) {
							if(resp.status) {
								$('#row'+id).remove();
								cms.notif.success('Deleted user successfully');
							} else {
								cms.notif.error('Can not delete this user at the momment.');
							}
						});
					});
				}
			}
		}
	});

	cms.modules.run('user.index');
});