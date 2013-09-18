(function($){
	$.extend(cms, {
		helper: {
			url: {
				siteUrl: function(path) {
					path = typeof(path) != 'undefined' ? path : '';
					return php.rtrim(cms.app.siteUrl, '/') + '/' + path;
				},
				baseUrl: function(params) {
					return cms.app.baseUrl+(cms.isBlank(params) ? '' : params);
				},
				redirect: function(url) {
					if(url.indexOf('http://') == -1 || url.indexOf('https://') == -1) {
						url = this.siteUrl(url);
					}
					
					window.location.assign(url);
				}
			},
			string: {
				utf82ascii: function(str) {
					var replaces = [
						{find: 'Ă|Ắ|Ằ|Ẵ|Ẳ|Ặ|Â|Ấ|Ầ|Ẫ|Ẩ|Ậ|Á|À|Ã|Ả|Ạ|ă|ắ|ằ|ẵ|ẳ|ẳ|â|ấ|ầ|ẫ|ẩ|ậ|á|à|ã|ả|ạ', replace: 'A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a'},
						{find: 'Đ|đ', replace: 'D|d'},
						{find: 'Ê|Ế|Ề|Ễ|Ể|Ệ|ê|ế|ề|ễ|ể|ệ|é|è|ẽ|ẻ|ẹ', replace: 'E|E|E|E|E|E|e|e|e|e|e|e|e|e|e|e|e'},
						{find: 'Í|Ì|Ĩ|Ỉ|Ị|í|ì|ĩ|ỉ|ị', replace: 'I|I|I|I|I|i|i|i|i|i'},
						{find: 'Ô|Ố|Ồ|Ỗ|Ổ|Ộ|Ơ|Ớ|Ờ|Ỡ|Ở|Ợ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ|ó|ò|õ|ỏ|ọ', replace: 'O|O|O|O|O|O|O|O|O|O|O|O|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o'},
						{find: 'Ư|Ứ|Ừ|Ữ|Ử|Ự|ư|ứ|ừ|ữ|ử|ự', replace: 'U|U|U|U|U|U|u|u|u|u|u'},
						{find: 'Ý|Ỳ|Ỹ|Ỷ|Ỵ|ý|ỳ|ỹ|ỷ|ỵ', replace: 'Y|Y|Y|Y|Y|y|y|y|y|y'}
					];

					for(var i in replaces) {
						var item = replaces[i];
						var find = php.explode('|', item.find);
						var replace = php.explode('|', item.replace);
						str = php.str_replace(find, replace, str);
					}

					return str;
				}
			},
			form: {
				open: function(action, attributes) {
					action = cms.isset(action);

					// action
					if(action != '' && action.indexOf('://') != -1) {
						action = cms.helper.url.siteUrl(action);
					}

					// attributes
					var attributesHtml = ' ';
					if(cms.isset(attributes) != '' && cms.is_str(attributes)) {
						attributesHtml += attributes;
					}
					if(attributes.indexOf('method') == -1) {
						attributesHtml = ' method="post"'+attributesHtml;
					}

					return '<form action="'+action+attributesHtml+'>';
				},
				open_multipart: function(action) {
					var attributes = [{name: 'enctype', value: 'multipart/form-data'}];
					return this.open(action, attributes);
				},
				input: function(name, attributes, value) {
					return '<form type="text" name="'+name+'"'+this._parseFormAttributes(attributes)+' value="'+value+'">';
				},
				hidden: function() {

				},
				password: function() {

				},
				textarea: function() {

				},
				upload: function() {

				},
				checkbox: function() {

				},
				radio: function() {

				},
				dropdown: function() {

				},
				multiselect: function() {

				},
				close: function() {

				},
				_parseFormAttributes: function(attributes) {
					var html = ' '; def = cms.isset(def);
					if(cms.isset(attributes) != '' && cms.is_str(attributes)) {
						html += attributes;
					}

					return html;
				},
				reset: function(ele) {
				    $(ele).get(0).reset();
				}
			},
			wysiwyg: function(element, theme) {
				theme = cms.isset(theme, 'advanced');
				cms.load('wysiwyg/jquery.tinymce.js', function() {
					$(cms.isset(element, 'textarea.tinymce')).tinymce({
						// Location of TinyMCE script
						script_url : cms.asset.getUrl(cms.asset.config.js+'/wysiwyg/tinymce/tiny_mce.js'),

						// General options
						theme : theme,//"advanced",
						plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

						// Theme options
						theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
						theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
						theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
						theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
						theme_advanced_toolbar_location : "top",
						theme_advanced_toolbar_align : "left",
						theme_advanced_statusbar_location : "bottom",
						theme_advanced_resizing : true,

						// Replace values for the template plugin
						template_replace_values : {
							username : "Some User",
							staffid : "991234"
						}
					});
				});				
			}
		}
	});

})(jQuery);