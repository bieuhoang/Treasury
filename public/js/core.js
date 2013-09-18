/*
--------------------------------------------
CORE JS
--------------------------------------------
* Author: Long Nguyen
* Site: http://lnguyen.info
* Email: lnguyen.info@gmail.com
*/
;(function($) {
	// config
	cms = {
		app: {},//window.site.app,
		user: {},//window.site.user,
		language: window.navigator.language,
		href: window.location.href,
		local: window.location,
		userAgent: window.navigator,
		loaded: [],
		modules: {
			run: function(name) {
				if(! cms.isBlank(name)) {
					eval('cms.modules.'+name+'.init()');
				} else {
					console.log('Modules: '+name+' is not exists.');
				}
			}
		},
		load: function() {
			var args = [];
			if(arguments.length > 0) {
				if(typeof(arguments[0]) == 'function') {
					arguments[0].call(this);
				} else {
					var length = arguments.length;

					if(typeof(arguments[arguments.length - 1]) == 'function') {
						length--;
					}

					if(typeof(arguments[0]) == 'object' 
					&& arguments[0].length 
					&& typeof(arguments[0][0]) == 'object' 
					&& arguments[0][0].length) {

						var newArgs = args[0].splice(0,1)[0];
						if(args[0].length > 0) {
							newArgs.push(function() {
								cms.load(args[0], args[1]);
							});
						} else {
							newArgs.push(args[1]);
						}

						cms.load.apply(this, newArgs);
						return;
					}

					for(var i = 0; i < length; i++) {
						if(typeof(arguments[i]) == 'string' && arguments[i]) {
							if(typeof(arguments[length]) == 'function') {
								cms.asset.add(arguments[i], arguments[length]);
							} else {
								cms.asset.add(arguments[i]);
							}
						}
					}
				}
			}
		},
		isset: function(variable, def) {
			def = typeof(def) != 'undefined' ? def : null;
			return typeof(variable) != 'undefined' ? variable : def;
		},
		isLoaded: function(path) {
			if($('html').html().indexOf(path) >= 0) return true;

			for(var i in this.loaded) {
				if(this.loaded[i] == path) {
					return true;
				}
			}

			return false;
		},
		extend: function(obj, extendObj) {
			if(cms.isObj(extendObj)) {
				$.each(extendObj, function (key, value) {
					eval('var exists = cms.isObj(obj.'+key+')');
					if(! exists) {
						if(! cms.isFunc(value)) {
							eval('obj.'+key+' = {};cms.extend(obj.'+key+', value);');
						} else {
							$.extend(obj, extendObj);
						}
					} else {
						eval('cms.extend(obj.'+key+', value)');
					}
				});
			}
		}
	};

	if(window.site) {
		cms.app = window.site.app;
		cms.user = window.site.user;
	}

	cms.loading = function() {
		if($('#loadingBG').length == 0) {
			var img_loading = cms.asset.getUrl(cms.asset.config.imgDir+'/loading/loading_facebook.gif');
			$('body').append('<div id="loadingBG">Loading... <img src="'+img_loading+'" alt=""></div>');
		}
	};

	cms.removeLoading = function() {
		$('#loadingBG').remove();
	};

	// common function
	$.join = cms.join = function(str) {
		var store = [str];
		return function extend(other) {
			if (other != null && 'string' == typeof other ) {
				store.push(other);
				return extend;
			}
			return store.join('');
		}
	};

	// redirect
	cms.redirect = function(url) {
		cms.helper.url.redirect(url);
	}

	// model
	cms.model = function(url, data, callback, method, onError) {

		if(cms.isFunc(data)) {
			callback = data;
			data = {};
		}

		$.ajax({
			url: cms.helper.url.siteUrl(url),
			type: cms.isset(method, 'post'),
			dataType: 'json',
			data: data,
			beforeSend: function() {
				cms.loading();
			},
			error: function(jqXHR, textStatus, errorThrown) {
				switch(textStatus) {
					case 'error':
						cms.message('Server isn\'t response at the moment. Please try again later.');
						break;
				}
				$('#loadingBG').remove();

				if(typeof(onError) == 'function') {
					onError.call(this);
				}
			},
			success: function(data) {
				if(cms.isFunc(callback)) {
					callback(data);
				}
				cms.removeLoading();
			}
		});
	};

	cms.post = function(url, data, callback) {
		cms.model(url, data, callback);
	};

	cms.get = function(url, data, callback) {
		cms.model(url, data, callback, 'get');
	};

	// asset
	cms.asset = {
		config: {},//window.site.asset,
		add: function(path, callback) {
			// is loaded?
			if(cms.isLoaded(path)) {
				if(cms.isFunc(callback)) {
					callback.call(this);
				}

				return false;
			}

			// get extenstion
			var ext = path.substring(path.lastIndexOf('.'), path.length);
			switch(ext) {
				case '.jpg':
				case '.jpeg':
				case '.png':
				case '.bmp':
					this.img(path);
					break;
				case '.js':
					this.js(path);
					break;
				case '.css':
					this.css(path);
					break;
				default:
					this.addAsset(path);
					break;
			}

			// add to loaded			
			cms.loaded.push(path);

			// callback
			if(cms.isFunc(callback)) {
				callback.call(this);
			}
		},
		css: function(path) {
			if(document.createStyleSheet) {
				document.createStyleSheet(this.getUrl(path, this.path('css')));
			} else {
				var html = '<link rel="stylesheet" type="text/css" href="'+this.getUrl(path, this.path('css'))+'">';
				$('head').append(html);
			}
		},
		js: function(path) {
			var html = '<script type="text/javascript" src="'+this.getUrl(path, this.path('js'))+'"></script>';
			$('body').append(html);
		},
		getUrl: function(url, subDir) {
			subDir = cms.isset(subDir, '');
			if(url.indexOf('http://') != -1 || url.indexOf('https://') != -1) {
				return url;
			} else {
				return cms.helper.url.baseUrl() + (subDir != '' ? (subDir + '/') : '') + url;
			}
		},
		img: function(path) {

		},
		addAsset: function(path) {
			if(path.indexOf('google') != -1 && path.indexOf('https://') != -1) {
				var html = '<script type="text/javascript" src="'+path+'"></script>';
				$('body').append(html);
			}
		},
		path: function(type) {
			var path;
			type = cms.isset(type, 'css');
			switch(type) {
				case 'css':
					path = this.config.cssDir;
					break;
				case 'img':
					path = this.config.imgDir;
					break;
				case 'js':
					path = this.config.jsDir;
					break;
			}

			return path;
		}
	};

	if(window.site) {
		cms.asset.config = window.site.asset;
	}

	// notification
	cms.notif = {
		init: function() {
			cms.load('plugin.jgrowl.css');			
		},
		show: function(msg, title, type) {
			this.init();

			cms.load('ui/jquery.jgrowl.js', function() {
				var settings = {
					header: cms.isset(title, 'Information!'),
					// sticky: true,
					beforeOpen: function() {
						$(this).addClass(cms.isset(type, ''));
					}
				};

				$.jGrowl(msg, settings);				
			});
		},
		success: function(msg) {
			this.show(msg, 'Successfully!', 'success');
		},
		warning: function(msg) {
			this.show(msg, 'Warning!', 'warning');
		},
		info: function(msg) {
			this.show(msg, 'Information!', 'infor');
		},
		error: function(msg) {
			this.show(msg, 'Error!', 'error');
		}
	};

	cms.alert = function(msg, title) {
		var settings = {
			header: cms.isset(title)
		};
		cms.load('plugin.jgrowl.css');
		cms.load('ui/jquery.jgrowl.js', function() {
			$.jGrowl(msg, settings);
		});
	};

	cms.confirm = function(msg, callback) {
		if(window.confirm(msg)) {
			if(cms.isFunc(callback)) {
				callback.call(this);
			}
		}
	};

	// message
	cms.message = function(msg) {
		cms.load('plugin.jgrowl.css');
		cms.load('ui/jquery.jgrowl.js', function() {
			$.jGrowl(msg, {
				position: 'top-right'
			});
		});
	};

	// notification
	$.message = {
		remove: function() {
			$('.alert').remove();
		},
		error: function(msg, obj) {
			this.remove();
			if(cms.isset(obj) != '') {				
				$(obj).before('<div class="alert alert-error" style="display: none">'+msg+'</div>');
			} else {
				$('body').append('<div class="alert alert-error" style="display: none">'+msg+'</div>');
			}
			$('.alert').fadeIn();
		},
		success: function(msg, obj) {
			this.remove();
			if(cms.isset(obj) != '') {				
				$(obj).before('<div class="alert alert-success" style="display: none">'+msg+'</div>');
			} else {
				$('body').append('<div class="alert alert-success" style="display: none">'+msg+'</div>');
			}
			$('.alert').fadeIn();
		},
		warning: function(msg, obj) {
			this.remove();
			if(cms.isset(obj) != '') {				
				$(obj).before('<div class="alert" style="display: none">'+msg+'</div>');
			} else {
				$('body').append('<div class="alert" style="display: none">'+msg+'</div>');
			}
			$('.alert').fadeIn();
		},
		info: function(msg, obj) {
			this.remove();
			if(cms.isset(obj) != '') {				
				$(obj).before('<div class="alert alert-info" style="display: none">'+msg+'</div>');
			} else {
				$('body').append('<div class="alert alert-info" style="display: none">'+msg+'</div>');
			}
			$('.alert').fadeIn();
		}
	};

	// dialog
	cms.popup = function(content, onComplete, options) {
		cms.load('jquery.fancybox.css');
		cms.load('ui/jquery.mousewheel.js');
		cms.load('ui/jquery.fancybox.js', function() {
			if(! cms.isFunc(onComplete)) {
				onComplete = 'function() {}';
			}
			options = cms.isset(options, {});
			width 	= cms.isset(options.width, '99%');
			height 	= cms.isset(options.height, '99%');
			var settings = {
				padding: cms.isset(options.padding, 0),
				width: width,
				height: height,
				titleShow: false,
				transitionIn: 'fade',
				transitionOut: 'fade',
				centerOnScroll: true,
				autoDimensions: false,
				afterShow: onComplete,
				beforeClose: cms.isset(options.onCleanup, null),
				afterLoad: cms.isset(options.onStart, null),
				afterClose: cms.isset(options.onClosed, null)
			}

			if(content.substring(0, 7) === 'http://') {
				settings.url = content;
			} else {
				settings.content = content;
			}
			
			$.fancybox(settings);
		});
	};

	// table flexigrid
	cms.table = {
		obj: {},
		init: function(obj, url, options, onComplete, onSuccess) {
			var that = this;
			// init form
			cms.load('forms/jquery.uniform.js', function(){
				$('thead input', obj).uniform();
			});

			// check all
			$('#checkall', obj).click(function() {
				var checked = $(this).is(':checked');
				$('tbody .uniform', obj).attr('checked', checked);
				$.uniform.update($('tbody .uniform', obj));
			});

			this.obj = obj, settings = {
				colModel: [],
				searchitems: [],
				url: cms.helper.url.siteUrl(url),
				dataType: 'json',
				height: '100%',
				usepager: true,
				useRp: true,
				rp: 10,
				rpOptions: [10, 15, 20, 30],
				total: 1,
				findtext: 'Search by',
				searchtext: 'Type your keywords and press Enter',
				autoload: true,
				hideOnSubmit: false,
				onSubmit: function() {
					cms.loading();
					return true;
				},
				onNoItems: function() {                	
					cms.removeLoading();
				},
				onComplete: function(data) {
					cms.removeLoading();
					// callback function
					if($.isFunction(onComplete)) onComplete(data);
					// uncheck all
					$('#checkall', obj).attr('checked', false);
					$.uniform.update($('#checkall', obj));

					//uniform init
					cms.load('forms/jquery.uniform.js', function(){
						$('select, input', '.dataTables_wrapper table tbody').uniform();
					});

					// check item
					$('tbody .uniform', obj).click(function() {
						var totalChecked = cms.table.totalChecked();
						if(totalChecked == $('tbody tr', obj).length) {
							$('#checkall', obj).attr('checked', true);
						} else {
							$('#checkall', obj).attr('checked', false);
						}
						$.uniform.update($('#checkall', obj));
					});
				},
				onSuccess: function() {
					// callback function
					if($.isFunction(onSuccess)) onSuccess();					
				}
			};

			options = typeof(options) != 'object' ? {} : options;
			$.extend(settings, options);

			/*cms.load('plugins.css');*/
			cms.load('tables/jquery.flexigrid.js', function(){
				$(obj).flexigrid(settings);
			});
		},
		reload: function(options) {
			if(! cms.isObj(options)) {
				options = {};
			}
			$(this.obj).flexOptions(options).flexReload();
		},
		totalChecked: function() {
			var total = 0;
			$('tbody .uniform', this.obj).each(function() {
				if($(this).is(':checked')) total++;
			});

			return total;
		}
	};

	cms.form = cms.validate = function(obj, options) {
		cms.form.submiting = false;
		options = cms.isset(options) ? options : {};
		cms.load('forms/jquery.form.js');
		cms.load('wizards/jquery.validate.js', function() {
			validateOptions = (cms.isset(options.validate) && $.isPlainObject(options.validate))?options.validate:{};
			validateOptions.submitHandler = function(form) {
				$(form).ajaxSubmit({
					url: cms.isset(options.url, (cms.isset($(form).attr('action'), ''))),
					clearForm: cms.isset(options.clearForm, true),
					resetForm: cms.isset(options.resetForm, true),
					dataType: cms.isset(options.dataType, 'json'),
					beforeSubmit: function() {
						if(cms.form.submiting) {
							return false;
						}
						cms.form.submiting = true;
						cms.loading();
					},
					error: function() {
						if(cms.isset(options.error) && $.isFunction(options.error)) {
							options.error();
						}
					},
					uploadProgress: function(event, position, total, percentComplete) {
						if(cms.isset(options.uploadProgress) && $.isFunction(options.uploadProgress)) {
							options.uploadProgress(event, position, total, percentComplete);
						}
					},
					success: function(response) {
						cms.removeLoading();
						cms.form.submiting = false;
						if(cms.isset(options.success) && $.isFunction(options.success)) {
							options.success(response);
						}
					}
				});
			}

			$(obj).validate(validateOptions);
		});
	};

	cms.run = function(callback, timeout) {
		timeout = cms.isset(timeout, 0);
		setTimeout(callback, timeout);
	};

	cms.isArr = function(arr) { return (arr != null && arr.constructor == Array) };

	cms.isStr = function(str) { return (str && (/string/).test(typeof str)) };

	cms.isFunc = function(func) { return (func != null && func.constructor == Function) };

	cms.isNum = function(num) { var num = Number(num); return (num != null && !isNaN(num)) };

	cms.isInt = function (x) {var y=parseInt(x);if (isNaN(y)) return false;return x==y && x.toString()==y.toString();} 

	cms.isObj = function(obj) { return (obj != null && obj instanceof Object) };

	cms.isEle = function(ele) { return (ele && ele.tagName && ele.nodeType == 1) };

	cms.isExists = function(obj) { return (obj != null && obj != undefined && obj != "undefined") };

	cms.isJson = function(){};

	cms.isBlank = function(str) { return ($.trim(str) == "") };

	cms.isEmail = function(str) {return (/^[a-z-_0-9\.]+@[a-z-_=>0-9\.]+\.[a-z]{2,3}$/i).test($.trim(str))};

	cms.isUsername = function(value){ return (value.match(/^[0-9]/) == null) && (value.search(/^[0-9_a-zA-Z]*$/) > -1); }

	cms.isLink = function(str){ return (/(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/).test(cms.util_trim(str)) };

	cms.isImage = function(imagePath){
		var fileType = imagePath.substring(imagePath.lastIndexOf("."), imagePath.length).toLowerCase();
		return (fileType == ".gif") || (fileType == ".jpg") || (fileType == ".png") || (fileType == ".jpeg");
	};

	cms.isFF  = function(){ return (/Firefox/).test(navigator.userAgent) };

	cms.isIE  = function() { return (/MSIE/).test(navigator.userAgent) };

	cms.isIE6 = function() { return (/MSIE 6/).test(navigator.userAgent) };

	cms.isIE7 = function() { return (/MSIE 7/).test(navigator.userAgent) };

	cms.isIE8 = function() { return (/MSIE 8/).test(navigator.userAgent) };

	cms.isChrome = function(){ return (/Chrome/).test(navigator.userAgent) };

	cms.isOpera = function() { return (/Opera/).test(navigator.userAgent) };

	cms.isSafari = function(){ return (/Safari/).test(navigator.userAgent) };

})(jQuery);