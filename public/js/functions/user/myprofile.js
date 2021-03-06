$(function() {
	cms.extend(cms.modules, {
		user: {
			myprofile: {
				map: null,
				marker: null,
				geocoder: null,
				init: function() {
					$('#user-sidebar-item-my-profile').addClass('active');

					if(cms.user.isOwner) {
						$('#map-canvas').css({'height': '400px', 'margin-top': '5px'});

						// init google map
						// load map
						var mapOptions = {
							zoom: 8,
							zoomControl: false,
							streetViewControl: false,
							panControl: false,
							center: new google.maps.LatLng($('#latitude').val(), $('#longitude').val()),
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
						this.geocoder = new google.maps.Geocoder();
						this.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
					}

					this.initEvents();
				},
				initEvents: function() {
					var _this = this;

					if(cms.user.isOwner) {
						// init wysiwyg
						cms.load('redactor.css');
						cms.load('wysiwyg/redactor/redactor.js', function() {
							$('#public_text').redactor({
								minHeight: 400,
								autoresize: false
							});
						});

						_this.marker = new google.maps.Marker({
							map: _this.map,
							draggable:true,
							title: cms.user.fullname,
							animation: google.maps.Animation.DROP,
							icon: cms.asset.getUrl('icons-map/townhouse.png', cms.asset.path('img'))
						});

						if($('#latitude').val() != '' && $('#longitude').val() != '') {
							this.setMarker(new google.maps.LatLng($('#latitude').val(), $('#longitude').val()));
						}

						// events
						google.maps.event.addListener(_this.map, 'click', function(event) {
							_this.setMarker(event.latLng);
						});

						google.maps.event.addListener(_this.marker, 'dragend', function() {
							_this.updatePosition(_this.marker.getPosition());
						});

						// search map
						$('#search-map').click(function() {
							var address = $('#address').val();
							_this.geocoder.geocode( { 'address': address }, function(results, status) {
								if (status == google.maps.GeocoderStatus.OK) {
									_this.map.setCenter(results[0].geometry.location);
								} else {
									alert('Geocode was not successful for the following reason: ' + status);
								}
							});
							return false;
						});
					}

					// form init
					cms.form('#update-profile', {
						validate: {
							rules: {
								username: 'required',
								repassword: {
									equalTo: '#password'
								}
							},
							invalidHandler: function(event, validator) {
								var errors = validator.numberOfInvalids();
								if(errors) {
									validator.currentElements.parent().parent().addClass('error');
								}
							},
							errorElement: 'span',
							showErrors: function(errorMap, errorList) {
								this.defaultShowErrors();
								$('span.error').addClass('help-inline');
							},
							success: function(label) {
								label.parent().parent().removeClass('error');
							}
						},
						resetForm: false,
						clearForm: false,
						success: function(resp) {
							if(resp.status) {
								cms.notif.success(resp.msg);
							} else {
								cms.notif.error(resp.msg);
							}
						}
					});
				},
				updatePosition: function(location) {
					$('#latitude').val(location.lat());
					$('#longitude').val(location.lng());
				},
				setMarker: function(location) {
					this.marker.setPosition(location);
					this.updatePosition(location);
				}
			}
		}
	});

	cms.modules.run('user.myprofile');
});