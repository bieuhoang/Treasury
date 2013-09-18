var php = {
	nl2br: function(string) {
		// Converts newlines to HTML line breaks  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/nl2br
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Philip Peterson
		// +   improved by: Onno Marsman
		// +   improved by: Atli Þór
		// +   bugfixed by: Onno Marsman
		// +      input by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: Maximusya
		// *     example 1: nl2br('Kevin\nvan\nZonneveld');
		// *     returns 1: 'Kevin\nvan\nZonneveld'
		// *     example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
		// *     returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
		// *     example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
		// *     returns 3: '\nOne\nTwo\n\nThree\n'
		var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '' : '<br>';
	 
		return (string + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	},
	lcfirst: function(string) {
		// !No description available for lcfirst. @php.js developers: Please update the function summary text file.
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/lcfirst
		// +   original by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: lcfirst('Kevin Van Zonneveld');
		// *     returns 1: 'kevin Van Zonneveld'
		var f = string.charAt(0).toLowerCase();
		return f + string.substr(1);
	},
	ltrim: function(string, charlist) {
		// Strips whitespace from the beginning of a string  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/ltrim
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: Erkekjetter
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// *     example 1: ltrim('    Kevin van Zonneveld    ');
		// *     returns 1: 'Kevin van Zonneveld    '
		charlist = !charlist ? ' \\s\u00A0' : (charlist + '').replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
		var re = new RegExp('^[' + charlist + ']+', 'g');
		return (string + '').replace(re, '');
	},
	rtrim: function(string, charlist) {
		// Removes trailing whitespace  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/rtrim
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: Erkekjetter
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// +   input by: rem
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: rtrim('    Kevin van Zonneveld    ');
		// *     returns 1: '    Kevin van Zonneveld'
		charlist = !charlist ? ' \\s\u00A0' : (charlist + '').replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\\$1');
		var re = new RegExp('[' + charlist + ']+$', 'g');
		return (string + '').replace(re, '');
	},
	repeat: function(string, multiplier) {
		// Returns the input string repeat mult times  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/str_repeat
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
		// *     example 1: '-='.strRepeat(10);
		// *     returns 1: '-=-=-=-=-=-=-=-=-=-='
		return new Array(multiplier + 1).join(string);
	},
	str_replace: function(search, replace, string, count) {
		// Replaces all occurrences of search in haystack with replace  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/str_replace
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Gabriel Paderni
		// +   improved by: Philip Peterson
		// +   improved by: Simon Willison (http://simonwillison.net)
		// +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
		// +   bugfixed by: Anton Ongson
		// +      input by: Onno Marsman
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +    tweaked by: Onno Marsman
		// +      input by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   input by: Oleg Eremeev
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Oleg Eremeev
		// %          note 1: The count parameter must be passed as a string in order
		// %          note 1:  to find a global variable in which the result will be given
		// *     example 1: 'Kevin van Zonneveld'.strReplace(' ', '.');
		// *     returns 1: 'Kevin.van.Zonneveld'
		// *     example 2: '{name}, lars'.strReplace(['{name}', 'l'], ['hello', 'm']);
		// *     returns 2: 'hemmo, mars'
		var i = 0,
			j = 0,
			temp = '',
			repl = '',
			sl = 0,
			fl = 0,
			f = [].concat(search),
			r = [].concat(replace),
			s = string,
			ra = Object.prototype.toString.call(r) === '[object Array]',
			sa = Object.prototype.toString.call(s) === '[object Array]';
		s = [].concat(s);
		if (count) {
			string.window[count] = 0;
		}
	 
		for (i = 0, sl = s.length; i < sl; i++) {
			if (s[i] === '') {
				continue;
			}
			for (j = 0, fl = f.length; j < fl; j++) {
				temp = s[i] + '';
				repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
				s[i] = (temp).split(f[j]).join(repl);
				if (count && s[i] !== temp) {
					string.window[count] += (temp.length - s[i].length) / f[j].length;
				}
			}
		}
		return sa ? s : s[0];
	},
	str_word_count: function(string, format, charlist) {
		// Counts the number of words inside a string. If format of 1 is specified,     then the function will return an array containing all the words     found inside the string. If format of 2 is specified, then the function     will return an associated array where the position of the word is the key     and the word itself is the value.      For the purpose of this function, 'word' is defined as a locale dependent     string containing alphabetic characters, which also may contain, but not start     with "'" and "-" characters.  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/str_word_count
		// +   original by: Ole Vrijenhoek
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +   input by: Bug?
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// -   depends on: ctype_alpha
		// *     example 1: "Hello fri3nd, you're\r\n       looking          good today!".strWordCount(1);
		// *     returns 1: ['Hello', 'fri', 'nd', "you're", 'looking', 'good', 'today']
		// *     example 2: "Hello fri3nd, you're\r\n       looking          good today!".strWordCount(2);
		// *     returns 2: {0: 'Hello', 6: 'fri', 10: 'nd', 14: "you're", 29: 'looking', 46: 'good', 51: 'today'}
		// *     example 3: "Hello fri3nd, you're\r\n       looking          good today!".strWordCount(1, '\u00e0\u00e1\u00e3\u00e73');
		// *     returns 3: ['Hello', 'fri3nd', 'youre', 'looking', 'good', 'today']
		var len = string.length,
			str = string,
			cl = charlist && charlist.length,
			chr = '',
			tmpStr = '',
			i = 0,
			c = '',
			wArr = [],
			wC = 0,
			assoc = {},
			aC = 0,
			reg = '',
			match = false;
	 
		// BEGIN STATIC
		var _preg_quote = function (str) {
			return (str + '').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!<>\|\:])/g, '\\$1');
		},
			_getWholeChar = function (str, i) { // Use for rare cases of non-BMP characters
				var code = str.charCodeAt(i);
				if (code < 0xD800 || code > 0xDFFF) {
					return str.charAt(i);
				}
				if (0xD800 <= code && code <= 0xDBFF) { // High surrogate (could change last hex to 0xDB7F to treat high private surrogates as single characters)
					if (str.length <= (i + 1)) {
						throw 'High surrogate without following low surrogate';
					}
					var next = str.charCodeAt(i + 1);
					if (0xDC00 > next || next > 0xDFFF) {
						throw 'High surrogate without following low surrogate';
					}
					return str.charAt(i) + str.charAt(i + 1);
				}
				// Low surrogate (0xDC00 <= code && code <= 0xDFFF)
				if (i === 0) {
					throw 'Low surrogate without preceding high surrogate';
				}
				var prev = str.charCodeAt(i - 1);
				if (0xD800 > prev || prev > 0xDBFF) { // (could change last hex to 0xDB7F to treat high private surrogates as single characters)
					throw 'Low surrogate without preceding high surrogate';
				}
				return false; // We can pass over low surrogates now as the second component in a pair which we have already processed
			};
		// END STATIC
		if (cl) {
			reg = '^(' + _preg_quote(_getWholeChar(charlist, 0));
			for (i = 1; i < cl; i++) {
				if ((chr = _getWholeChar(charlist, i)) === false) {
					continue;
				}
				reg += '|' + _preg_quote(chr);
			}
			reg += ')$';
			reg = new RegExp(reg);
		}
	 
		for (i = 0; i < len; i++) {
			if ((c = _getWholeChar(str, i)) === false) {
				continue;
			}
			match = string.ctype_alpha(c) || (reg && c.search(reg) !== -1) || ((i !== 0 && i !== len - 1) && c === '-') || // No hyphen at beginning or end unless allowed in charlist (or locale)
			(i !== 0 && c === "'"); // No apostrophe at beginning unless allowed in charlist (or locale)
			if (match) {
				if (tmpStr === '' && format === 2) {
					aC = i;
				}
				tmpStr = tmpStr + c;
			}
			if (i === len - 1 || !match && tmpStr !== '') {
				if (format !== 2) {
					wArr[wArr.length] = tmpStr;
				} else {
					assoc[aC] = tmpStr;
				}
				tmpStr = '';
				wC++;
			}
		}
	 
		if (!format) {
			return wC;
		} else if (format === 1) {
			return wArr;
		} else if (format === 2) {
			return assoc;
		}
		throw 'You have supplied an incorrect format';
	},
	strlen: function(string) {
		// http://kevin.vanzonneveld.net
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Sakimori
		// +      input by: Kirk Strobeck
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// +    revised by: Brett Zamir (http://brett-zamir.me)
		// %        note 1: May look like overkill, but in order to be truly faithful to handling all Unicode
		// %        note 1: characters and to this function in PHP which does not count the number of bytes
		// %        note 1: but counts the number of characters, something like this is really necessary.
		// *     example 1: strlen('Kevin van Zonneveld');
		// *     returns 1: 19
		// *     example 2: strlen('A\ud87e\udc04Z');
		// *     returns 2: 3
		var str = string + '';
		var i = 0,
		chr = '',
		lgth = 0;

		if (!this.php_js || !this.php_js.ini || !this.php_js.ini['unicode.semantics'] || this.php_js.ini['unicode.semantics'].local_value.toLowerCase() !== 'on') {
			return string.length;
		}

		var getWholeChar = function (str, i) {
			var code = str.charCodeAt(i);
			var next = '',
				prev = '';
			if (0xD800 <= code && code <= 0xDBFF) { // High surrogate (could change last hex to 0xDB7F to treat high private surrogates as single characters)
				if (str.length <= (i + 1)) {
					throw 'High surrogate without following low surrogate';
				}
				next = str.charCodeAt(i + 1);
				if (0xDC00 > next || next > 0xDFFF) {
					throw 'High surrogate without following low surrogate';
				}
				return str.charAt(i) + str.charAt(i + 1);
			}
			else if (0xDC00 <= code && code <= 0xDFFF) { // Low surrogate
				if (i === 0) {
					throw 'Low surrogate without preceding high surrogate';
				}
				prev = str.charCodeAt(i - 1);
				if (0xD800 > prev || prev > 0xDBFF) { //(could change last hex to 0xDB7F to treat high private surrogates as single characters)
					throw 'Low surrogate without preceding high surrogate';
				}
				return false; // We can pass over low surrogates now as the second component in a pair which we have already processed
			}
			return str.charAt(i);
		};

		for (i = 0, lgth = 0; i < str.length; i++) {
			if ((chr = getWholeChar(str, i)) === false) {
				continue;
			} // Adapt this line at the top of any loop, passing in the whole string and the current iteration and returning a variable to represent the individual character; purpose is to treat the first part of a surrogate pair as the whole character and then ignore the second part
			lgth++;
		}
		return lgth;
	},
	strpos: function(haystack, needle, offset) {
		// http://kevin.vanzonneveld.net
			// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Onno Marsman
		// +   bugfixed by: Daniel Esteban
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: strpos('Kevin van Zonneveld', 'e', 5);
		// *     returns 1: 14
		var i = (haystack + '').indexOf(needle, (offset || 0));
		return i === -1 ? false : i;
	},
	strtolower: function(str) {
		// http://kevin.vanzonneveld.net
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Onno Marsman
		// *     example 1: strtolower('Kevin van Zonneveld');
		// *     returns 1: 'kevin van zonneveld'
		return (str + '').toLowerCase();
	},
	strtoupper: function(str) {
		// http://kevin.vanzonneveld.net
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Onno Marsman
		// *     example 1: strtoupper('Kevin van Zonneveld');
		// *     returns 1: 'KEVIN VAN ZONNEVELD'
		return (str + '').toUpperCase();
	},
	ucwords: function(str) {
		// http://kevin.vanzonneveld.net
		// +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
		// +   improved by: Waldo Malqui Silva
		// +   bugfixed by: Onno Marsman
		// +   improved by: Robin
		// +      input by: James (http://www.james-bell.co.uk/)
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// *     example 1: ucwords('kevin van  zonneveld');
		// *     returns 1: 'Kevin Van  Zonneveld'
		// *     example 2: ucwords('HELLO WORLD');
		// *     returns 2: 'HELLO WORLD'
		return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function ($1) {
			return $1.toUpperCase();
		});
	},
	ucfirst: function(str) {
		// http://kevin.vanzonneveld.net
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: ucfirst('kevin van zonneveld');
		// *     returns 1: 'Kevin van zonneveld'
		str += '';
		var f = str.charAt(0).toUpperCase();
		return f + str.substr(1);
	},
	strip_tags: function(input, allowed) {
		// Strips HTML and PHP tags from a string  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/strip_tags
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Luke Godfrey
		// +      input by: Pul
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// +      input by: Alex
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: Marc Palau
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Eric Nagel
		// +      input by: Bobby Drake
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Tomasz Wesolowski
		// +      input by: Evertjan Garretsen
		// +    revised by: Rafał Kukawski (http://blog.kukawski.pl/)
		// *     example 1: strip_tags('<p>Kevin</p> <b>van</b> <i>Zonneveld</i>', '<i><b>');
		// *     returns 1: 'Kevin <b>van</b> <i>Zonneveld</i>'
		// *     example 2: strip_tags('<p>Kevin <img src="someimage.png" onmouseover="someFunction()">van <i>Zonneveld</i></p>', '<p>');
		// *     returns 2: '<p>Kevin van Zonneveld</p>'
		// *     example 3: strip_tags("<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>", "<a>");
		// *     returns 3: '<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>'
		// *     example 4: strip_tags('1 < 5 5 > 1');
		// *     returns 4: '1 < 5 5 > 1'
		// *     example 5: strip_tags('1 <br/> 1');
		// *     returns 5: '1  1'
		// *     example 6: strip_tags('1 <br/> 1', '<br>');
		// *     returns 6: '1  1'
		// *     example 7: strip_tags('1 <br/> 1', '<br><br/>');
		// *     returns 7: '1 <br/> 1'
		allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
		var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
			commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
		return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
			return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
		});
	},
	sub_str: function(str, start, len) {
		// Returns part of a string  
		// 
		// version: 909.322
		// discuss at: http://phpjs.org/functions/substr
		// +     original by: Martijn Wieringa
		// +     bugfixed by: T.Wild
		// +      tweaked by: Onno Marsman
		// +      revised by: Theriault
		// +      improved by: Brett Zamir (http://brett-zamir.me)
		// %    note 1: Handles rare Unicode characters if 'unicode.semantics' ini (PHP6) is set to 'on'
		// *       example 1: substr('abcdef', 0, -1);
		// *       returns 1: 'abcde'
		// *       example 2: substr(2, 0, -6);
		// *       returns 2: false
		// *       example 3: ini_set('unicode.semantics',  'on');
		// *       example 3: substr('a\uD801\uDC00', 0, -1);
		// *       returns 3: 'a'
		// *       example 4: ini_set('unicode.semantics',  'on');
		// *       example 4: substr('a\uD801\uDC00', 0, 2);
		// *       returns 4: 'a\uD801\uDC00'
		// *       example 5: ini_set('unicode.semantics',  'on');
		// *       example 5: substr('a\uD801\uDC00', -1, 1);
		// *       returns 5: '\uD801\uDC00'
		// *       example 6: ini_set('unicode.semantics',  'on');
		// *       example 6: substr('a\uD801\uDC00z\uD801\uDC00', -3, 2);
		// *       returns 6: '\uD801\uDC00z'
		// *       example 7: ini_set('unicode.semantics',  'on');
		// *       example 7: substr('a\uD801\uDC00z\uD801\uDC00', -3, -1)
		// *       returns 7: '\uD801\uDC00z'
		// Add: (?) Use unicode.runtime_encoding (e.g., with string wrapped in "binary" or "Binary" class) to
		// allow access of binary (see file_get_contents()) by: charCodeAt(x) & 0xFF (see https://developer.mozilla.org/En/Using_XMLHttpRequest ) or require conversion first?
		var i = 0,
			allBMP = true,
			es = 0,
			el = 0,
			se = 0,
			ret = '';
		str += '';
		var end = str.length;
	 
		// BEGIN REDUNDANT
		this.php_js = this.php_js || {};
		this.php_js.ini = this.php_js.ini || {};
		// END REDUNDANT
		switch ((this.php_js.ini['unicode.semantics'] && this.php_js.ini['unicode.semantics'].local_value.toLowerCase())) {
		case 'on':
			// Full-blown Unicode including non-Basic-Multilingual-Plane characters
			// strlen()
			for (i = 0; i < str.length; i++) {
				if (/[\uD800-\uDBFF]/.test(str.charAt(i)) && /[\uDC00-\uDFFF]/.test(str.charAt(i + 1))) {
					allBMP = false;
					break;
				}
			}
	 
			if (!allBMP) {
				if (start < 0) {
					for (i = end - 1, es = (start += end); i >= es; i--) {
						if (/[\uDC00-\uDFFF]/.test(str.charAt(i)) && /[\uD800-\uDBFF]/.test(str.charAt(i - 1))) {
							start--;
							es--;
						}
					}
				} else {
					var surrogatePairs = /[\uD800-\uDBFF][\uDC00-\uDFFF]/g;
					while ((surrogatePairs.exec(str)) != null) {
						var li = surrogatePairs.lastIndex;
						if (li - 2 < start) {
							start++;
						} else {
							break;
						}
					}
				}
	 
				if (start >= end || start < 0) {
					return false;
				}
				if (len < 0) {
					for (i = end - 1, el = (end += len); i >= el; i--) {
						if (/[\uDC00-\uDFFF]/.test(str.charAt(i)) && /[\uD800-\uDBFF]/.test(str.charAt(i - 1))) {
							end--;
							el--;
						}
					}
					if (start > end) {
						return false;
					}
					return str.slice(start, end);
				} else {
					se = start + len;
					for (i = start; i < se; i++) {
						ret += str.charAt(i);
						if (/[\uD800-\uDBFF]/.test(str.charAt(i)) && /[\uDC00-\uDFFF]/.test(str.charAt(i + 1))) {
							se++; // Go one further, since one of the "characters" is part of a surrogate pair
						}
					}
					return ret;
				}
				break;
			}
			// Fall-through
		case 'off':
			// assumes there are no non-BMP characters;
			//    if there may be such characters, then it is best to turn it on (critical in true XHTML/XML)
		default:
			if (start < 0) {
				start += end;
			}
			end = typeof len === 'undefined' ? end : (len < 0 ? len + end : len + start);
			// PHP returns false if start does not fall within the string.
			// PHP returns false if the calculated end comes before the calculated start.
			// PHP returns an empty string if start and end are the same.
			// Otherwise, PHP returns the portion of the string from start to end.
			return start >= str.length || start < 0 || start > end ? !1 : str.slice(start, end);
		}
		return undefined; // Please Netbeans
	},
	strripos: function(haystack, needle, offset) {
		// Finds position of last occurrence of a string within another string  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/strripos
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// +   input by: saulius
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: strripos('Kevin van Zonneveld', 'E');
		// *     returns 1: 16
		haystack = (haystack + '').toLowerCase();
		needle = (needle + '').toLowerCase();
	 
		var i = -1;
		if (offset) {
			i = (haystack + '').slice(offset).lastIndexOf(needle); // strrpos' offset indicates starting point of range till end,
			// while lastIndexOf's optional 2nd argument indicates ending point of range from the beginning
			if (i !== -1) {
				i += offset;
			}
		} else {
			i = (haystack + '').lastIndexOf(needle);
		}
		return i >= 0 ? i : false;
	},
	strrpos: function(haystack, needle, offset) {
		// Finds position of last occurrence of a string within another string  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/strrpos
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// +   input by: saulius
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: strrpos('Kevin van Zonneveld', 'e');
		// *     returns 1: 16
		// *     example 2: strrpos('somepage.com', '.', false);
		// *     returns 2: 8
		// *     example 3: strrpos('baa', 'a', 3);
		// *     returns 3: false
		// *     example 4: strrpos('baa', 'a', 2);
		// *     returns 4: 2
		var i = -1;
		if (offset) {
			i = (haystack + '').slice(offset).lastIndexOf(needle); // strrpos' offset indicates starting point of range till end,
			// while lastIndexOf's optional 2nd argument indicates ending point of range from the beginning
			if (i !== -1) {
				i += offset;
			}
		} else {
			i = (haystack + '').lastIndexOf(needle);
		}
		return i >= 0 ? i : false;
	},
	number_format: function(number, decimals, dec_point, thousands_sep) {
		// Formats a number with grouped thousands  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/number_format
		// +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +     bugfix by: Michael White (http://getsprink.com)
		// +     bugfix by: Benjamin Lupton
		// +     bugfix by: Allan Jensen (http://www.winternet.no)
		// +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
		// +     bugfix by: Howard Yeend
		// +    revised by: Luke Smith (http://lucassmith.name)
		// +     bugfix by: Diogo Resende
		// +     bugfix by: Rival
		// +      input by: Kheang Hok Chin (http://www.distantia.ca/)
		// +   improved by: davook
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +      input by: Jay Klehr
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +      input by: Amir Habibi (http://www.residence-mixte.com/)
		// +     bugfix by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: Theriault
		// +      input by: Amirouche
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// *     example 1: number_format(1234.56);
		// *     returns 1: '1,235'
		// *     example 2: number_format(1234.56, 2, ',', ' ');
		// *     returns 2: '1 234,56'
		// *     example 3: number_format(1234.5678, 2, '.', '');
		// *     returns 3: '1234.57'
		// *     example 4: number_format(67, 2, ',', '.');
		// *     returns 4: '67,00'
		// *     example 5: number_format(1000);
		// *     returns 5: '1,000'
		// *     example 6: number_format(67.311, 2);
		// *     returns 6: '67.31'
		// *     example 7: number_format(1000.55, 1);
		// *     returns 7: '1,000.6'
		// *     example 8: number_format(67000, 5, ',', '.');
		// *     returns 8: '67.000,00000'
		// *     example 9: number_format(0.9, 0);
		// *     returns 9: '1'
		// *    example 10: number_format('1.20', 2);
		// *    returns 10: '1.20'
		// *    example 11: number_format('1.20', 4);
		// *    returns 11: '1.2000'
		// *    example 12: number_format('1.2000', 3);
		// *    returns 12: '1.200'
		// *    example 13: number_format('1 000,50', 2, '.', ' ');
		// *    returns 13: '100 050.00'
		// Strip all characters but numerical ones.
		var str = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+str) ? 0 : +str,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function (n, prec) {
				var k = Math.pow(10, prec);
				return '' + Math.round(n * k) / k;
			};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	},
	sha1: function(str) {
		// http://kevin.vanzonneveld.net
		// +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
		// + namespaced by: Michael White (http://getsprink.com)
		// +      input by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// -    depends on: utf8_encode
		// *     example 1: sha1('Kevin van Zonneveld');
		// *     returns 1: '54916d2e62f65b3afa6e192e6a601cdbe5cb5897'
		var rotate_left = function (n, s) {
			var t4 = (n << s) | (n >>> (32 - s));
			return t4;
		};

		/*var lsb_hex = function (val) { // Not in use; needed?
		var str="";
		var i;
		var vh;
		var vl;

		for ( i=0; i<=6; i+=2 ) {
		  vh = (val>>>(i*4+4))&0x0f;
		  vl = (val>>>(i*4))&0x0f;
		  str += vh.toString(16) + vl.toString(16);
		}
		return str;
		};*/

		var cvt_hex = function (val) {
			var str = "";
			var i;
			var v;

			for (i = 7; i >= 0; i--) {
				v = (val >>> (i * 4)) & 0x0f;
				str += v.toString(16);
			}
			return str;
		};

		var blockstart;
		var i, j;
		var W = new Array(80);
		var H0 = 0x67452301;
		var H1 = 0xEFCDAB89;
		var H2 = 0x98BADCFE;
		var H3 = 0x10325476;
		var H4 = 0xC3D2E1F0;
		var A, B, C, D, E;
		var temp;

		str = this.utf8_encode(str);
		var str_len = str.length;

		var word_array = [];
		for (i = 0; i < str_len - 3; i += 4) {
			j = str.charCodeAt(i) << 24 | str.charCodeAt(i + 1) << 16 | str.charCodeAt(i + 2) << 8 | str.charCodeAt(i + 3);
			word_array.push(j);
		}

		switch (str_len % 4) {
			case 0:
				i = 0x080000000;
			break;
			case 1:
				i = str.charCodeAt(str_len - 1) << 24 | 0x0800000;
			break;
			case 2:
				i = str.charCodeAt(str_len - 2) << 24 | str.charCodeAt(str_len - 1) << 16 | 0x08000;
			break;
			case 3:
				i = str.charCodeAt(str_len - 3) << 24 | str.charCodeAt(str_len - 2) << 16 | str.charCodeAt(str_len - 1) << 8 | 0x80;
			break;
		}

		word_array.push(i);

		while ((word_array.length % 16) != 14) {
			word_array.push(0);
		}

		word_array.push(str_len >>> 29);
		word_array.push((str_len << 3) & 0x0ffffffff);

		for (blockstart = 0; blockstart < word_array.length; blockstart += 16) {
			for (i = 0; i < 16; i++) {
				W[i] = word_array[blockstart + i];
			}
			for (i = 16; i <= 79; i++) {
				W[i] = rotate_left(W[i - 3] ^ W[i - 8] ^ W[i - 14] ^ W[i - 16], 1);
			}

			A = H0;
			B = H1;
			C = H2;
			D = H3;
			E = H4;

			for (i = 0; i <= 19; i++) {
				temp = (rotate_left(A, 5) + ((B & C) | (~B & D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
				E = D;
				D = C;
				C = rotate_left(B, 30);
				B = A;
				A = temp;
			}

			for (i = 20; i <= 39; i++) {
				temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
				E = D;
				D = C;
				C = rotate_left(B, 30);
				B = A;
				A = temp;
			}

			for (i = 40; i <= 59; i++) {
				temp = (rotate_left(A, 5) + ((B & C) | (B & D) | (C & D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
				E = D;
				D = C;
				C = rotate_left(B, 30);
				B = A;
				A = temp;
			}

			for (i = 60; i <= 79; i++) {
				temp = (rotate_left(A, 5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
				E = D;
				D = C;
				C = rotate_left(B, 30);
				B = A;
				A = temp;
			}

			H0 = (H0 + A) & 0x0ffffffff;
			H1 = (H1 + B) & 0x0ffffffff;
			H2 = (H2 + C) & 0x0ffffffff;
			H3 = (H3 + D) & 0x0ffffffff;
			H4 = (H4 + E) & 0x0ffffffff;
		}

		temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);
		return temp.toLowerCase();
	},
	md5: function(str) {
		// http://kevin.vanzonneveld.net
		// +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
		// + namespaced by: Michael White (http://getsprink.com)
		// +    tweaked by: Jack
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// -    depends on: utf8_encode
		// *     example 1: md5('Kevin van Zonneveld');
		// *     returns 1: '6e658d4bfcb59cc13f96c14450ac40b9'
		var xl;

		var rotateLeft = function (lValue, iShiftBits) {
			return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
		};

		var addUnsigned = function (lX, lY) {
			var lX4, lY4, lX8, lY8, lResult;
			lX8 = (lX & 0x80000000);
			lY8 = (lY & 0x80000000);
			lX4 = (lX & 0x40000000);
			lY4 = (lY & 0x40000000);
			lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);
			if (lX4 & lY4) {
				return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
			}
			if (lX4 | lY4) {
				if (lResult & 0x40000000) {
					return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
				} else {
					return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
				}
			} else {
				return (lResult ^ lX8 ^ lY8);
			}
		};

		var _F = function (x, y, z) {
			return (x & y) | ((~x) & z);
		};
		var _G = function (x, y, z) {
			return (x & z) | (y & (~z));
		};
		var _H = function (x, y, z) {
			return (x ^ y ^ z);
		};
		var _I = function (x, y, z) {
			return (y ^ (x | (~z)));
		};

		var _FF = function (a, b, c, d, x, s, ac) {
			a = addUnsigned(a, addUnsigned(addUnsigned(_F(b, c, d), x), ac));
			return addUnsigned(rotateLeft(a, s), b);
		};

		var _GG = function (a, b, c, d, x, s, ac) {
			a = addUnsigned(a, addUnsigned(addUnsigned(_G(b, c, d), x), ac));
			return addUnsigned(rotateLeft(a, s), b);
		};

		var _HH = function (a, b, c, d, x, s, ac) {
			a = addUnsigned(a, addUnsigned(addUnsigned(_H(b, c, d), x), ac));
			return addUnsigned(rotateLeft(a, s), b);
		};

		var _II = function (a, b, c, d, x, s, ac) {
			a = addUnsigned(a, addUnsigned(addUnsigned(_I(b, c, d), x), ac));
			return addUnsigned(rotateLeft(a, s), b);
		};

		var convertToWordArray = function (str) {
			var lWordCount;
			var lMessageLength = str.length;
			var lNumberOfWords_temp1 = lMessageLength + 8;
			var lNumberOfWords_temp2 = (lNumberOfWords_temp1 - (lNumberOfWords_temp1 % 64)) / 64;
			var lNumberOfWords = (lNumberOfWords_temp2 + 1) * 16;
			var lWordArray = new Array(lNumberOfWords - 1);
			var lBytePosition = 0;
			var lByteCount = 0;
			while (lByteCount < lMessageLength) {
				lWordCount = (lByteCount - (lByteCount % 4)) / 4;
				lBytePosition = (lByteCount % 4) * 8;
				lWordArray[lWordCount] = (lWordArray[lWordCount] | (str.charCodeAt(lByteCount) << lBytePosition));
				lByteCount++;
			}
			lWordCount = (lByteCount - (lByteCount % 4)) / 4;
			lBytePosition = (lByteCount % 4) * 8;
			lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80 << lBytePosition);
			lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
			lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
			return lWordArray;
		};

		var wordToHex = function (lValue) {
			var wordToHexValue = "",
				wordToHexValue_temp = "",
				lByte, lCount;
			for (lCount = 0; lCount <= 3; lCount++) {
				lByte = (lValue >>> (lCount * 8)) & 255;
				wordToHexValue_temp = "0" + lByte.toString(16);
				wordToHexValue = wordToHexValue + wordToHexValue_temp.substr(wordToHexValue_temp.length - 2, 2);
			}
			return wordToHexValue;
		};

		var x = [],
		k, AA, BB, CC, DD, a, b, c, d, S11 = 7,
		S12 = 12,
		S13 = 17,
		S14 = 22,
		S21 = 5,
		S22 = 9,
		S23 = 14,
		S24 = 20,
		S31 = 4,
		S32 = 11,
		S33 = 16,
		S34 = 23,
		S41 = 6,
		S42 = 10,
		S43 = 15,
		S44 = 21;

		str = this.utf8_encode(str);
		x = convertToWordArray(str);
		a = 0x67452301;
		b = 0xEFCDAB89;
		c = 0x98BADCFE;
		d = 0x10325476;

		xl = x.length;
		for (k = 0; k < xl; k += 16) {
			AA = a;
			BB = b;
			CC = c;
			DD = d;
			a = _FF(a, b, c, d, x[k + 0], S11, 0xD76AA478);
			d = _FF(d, a, b, c, x[k + 1], S12, 0xE8C7B756);
			c = _FF(c, d, a, b, x[k + 2], S13, 0x242070DB);
			b = _FF(b, c, d, a, x[k + 3], S14, 0xC1BDCEEE);
			a = _FF(a, b, c, d, x[k + 4], S11, 0xF57C0FAF);
			d = _FF(d, a, b, c, x[k + 5], S12, 0x4787C62A);
			c = _FF(c, d, a, b, x[k + 6], S13, 0xA8304613);
			b = _FF(b, c, d, a, x[k + 7], S14, 0xFD469501);
			a = _FF(a, b, c, d, x[k + 8], S11, 0x698098D8);
			d = _FF(d, a, b, c, x[k + 9], S12, 0x8B44F7AF);
			c = _FF(c, d, a, b, x[k + 10], S13, 0xFFFF5BB1);
			b = _FF(b, c, d, a, x[k + 11], S14, 0x895CD7BE);
			a = _FF(a, b, c, d, x[k + 12], S11, 0x6B901122);
			d = _FF(d, a, b, c, x[k + 13], S12, 0xFD987193);
			c = _FF(c, d, a, b, x[k + 14], S13, 0xA679438E);
			b = _FF(b, c, d, a, x[k + 15], S14, 0x49B40821);
			a = _GG(a, b, c, d, x[k + 1], S21, 0xF61E2562);
			d = _GG(d, a, b, c, x[k + 6], S22, 0xC040B340);
			c = _GG(c, d, a, b, x[k + 11], S23, 0x265E5A51);
			b = _GG(b, c, d, a, x[k + 0], S24, 0xE9B6C7AA);
			a = _GG(a, b, c, d, x[k + 5], S21, 0xD62F105D);
			d = _GG(d, a, b, c, x[k + 10], S22, 0x2441453);
			c = _GG(c, d, a, b, x[k + 15], S23, 0xD8A1E681);
			b = _GG(b, c, d, a, x[k + 4], S24, 0xE7D3FBC8);
			a = _GG(a, b, c, d, x[k + 9], S21, 0x21E1CDE6);
			d = _GG(d, a, b, c, x[k + 14], S22, 0xC33707D6);
			c = _GG(c, d, a, b, x[k + 3], S23, 0xF4D50D87);
			b = _GG(b, c, d, a, x[k + 8], S24, 0x455A14ED);
			a = _GG(a, b, c, d, x[k + 13], S21, 0xA9E3E905);
			d = _GG(d, a, b, c, x[k + 2], S22, 0xFCEFA3F8);
			c = _GG(c, d, a, b, x[k + 7], S23, 0x676F02D9);
			b = _GG(b, c, d, a, x[k + 12], S24, 0x8D2A4C8A);
			a = _HH(a, b, c, d, x[k + 5], S31, 0xFFFA3942);
			d = _HH(d, a, b, c, x[k + 8], S32, 0x8771F681);
			c = _HH(c, d, a, b, x[k + 11], S33, 0x6D9D6122);
			b = _HH(b, c, d, a, x[k + 14], S34, 0xFDE5380C);
			a = _HH(a, b, c, d, x[k + 1], S31, 0xA4BEEA44);
			d = _HH(d, a, b, c, x[k + 4], S32, 0x4BDECFA9);
			c = _HH(c, d, a, b, x[k + 7], S33, 0xF6BB4B60);
			b = _HH(b, c, d, a, x[k + 10], S34, 0xBEBFBC70);
			a = _HH(a, b, c, d, x[k + 13], S31, 0x289B7EC6);
			d = _HH(d, a, b, c, x[k + 0], S32, 0xEAA127FA);
			c = _HH(c, d, a, b, x[k + 3], S33, 0xD4EF3085);
			b = _HH(b, c, d, a, x[k + 6], S34, 0x4881D05);
			a = _HH(a, b, c, d, x[k + 9], S31, 0xD9D4D039);
			d = _HH(d, a, b, c, x[k + 12], S32, 0xE6DB99E5);
			c = _HH(c, d, a, b, x[k + 15], S33, 0x1FA27CF8);
			b = _HH(b, c, d, a, x[k + 2], S34, 0xC4AC5665);
			a = _II(a, b, c, d, x[k + 0], S41, 0xF4292244);
			d = _II(d, a, b, c, x[k + 7], S42, 0x432AFF97);
			c = _II(c, d, a, b, x[k + 14], S43, 0xAB9423A7);
			b = _II(b, c, d, a, x[k + 5], S44, 0xFC93A039);
			a = _II(a, b, c, d, x[k + 12], S41, 0x655B59C3);
			d = _II(d, a, b, c, x[k + 3], S42, 0x8F0CCC92);
			c = _II(c, d, a, b, x[k + 10], S43, 0xFFEFF47D);
			b = _II(b, c, d, a, x[k + 1], S44, 0x85845DD1);
			a = _II(a, b, c, d, x[k + 8], S41, 0x6FA87E4F);
			d = _II(d, a, b, c, x[k + 15], S42, 0xFE2CE6E0);
			c = _II(c, d, a, b, x[k + 6], S43, 0xA3014314);
			b = _II(b, c, d, a, x[k + 13], S44, 0x4E0811A1);
			a = _II(a, b, c, d, x[k + 4], S41, 0xF7537E82);
			d = _II(d, a, b, c, x[k + 11], S42, 0xBD3AF235);
			c = _II(c, d, a, b, x[k + 2], S43, 0x2AD7D2BB);
			b = _II(b, c, d, a, x[k + 9], S44, 0xEB86D391);
			a = addUnsigned(a, AA);
			b = addUnsigned(b, BB);
			c = addUnsigned(c, CC);
			d = addUnsigned(d, DD);
		}

		var temp = wordToHex(a) + wordToHex(b) + wordToHex(c) + wordToHex(d);

		return temp.toLowerCase();
	},
	htmlentities: function(string, quote_style, charset, double_encode) {
		// http://kevin.vanzonneveld.net
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: nobbler
		// +    tweaked by: Jack
		// +   bugfixed by: Onno Marsman
		// +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +    bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +      input by: Ratheous
		// +   improved by: Rafał Kukawski (http://blog.kukawski.pl)
		// +   improved by: Dj (http://phpjs.org/functions/htmlentities:425#comment_134018)
		// -    depends on: get_html_translation_table
		// *     example 1: htmlentities('Kevin & van Zonneveld');
		// *     returns 1: 'Kevin &amp; van Zonneveld'
		// *     example 2: htmlentities("foo'bar","ENT_QUOTES");
		// *     returns 2: 'foo&#039;bar'
		var hash_map = this.get_html_translation_table('HTML_ENTITIES', quote_style),
			symbol = '';
			string = string == null ? '' : string + '';

		if (!hash_map) {
			return false;
		}

		if (quote_style && quote_style === 'ENT_QUOTES') {
			hash_map["'"] = '&#039;';
		}

		if (!!double_encode || double_encode == null) {
			for (symbol in hash_map) {
				if (hash_map.hasOwnProperty(symbol)) {
					string = string.split(symbol).join(hash_map[symbol]);
				}
			}
		} else {
			string = string.replace(/([\s\S]*?)(&(?:#\d+|#x[\da-f]+|[a-zA-Z][\da-z]*);|$)/g, function (ignore, text, entity) {
				for (symbol in hash_map) {
					if (hash_map.hasOwnProperty(symbol)) {
						text = text.split(symbol).join(hash_map[symbol]);
					}
				}

			  return text + entity;
			});
		}

		return string;
	},
	html_entity_decode: function (string, quote_style) {
		// http://kevin.vanzonneveld.net
		// +   original by: john (http://www.jd-tech.net)
		// +      input by: ger
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// +   improved by: marc andreu
		// +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: Ratheous
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +      input by: Nick Kolosov (http://sammy.ru)
		// +   bugfixed by: Fox
		// -    depends on: get_html_translation_table
		// *     example 1: html_entity_decode('Kevin &amp; van Zonneveld');
		// *     returns 1: 'Kevin & van Zonneveld'
		// *     example 2: html_entity_decode('&amp;lt;');
		// *     returns 2: '&lt;'
		var hash_map = {},
		symbol = '',
		tmp_str = '',
		entity = '';
		tmp_str = string.toString();

		if (false === (hash_map = this.get_html_translation_table('HTML_ENTITIES', quote_style))) {
			return false;
		}

		// fix &amp; problem
		// http://phpjs.org/functions/get_html_translation_table:416#comment_97660
		delete(hash_map['&']);
		hash_map['&'] = '&amp;';

		for (symbol in hash_map) {
			entity = hash_map[symbol];
			tmp_str = tmp_str.split(entity).join(symbol);
		}
		tmp_str = tmp_str.split('&#039;').join("'");

		return tmp_str;
	},
	htmlspecialchars: function(string, quote_style, charset, double_encode) {
		// http://kevin.vanzonneveld.net
		// +   original by: Mirek Slugen
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Nathan
		// +   bugfixed by: Arno
		// +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +    bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +      input by: Ratheous
		// +      input by: Mailfaker (http://www.weedem.fr/)
		// +      reimplemented by: Brett Zamir (http://brett-zamir.me)
		// +      input by: felix
		// +    bugfixed by: Brett Zamir (http://brett-zamir.me)
		// %        note 1: charset argument not supported
		// *     example 1: htmlspecialchars("<a href='test'>Test</a>", 'ENT_QUOTES');
		// *     returns 1: '&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;'
		// *     example 2: htmlspecialchars("ab\"c'd", ['ENT_NOQUOTES', 'ENT_QUOTES']);
		// *     returns 2: 'ab"c&#039;d'
		// *     example 3: htmlspecialchars("my "&entity;" is still here", null, null, false);
		// *     returns 3: 'my &quot;&entity;&quot; is still here'
		var optTemp = 0,
			i = 0,
			noquotes = false;
		if (typeof quote_style === 'undefined' || quote_style === null) {
			quote_style = 2;
		}
		string = string.toString();
		if (double_encode !== false) { // Put this first to avoid double-encoding
			string = string.replace(/&/g, '&amp;');
		}
		string = string.replace(/</g, '&lt;').replace(/>/g, '&gt;');

		var OPTS = {
			'ENT_NOQUOTES': 0,
			'ENT_HTML_QUOTE_SINGLE': 1,
			'ENT_HTML_QUOTE_DOUBLE': 2,
			'ENT_COMPAT': 2,
			'ENT_QUOTES': 3,
			'ENT_IGNORE': 4
		};
		if (quote_style === 0) {
			noquotes = true;
		}
		if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
			quote_style = [].concat(quote_style);
			for (i = 0; i < quote_style.length; i++) {
				// Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
				if (OPTS[quote_style[i]] === 0) {
					noquotes = true;
				}
				else if (OPTS[quote_style[i]]) {
					optTemp = optTemp | OPTS[quote_style[i]];
				}
			}
			quote_style = optTemp;
		}
		if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
			string = string.replace(/'/g, '&#039;');
		}
		if (!noquotes) {
			string = string.replace(/"/g, '&quot;');
		}

		return string;
	},
	htmlspecialchars_decode: function(string, quote_style) {
		// http://kevin.vanzonneveld.net
		// +   original by: Mirek Slugen
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Mateusz "loonquawl" Zalega
		// +      input by: ReverseSyntax
		// +      input by: Slawomir Kaniecki
		// +      input by: Scott Cariss
		// +      input by: Francois
		// +   bugfixed by: Onno Marsman
		// +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +      input by: Ratheous
		// +      input by: Mailfaker (http://www.weedem.fr/)
		// +      reimplemented by: Brett Zamir (http://brett-zamir.me)
		// +    bugfixed by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: htmlspecialchars_decode("<p>this -&gt; &quot;</p>", 'ENT_NOQUOTES');
		// *     returns 1: '<p>this -> &quot;</p>'
		// *     example 2: htmlspecialchars_decode("&amp;quot;");
		// *     returns 2: '&quot;'
		var optTemp = 0,
			i = 0,
			noquotes = false;
		if (typeof quote_style === 'undefined') {
			quote_style = 2;
		}
		string = string.toString().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
		var OPTS = {
			'ENT_NOQUOTES': 0,
			'ENT_HTML_QUOTE_SINGLE': 1,
			'ENT_HTML_QUOTE_DOUBLE': 2,
			'ENT_COMPAT': 2,
			'ENT_QUOTES': 3,
			'ENT_IGNORE': 4
		};
		if (quote_style === 0) {
			noquotes = true;
		}
		if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
			quote_style = [].concat(quote_style);
			for (i = 0; i < quote_style.length; i++) {
				// Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
				if (OPTS[quote_style[i]] === 0) {
					noquotes = true;
				} else if (OPTS[quote_style[i]]) {
					optTemp = optTemp | OPTS[quote_style[i]];
				}
			}
			quote_style = optTemp;
		}
		if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
			string = string.replace(/&#0*39;/g, "'"); // PHP doesn't currently escape if more than one 0, but it should
			// string = string.replace(/&apos;|&#x0*27;/g, "'"); // This would also be useful here, but not a part of PHP
		}
		if (!noquotes) {
			string = string.replace(/&quot;/g, '"');
		}
		// Put this in last place to avoid escape being double-decoded
		string = string.replace(/&amp;/g, '&');

		return string;
	},
	mktime: function() {
		// http://kevin.vanzonneveld.net
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: baris ozdil
		// +      input by: gabriel paderni
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: FGFEmperor
		// +      input by: Yannoo
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: jakes
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Marc Palau
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +      input by: 3D-GRAF
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +      input by: Chris
		// +    revised by: Theriault
		// %        note 1: The return values of the following examples are
		// %        note 1: received only if your system's timezone is UTC.
		// *     example 1: mktime(14, 10, 2, 2, 1, 2008);
		// *     returns 1: 1201875002
		// *     example 2: mktime(0, 0, 0, 0, 1, 2008);
		// *     returns 2: 1196467200
		// *     example 3: make = mktime();
		// *     example 3: td = new Date();
		// *     example 3: real = Math.floor(td.getTime() / 1000);
		// *     example 3: diff = (real - make);
		// *     results 3: diff < 5
		// *     example 4: mktime(0, 0, 0, 13, 1, 1997)
		// *     returns 4: 883612800
		// *     example 5: mktime(0, 0, 0, 1, 1, 1998)
		// *     returns 5: 883612800
		// *     example 6: mktime(0, 0, 0, 1, 1, 98)
		// *     returns 6: 883612800
		// *     example 7: mktime(23, 59, 59, 13, 0, 2010)
		// *     returns 7: 1293839999
		// *     example 8: mktime(0, 0, -1, 1, 1, 1970)
		// *     returns 8: -1
		var d = new Date(),
			r = arguments,
			i = 0,
			e = ['Hours', 'Minutes', 'Seconds', 'Month', 'Date', 'FullYear'];

		for (i = 0; i < e.length; i++) {
			if (typeof r[i] === 'undefined') {
				r[i] = d['get' + e[i]]();
				r[i] += (i === 3); // +1 to fix JS months.
			} else {
				r[i] = parseInt(r[i], 10);
				if (isNaN(r[i])) {
					return false;
				}
			}
		}

		// Map years 0-69 to 2000-2069 and years 70-100 to 1970-2000.
		r[5] += (r[5] >= 0 ? (r[5] <= 69 ? 2e3 : (r[5] <= 100 ? 1900 : 0)) : 0);

		// Set year, month (-1 to fix JS months), and date.
		// !This must come before the call to setHours!
		d.setFullYear(r[5], r[3] - 1, r[4]);

		// Set hours, minutes, and seconds.
		d.setHours(r[0], r[1], r[2]);

		// Divide milliseconds by 1000 to return seconds and drop decimal.
		// Add 1 second if negative or it'll be off from PHP by 1 second.
		return (d.getTime() / 1e3 >> 0) - (d.getTime() < 0);
	},
	strftime: function(fmt, timestamp) {
		// http://kevin.vanzonneveld.net
		// +      original by: Blues (http://tech.bluesmoon.info/)
		// + reimplemented by: Brett Zamir (http://brett-zamir.me)
		// +   input by: Alex
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// -       depends on: setlocale
		// %        note 1: Uses global: php_js to store locale info
		// *        example 1: strftime("%A", 1062462400); // Return value will depend on date and locale
		// *        returns 1: 'Tuesday'
		// BEGIN REDUNDANT
		this.php_js = this.php_js || {};
		this.setlocale('LC_ALL', 0); // ensure setup of localization variables takes place
		// END REDUNDANT
		var phpjs = this.php_js;

		// BEGIN STATIC
		var _xPad = function (x, pad, r) {
			if (typeof r === 'undefined') {
				r = 10;
			}
			for (; parseInt(x, 10) < r && r > 1; r /= 10) {
				x = pad.toString() + x;
			}
			return x.toString();
		};

		var locale = phpjs.localeCategories.LC_TIME;
		var locales = phpjs.locales;
		var lc_time = locales[locale].LC_TIME;

		var _formats = {
			a: function (d) {
				return lc_time.a[d.getDay()];
			},
			A: function (d) {
				return lc_time.A[d.getDay()];
			},
			b: function (d) {
				return lc_time.b[d.getMonth()];
			},
			B: function (d) {
				return lc_time.B[d.getMonth()];
			},
			C: function (d) {
				return _xPad(parseInt(d.getFullYear() / 100, 10), 0);
			},
			d: ['getDate', '0'],
			e: ['getDate', ' '],
			g: function (d) {
				return _xPad(parseInt(this.G(d) / 100, 10), 0);
			},
			G: function (d) {
				var y = d.getFullYear();
				var V = parseInt(_formats.V(d), 10);
				var W = parseInt(_formats.W(d), 10);

				if (W > V) {
					y++;
				} else if (W === 0 && V >= 52) {
					y--;
				}

				return y;
			},
			H: ['getHours', '0'],
			I: function (d) {
				var I = d.getHours() % 12;
				return _xPad(I === 0 ? 12 : I, 0);
			},
			j: function (d) {
				var ms = d - new Date('' + d.getFullYear() + '/1/1 GMT');
				ms += d.getTimezoneOffset() * 60000; // Line differs from Yahoo implementation which would be equivalent to replacing it here with:
				// ms = new Date('' + d.getFullYear() + '/' + (d.getMonth()+1) + '/' + d.getDate() + ' GMT') - ms;
				var doy = parseInt(ms / 60000 / 60 / 24, 10) + 1;
				return _xPad(doy, 0, 100);
			},
			k: ['getHours', '0'],
			// not in PHP, but implemented here (as in Yahoo)
			l: function (d) {
				var l = d.getHours() % 12;
				return _xPad(l === 0 ? 12 : l, ' ');
			},
			m: function (d) {
				return _xPad(d.getMonth() + 1, 0);
			},
			M: ['getMinutes', '0'],
			p: function (d) {
				return lc_time.p[d.getHours() >= 12 ? 1 : 0];
			},
			P: function (d) {
				return lc_time.P[d.getHours() >= 12 ? 1 : 0];
			},
			s: function (d) { // Yahoo uses return parseInt(d.getTime()/1000, 10);
				return Date.parse(d) / 1000;
			},
			S: ['getSeconds', '0'],
			u: function (d) {
				var dow = d.getDay();
				return ((dow === 0) ? 7 : dow);
			},
			U: function (d) {
				var doy = parseInt(_formats.j(d), 10);
				var rdow = 6 - d.getDay();
				var woy = parseInt((doy + rdow) / 7, 10);
				return _xPad(woy, 0);
			},
			V: function (d) {
				var woy = parseInt(_formats.W(d), 10);
				var dow1_1 = (new Date('' + d.getFullYear() + '/1/1')).getDay();
				// First week is 01 and not 00 as in the case of %U and %W,
				// so we add 1 to the final result except if day 1 of the year
				// is a Monday (then %W returns 01).
				// We also need to subtract 1 if the day 1 of the year is
				// Friday-Sunday, so the resulting equation becomes:
				var idow = woy + (dow1_1 > 4 || dow1_1 <= 1 ? 0 : 1);
				if (idow === 53 && (new Date('' + d.getFullYear() + '/12/31')).getDay() < 4) {
					idow = 1;
				} else if (idow === 0) {
					idow = _formats.V(new Date('' + (d.getFullYear() - 1) + '/12/31'));
				}
				return _xPad(idow, 0);
			},
			w: 'getDay',
			W: function (d) {
				var doy = parseInt(_formats.j(d), 10);
				var rdow = 7 - _formats.u(d);
				var woy = parseInt((doy + rdow) / 7, 10);
				return _xPad(woy, 0, 10);
			},
			y: function (d) {
				return _xPad(d.getFullYear() % 100, 0);
			},
			Y: 'getFullYear',
			z: function (d) {
				var o = d.getTimezoneOffset();
				var H = _xPad(parseInt(Math.abs(o / 60), 10), 0);
				var M = _xPad(o % 60, 0);
				return (o > 0 ? '-' : '+') + H + M;
			},
			Z: function (d) {
				return d.toString().replace(/^.*\(([^)]+)\)$/, '$1');
			/*
			  // Yahoo's: Better?
			  var tz = d.toString().replace(/^.*:\d\d( GMT[+-]\d+)? \(?([A-Za-z ]+)\)?\d*$/, '$2').replace(/[a-z ]/g, '');
			  if(tz.length > 4) {
				tz = Dt.formats.z(d);
			  }
			  return tz;
			  */
			},
			'%': function (d) {
				return '%';
			}
		};
		// END STATIC
		/* Fix: Locale alternatives are supported though not documented in PHP; see http://linux.die.net/man/3/strptime
		Ec
		EC
		Ex
		EX
		Ey
		EY
		Od or Oe
		OH
		OI
		Om
		OM
		OS
		OU
		Ow
		OW
		Oy
		*/

		var _date = ((typeof(timestamp) == 'undefined') ? new Date() : // Not provided
		(typeof(timestamp) == 'object') ? new Date(timestamp) : // Javascript Date()
		new Date(timestamp * 1000) // PHP API expects UNIX timestamp (auto-convert to int)
		);

		var _aggregates = {
			c: 'locale',
			D: '%m/%d/%y',
			F: '%y-%m-%d',
			h: '%b',
			n: '\n',
			r: 'locale',
			R: '%H:%M',
			t: '\t',
			T: '%H:%M:%S',
			x: 'locale',
			X: 'locale'
		};


		// First replace aggregates (run in a loop because an agg may be made up of other aggs)
		while (fmt.match(/%[cDFhnrRtTxX]/)) {
			fmt = fmt.replace(/%([cDFhnrRtTxX])/g, function (m0, m1) {
				var f = _aggregates[m1];
				return (f === 'locale' ? lc_time[m1] : f);
			});
		}

		// Now replace formats - we need a closure so that the date object gets passed through
		var str = fmt.replace(/%([aAbBCdegGHIjklmMpPsSuUVwWyYzZ%])/g, function (m0, m1) {
			var f = _formats[m1];
			if (typeof f === 'string') {
				return _date[f]();
			} else if (typeof f === 'function') {
				return f(_date);
			} else if (typeof f === 'object' && typeof(f[0]) === 'string') {
				return _xPad(_date[f[0]](), f[1]);
			} else { // Shouldn't reach here
				return m1;
			}
		});
		return str;
	},
	strtotime: function(text, now) {
		// Convert string representation of date and time to a timestamp  
		// 
		// version: 1109.2015
		// discuss at: http://phpjs.org/functions/strtotime
		// +   original by: Caio Ariede (http://caioariede.com)
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: David
		// +   improved by: Caio Ariede (http://caioariede.com)
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Wagner B. Soares
		// +   bugfixed by: Artur Tchernychev
		// +   improved by: A. Matías Quezada (http://amatiasq.com)
		// %        note 1: Examples all have a fixed timestamp to prevent tests to fail because of variable time(zones)
		// *     example 1: strtotime('+1 day', 1129633200);
		// *     returns 1: 1129719600
		// *     example 2: strtotime('+1 week 2 days 4 hours 2 seconds', 1129633200);
		// *     returns 2: 1130425202
		// *     example 3: strtotime('last month', 1129633200);
		// *     returns 3: 1127041200
		// *     example 4: strtotime('2009-05-04 08:30:00');
		// *     returns 4: 1241418600
		if (!text)
			return null;

		// Unecessary spaces
		text = text.trim()
			.replace(/\s{2,}/g, ' ')
			.replace(/[\t\r\n]/g, '')
			.toLowerCase();

		var parsed;

		if (text === 'now')
			return now === null || isNaN(now) ? new Date().getTime() / 1000 | 0 : now | 0;
		else if (!isNaN(parse = Date.parse(text)))
			return parse / 1000 | 0;
		if (text == 'now')
			return new Date().getTime() / 1000; // Return seconds, not milli-seconds
		else if (!isNaN(parsed = Date.parse(text)))
			return parsed / 1000;

		var match = text.match(/^(\d{2,4})-(\d{2})-(\d{2})(?:\s(\d{1,2}):(\d{2})(?::\d{2})?)?(?:\.(\d+)?)?$/);
		if (match) {
			var year = match[1] >= 0 && match[1] <= 69 ? +match[1] + 2000 : match[1];
			return new Date(year, parseInt(match[2], 10) - 1, match[3],
				match[4] || 0, match[5] || 0, match[6] || 0, match[7] || 0) / 1000;
		}

		var date = now ? new Date(now * 1000) : new Date();
		var days = {
			'sun': 0,
			'mon': 1,
			'tue': 2,
			'wed': 3,
			'thu': 4,
			'fri': 5,
			'sat': 6
		};
		var ranges = {
			'yea': 'FullYear',
			'mon': 'Month',
			'day': 'Date',
			'hou': 'Hours',
			'min': 'Minutes',
			'sec': 'Seconds'
		};

		function lastNext(type, range, modifier) {
			var day = days[range];

			if (typeof(day) !== 'undefined') {
				var diff = day - date.getDay();

				if (diff === 0)
					diff = 7 * modifier;
				else if (diff > 0 && type === 'last')
					diff -= 7;
				else if (diff < 0 && type === 'next')
					diff += 7;

				date.setDate(date.getDate() + diff);
			}
		}
		function process(val) {
			var split = val.split(' ');
			var type = split[0];
			var range = split[1].substring(0, 3);
			var typeIsNumber = /\d+/.test(type);

			var ago = split[2] === 'ago';
			var num = (type === 'last' ? -1 : 1) * (ago ? -1 : 1);

			if (typeIsNumber)
				num *= parseInt(type, 10);

			if (ranges.hasOwnProperty(range))
				return date['set' + ranges[range]](date['get' + ranges[range]]() + num);
			else if (range === 'wee')
				return date.setDate(date.getDate() + (num * 7));

			if (type === 'next' || type === 'last')
				lastNext(type, range, num);
			else if (!typeIsNumber)
				return false;

			return true;
		}

		var regex = '([+-]?\\d+\\s' +
			'(years?|months?|weeks?|days?|hours?|min|minutes?|sec|seconds?' +
			'|sun\\.?|sunday|mon\\.?|monday|tue\\.?|tuesday|wed\\.?|wednesday' +
			'|thu\\.?|thursday|fri\\.?|friday|sat\\.?|saturday)|(last|next)\\s' +
			'(years?|months?|weeks?|days?|hours?|min|minutes?|sec|seconds?' +
			'|sun\\.?|sunday|mon\\.?|monday|tue\\.?|tuesday|wed\\.?|wednesday' +
			'|thu\\.?|thursday|fri\\.?|friday|sat\\.?|saturday))(\\sago)?';

		match = text.match(new RegExp(regex, 'gi'));
		if (!match)
			return false;

		for (var i = 0, len = match.length; i < len; i++)
			if (!process(match[i]))
				return false;

		// ECMAScript 5 only
		//if (!match.every(process))
		// return false;

		return (date.getTime() / 1000);
	},
	date: function(format, timestamp) {
		// http://kevin.vanzonneveld.net
		// +   original by: Carlos R. L. Rodrigues (http://www.jsfromhell.com)
		// +      parts by: Peter-Paul Koch (http://www.quirksmode.org/js/beat.html)
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: MeEtc (http://yass.meetcweb.com)
		// +   improved by: Brad Touesnard
		// +   improved by: Tim Wiel
		// +   improved by: Bryan Elliott
		//
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: David Randall
		// +      input by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: Theriault
		// +  derived from: gettimeofday
		// +      input by: majak
		// +   bugfixed by: majak
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: Alex
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: Theriault
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +   improved by: Theriault
		// +   improved by: Thomas Beaucourt (http://www.webapp.fr)
		// +   improved by: JT
		// +   improved by: Theriault
		// +   improved by: Rafał Kukawski (http://blog.kukawski.pl)
		// +   bugfixed by: omid (http://phpjs.org/functions/380:380#comment_137122)
		// +      input by: Martin
		// +      input by: Alex Wilson
		// +   bugfixed by: Chris (http://www.devotis.nl/)
		// %        note 1: Uses global: php_js to store the default timezone
		// %        note 2: Although the function potentially allows timezone info (see notes), it currently does not set
		// %        note 2: per a timezone specified by date_default_timezone_set(). Implementers might use
		// %        note 2: this.php_js.currentTimezoneOffset and this.php_js.currentTimezoneDST set by that function
		// %        note 2: in order to adjust the dates in this function (or our other date functions!) accordingly
		// *     example 1: date('H:m:s \\m \\i\\s \\m\\o\\n\\t\\h', 1062402400);
		// *     returns 1: '09:09:40 m is month'
		// *     example 2: date('F j, Y, g:i a', 1062462400);
		// *     returns 2: 'September 2, 2003, 2:26 am'
		// *     example 3: date('Y W o', 1062462400);
		// *     returns 3: '2003 36 2003'
		// *     example 4: x = date('Y m d', (new Date()).getTime()/1000);
		// *     example 4: (x+'').length == 10 // 2009 01 09
		// *     returns 4: true
		// *     example 5: date('W', 1104534000);
		// *     returns 5: '53'
		// *     example 6: date('B t', 1104534000);
		// *     returns 6: '999 31'
		// *     example 7: date('W U', 1293750000.82); // 2010-12-31
		// *     returns 7: '52 1293750000'
		// *     example 8: date('W', 1293836400); // 2011-01-01
		// *     returns 8: '52'
		// *     example 9: date('W Y-m-d', 1293974054); // 2011-01-02
		// *     returns 9: '52 2011-01-02'
		var that = this,
			jsdate,
			f,
			formatChr = /\\?([a-z])/gi,
			formatChrCb,
			// Keep this here (works, but for code commented-out
			// below for file size reasons)
			//, tal= [],
			_pad = function (n, c) {
				n = n.toString();
				return n.length < c ? _pad('0' + n, c, '0') : n;
			},
			txt_words = ["Sun", "Mon", "Tues", "Wednes", "Thurs", "Fri", "Satur", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		formatChrCb = function (t, s) {
			return f[t] ? f[t]() : s;
		};
		f = {
			// Day
			d: function () { // Day of month w/leading 0; 01..31
				return _pad(f.j(), 2);
			},
			D: function () { // Shorthand day name; Mon...Sun
				return f.l().slice(0, 3);
			},
			j: function () { // Day of month; 1..31
				return jsdate.getDate();
			},
			l: function () { // Full day name; Monday...Sunday
				return txt_words[f.w()] + 'day';
			},
			N: function () { // ISO-8601 day of week; 1[Mon]..7[Sun]
				return f.w() || 7;
			},
			S: function () { // Ordinal suffix for day of month; st, nd, rd, th
				var j = f.j();
				return j < 4 | j > 20 && (['st', 'nd', 'rd'][j % 10 - 1] || 'th');
			},
			w: function () { // Day of week; 0[Sun]..6[Sat]
				return jsdate.getDay();
			},
			z: function () { // Day of year; 0..365
				var a = new Date(f.Y(), f.n() - 1, f.j()),
					b = new Date(f.Y(), 0, 1);
				return Math.round((a - b) / 864e5);
			},

			// Week
			W: function () { // ISO-8601 week number
				var a = new Date(f.Y(), f.n() - 1, f.j() - f.N() + 3),
					b = new Date(a.getFullYear(), 0, 4);
				return _pad(1 + Math.round((a - b) / 864e5 / 7), 2);
			},

			// Month
			F: function () { // Full month name; January...December
				return txt_words[6 + f.n()];
			},
			m: function () { // Month w/leading 0; 01...12
				return _pad(f.n(), 2);
			},
			M: function () { // Shorthand month name; Jan...Dec
				return f.F().slice(0, 3);
			},
			n: function () { // Month; 1...12
				return jsdate.getMonth() + 1;
			},
			t: function () { // Days in month; 28...31
				return (new Date(f.Y(), f.n(), 0)).getDate();
			},

			// Year
			L: function () { // Is leap year?; 0 or 1
				var j = f.Y();
				return j % 4 === 0 & j % 100 !== 0 | j % 400 === 0;
			},
			o: function () { // ISO-8601 year
				var n = f.n(),
					W = f.W(),
					Y = f.Y();
				return Y + (n === 12 && W < 9 ? 1 : n === 1 && W > 9 ? -1 : 0);
			},
			Y: function () { // Full year; e.g. 1980...2010
				return jsdate.getFullYear();
			},
			y: function () { // Last two digits of year; 00...99
				return f.Y().toString().slice(-2);
			},

			// Time
			a: function () { // am or pm
				return jsdate.getHours() > 11 ? "pm" : "am";
			},
			A: function () { // AM or PM
				return f.a().toUpperCase();
			},
			B: function () { // Swatch Internet time; 000..999
				var H = jsdate.getUTCHours() * 36e2,
					// Hours
					i = jsdate.getUTCMinutes() * 60,
					// Minutes
					s = jsdate.getUTCSeconds(); // Seconds
				return _pad(Math.floor((H + i + s + 36e2) / 86.4) % 1e3, 3);
			},
			g: function () { // 12-Hours; 1..12
				return f.G() % 12 || 12;
			},
			G: function () { // 24-Hours; 0..23
				return jsdate.getHours();
			},
			h: function () { // 12-Hours w/leading 0; 01..12
				return _pad(f.g(), 2);
			},
			H: function () { // 24-Hours w/leading 0; 00..23
				return _pad(f.G(), 2);
			},
			i: function () { // Minutes w/leading 0; 00..59
				return _pad(jsdate.getMinutes(), 2);
			},
			s: function () { // Seconds w/leading 0; 00..59
				return _pad(jsdate.getSeconds(), 2);
			},
			u: function () { // Microseconds; 000000-999000
				return _pad(jsdate.getMilliseconds() * 1000, 6);
			},

			// Timezone
			e: function () { // Timezone identifier; e.g. Atlantic/Azores, ...
				// The following works, but requires inclusion of the very large
				// timezone_abbreviations_list() function.
				throw 'Not supported (see source code of date() for timezone on how to add support)';
			},
			I: function () { // DST observed?; 0 or 1
				// Compares Jan 1 minus Jan 1 UTC to Jul 1 minus Jul 1 UTC.
				// If they are not equal, then DST is observed.
				var a = new Date(f.Y(), 0),
					// Jan 1
					c = Date.UTC(f.Y(), 0),
					// Jan 1 UTC
					b = new Date(f.Y(), 6),
					// Jul 1
					d = Date.UTC(f.Y(), 6); // Jul 1 UTC
				return ((a - c) !== (b - d)) ? 1 : 0;
			},
			O: function () { // Difference to GMT in hour format; e.g. +0200
				var tzo = jsdate.getTimezoneOffset(),
					a = Math.abs(tzo);
				return (tzo > 0 ? "-" : "+") + _pad(Math.floor(a / 60) * 100 + a % 60, 4);
			},
			P: function () { // Difference to GMT w/colon; e.g. +02:00
				var O = f.O();
				return (O.substr(0, 3) + ":" + O.substr(3, 2));
			},
			T: function () { // Timezone abbreviation; e.g. EST, MDT, ...
				// The following works, but requires inclusion of the very
				// large timezone_abbreviations_list() function.
				return 'UTC';
			},
			Z: function () { // Timezone offset in seconds (-43200...50400)
				return -jsdate.getTimezoneOffset() * 60;
			},

			// Full Date/Time
			c: function () { // ISO-8601 date.
				return 'Y-m-d\\TH:i:sP'.replace(formatChr, formatChrCb);
			},
			r: function () { // RFC 2822
				return 'D, d M Y H:i:s O'.replace(formatChr, formatChrCb);
			},
			U: function () { // Seconds since UNIX epoch
				return jsdate / 1000 | 0;
			}
		};
		this.date = function (format, timestamp) {
			that = this;
			jsdate = (timestamp === undefined ? new Date() : // Not provided
			(timestamp instanceof Date) ? new Date(timestamp) : // JS Date()
			new Date(timestamp * 1000) // UNIX timestamp (auto-convert to int)
			);
			return format.replace(formatChr, formatChrCb);
		};
		return this.date(format, timestamp);
	},
	time: function() {
		// http://kevin.vanzonneveld.net
		// +   original by: GeekFG (http://geekfg.blogspot.com)
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: metjay
		// +   improved by: HKM
		// *     example 1: timeStamp = time();
		// *     results 1: timeStamp > 1000000000 && timeStamp < 2000000000
		return Math.floor(new Date().getTime() / 1000);
	},
	urlencode: function(str) {
		// http://kevin.vanzonneveld.net
		// +   original by: Philip Peterson
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: AJ
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: travc
		// +      input by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Lars Fischer
		// +      input by: Ratheous
		// +      reimplemented by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Joris
		// +      reimplemented by: Brett Zamir (http://brett-zamir.me)
		// %          note 1: This reflects PHP 5.3/6.0+ behavior
		// %        note 2: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
		// %        note 2: pages served as UTF-8
		// *     example 1: urlencode('Kevin van Zonneveld!');
		// *     returns 1: 'Kevin+van+Zonneveld%21'
		// *     example 2: urlencode('http://kevin.vanzonneveld.net/');
		// *     returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
		// *     example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
		// *     returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'
		str = (str + '').toString();

		// Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
		// PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
		return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
		replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
	},
	base64_encode: function(data) {
		// http://kevin.vanzonneveld.net
		// +   original by: Tyler Akins (http://rumkin.com)
		// +   improved by: Bayron Guevara
		// +   improved by: Thunder.m
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Pellentesque Malesuada
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Rafał Kukawski (http://kukawski.pl)
		// *     example 1: base64_encode('Kevin van Zonneveld');
		// *     returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='
		// mozilla has this native
		// - but breaks in 2.0.0.12!
		//if (typeof this.window['btoa'] == 'function') {
		//    return btoa(data);
		//}
		var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
		var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
			ac = 0,
			enc = "",
			tmp_arr = [];

		if (!data) {
			return data;
		}

		do { // pack three octets into four hexets
			o1 = data.charCodeAt(i++);
			o2 = data.charCodeAt(i++);
			o3 = data.charCodeAt(i++);

			bits = o1 << 16 | o2 << 8 | o3;

			h1 = bits >> 18 & 0x3f;
			h2 = bits >> 12 & 0x3f;
			h3 = bits >> 6 & 0x3f;
			h4 = bits & 0x3f;

			// use hexets to index into b64, and append result to encoded string
			tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
		} while (i < data.length);

		enc = tmp_arr.join('');

		var r = data.length % 3;

		return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
	},
	base64_decode: function(data) {
		// http://kevin.vanzonneveld.net
		// +   original by: Tyler Akins (http://rumkin.com)
		// +   improved by: Thunder.m
		// +      input by: Aman Gupta
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// +   bugfixed by: Pellentesque Malesuada
		// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +      input by: Brett Zamir (http://brett-zamir.me)
		// +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// *     example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
		// *     returns 1: 'Kevin van Zonneveld'
		// mozilla has this native
		// - but breaks in 2.0.0.12!
		//if (typeof this.window['atob'] == 'function') {
		//    return atob(data);
		//}
		var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
		var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
			ac = 0,
			dec = "",
			tmp_arr = [];

		if (!data) {
			return data;
		}

		data += '';

		do { // unpack four hexets into three octets using index points in b64
			h1 = b64.indexOf(data.charAt(i++));
			h2 = b64.indexOf(data.charAt(i++));
			h3 = b64.indexOf(data.charAt(i++));
			h4 = b64.indexOf(data.charAt(i++));

			bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

			o1 = bits >> 16 & 0xff;
			o2 = bits >> 8 & 0xff;
			o3 = bits & 0xff;

			if (h3 == 64) {
				tmp_arr[ac++] = String.fromCharCode(o1);
			} else if (h4 == 64) {
				tmp_arr[ac++] = String.fromCharCode(o1, o2);
			} else {
				tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
			}
		} while (i < data.length);

		dec = tmp_arr.join('');

		return dec;
	},
	parse_url: function(str, component) {
		// http://kevin.vanzonneveld.net
		// +      original by: Steven Levithan (http://blog.stevenlevithan.com)
		// + reimplemented by: Brett Zamir (http://brett-zamir.me)
		// + input by: Lorenzo Pisani
		// + input by: Tony
		// + improved by: Brett Zamir (http://brett-zamir.me)
		// %          note: Based on http://stevenlevithan.com/demo/parseuri/js/assets/parseuri.js
		// %          note: blog post at http://blog.stevenlevithan.com/archives/parseuri
		// %          note: demo at http://stevenlevithan.com/demo/parseuri/js/assets/parseuri.js
		// %          note: Does not replace invalid characters with '_' as in PHP, nor does it return false with
		// %          note: a seriously malformed URL.
		// %          note: Besides function name, is essentially the same as parseUri as well as our allowing
		// %          note: an extra slash after the scheme/protocol (to allow file:/// as in PHP)
		// *     example 1: parse_url('http://username:password@hostname/path?arg=value#anchor');
		// *     returns 1: {scheme: 'http', host: 'hostname', user: 'username', pass: 'password', path: '/path', query: 'arg=value', fragment: 'anchor'}
		var key = ['source', 'scheme', 'authority', 'userInfo', 'user', 'pass', 'host', 'port',
			'relative', 'path', 'directory', 'file', 'query', 'fragment'],
			ini = (this.php_js && this.php_js.ini) || {},
			mode = (ini['phpjs.parse_url.mode'] && ini['phpjs.parse_url.mode'].local_value) || 'php',
			parser = {
				php: /^(?:([^:\/?#]+):)?(?:\/\/()(?:(?:()(?:([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?()(?:(()(?:(?:[^?#\/]*\/)*)()(?:[^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
				strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
				loose: /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/\/?)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/ // Added one optional slash to post-scheme to catch file:/// (should restrict this)
			};

		var m = parser[mode].exec(str),
			uri = {},
			i = 14;
		while (i--) {
			if (m[i]) {
				uri[key[i]] = m[i];
			}
		}

		if (component) {
			return uri[component.replace('PHP_URL_', '').toLowerCase()];
		}
		if (mode !== 'php') {
			var name = (ini['phpjs.parse_url.queryKey'] && ini['phpjs.parse_url.queryKey'].local_value) || 'queryKey';
			parser = /(?:^|&)([^&=]*)=?([^&]*)/g;
			uri[name] = {};
			uri[key[12]].replace(parser, function ($0, $1, $2) {
				if ($1) {
					uri[name][$1] = $2;
				}
			});
		}
		delete uri.source;
		return uri;
	},
	in_array: function(needle, haystack, argStrict) {
		// http://kevin.vanzonneveld.net
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: vlado houba
		// +   input by: Billy
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: in_array('van', ['Kevin', 'van', 'Zonneveld']);
		// *     returns 1: true
		// *     example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1: 'Zonneveld'});
		// *     returns 2: false
		// *     example 3: in_array(1, ['1', '2', '3']);
		// *     returns 3: true
		// *     example 3: in_array(1, ['1', '2', '3'], false);
		// *     returns 3: true
		// *     example 4: in_array(1, ['1', '2', '3'], true);
		// *     returns 4: false
		var key = '',
			strict = !! argStrict;

		if (strict) {
			for (key in haystack) {
				if (haystack[key] === needle) {
					return true;
				}
			}
		} else {
			for (key in haystack) {
				if (haystack[key] == needle) {
					return true;
				}
			}
		}

		return false;
	},
	explode: function(delimiter, string, limit) {

		if (arguments.length < 2 || typeof delimiter == 'undefined' || typeof string == 'undefined') return null;
		if (delimiter === '' || delimiter === false || delimiter === null) return false;
		if (typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object') {
			return {
				0: ''
			};
		}
		if (delimiter === true) delimiter = '1';

		// Here we go...
		delimiter += '';
		string += '';

		var s = string.split(delimiter);


		if (typeof limit === 'undefined') return s;

		// Support for limit
		if (limit === 0) limit = 1;

		// Positive limit
		if (limit > 0) {
			if (limit >= s.length) return s;
			return s.slice(0, limit - 1).concat([s.slice(limit - 1).join(delimiter)]);
		}

		// Negative limit
		if (-limit >= s.length) return [];

		s.splice(s.length + limit);
		return s;
	},
	implode: function(glue, pieces) {
		// http://kevin.vanzonneveld.net
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   improved by: Waldo Malqui Silva
		// +   improved by: Itsacon (http://www.itsacon.net/)
		// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: implode(' ', ['Kevin', 'van', 'Zonneveld']);
		// *     returns 1: 'Kevin van Zonneveld'
		// *     example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'});
		// *     returns 2: 'Kevin van Zonneveld'
		var i = '',
			retVal = '',
			tGlue = '';
		if (arguments.length === 1) {
			pieces = glue;
			glue = '';
		}
		if (typeof (pieces) === 'object') {
			if (Object.prototype.toString.call(pieces) === '[object Array]') {
				return pieces.join(glue);
			}
			for (i in pieces) {
				retVal += tGlue + pieces[i];
				tGlue = glue;
			}
			return retVal;
		}
		return pieces;
	}
};