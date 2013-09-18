$(function() {
	$('a[data-toggle="tooltip"]').tooltip();

	$('.edit-title').click(function() {
		var _this = this;
		if($(this).data('editing')) return false;

		$(this).attr('contenteditable', true).data('editing', 1);
		$('<a href="#" class="btn btn-primary btn-mini save-title">Save change</a>').insertAfter(this);

		$('a.save-title').on('click', function(e) {
			$(_this).attr('contenteditable', false);
			cms.model('site/update_page_title', { page: $(_this).data('name'), content: $(_this).text() }, function(resp) {
				eval('cms.notif.'+(resp.status ? 'success' : 'error')+'(resp.msg)');
			});
			$(this).remove();
		});
	});

	// edit page
	$('a.edit-page').click(function() {
		var page = $(this).data('page');

		var html = cms.join('<div class="row">')
								('<div class="span12">')
									('<div class="row-fluid">')
										('<form id="form-page" method="post" action="'+cms.helper.url.siteUrl('site/save_page')+'">')
											('<input type="hidden" name="page" value="'+page+'">')
											('<div class="">')
												('<div class="page-title mb20">')
													('<h3 class="box-title">Edit page: '+$(this).data('title')+'</h3>')
												('</div>')
												('<textarea name="content" id="page-content-textarea">'+$('#page-content-'+page).html()+'</textarea>')
												('<div class="row-fluid mt10 ">')
													('<button type="submit" class="pull-right btn btn-primary">Save changes</button>')
												('</div>')
											('</div>')
										('</form>')
									('<?div>')
								('</div>')
							('</div>')();

		cms.popup(html, function() {
			cms.load('redactor.css');
			cms.load('wysiwyg/redactor/redactor.js', function() {
				$('#page-content-textarea').redactor({
					minHeight: 400,
					autoresize: false
				});
			});

			cms.form('form#form-page', {
				success: function(resp) {
					// eval('cms.notif.'+(resp.status?'success':'error')+'(resp.msg);');
					if(resp.status) {
						window.location.reload();
					}
				}
			});
		}, {
			padding: 10
		});
	});
});