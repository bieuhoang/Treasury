$(function() {
	
	cms.extend(cms.modules, {
		user: {
			viewshop: {
				map: null,
				marker: null,
				hasMap: false,
				init: function() {

					if($('#map-'+SHOP_ID).length) {
						$('#map-'+SHOP_ID).css({'height': '200px', 'margin-top': '5px', 'display': 'block'});
						this.hasMap = true;
						// load map
						var mapOptions = {
								zoom: 14,
								center: new google.maps.LatLng(SHOP_LATITUDE, SHOP_LONGITUDE),
								mapTypeId: google.maps.MapTypeId.ROADMAP,
								zoomControl: false,
								streetViewControl: false,
								panControl: false
							};
						this.map = new google.maps.Map(document.getElementById('map-'+SHOP_ID), mapOptions);
						this.marker = new google.maps.Marker({
							map: this.map,
							draggable: false,
							animation: google.maps.Animation.DROP,
							position: new google.maps.LatLng(SHOP_LATITUDE, SHOP_LONGITUDE),
							icon: cms.asset.getUrl('icons-map/townhouse.png', cms.asset.path('img'))
						});
					}

					if(! cms.user.id) {
						cms.load('functions/libs/user.js');
					}

					// init events
					this.initEvents();
				},
				initEvents: function() {
					var _this = this;

					// add to treasury
					$('#add-to-treasury').on('click', function() {
						var _id = $(this).data('id');
						if(! cms.user.id) {
							cms.user.register.popup(function(resp) {
								if(resp.status) {
									cms.notif.success(resp.msg);
									cms.post('user/save_my_favorite', { id: _id }, function(resp) {
										eval('cms.notif.'+(resp.status?'success':'error')+'(resp.msg);');
									});
									// cms.user.register.closePopup();
									window.location.reload();
								} else {
									cms.notif.error(resp.msg);
								}
							});
						} else {
							cms.post('user/save_my_favorite', { id: _id }, function(resp) {
								eval('cms.notif.'+(resp.status?'success':'error')+'(resp.msg);');
							});
						}
					});

					// edit event
					if(cms.user.id && cms.user.isOwner) {
						$('.edit-public-page').on('click', function() {

							var html = cms.join('<div class="row">')
								('<div class="span12">')
									('<div class="row-fluid">')
										('<form id="form-public-page" method="post" action="'+cms.helper.url.siteUrl('user/save_public_page')+'">')
											('<div class="">')
												('<div class="page-title mb20">')
													('<h3 class="box-title">Public page: <strong>'+cms.user.fullname+'</strong></h3>')
												('</div>')
												('<textarea name="content" id="page-content-textarea">'+$('#public_text_content').html()+'</textarea>')
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

								cms.form('form#form-public-page', {
									success: function(resp) {
										if(resp.status) {
											window.location.reload();
										}
									}
								});
							}, {
								padding: 10
							});

							return false;
						});
					}
				}
			}
		}
	});

	cms.modules.run('user.viewshop');

});