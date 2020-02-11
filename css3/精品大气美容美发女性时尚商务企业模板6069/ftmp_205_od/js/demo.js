/**
 *
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 * 
 * Dual licensed under the MIT and GPL licenses
 * 
 */
(function ($) {
	var ColorPicker = function () {
		var
			ids = {},
			inAction,
			charMin = 65,
			visible,
			tpl = '<div class="colorpicker"><div class="colorpicker_color"><div><div></div></div></div><div class="colorpicker_hue"><div></div></div><div class="colorpicker_new_color"></div><div class="colorpicker_current_color"></div><div class="colorpicker_hex"><input type="text" maxlength="6" size="6" /></div><div class="colorpicker_rgb_r colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_submit"></div></div>',
			defaults = {
				eventName: 'click',
				onShow: function () {},
				onBeforeShow: function(){},
				onHide: function () {},
				onChange: function () {},
				onSubmit: function () {},
				color: 'ff0000',
				livePreview: true,
				flat: false
			},
			fillRGBFields = function  (hsb, cal) {
				var rgb = HSBToRGB(hsb);
				$(cal).data('colorpicker').fields
					.eq(1).val(rgb.r).end()
					.eq(2).val(rgb.g).end()
					.eq(3).val(rgb.b).end();
			},
			fillHSBFields = function  (hsb, cal) {
				$(cal).data('colorpicker').fields
					.eq(4).val(hsb.h).end()
					.eq(5).val(hsb.s).end()
					.eq(6).val(hsb.b).end();
			},
			fillHexFields = function (hsb, cal) {
				$(cal).data('colorpicker').fields
					.eq(0).val(HSBToHex(hsb)).end();
			},
			setSelector = function (hsb, cal) {
				$(cal).data('colorpicker').selector.css('backgroundColor', '#' + HSBToHex({h: hsb.h, s: 100, b: 100}));
				$(cal).data('colorpicker').selectorIndic.css({
					left: parseInt(150 * hsb.s/100, 10),
					top: parseInt(150 * (100-hsb.b)/100, 10)
				});
			},
			setHue = function (hsb, cal) {
				$(cal).data('colorpicker').hue.css('top', parseInt(150 - 150 * hsb.h/360, 10));
			},
			setCurrentColor = function (hsb, cal) {
				$(cal).data('colorpicker').currentColor.css('backgroundColor', '#' + HSBToHex(hsb));
			},
			setNewColor = function (hsb, cal) {
				$(cal).data('colorpicker').newColor.css('backgroundColor', '#' + HSBToHex(hsb));
			},
			keyDown = function (ev) {
				var pressedKey = ev.charCode || ev.keyCode || -1;
				if ((pressedKey > charMin && pressedKey <= 90) || pressedKey == 32) {
					return false;
				}
				var cal = $(this).parent().parent();
				if (cal.data('colorpicker').livePreview === true) {
					change.apply(this);
				}
			},
			change = function (ev) {
				var cal = $(this).parent().parent(), col;
				if (this.parentNode.className.indexOf('_hex') > 0) {
					cal.data('colorpicker').color = col = HexToHSB(fixHex(this.value));
				} else if (this.parentNode.className.indexOf('_hsb') > 0) {
					cal.data('colorpicker').color = col = fixHSB({
						h: parseInt(cal.data('colorpicker').fields.eq(4).val(), 10),
						s: parseInt(cal.data('colorpicker').fields.eq(5).val(), 10),
						b: parseInt(cal.data('colorpicker').fields.eq(6).val(), 10)
					});
				} else {
					cal.data('colorpicker').color = col = RGBToHSB(fixRGB({
						r: parseInt(cal.data('colorpicker').fields.eq(1).val(), 10),
						g: parseInt(cal.data('colorpicker').fields.eq(2).val(), 10),
						b: parseInt(cal.data('colorpicker').fields.eq(3).val(), 10)
					}));
				}
				if (ev) {
					fillRGBFields(col, cal.get(0));
					fillHexFields(col, cal.get(0));
					fillHSBFields(col, cal.get(0));
				}
				setSelector(col, cal.get(0));
				setHue(col, cal.get(0));
				setNewColor(col, cal.get(0));
				cal.data('colorpicker').onChange.apply(cal, [col, HSBToHex(col), HSBToRGB(col)]);
			},
			blur = function (ev) {
				var cal = $(this).parent().parent();
				cal.data('colorpicker').fields.parent().removeClass('colorpicker_focus');
			},
			focus = function () {
				charMin = this.parentNode.className.indexOf('_hex') > 0 ? 70 : 65;
				$(this).parent().parent().data('colorpicker').fields.parent().removeClass('colorpicker_focus');
				$(this).parent().addClass('colorpicker_focus');
			},
			downIncrement = function (ev) {
				var field = $(this).parent().find('input').focus();
				var current = {
					el: $(this).parent().addClass('colorpicker_slider'),
					max: this.parentNode.className.indexOf('_hsb_h') > 0 ? 360 : (this.parentNode.className.indexOf('_hsb') > 0 ? 100 : 255),
					y: ev.pageY,
					field: field,
					val: parseInt(field.val(), 10),
					preview: $(this).parent().parent().data('colorpicker').livePreview					
				};
				$(document).bind('mouseup', current, upIncrement);
				$(document).bind('mousemove', current, moveIncrement);
			},
			moveIncrement = function (ev) {
				ev.data.field.val(Math.max(0, Math.min(ev.data.max, parseInt(ev.data.val + ev.pageY - ev.data.y, 10))));
				if (ev.data.preview) {
					change.apply(ev.data.field.get(0), [true]);
				}
				return false;
			},
			upIncrement = function (ev) {
				change.apply(ev.data.field.get(0), [true]);
				ev.data.el.removeClass('colorpicker_slider').find('input').focus();
				$(document).unbind('mouseup', upIncrement);
				$(document).unbind('mousemove', moveIncrement);
				return false;
			},
			downHue = function (ev) {
				var current = {
					cal: $(this).parent(),
					y: $(this).offset().top
				};
				current.preview = current.cal.data('colorpicker').livePreview;
				$(document).bind('mouseup', current, upHue);
				$(document).bind('mousemove', current, moveHue);
			},
			moveHue = function (ev) {
				change.apply(
					ev.data.cal.data('colorpicker')
						.fields
						.eq(4)
						.val(parseInt(360*(150 - Math.max(0,Math.min(150,(ev.pageY - ev.data.y))))/150, 10))
						.get(0),
					[ev.data.preview]
				);
				return false;
			},
			upHue = function (ev) {
				fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
				fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
				$(document).unbind('mouseup', upHue);
				$(document).unbind('mousemove', moveHue);
				return false;
			},
			downSelector = function (ev) {
				var current = {
					cal: $(this).parent(),
					pos: $(this).offset()
				};
				current.preview = current.cal.data('colorpicker').livePreview;
				$(document).bind('mouseup', current, upSelector);
				$(document).bind('mousemove', current, moveSelector);
			},
			moveSelector = function (ev) {
				change.apply(
					ev.data.cal.data('colorpicker')
						.fields
						.eq(6)
						.val(parseInt(100*(150 - Math.max(0,Math.min(150,(ev.pageY - ev.data.pos.top))))/150, 10))
						.end()
						.eq(5)
						.val(parseInt(100*(Math.max(0,Math.min(150,(ev.pageX - ev.data.pos.left))))/150, 10))
						.get(0),
					[ev.data.preview]
				);
				return false;
			},
			upSelector = function (ev) {
				fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
				fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
				$(document).unbind('mouseup', upSelector);
				$(document).unbind('mousemove', moveSelector);
				return false;
			},
			enterSubmit = function (ev) {
				$(this).addClass('colorpicker_focus');
			},
			leaveSubmit = function (ev) {
				$(this).removeClass('colorpicker_focus');
			},
			clickSubmit = function (ev) {
				var cal = $(this).parent();
				var col = cal.data('colorpicker').color;
				cal.data('colorpicker').origColor = col;
				setCurrentColor(col, cal.get(0));
				cal.data('colorpicker').onSubmit(col, HSBToHex(col), HSBToRGB(col), cal.data('colorpicker').el);
			},
			show = function (ev) {
				var cal = $('#' + $(this).data('colorpickerId'));
				cal.data('colorpicker').onBeforeShow.apply(this, [cal.get(0)]);
				var pos = $(this).offset();
				var viewPort = getViewport();
				var top = pos.top + this.offsetHeight;
				var left = pos.left;
				if (top + 176 > viewPort.t + viewPort.h) {
					top -= this.offsetHeight + 176;
				}
				if (left + 356 > viewPort.l + viewPort.w) {
					left -= 356;
				}
				cal.css({left: left + 'px', top: top + 'px'});
				if (cal.data('colorpicker').onShow.apply(this, [cal.get(0)]) != false) {
					cal.show();
				}
				$(document).bind('mousedown', {cal: cal}, hide);
				return false;
			},
			hide = function (ev) {
				if (!isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0))) {
					if (ev.data.cal.data('colorpicker').onHide.apply(this, [ev.data.cal.get(0)]) != false) {
						ev.data.cal.hide();
					}
					$(document).unbind('mousedown', hide);
				}
			},
			isChildOf = function(parentEl, el, container) {
				if (parentEl == el) {
					return true;
				}
				if (parentEl.contains) {
					return parentEl.contains(el);
				}
				if ( parentEl.compareDocumentPosition ) {
					return !!(parentEl.compareDocumentPosition(el) & 16);
				}
				var prEl = el.parentNode;
				while(prEl && prEl != container) {
					if (prEl == parentEl)
						return true;
					prEl = prEl.parentNode;
				}
				return false;
			},
			getViewport = function () {
				var m = document.compatMode == 'CSS1Compat';
				return {
					l : window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),
					t : window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),
					w : window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),
					h : window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)
				};
			},
			fixHSB = function (hsb) {
				return {
					h: Math.min(360, Math.max(0, hsb.h)),
					s: Math.min(100, Math.max(0, hsb.s)),
					b: Math.min(100, Math.max(0, hsb.b))
				};
			}, 
			fixRGB = function (rgb) {
				return {
					r: Math.min(255, Math.max(0, rgb.r)),
					g: Math.min(255, Math.max(0, rgb.g)),
					b: Math.min(255, Math.max(0, rgb.b))
				};
			},
			fixHex = function (hex) {
				var len = 6 - hex.length;
				if (len > 0) {
					var o = [];
					for (var i=0; i<len; i++) {
						o.push('0');
					}
					o.push(hex);
					hex = o.join('');
				}
				return hex;
			}, 
			HexToRGB = function (hex) {
				var hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);
				return {r: hex >> 16, g: (hex & 0x00FF00) >> 8, b: (hex & 0x0000FF)};
			},
			HexToHSB = function (hex) {
				return RGBToHSB(HexToRGB(hex));
			},
			RGBToHSB = function (rgb) {
				var hsb = {
					h: 0,
					s: 0,
					b: 0
				};
				var min = Math.min(rgb.r, rgb.g, rgb.b);
				var max = Math.max(rgb.r, rgb.g, rgb.b);
				var delta = max - min;
				hsb.b = max;
				if (max != 0) {
					
				}
				hsb.s = max != 0 ? 255 * delta / max : 0;
				if (hsb.s != 0) {
					if (rgb.r == max) {
						hsb.h = (rgb.g - rgb.b) / delta;
					} else if (rgb.g == max) {
						hsb.h = 2 + (rgb.b - rgb.r) / delta;
					} else {
						hsb.h = 4 + (rgb.r - rgb.g) / delta;
					}
				} else {
					hsb.h = -1;
				}
				hsb.h *= 60;
				if (hsb.h < 0) {
					hsb.h += 360;
				}
				hsb.s *= 100/255;
				hsb.b *= 100/255;
				return hsb;
			},
			HSBToRGB = function (hsb) {
				var rgb = {};
				var h = Math.round(hsb.h);
				var s = Math.round(hsb.s*255/100);
				var v = Math.round(hsb.b*255/100);
				if(s == 0) {
					rgb.r = rgb.g = rgb.b = v;
				} else {
					var t1 = v;
					var t2 = (255-s)*v/255;
					var t3 = (t1-t2)*(h%60)/60;
					if(h==360) h = 0;
					if(h<60) {rgb.r=t1;rgb.b=t2;rgb.g=t2+t3}
					else if(h<120) {rgb.g=t1;rgb.b=t2;rgb.r=t1-t3}
					else if(h<180) {rgb.g=t1;rgb.r=t2;rgb.b=t2+t3}
					else if(h<240) {rgb.b=t1;rgb.r=t2;rgb.g=t1-t3}
					else if(h<300) {rgb.b=t1;rgb.g=t2;rgb.r=t2+t3}
					else if(h<360) {rgb.r=t1;rgb.g=t2;rgb.b=t1-t3}
					else {rgb.r=0;rgb.g=0;rgb.b=0}
				}
				return {r:Math.round(rgb.r), g:Math.round(rgb.g), b:Math.round(rgb.b)};
			},
			RGBToHex = function (rgb) {
				var hex = [
					rgb.r.toString(16),
					rgb.g.toString(16),
					rgb.b.toString(16)
				];
				$.each(hex, function (nr, val) {
					if (val.length == 1) {
						hex[nr] = '0' + val;
					}
				});
				return hex.join('');
			},
			HSBToHex = function (hsb) {
				return RGBToHex(HSBToRGB(hsb));
			},
			restoreOriginal = function () {
				var cal = $(this).parent();
				var col = cal.data('colorpicker').origColor;
				cal.data('colorpicker').color = col;
				fillRGBFields(col, cal.get(0));
				fillHexFields(col, cal.get(0));
				fillHSBFields(col, cal.get(0));
				setSelector(col, cal.get(0));
				setHue(col, cal.get(0));
				setNewColor(col, cal.get(0));
			};
		return {
			init: function (opt) {
				opt = $.extend({}, defaults, opt||{});
				if (typeof opt.color == 'string') {
					opt.color = HexToHSB(opt.color);
				} else if (opt.color.r != undefined && opt.color.g != undefined && opt.color.b != undefined) {
					opt.color = RGBToHSB(opt.color);
				} else if (opt.color.h != undefined && opt.color.s != undefined && opt.color.b != undefined) {
					opt.color = fixHSB(opt.color);
				} else {
					return this;
				}
				return this.each(function () {
					if (!$(this).data('colorpickerId')) {
						var options = $.extend({}, opt);
						options.origColor = opt.color;
						var id = 'collorpicker_' + parseInt(Math.random() * 1000);
						$(this).data('colorpickerId', id);
						var cal = $(tpl).attr('id', id);
						if (options.flat) {
							cal.appendTo(this).show();
						} else {
							cal.appendTo(document.body);
						}
						options.fields = cal
											.find('input')
												.bind('keyup', keyDown)
												.bind('change', change)
												.bind('blur', blur)
												.bind('focus', focus);
						cal
							.find('span').bind('mousedown', downIncrement).end()
							.find('>div.colorpicker_current_color').bind('click', restoreOriginal);
						options.selector = cal.find('div.colorpicker_color').bind('mousedown', downSelector);
						options.selectorIndic = options.selector.find('div div');
						options.el = this;
						options.hue = cal.find('div.colorpicker_hue div');
						cal.find('div.colorpicker_hue').bind('mousedown', downHue);
						options.newColor = cal.find('div.colorpicker_new_color');
						options.currentColor = cal.find('div.colorpicker_current_color');
						cal.data('colorpicker', options);
						cal.find('div.colorpicker_submit')
							.bind('mouseenter', enterSubmit)
							.bind('mouseleave', leaveSubmit)
							.bind('click', clickSubmit);
						fillRGBFields(options.color, cal.get(0));
						fillHSBFields(options.color, cal.get(0));
						fillHexFields(options.color, cal.get(0));
						setHue(options.color, cal.get(0));
						setSelector(options.color, cal.get(0));
						setCurrentColor(options.color, cal.get(0));
						setNewColor(options.color, cal.get(0));
						if (options.flat) {
							cal.css({
								position: 'relative',
								display: 'block'
							});
						} else {
							$(this).bind(options.eventName, show);
						}
					}
				});
			},
			showPicker: function() {
				return this.each( function () {
					if ($(this).data('colorpickerId')) {
						show.apply(this);
					}
				});
			},
			hidePicker: function() {
				return this.each( function () {
					if ($(this).data('colorpickerId')) {
						$('#' + $(this).data('colorpickerId')).hide();
					}
				});
			},
			setColor: function(col) {
				if (typeof col == 'string') {
					col = HexToHSB(col);
				} else if (col.r != undefined && col.g != undefined && col.b != undefined) {
					col = RGBToHSB(col);
				} else if (col.h != undefined && col.s != undefined && col.b != undefined) {
					col = fixHSB(col);
				} else {
					return this;
				}
				return this.each(function(){
					if ($(this).data('colorpickerId')) {
						var cal = $('#' + $(this).data('colorpickerId'));
						cal.data('colorpicker').color = col;
						cal.data('colorpicker').origColor = col;
						fillRGBFields(col, cal.get(0));
						fillHSBFields(col, cal.get(0));
						fillHexFields(col, cal.get(0));
						setHue(col, cal.get(0));
						setSelector(col, cal.get(0));
						setCurrentColor(col, cal.get(0));
						setNewColor(col, cal.get(0));
					}
				});
			}
		};
	}();
	$.fn.extend({
		ColorPicker: ColorPicker.init,
		ColorPickerHide: ColorPicker.hidePicker,
		ColorPickerShow: ColorPicker.showPicker,
		ColorPickerSetColor: ColorPicker.setColor
	});
})(jQuery)




/* demo scripts */
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}


document.write('<style type="text/css">.nav-decorator>div{opacity:0}</style>');
	
document.write('<link rel="stylesheet" type="text/css" href="styles/colorpicker.css" media="screen" />');

var color = readCookie('demo-color');
if(color==null)
	createCookie('demo-color', 'default');

if(color!='default')
	document.write('<link rel="stylesheet" type="text/css" href="styles/color-themes/'+color+'.css" media="screen" />');


var bg = readCookie('bg');
if(bg == null) bg = 1;

bg=parseInt(bg);

jQuery(function(){

	var buttonBorder = [
		'#2192cc',
		'#1603ce',
		'#7b05cb',
		'#ce03c1',
		'#cf0358',
		'#d01705',
		'#cb7c03',
		'#6a6a6a',
		'#6da021',
		'#23a461',
		'#2192CC',
		'#dbdbdb'
	];
	
	var buttonShadow = [
		'#0f7cef -1px -1px 0',
		'#120fef -1px -1px 0',
		'#820fef -1px -1px 0',
		'#e416e5 -1px -1px 0',
		'#e30b76 -1px -1px 0',
		'#ef120f -1px -1px 0',
		'#ef820f -1px -1px 0',
		'#7f7f7f -1px -1px 0',
		'#36c838 -1px -1px 0',
		'#36c881 -1px -1px 0',
		'#2BD1D3 -1px -1px 0',
		'transparent -1px -1px 0'
	];
	
	$('.demo-colors li a, #demo-colors li a').click(function(){
		var newcolor = $(this).html().toLowerCase().replace(" ", "-");
		if(newcolor=='default')
		{
			createCookie('demo-color-1' ,null);
			createCookie('demo-color', null);
		} else {
			createCookie('demo-color-1' ,colors[newcolor.replace("-", "")].replace("#",""));
			createCookie('demo-color', newcolor);
		}
		createCookie('demo-color-2', colors[newcolor.replace("-", "")].replace("#",""));
		createCookie('demo-color-3', '000000');
		createCookie('demo-color-4', linksColors[newcolor.replace("-", "")].replace("#",""));
		window.location.reload( false );
	});
	
	var demoPanel =
	' <div id="demopanel" style="opacity: 1; left: 0px; ">'+
	'		<div id="demo-nav" title="Demo styles"></div>'+
	'	<form action="" method="post" id="invent-demo-form">'+
	'		<div id="demo-set">'+
	'		<label>Theme style</label>'+
	'		<div class="invent-demo-theme-style demo-wide'+(boxed=='false' ? ' active-demo-theme-style' : '')+'"></div><div class="invent-demo-theme-style demo-narrow'+(boxed=='true' ? ' active-demo-theme-style' : '')+'"></div>'+
			
	'		<div class="demo-background">'+
	'			<label>Background</label>'+
	'			<div class="demo-background-box">'+
					
	'			</div>'+
	'			<div>'+
	'				<div class="demo-background-next demo-button">next</div><div class="demo-background-prev demo-button">prev</div>'+
	'			</div>'+
	'			<div class="shadow-settings">'+
	'				<div class="demo-button demo-shadow-on">Shadow on</div><div class="demo-button demo-shadow-off">Shadow off</div>'+
	'			</div>'+
	
	'		</div>'+
	'		<div class="clear"></div>'+
		
	'		<label>Buttons color</label>'+
	'		<div>'+
	'			<div class="invent-demo-select-color invent-demo-color-1 invent-demo-selected"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-2"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-3"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-4"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-5"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-6"></div>'+
	'			<div class="clear"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-7"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-8"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-9"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-10"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-11"></div>'+
	'			<div class="invent-demo-select-color invent-demo-color-12"></div>'+
	'		</div><br /><br />'+
	'		<label>Custom color</label>'+
	'		<label class="small">Links color</label>'+
	'		<div class="color-pipet-decoration">'+
	'			<div class="color-pipet" id="demo-color3-color" style="background-color: rgb(88, 88, 88); "></div>'+
	'		</div>'+
	'		<label class="small">Headers color</label>'+
	'		<div class="color-pipet-decoration">'+
	'			<div class="color-pipet" id="demo-color2-color" style="background-color: rgb(88, 88, 88); "></div>'+
	'		</div>'+
	'		<label class="small long-text">Nivo, Lof, Anything Slider Background</label>'+
	'		<div class="color-pipet-decoration">'+
	'			<div class="color-pipet" id="demo-color1-color" style="background-color: rgb(88, 88, 88); "></div>'+
	'		</div>'+

	'		<div class="clear"></div>'+
	'		<div class="demo-button demo-reset">Default colors</div>'+
	'		</div>'+
	'	</form>'+
	'</div>';

	$('body').append($(demoPanel));
	
	$("#demo-nav").tipTip({'defaultPosition': 'right'});

	$('.invent-demo-theme-style.demo-narrow').click(function(){
		createCookie('boxed', 'true');
		createCookie('bg', 1);
		window.location.reload( false );
	});

	$('.invent-demo-theme-style.demo-wide').click(function(){
		createCookie('boxed', 'false');
		createCookie('bg', 0);
		window.location.reload( false );
	});
	
	
	var boxed = readCookie('boxed');

	if(boxed == null) boxed = 'true';

	if(boxed=='true') {
		$('body').addClass("boxed");
		$('.shadow-settings').css({display: 'block'});
		$('.demo-narrow').css({borderColor: '#FD4C31'});
	}else {
		$('body.boxed').removeClass("boxed");
		$('.shadow-settings').css({'display': 'none'});
		$('.demo-wide').css({borderColor: '#FD4C31'});
	}


	function refreshBackground(){
		createCookie('bg', bg);

		if(bg>0 && boxed == 'false') {
			createCookie('boxed', 'true');
			$('.demo-background').css({display: 'block'});
			window.location.reload( false );
		}
		
		switch(bg){
			case 0:
				$('.demo-background-box').css({background: "url('images/demo-panel/bg-none.png')"});
				$('#background').css({background: "transparent"});
				$('#background-2').css({background: "transparent"});
				break;
			case 1:
				$('.demo-background-box').css({background: "url('images/demo-panel/default-1.jpg') "});
				$('#background').addClass('scrollable').css({background: "url('images/backgrounds/default-bottom.jpg') repeat fixed"});
				$('#background-front').css({background: "url('images/backgrounds/default-top.png') fixed"});
				break;
			case 2:
			case 3:
				$('.demo-background-box').css({background: "url('images/demo-panel/default-"+bg+".jpg') "});
				$('#background').addClass('scrollable').css({background: "url('images/backgrounds/default-bottom-"+bg+".jpg') repeat fixed"});
				$('#background-front').css({background: "url('images/backgrounds/default-top-"+bg+".png') fixed"});
				break;
			case 4:
			case 5:
			case 6:
			case 7:
				$('.demo-background-box').css({background: "url('images/demo-panel/"+(bg-3)+".jpg')"});
				$('#background').removeClass('scrollable').css({background: "url('images/photobackgrounds/0"+(bg-3)+".jpg') fixed no-repeat 0 0"});
				$('#background-front').css({background: "transparent"});
				break;
		}
	}
	refreshBackground();
	$('.demo-background-next').click(function(){
		bg++;
		if(bg==8) bg=1;
		refreshBackground();
	});

	$('.demo-background-prev').click(function(){
		bg--;
		if(bg==0) bg=7;
		refreshBackground();
	});

	$('#demo-nav').click(function() {

		if($('#demopanel').css('left') == '0px') {
			$('#demopanel').animate({opacity: 0.5, 'left': '-210px'}, 500, function() { });
			$('#demo-nav').css({'background-position':'top left'});
			$('#demo-nav').hover(function () {$(this).css({'background-position':'-27px 0px'});},function () {$(this).css({'background-position':'top left'});});
		}else{
			$('#demopanel').animate({opacity: 1.0, 'left': '0px'}, 500, function() { });
			$('#demo-nav').css({'background-position':'top right'});
			$('#demo-nav').hover(function () {$(this).css({'background-position':'-27px 0px'});},function () {$(this).css({'background-position':'top left'});});
		}

	});
	
	function refreshColor1(hex){
		$('#demo-color1-color, .home-page-slider-color').css('backgroundColor', '#' + hex);
		
		
	}
	
	function refreshColor2(hex){
		$('#demo-color2-color').css('backgroundColor', '#' + hex);
		$('h1,h2,h3,h4,h5,h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a', $('.content')).add('h1,h2,h3,h4,h5,h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a', $('#content')).not('.invent-solid-container h1, .invent-solid-container h2, .invent-solid-container h3').css('color', '#' + hex);
		$('.widget-title').css('color', '#'+hex);
	}

	function refreshColor3(hex){
		var exceptions = 'h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, invent-button, .scroll-to-top, .invent-paginator a,  a[class*="button"]';
		$('.slider-decoration-bottom a').css({backgroundColor: '#fff'});
		$('#demo-color3-color, .fade-carousel-controls a.actual, .invent-paginator a.actual, .nav-decorator div, .slider-decoration-bottom a.active, .invent-big-color-icon-center, .lof-main-item-desc h3 a').css({backgroundColor: '#' + hex});
		
		$('.invent-content a, a').not(exceptions).not('#nav a, .invent-site-map a, .widget-container a').add('.invent-site-map a.active, #nav li.current > a, .twitter-carousel a').css({color: '#' + hex}); 
		
		$('.invent-content a, a').not(exceptions).not('.invent-read-more, #nav li li a, .site-footer a, #nav li.current > a, .invent-paginator a, .gallery-splitter li a').add('.entry-title a').hover(function(){ 
			$(this).css({color: '#' + hex}); 
			}, function(){ 
				$(this).css({color: '#000'});
		});
		
		$('.widget-container a').not('.widget_twitter a').css({color: '#' + hex});
		
		$('.invent-site-map a').not(exceptions).hover(function(){ 
			$(this).css({color: '#000'}); 
			}, function(){ 
				$(this).css({color: '#666'});
		});
		
		$('.invent-site-map a.active, .invent-read-more, .entry-meta a, blockquote a, .reply, .widget-container a').not('.invent-button.invent-read-more, .all-tweets').hover(function(){ 
			$(this).css({color: '#000'}); 
			}, function(){ 
				$(this).css({color: '#' + hex});
		});
	
		$('.border-standard').each(function(){
			var color = $(this).css('borderColor');
			$(this).hover(function(){ 
					$(this).css({borderColor: '#' + hex}); 
				}, function(){
					$(this).css({borderColor: color});
			})
		});
				
		
		$('.scroll-to-top, .border-standard, .invent-paginator a').each(function(){
			var color = $(this).css('backgroundColor');
			$(this).hover(
				function(){ 
					$(this).css({backgroundColor: '#' + hex}); 
				}, function(){
					$(this).css({backgroundColor: color});
				})
		});
		
			
		$('.invent-paginator a').not('.invent-paginator a.actual').css({color: '#' + hex});
		$('.invent-paginator a').not('.invent-paginator a.actual').hover(
			function(){ 
				$(this).css({color: '#fff'}); 
			}, function(){
				$(this).css({color: '#' + hex});
			});

		$('.widget-search-submit').css({backgroundColor: '#' + hex});
		$('.widget-search-submit').hover(function(){ 
				$(this).css({backgroundColor: '#000'}); 
			}, function(){
				$(this).css({backgroundColor: '#' + hex});
		});
		
		color3 = hex;
		$('.lof-navigator li.active img').css('border-color', '#'+color3);
	}
	
	
	function changeButtonColor(i){
		$('input[name="invent-demo-nav-color"]').val(i);
			$('.invent-demo-selected').removeClass('invent-demo-selected');
			$('.invent-demo-color-'+i).addClass('invent-demo-selected');
			$(' .invent-button-default').css({backgroundImage: "url('images/demo-panel/buttons/small/"+i+".png')"});
			$(' .invent-button-big.invent-button-default').css({backgroundImage: "url('images/demo-panel/buttons/big/"+i+".png')"});
			$('.invent-button-default').css({borderColor: buttonBorder[i-1], textShadow: buttonShadow[i-1], color: "#fff"});
				
			if(i==12){
				$('.invent-button-default').css({color: "#575757"});
			}
	}
	$('.invent-demo-select-color').click(function(){
		var e = $(this);
		for(var i=1; i<13; i++){


			if(e.hasClass('invent-demo-color-'+i)) {
				createCookie('demo-button-color', i);
				changeButtonColor(i);
			}
		}
	});

	var buttonColor = readCookie('demo-button-color');
	if( buttonColor == null)
		buttonColor = 6;
	changeButtonColor(buttonColor);
	
	var color1 = readCookie('demo-color-1');

	if(color1=='null' || color1==null) color1 = '084a8d';

	var color2 = readCookie('demo-color-2');
	
	if(color2==null) {
		if(color=='default')
			color2 = '000000';
		else
			color2 = '000000';
	}
	
	color3 = readCookie('demo-color-3');
	
	DEMO_COLOR = color3;
	
	$('.demo-reset').click(function(){
		var color1 = '084a8d';
		var color2 = '000000';
		color3 = 'FD4B30';
		createCookie('demo-color-1', color1)
		createCookie('demo-color-2', color2)
		createCookie('demo-color-3', color3)
		refreshColor1(color1);
		refreshColor2(color2);
		refreshColor3(color3);
		changeButtonColor(6);
		createCookie('demo-button-color', 6);
	});
	
	var shadow = readCookie('demo-shadow');
	if(shadow==null) {
		$('.demo-shadow-off').addClass('active');
		$('.demo-shadow-on').removeClass('active');
		$('body.boxed').addClass('shadow');
	}else {
		$('.demo-shadow-on').addClass('active');
		$('.demo-shadow-off').removeClass('active');
		$('body.boxed').removeClass('shadow');
	}
	
	$('.demo-shadow-on').click(function(){
		$('.demo-shadow-off').addClass('active');
		$(this).removeClass('active');
		$('body.boxed').addClass('shadow');
		createCookie('demo-shadow', 0);
	});
	
	$('.demo-shadow-off').click(function(){
		$('.demo-shadow-on').addClass('active');
		$(this).removeClass('active');
		createCookie('demo-shadow', 1);
		$('body.boxed').removeClass('shadow');
	});
	
	$('#demo-color1-color').ColorPicker({
		color: '#'+color1,
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			createCookie('demo-color-1', hex);
			refreshColor1(hex);
		}
	});

	$('#demo-color2-color').ColorPicker({
		color: '#'+color2,
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			createCookie('demo-color-2', hex);
			refreshColor2(hex);
		}
	});

	if(color3==null) color3 = 'FD4B30';
	
	$('#demo-color3-color').ColorPicker({
		color: '#'+color3,
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			createCookie('demo-color-3', hex);
			refreshColor3(hex);
		}
	});
	
	refreshColor1(color1);
	refreshColor2(color2);
	refreshColor3(color3);
	
	function checkMenu(){
		window.setTimeout(function(){
			if($('.nav-decorator').length == 0)
				checkAgain();
			else {
				$('.nav-decorator>div').css({opacity:1, background:'#'+color3});
			}
		}, 30);
	}
	checkMenu();


	var e = $('.twitter-data input[name="number"]');
	function checkAgain(){
		window.setTimeout(function(){
			if( $('.widget_twitter .fade-carousel-controls a.actual').length==0)
				checkAgain();
			else {
				var controls = $('.fade-carousel-controls a');
				$('.widget_twitter .fade-carousel a').css({color: '#'+color3});
				$('.actual', controls.parent()).css({background: '#'+color3});
				controls.hover(function(){
					$(this).css({background: '#'+color3});
				}, function(){
					if( !$(this).hasClass('actual') )
						$(this).css({background: '#D6D6D6'})
				});
				
				controls.click(function(){
					$(this).siblings().css({background: '#D6D6D6'})
					$(this).addClass('actual').css({background: '#'+color3});
				});
			}
		}, 200);
	}
	checkAgain();

	$('.fancyslider-bullets a').click(function(){
		$(this).siblings().css({'background': '#fff'});
		$(this).addClass('active').css({'background': '#'+color3});
	});
	
	$('.fancyslider-bullets a').hover(function(){
		$(this).css({background: '#'+color3});
	}, function(){
		if( !$(this).hasClass('active') )
			$(this).css({background: '#fff'});
	})


	$('.gallery-splitter li.selected a').css({color: '#fff', background: '#'+color3});
	$('.gallery-splitter a').hover(function(){
			$(this).css({color: '#fff', background: '#'+color3}); 
		}, function(){
			if(!$(this).parent().hasClass('selected'))
				$(this).css({color: '#' + color3, background: '#F3F3F3'});
	});
	
	$('.gallery-splitter a').click(function(){
		$(this).parent().addClass('selected');
		$('.gallery-splitter a').css({color: '#' + color3, background: '#F3F3F3'});
		$(this).css({color: '#fff', background: '#'+color3});
	})
	
	
	if($('.lof-main-wapper').length) {

		function checkLof(){
			if($('.lof-navigator li.active').length) {
			$('.lof-navigator li.active img').css('border-color', '#'+color3);

				$('.lof-navigator li').hover(function(){
					$('img', this).css('border-color', '#'+color3);
				}, function(){
					if(!$(this).hasClass('active'))
						$('img', this).css('border-color', '#666');
				})

				$('.lof-navigator li').click(function(){
					$('.lof-navigator li img').css('border-color', '#666');
					$('img', this).css('border-color', '#'+color3);
				})

				var allSlides = $('.lof-navigator li').length;
				$('#minus-image').parent().click(function(){
					$('.lof-navigator li img').css('border-color', '#666');
					
					$( '.lof-navigator li.active img' ).css('border-color', '#'+color3);
				});

				$('#plus-image').parent().click(function(){
					$('.lof-navigator li img').css('border-color', '#666');
					
					$( '.lof-navigator li.active img' ).css('border-color', '#'+color3);
				});


			} else {
				setTimeout(function(){checkLof();}, 50);
			}
		}
		checkLof();
	}
});


