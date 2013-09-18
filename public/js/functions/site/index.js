$(function() {

	cms.extend(cms.modules, {
		site: {
			map: null,
			marker: [],
			infowindow: [],
			geocoder: null,
			init: function() {
				var _this = this;

				// active item
				$('#nav-item-site-index').addClass('active');

				// load map
				var mapOptions = {
						zoom: 14,
						center: new google.maps.LatLng(	51.511214, -0.119824 ), //51.511214,-0.119824
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						zoomControl: false,
						streetViewControl: false
					};
				this.geocoder = new google.maps.Geocoder();
				this.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

				if(this.map) {
					$('#map-canvas').removeClass('google-map-loading').css({height: '400px'});
				}

				cms.get('site/get_all_shop', function(resp) {
					if(cms.isObj(resp) && resp.total_items) {
						$.each(resp.items, function(index, ele) {
							if(ele.latitude !== '' && ele.longitude !== '') {
								// marker
								_this.marker[index] = new google.maps.Marker({
									map: _this.map,
									draggable: false,
									title: ele.title,
									animation: google.maps.Animation.DROP,
									position: new google.maps.LatLng(ele.latitude, ele.longitude),
									icon: cms.asset.getUrl('icons-map/marijuana.png', cms.asset.path('img')) //townhouse, marijuana
								});

								_this.infowindow[index] = new google.maps.InfoWindow({
									content: _this.shopInfoHTML(ele)//_this.infoHTML(ele)
								});

								// event for marker
								google.maps.event.addListener(_this.marker[index], 'click', function() {
									_this.infowindow[index].open(_this.map, _this.marker[index])
									$('a[data-toggle="tooltip"]').tooltip();
								});
							}
						});
					}
				});

				this.initEvents();
			},
			initEvents: function() {
				var _this = this;

				// search map
				$('#form-search-map-homepage').submit(function() {
					var address = $('#search-input-homepage', this).val();
					if(address == '') return false;
					_this.geocoder.geocode( { 'address': address }, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							_this.map.setCenter(results[0].geometry.location);
						} else {
							alert('Geocode was not successful for the following reason: ' + status);
						}
					});
					return false;
				});

				$('.join-now').on('click', function() {
					cms.redirect('register');
					return false;
				});
			},
			shopInfoHTML: function(obj) {
				var address = cms.isBlank(obj.address) ? '' : ('<br>Address: '+obj.address),
					phone = cms.isBlank(obj.phone) ? '' : ('<br>Phone: '+obj.phone),
					email = cms.isBlank(obj.email) ? '' : ('<br>Email: <a title="Send mail to '+obj.email+'" data-toggle="tooltip" href="mailto:'+obj.email+'">'+obj.email+'</a>'),
					website = cms.isBlank(obj.website) ? '' : ('<br>Website: <a href="'+obj.website+'" title="Go to website" data-toggle="tooltip">'+obj.website+'</a>')
					avatar = cms.isBlank(obj.avatar) ? cms.helper.url.baseUrl('public/img/avatar.png') : cms.helper.url.baseUrl(obj.avatar);
				return cms.join('')
					('<div class="promotion-infowindow">')
						('<div class="row-fluid">')
							('<div class="span12">')
								('<div class="row-fluid">')
									('<div class="span8">')
										('<address>')
											('<h3><strong><a href="'+cms.helper.url.siteUrl('store/'+obj.id+'-'+obj.store_name_seo)+'" title="'+obj.fullname+'">'+obj.fullname+'</a></strong></h3>')
											(address)(phone)(email)(website)
										('</address>')
									('</div>')
									('<div class="span3">')
										('<img class="avatar" src="'+avatar+'" width="100" alt="Avatar">')
									('</div>')
								('</div>')
								('<div class="row-fluid">')
									('<div class="span12">')
										('<div class="pull-right">')
											('<a href="'+cms.helper.url.siteUrl('store/'+obj.id+'-'+obj.store_name_seo)+'" data-toggle="tooltip" title="Store detail"><span class="icon-home"></span></a> ')
											('<a href="javascript:;" data-shop-id="'+obj.id+'" class="save-my-list" data-toggle="tooltip" title="Save to my favorites"><span class="icon-heart"></span></a>')
										('</div>')
									('</div>')
								('</div>')
							('</div>')
						('</div>')
					('</div>')
					('')();
			},
			infoHTML: function(obj) {
				var address = cms.isBlank(obj.owner.address) ? '' : ('<br>'+obj.owner.address),
					phone = cms.isBlank(obj.owner.phone) ? '' : ('<br>'+obj.owner.phone),
					email = cms.isBlank(obj.owner.email) ? '' : ('<br>'+obj.owner.email),
					website = cms.isBlank(obj.owner.website) ? '' : ('<br>'+obj.owner.website),
					gender_limit = cms.isBlank(obj.gender_limit) ? '' : ('Gender: '+obj.gender_limit+'<br>'),
					age_limit = obj.age_limit ? '' : ('Age: '+obj.age_limit);
				return cms.join('')
					('<div class="promotion-infowindow">')
						('<div class="row-fluid">')
							('<div class="span12">')
								('<div class="row-fluid">')
									('<div class="span7 border-left">')
										('<h3>'+obj.title+'</h3>')
										('<address>')
										('Date from: '+obj.date_from+'<br>')
										('Date to: '+obj.date_to+'<br>')
										(gender_limit)(age_limit)
										('</address>')
										('<blockquote>'+obj.content+'</blockquote>')
									('</div>')
									('<div class="span5">')
										('<address>')
											('<strong><a href="'+cms.helper.url.siteUrl('view-profile/'+obj.owner.id)+'" title="'+obj.owner.fullname+'">'+obj.owner.fullname+'</a></strong>')
											(address)(phone)(email)(website)
										('</address>')
									('</div>')
								('</div>')
								('<div class="row-fluid">')
									('<div class="span12">')
										('<ul class="inline unstyled pull-right">')
											('<li><a href="javascript:;" class="save-my-list" data-toggle="tooltip" title="Save to my favorites"><span class="icon-heart"></span></a></li>')
										('</ul>')
									('</div>')
								('</div>')
							('</div>')
						('</div>')
					('</div>')
					('')();
			}
		}
	});

	cms.modules.run('site');
});