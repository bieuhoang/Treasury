$(function() {
	cms.extend(cms.modules, {
		user: {
			add: {
				isStore: null,
				map: null,
				geocoder: null,
				forms: [],
				init: function() {
					this.forms.push('#normal-user-form');
					this.forms.push('#store-user-form');
					this.forms.push('#admin-user-form');
					this.isStore = window.isStore;
					
					if(this.isStore !== null) {
						$('#map-canvas').css({'height': '200px', 'margin-top': '5px'});

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
					
					if(this.isStore !== null) {
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

					$('#myTab a:first').tab('show');

					$('#myTab a').click(function (e) {
						e.preventDefault();
						$(this).tab('show');
					});

					for(var i in this.forms) {
						this.setupForm(this.forms[i]);
					}
				},
				updatePosition: function(location) {
					$('#latitude').val(location.lat());
					$('#longitude').val(location.lng());
				},
				setMarker: function(location) {
					this.marker.setPosition(location);
					this.updatePosition(location);
				},
				setupForm: function(formID) {
					cms.form(formID, {
						validate: {
							rules: {
								'email': {
									required: true,
									email: true
								},
								'username': 'required',
								'password': 'required',
								'repassword': {
									required: true,
									equalTo: '#password-'+formID.replace('#', '')
								},
								'group_id': 'required'
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
						success: function(resp) {
							if(resp.status) {
								cms.notif.success('Add new user successfully');
							} else {
								cms.notif.error(resp.msg);
							}
						}
					});
				}
			}
		}
	});

	cms.modules.run('user.add');
});