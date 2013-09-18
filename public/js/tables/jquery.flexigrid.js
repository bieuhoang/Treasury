/*
 * Flexigrid for jQuery -  v1.1
 *
 * Copyright (c) 2008 Paulo P. Marinas (code.google.com/p/flexigrid/)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 */
(function ($) {
	$.addFlex = function (t, p) {
		if (t.grid) return false; //return if already exist
		p = $.extend({ //apply default properties
			height: 200, //default height
			width: 'auto', //auto width
			url: false, //URL if using data from AJAX
			method: 'POST', //data sending method
			dataType: 'xml', //type of data for AJAX, either xml or json
			errormsg: 'Connection Error',
			usepager: false,
			nowrap: true,
			page: 1, //current page
			total: 1, //total pages
			numLinks: 2,
			links: 'numeric', //blank | title
			useRp: true, //use the results per page select box
			rp: 15, //results per page
			rpOptions: [10, 15, 20, 30, 50], //allowed per-page values 
			title: false,
			pagestat: 'Displaying {from} to {to} of {total} items',
			pagetext: 'Page',
			outof: 'of',
			findtext: 'Find',
			procmsg: 'Processing, please wait ...',
			query: '',
			qtype: '',
			nomsg: 'No items',
			evenClass: 'even',
			autoload: true,
			onChangeSort: false,
			onSuccess: false,
			onComplete: false,
			onError: false,
			onSubmit: false //using a custom populate function
		}, p);
		$(t).show() //show if hidden
			.attr({
				cellPadding: 0,
				cellSpacing: 0,
				border: 0
			}) //remove padding and spacing
			.removeAttr('width'); //remove width properties
		//create grid class
		var g = {
			hset: {},
			addData: function (data) { //parse data
				if (p.dataType == 'json') {
					data = $.extend({rows: [], page: 0, total: 0}, data);
				}
				if (p.preProcess) {
					data = p.preProcess(data);
				}
				$('.pReload', this.pDiv).removeClass('loading');
				this.isLoading = false;
				if (!data) {
					$('.dataTables_info').html(p.errormsg);
					return false;
				}
				if (p.dataType == 'xml') {
					p.total = +$('rows total', data).text();
				} else {
					p.total = data.total;
				}
				if (p.total == 0) {
					p.pages = 1;
					p.page = 1;
					//no items
					$('tbody', t).empty().html('<tr><td align="center" colspan="' + p.colModel.length + '">' + p.nomsg + '</td></tr>');
					$('.dataTables_info').html('');
					if(p.onNoItems) {
						p.onNoItems();
					}
					return false;
				}
				p.pages = Math.ceil(p.total / p.rp);
				if (p.dataType == 'xml') {
					p.page = +$('rows page', data).text();
				} else {
					p.page = data.page;
				}
				//build new body
				var tbody = document.createElement('tbody');
				if (p.dataType == 'json') {
					$.each(data.rows, function (i, row) {
						var tr = document.createElement('tr');
						if (i % 2/* && p.striped*/) {
							tr.className = p.evenClass;
						}
						if (row.id) {
							tr.id = 'row' + row.id;
						}
						$('thead tr:first th', t).each( //add cell
							function (idx) {
								var td = document.createElement('td');
								this.align = this.align ? this.align : 'left';
								td.align = this.align;
								// If the json elements aren't named (which is typical), use numeric order
								if (typeof row.cell[idx] != "undefined") {
									td.innerHTML = (row.cell[idx] != null) ? row.cell[idx] : '';//null-check for Opera-browser
								} else {
									td.innerHTML = row.cell[p.colModel[idx].name];
								}
								$(td).attr('abbr', $(this).attr('abbr'));
								$(tr).append(td);
								td = null;
							}
						);
						if ($('thead', this.gDiv).length < 1) {//handle if grid has no headers
							for (idx = 0; idx < cell.length; idx++) {
								var td = document.createElement('td');
								// If the json elements aren't named (which is typical), use numeric order
								if (typeof row.cell[idx] != "undefined") {
									td.innerHTML = (row.cell[idx] != null) ? row.cell[idx] : '';//null-check for Opera-browser
								} else {
									td.innerHTML = row.cell[p.colModel[idx].name];
								}
								$(tr).append(td);
								td = null;
							}
						}
						$(tbody).append(tr);
						tr = null;
					});
				} else if (p.dataType == 'xml') {
					var i = 1;
					$("rows row", data).each(function () {
						i++;
						var tr = document.createElement('tr');
						if (i % 2 && p.striped) {
							tr.className = 'erow';
						}
						var nid = $(this).attr('id');
						if (nid) {
							tr.id = 'row' + nid;
						}
						nid = null;
						var robj = this;
						$('thead tr:first th', g.hDiv).each(function () {
							var td = document.createElement('td');
							this.align = this.align ? this.align : 'left';
							td.align = this.align;
							td.innerHTML = $("cell:eq(" + idx + ")", robj).text();
							$(td).attr('abbr', $(this).attr('abbr'));
							$(tr).append(td);
							td = null;
						});
						if ($('thead', this.gDiv).length < 1) {//handle if grid has no headers
							$('cell', this).each(function () {
								var td = document.createElement('td');
								td.innerHTML = $(this).text();
								$(tr).append(td);
								td = null;
							});
						}
						$(tbody).append(tr);
						tr = null;
						robj = null;
					});
				}
				$('tr', t).unbind();
				$('tbody', t).remove();
				$(t).append(tbody);

				if (p.onComplete) {
					p.onComplete(data);
				}
                
				tbody = null;
				data = null;
				i = null;
				if (p.onSuccess) {
					p.onSuccess(this);
				}
				
				//buildpaper
				this.buildpager();
				
				if ($.browser && $.browser.opera) {
					$(t).css('visibility', 'visible');
				}
			},
			changeSort: function (th) { //change sortorder
				if (this.isLoading) {
					return true;
				}
				if (p.sortname == $(th).attr('abbr')) {
					if (p.sortorder == 'asc') {
						p.sortorder = 'desc';
					} else {
						p.sortorder = 'asc';
					}
				}
				$('thead tr th', t).each(function(i, e){
					if($(this).attr('abbr'))
					{
						$(this).addClass('sorting');
					}
				});
				$(th).removeClass().addClass('sorting_'+p.sortorder).siblings();
				p.sortname = $(th).attr('abbr');
				if (p.onChangeSort) {
					p.onChangeSort(p.sortname, p.sortorder);
				} else {
					this.populate();
				}
			},
			buildpager: function () { //rebuild pager based on new properties			
				// add pager
				if (p.usepager) {
					g.pDiv.className = 'fg-toolbar tableFooter';
					$(t).after(g.pDiv);
					var html = '<div class="dataTables_paginate paging_full_numbers"><a class="first paginate_button">First</a><a class="previous paginate_button">Previous</a><span class="pcontrol"></span><a class="next paginate_button">Next</a><a class="last paginate_button">Last</a></div>';
					$(g.pDiv).html(html);
					$('.pReload', g.pDiv).click(function () {
						g.populate();
					});
					$('.first.paginate_button', g.pDiv).on('click', function (e) {
						e.preventDefault();
						g.changePage('first')
					});
					$('.previous.paginate_button', g.pDiv).on('click', function (e) {
						e.preventDefault();
						g.changePage('prev')
					});
					$('.next.paginate_button', g.pDiv).on('click', function (e) {
						e.preventDefault();
						g.changePage('next')
					});
					$('.last.paginate_button', g.pDiv).on('click', function (e) {
						e.preventDefault();
						g.changePage('last')
					});
					$('.pcontrol a.paginate_button', g.pDiv).on('click', function (e) {
						e.preventDefault();
						g.changePage('page', this);
					});
				}
				var i, navhtml = '', classPage;
				p.startRange = ((p.page - p.numLinks) > 0) ? (p.page - (p.numLinks)) : 1;
				p.endRange = ((parseInt(p.page) + parseInt(p.numLinks)) < p.pages) ? (parseInt(p.page) + parseInt(p.numLinks)) : p.pages;

				for( i = p.startRange; i <= p.endRange; i++) {

		            if(i == p.page) {
		            	classPage = 'paginate_active';
		            } else {
		            	classPage = 'paginate_button';
		            }
	              	
	              	navhtml += "<a href='javascript:;' class='"+classPage+"'>";

		            switch ( p.links ) {
		                case "numeric" :
		                    navhtml += i;
		                    break;
		                case "blank" :
		                    break;
		                case "title" :
		                    var title = this._items.eq(i-1).attr("data-title");
		                    navhtml += title !== undefined ? title : "";
		                    break;
		            }

		            navhtml += "</a>";

				}
				var r1 = (p.page - 1) * p.rp + 1;
				var r2 = r1 + p.rp - 1;
				if (p.total < r2) {
					r2 = p.total;
				}
				var stat = p.pagestat;
				stat = stat.replace(/{from}/, r1);
				stat = stat.replace(/{to}/, r2);
				stat = stat.replace(/{total}/, p.total);

				$('.dataTables_info').remove();
				$('.dataTables_paginate').before('<div class="dataTables_info">'+stat+'</div>');
				$('.pcontrol', p.pDiv).html(navhtml);
			},
			populate: function () { //get latest data
				if (this.isLoading) {
					return true;
				}
				if (p.onSubmit) {
					var gh = p.onSubmit();
					if (!gh) {
						return false;
					}
				}
				this.isLoading = true;
				if (!p.url) {
					return false;
				}

				if ($.browser && $.browser.opera) {
					$(t).css('visibility', 'hidden');
				}
				if (!p.newp) {
					p.newp = 1;
				}
				if (p.page > p.pages) {
					p.page = p.pages;
				}
				var param = [{
					name: 'page',
					value: p.newp
				}, {
					name: 'rp',
					value: p.rp
				}, {
					name: 'sortname',
					value: p.sortname
				}, {
					name: 'sortorder',
					value: p.sortorder
				}, {
					name: 'query',
					value: p.query
				}, {
					name: 'qtype',
					value: p.qtype
				}];
				if (p.params) {
					for (var pi = 0; pi < p.params.length; pi++) {
						param[param.length] = p.params[pi];
					}
				}
				$.ajax({
					type: p.method,
					url: p.url,
					data: param,
					dataType: p.dataType,
					success: function (data) {
						g.addData(data);
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						try {
							if (p.onError) p.onError(XMLHttpRequest, textStatus, errorThrown);
						} catch (e) {}
					}
				});
			},
			doSearch: function () {
				p.query = $('input[name=q]', g.fDiv).val();
				p.qtype = $('select[name=qtype]', g.fDiv).val();
				p.newp = 1;
				this.populate();
			},
			changePage: function (ctype, obj) { //change page
				if (this.isLoading) {
					return true;
				}
				switch (ctype) {
					case 'first':
						p.newp = 1;
						break;
					case 'prev':
						if (p.page > 1) {
							p.newp = parseInt(p.page) - 1;
						}
						break;
					case 'next':
						if (p.page < p.pages) {
							p.newp = parseInt(p.page) + 1;
						}
						break;
					case 'last':
						p.newp = p.pages;
						break;
					case 'page':
						var nv = parseInt($(obj, this.pDiv).text());
						if (isNaN(nv)) {
							nv = 1;
						}
						if (nv < 1) {
							nv = 1;
						} else if (nv > p.pages) {
							nv = p.pages;
						}
						p.newp = nv;
						break;
				}
				if (p.newp == p.page) {
					return false;
				}
				if (p.onChangePage) {
					p.onChangePage(p.newp);
				} else {
					this.populate();
				}
			},
			pager: 0
		};
		if (p.colModel && !$('thead tr th', t).length) { //create model if any
			thead = document.createElement('thead');
			var tr = document.createElement('tr');
			for (var i = 0; i < p.colModel.length; i++) {
				var cm = p.colModel[i];
				var th = document.createElement('th');
				th.innerHTML = cm.display;
				if (cm.name && cm.sortable) {
					$(th).attr('abbr', cm.name);
				}
				$(th).attr('axis', 'col' + i);
				if (cm.align) {
					th.align = cm.align;
				}
				if (cm.width) {
					$(th).attr('width', cm.width);
				}
				if ($(cm).attr('hide')) {
					th.hidden = true;
				}
				if (cm.process) {
					th.process = cm.process;
				}
				$(tr).append(th);
			}
			$(thead).append(tr);
            //append loading
			$(t).prepend(thead).append('<tr><td colspan="'+p.colModel.length+'" align="center">Loading...</td></tr>');
		} // end if p.colmodel
		else {
			$('thead tr th', t).each(function(i, e){
				var self = $(e);
				p.colModel[i] = {};
				if(self.text() != '') {
					p.colModel[i].display = self.text();
					if(self.attr('abbr')){
						p.colModel[i].sortable = true;
					}
				}
				if(self.data('name')){
					p.colModel[i].name = self.data('name');
				}
				if(self.attr('align')){
					p.colModel[i].align = self.attr('align');
				}
				if(self.attr('width')){
					p.colModel[i].width = self.attr('width');
				}
				if(self.attr('hide')){
					p.colModel[i].hide = self.attr('hide');
				}
				self.attr('axis', 'col' + i);
				$('tbody', t).html('<tr><td colspan="'+p.colModel.length+'" align="center">Loading...</td></tr>');
			});
		}
		//init divs

		g.fullFilterDiv = document.createElement('div'); //create filter area
		g.fullFilterDiv.className = 'tablePars';
		g.gDiv = document.createElement('div'); //create global container
		g.pDiv = document.createElement('div'); //create pager container
		if (!p.usepager) {
			g.pDiv.style.display = 'none';
		}
		g.gDiv.className = 'dataTables_wrapper';
		if (p.width != 'auto') {
			g.gDiv.style.width = p.width + 'px';
		}
		//add conditional classes
		if ($.browser && $.browser.msie) {
			$(g.gDiv).addClass('ie');
		}
		if (p.novstripe) {
			$(g.gDiv).addClass('novstripe');
		}
		t.className = 'dataTable checkAll tDefault table table-striped';
		$(t).before(g.gDiv);
		$(g.gDiv).append(t);
		if (!p.colModel) var ci = 0;
		$('thead tr:first th', t).each(function (i, e) {
			if ($(this).attr('abbr')) {
				$(this).click(function (e) {
					var obj = (e.target || e.srcElement);
					if (obj.href || obj.type) return true;
					g.changeSort(this);
				});
				this.className = 'sorting';
				if ($(this).attr('abbr') == p.sortname) {
					this.className = 'sorting_' + p.sortorder;
				}
			}
			if (this.hidden) {
				$(this).hide();
			}
			if (!p.colModel) {
				$(this).attr('axis', 'col' + ci++);
			}
		});
		
		//add search button
		if (p.searchitems.length) {
			//filter
			g.fDiv = document.createElement('div');
			g.fDiv.className = 'dataTables_filter';

			//add search box
			var sitems = p.searchitems;
			var sopt = '', sel = '';
			for (var s = 0; s < sitems.length; s++) {
				if (p.qtype == '' && sitems[s].isdefault == true) {
					p.qtype = sitems[s].name;
					sel = 'selected="selected"';
				} else {
					sel = '';
				}
				sopt += "<option value='" + sitems[s].name + "' " + sel + " >" + sitems[s].display + "</option>";
			}
			if (p.qtype == '' && sitems.length) {
				p.qtype = sitems[0].name;
			}
			$(g.fDiv).append("<div class='sDiv2'>" + p.findtext + 
					" <select name='qtype'>" + sopt + "</select> " + 
					" <input type='text' value='" + p.query +"' size='30' name='q' class='qsbox' placeholder='Please enter your keywords' /> " +
					" <!--<button class='qsearch btn marginR5 btn-danger'>Search</button><button class='qclear btn'>Clear</button></div>-->");
			//Split into separate selectors because of bug in jQuery 1.3.2
			$('input[name=q]', g.fDiv).keydown(function (e) {
				if (e.keyCode == 13) {
					g.doSearch();
				}
			});
			$('button.qsearch', g.fDiv).click(function (e) {
				if($('input[name=q]', g.fDiv).val())
				g.doSearch();
			});
			$('select[name=qtype]', g.fDiv).keydown(function (e) {
				if (e.keyCode == 13) {
					g.doSearch();
				}
			});
			$('button.qclear', g.fDiv).click(function () {
				$('input[name=q]', g.fDiv).val('');
				p.query = '';
				g.doSearch();
			});
			$(t).before($(g.fullFilterDiv).append(g.fDiv));
		}

		// use buttons more - developing...
		/*if(p.buttons) {
			g.fullButtonDiv = document.createElement('div');
			g.fullButtonDiv.className = 'buttonsDiv';

			// each elements
			var html = '';
			$.each(p.buttons, function(i, e) {
				var icon = typeof(p.buttons[i].icon) != 'undefined' ? '<span class="led-icon led-icon-'+p.buttons[i].icon+'"></span>': '';
				html += '<a href="javascript:;" class="sButton'+(typeof(p.buttons[i].className)!='undefined'?(' '+p.buttons[i].className):'')+'">'+icon+p.buttons[i].name+'</a>';
			});
			$(t).before($(g.fullButtonDiv).html(html));
			$('.tablePars').css({'border-top': '1px solid #fff'});
		}*/
		
		//use Row options
		if (p.useRp) {
			var opt = '',
				sel = '';
			for (var nx = 0; nx < p.rpOptions.length; nx++) {
				if (p.rp == p.rpOptions[nx]) sel = 'selected="selected"';
				else sel = '';
				opt += "<option value='" + p.rpOptions[nx] + "' " + sel + " >" + p.rpOptions[nx] + "</option>";
			}

			g.plDiv = document.createElement('div');
			g.plDiv.className = 'dataTables_length';

			$(g.plDiv).prepend("Show <select name='rp'>" + opt + "</select> entries");
			$(t).before($(g.fullFilterDiv).append(g.plDiv));
			$('select', g.plDiv).change(function () {
				if (p.onRpChange) {
					p.onRpChange(+this.value);
				} else {
					p.newp = 1;
					p.rp = +this.value;
					g.populate();
				}
			});
		}

		//uniform init
		cms.load('forms/jquery.uniform.js', function(){
	        $('select, input, textarea', '.dataTables_wrapper .tablePars').uniform();
	    });
		
		//make grid functions accessible
		t.p = p;
		t.grid = g;
		// load data
		if (p.url && p.autoload) {
			g.populate();
		}
		return t;
	};
	var docloaded = false;
	$(document).ready(function () {
		docloaded = true
	});
	$.fn.flexigrid = function (p) {
		return this.each(function () {
			if (!docloaded) {
				$(this).hide();
				var t = this;
				$(document).ready(function () {
					$.addFlex(t, p);
				});
			} else {
				$.addFlex(this, p);
			}
		});
	}; //end flexigrid
	$.fn.flexReload = function (p) { // function to reload grid
		return this.each(function () {
			if (this.grid && this.p.url) this.grid.populate();
		});
	}; //end flexReload
	$.fn.flexOptions = function (p) { //function to update general options
		return this.each(function () {
			if (this.grid) $.extend(this.p, p);
		});
	}; //end flexOptions
	$.fn.flexAddData = function (data) { // function to add data to grid
		return this.each(function () {
			if (this.grid) this.grid.addData(data);
		});
	};
})(jQuery);