$(function() {
	cms.extend(cms.modules, {
		promotion: {
			init: function() {
				this.initEvents();
			},
			initEvents: function() {
				// 
				var _this = this;

				cms.load('tables/jquery.dataTables.js', function() {
					$('table').dataTable({
						"sPaginationType": "full_numbers"
					});
				});

				// actions
				$('.item-action').click(function() {
					var _action = $(this).data('action')
						_id = $(this).data('id');

					// do it
					eval('_this.'+_action+'(_id, this)');
				});
			},
			remove: function(id, obj) {
				cms.confirm('Are you sure you want to remove this item?', function() {
					cms.model('admin/promotion/remove', {id: id}, function(resp) {
						eval('cms.notif.'+(resp.status?'success':'error')+'(resp.msg)');
						$('#row'+id).remove();
					});
				});
			},
			block: function(id, obj) {
				cms.confirm('Are you sure you want to block this item?', function() {
					cms.model('admin/promotion/block', {id: id}, function(resp) {
						eval('cms.notif.'+(resp.status?'success':'error')+'(resp.msg)');
						if(resp.status) {
							addNewPromotionIcon(id, obj);
						}
					});
				});
			},
			active: function(id, obj) {
				cms.confirm('Are you sure you want to active this item?', function() {
					cms.model('admin/promotion/active', {id: id}, function(resp) {
						eval('cms.notif.'+(resp.status?'success':'error')+'(resp.msg)');
						if(resp.status) {
							addNewPromotionIcon(id, obj);	
						}
					});
				});
			},			
			pending: function(id, obj) {
				cms.confirm('Are you sure you want to pending this item?', function() {
					cms.model('admin/promotion/pending', {id: id}, function(resp) {
						eval('cms.notif.'+(resp.status?'success':'error')+'(resp.msg)');
						if(resp.status) {
							addNewPromotionIcon(id, obj);						
						}
					});
				});
			}
		}
	});

	cms.modules.run('promotion');
});
function updateStatusPromotion(){
	
}
function addNewPromotionIcon(id, obj){	
	var nextStatus = obj.getAttribute("nextStatus");
	var nextStatusName = obj.getAttribute("changeTo");
	var thisStatus = obj.getAttribute("thisStatus");
	var actionStatus;
	var titleStatus;
	var iconClass;
	var newStatus;
	if(nextStatus ==0){
		actionStatus = "block";
		titleStatus = "Block";
		iconClass="icon-ok-circle";
	}
	if(nextStatus ==1){
		actionStatus = "block";
		titleStatus = "Active";
		iconClass="icon-ban-circle";
	}
	if(nextStatus ==2){
		actionStatus = "block";
		titleStatus = "Pending";
		iconClass="icon-time";
	}
	$('#statusName'+id).html(nextStatusName);
	$(obj).data('action', actionStatus).attr('data-original-title', titleStatus).attr('thisStatus', nextStatus)
	.html('<span class="'+iconClass+'"></span>');
	$('.item-action'+id).attr('nextstatus', thisStatus);
}