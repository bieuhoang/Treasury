$(function() {
	cms.extend(cms.modules, {
		category: {
			init: function() {
				this.initEvents();
			},
			initEvents: function() {
				var _this = this;

				// delete
				$('.action.delete').on('click', function() {
					$('#item-id').val($(this).data('id'));
					$('#form-management').submit();
				});
			}
		}
	});
});