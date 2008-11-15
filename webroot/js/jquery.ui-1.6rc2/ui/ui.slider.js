/*
 * jQuery UI Slider @VERSION
 *
 * Copyright (c) 2008 Paul Bakaus
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 * 
 * http://docs.jquery.com/UI/Slider
 *
 * Depends:
 *	ui.core.js
 */
(function($) {

$.fn.unwrap = $.fn.unwrap || function(expr) {
  return this.each(function(){
     $(this).parents(expr).eq(0).after(this).remove();
  });
};

$.widget("ui.slider", {
	plugins: {},
	ui: function(e) {
		return {
			options: this.options,
			handle: this.currentHandle,
			value: this.options.axis != "both" || !this.options.axis ? Math.round(this.value(null,this.options.axis == "vertical" ? "y" : "x")) : {
				x: Math.round(this.value(null,"x")),
				y: Math.round(this.value(null,"y"))
			},
			range: this._getRange()
		};
	},
	_propagate: function(n,e) {
		$.ui.plugin.call(this, n, [e, this.ui()]);
		this.element.triggerHandler(n == "slide" ? n : "slide"+n, [e, this.ui()], this.options[n]);
	},
	destroy: function() {
		
		this.element
			.removeClass("ui-slider ui-slider-disabled")
			.removeData("slider")
			.unbind(".slider");
		
		if(this.handle && this.handle.length) {
			this.handle
				.unwrap("a");
			this.handle.each(function() {
				$(this).data("mouse")._mouseDestroy();
			});
		}
		
		this.generated && this.generated.remove();
		
	},
	_setData: function(key, value) {
		$.widget.prototype._setData.apply(this, arguments);
		if (/min|max|steps/.test(key)) {
			this._initBoundaries();
		}
		
		if(key == "range") {
			value ? this.handle.length == 2 && this._createRange() : this._removeRange();
		}
		
	},

	_init: function() {
		
		var self = this;
		this.element.addClass("ui-slider");
		this._initBoundaries();
		
		// Initialize mouse and key events for interaction
		this.handle = $(this.options.handle, this.element);
		if (!this.handle.length) {
			self.handle = self.generated = $(self.options.handles || [0]).map(function() {
				var handle = $("<div/>").addClass("ui-slider-handle").appendTo(self.element);
				if (this.id)
					handle.attr("id", this.id);
				return handle[0];
			});
		}
		
		
		var handleclass = function(el) {
			this.element = $(el);
			this.element.data("mouse", this);
			this.options = self.options;
			
			this.element.bind("mousedown", function() {
				if(self.currentHandle) this.blur(self.currentHandle);
				self._focus(this, true);
			});
			
			this._mouseInit();
		};
		
		$.extend(handleclass.prototype, $.ui.mouse, {
			_mouseStart: function(e) { return self._start.call(self, e, this.element[0]); },
			_mouseStop: function(e) { return self._stop.call(self, e, this.element[0]); },
			_mouseDrag: function(e) { return self._drag.call(self, e, this.element[0]); },
			_mouseCapture: function() { return true; },
			trigger: function(e) { this._mouseDown(e); }
		});
		
		
		$(this.handle)
			.each(function() {
				new handleclass(this);
			})
			.wrap('<a href="#" style="outline:none;border:none;"></a>')
			.parent()
				.bind('click', function() { return false; })
				.bind('focus', function(e) { self._focus(this.firstChild); })
				.bind('blur', function(e) { self._blur(this.firstChild); })
				.bind('keydown', function(e) { if(!self.options.noKeyboard) return self._keydown(e.keyCode, this.firstChild); })
		;
		
		// Bind the click to the slider itself
		this.element.bind('mousedown.slider', function(e) {
			self._click.apply(self, [e]);
			self.currentHandle.data("mouse").trigger(e);
			self.firstValue = self.firstValue + 1; //This is for always triggering the change event
		});
		
		// Move the first handle to the startValue
		$.each(this.options.handles || [], function(index, handle) {
			self.moveTo(handle.start, index, true);
		});
		if (!isNaN(this.options.startValue))
			this.moveTo(this.options.startValue, 0, true);

		this.previousHandle = $(this.handle[0]); //set the previous handle to the first to allow clicking before selecting the handle
		if(this.handle.length == 2 && this.options.range) this._createRange();
	},
	_initBoundaries: function() {
		
		var element = this.element[0], o = this.options;
		this.actualSize = { width: this.element.outerWidth() , height: this.element.outerHeight() };			
		
		$.extend(o, {
			axis: o.axis || (element.offsetWidth < element.offsetHeight ? 'vertical' : 'horizontal'),
			max: !isNaN(parseInt(o.max,10)) ? { x: parseInt(o.max, 10), y: parseInt(o.max, 10) } : ({ x: o.max && o.max.x || 100, y: o.max && o.max.y || 100 }),
			min: !isNaN(parseInt(o.min,10)) ? { x: parseInt(o.min, 10), y: parseInt(o.min, 10) } : ({ x: o.min && o.min.x || 0, y: o.min && o.min.y || 0 })
		});
		//Prepare the real maxValue
		o.realMax = {
			x: o.max.x - o.min.x,
			y: o.max.y - o.min.y
		};
		//Calculate stepping based on steps
		o.stepping = {
			x: o.stepping && o.stepping.x || parseInt(o.stepping, 10) || (o.steps ? o.realMax.x/(o.steps.x || parseInt(o.steps, 10) || o.realMax.x) : 0),
			y: o.stepping && o.stepping.y || parseInt(o.stepping, 10) || (o.steps ? o.realMax.y/(o.steps.y || parseInt(o.steps, 10) || o.realMax.y) : 0)
		};
	},

	
	_keydown: function(keyCode, handle) {
		var k = keyCode;
		if(/(33|34|35|36|37|38|39|40)/.test(k)) {
			var o = this.options, xpos, ypos;
			if (/(35|36)/.test(k)) {
				xpos = (k == 35) ? o.max.x : o.min.x;
				ypos = (k == 35) ? o.max.y : o.min.y;
			} else {
				var oper = /(34|37|40)/.test(k) ? "-=" : "+=";
				var step = /(37|38|39|40)/.test(k) ? "_oneStep" : "_pageStep";
				xpos = oper + this[step]("x");
				ypos = oper + this[step]("y");
			}
			this.moveTo({
				x: xpos,
				y: ypos
			}, handle);
			return false;
		}
		return true;
	},
	_focus: function(handle,hard) {
		this.currentHandle = $(handle).addClass('ui-slider-handle-active');
		if (hard)
			this.currentHandle.parent()[0].focus();
	},
	_blur: function(handle) {
		$(handle).removeClass('ui-slider-handle-active');
		if(this.currentHandle && this.currentHandle[0] == handle) { this.previousHandle = this.currentHandle; this.currentHandle = null; };
	},
	_click: function(e) {
		// This method is only used if:
		// - The user didn't click a handle
		// - The Slider is not disabled
		// - There is a current, or previous selected handle (otherwise we wouldn't know which one to move)
		
		var pointer = [e.pageX,e.pageY];
		
		var clickedHandle = false;
		this.handle.each(function() {
			if(this == e.target)
				clickedHandle = true;
		});
		if (clickedHandle || this.options.disabled || !(this.currentHandle || this.previousHandle))
			return;

		// If a previous handle was focussed, focus it again
		if (!this.currentHandle && this.previousHandle)
			this._focus(this.previousHandle, true);
		
		// propagate only for distance > 0, otherwise propagation is done my drag
		this.offset = this.element.offset();

		this.moveTo({
			y: this._convertValue(e.pageY - this.offset.top - this.currentHandle[0].offsetHeight/2, "y"),
			x: this._convertValue(e.pageX - this.offset.left - this.currentHandle[0].offsetWidth/2, "x")
		}, null, !this.options.distance);
	},
	


	_createRange: function() {
		if(this.rangeElement) return;
		this.rangeElement = $('<div></div>')
			.addClass('ui-slider-range')
			.css({ position: 'absolute' })
			.appendTo(this.element);
		this._updateRange();
	},
	_removeRange: function() {
		this.rangeElement.remove();
		this.rangeElement = null;
	},
	_updateRange: function() {
		var prop = this.options.axis == "vertical" ? "top" : "left";
		var size = this.options.axis == "vertical" ? "height" : "width";
		this.rangeElement.css(prop, (parseInt($(this.handle[0]).css(prop),10) || 0) + this._handleSize(0, this.options.axis == "vertical" ? "y" : "x")/2);
		this.rangeElement.css(size, (parseInt($(this.handle[1]).css(prop),10) || 0) - (parseInt($(this.handle[0]).css(prop),10) || 0));
	},
	_getRange: function() {
		return this.rangeElement ? this._convertValue(parseInt(this.rangeElement.css(this.options.axis == "vertical" ? "height" : "width"),10), this.options.axis == "vertical" ? "y" : "x") : null;
	},

	_handleIndex: function() {
		return this.handle.index(this.currentHandle[0]);
	},
	value: function(handle, axis) {
		if(this.handle.length == 1) this.currentHandle = this.handle;
		if(!axis) axis = this.options.axis == "vertical" ? "y" : "x";

		var curHandle = $(handle != undefined && handle !== null ? this.handle[handle] || handle : this.currentHandle);
		
		if(curHandle.data("mouse").sliderValue) {
			return parseInt(curHandle.data("mouse").sliderValue[axis],10);
		} else {
			return parseInt(((parseInt(curHandle.css(axis == "x" ? "left" : "top"),10) / (this.actualSize[axis == "x" ? "width" : "height"] - this._handleSize(handle,axis))) * this.options.realMax[axis]) + this.options.min[axis],10);
		}

	},
	_convertValue: function(value,axis) {
		return this.options.min[axis] + (value / (this.actualSize[axis == "x" ? "width" : "height"] - this._handleSize(null,axis))) * this.options.realMax[axis];
	},
	
	_translateValue: function(value,axis) {
		return ((value - this.options.min[axis]) / this.options.realMax[axis]) * (this.actualSize[axis == "x" ? "width" : "height"] - this._handleSize(null,axis));
	},
	_translateRange: function(value,axis) {
		if (this.rangeElement) {
			if (this.currentHandle[0] == this.handle[0] && value >= this._translateValue(this.value(1),axis))
				value = this._translateValue(this.value(1,axis) - this._oneStep(axis), axis);
			if (this.currentHandle[0] == this.handle[1] && value <= this._translateValue(this.value(0),axis))
				value = this._translateValue(this.value(0,axis) + this._oneStep(axis), axis);
		}
		if (this.options.handles) {
			var handle = this.options.handles[this._handleIndex()];
			if (value < this._translateValue(handle.min,axis)) {
				value = this._translateValue(handle.min,axis);
			} else if (value > this._translateValue(handle.max,axis)) {
				value = this._translateValue(handle.max,axis);
			}
		}
		return value;
	},
	_translateLimits: function(value,axis) {
		if (value >= this.actualSize[axis == "x" ? "width" : "height"] - this._handleSize(null,axis))
			value = this.actualSize[axis == "x" ? "width" : "height"] - this._handleSize(null,axis);
		if (value <= 0)
			value = 0;
		return value;
	},
	_handleSize: function(handle,axis) {
		return $(handle != undefined && handle !== null ? this.handle[handle] : this.currentHandle)[0]["offset"+(axis == "x" ? "Width" : "Height")];	
	},
	_oneStep: function(axis) {
		return this.options.stepping[axis] || 1;
	},
	_pageStep: function(axis) {
		return /* this.options.paging[axis] ||*/ 10;
	},


	_start: function(e, handle) {
	
		var o = this.options;
		if(o.disabled) return false;

		// Prepare the outer size
		this.actualSize = { width: this.element.outerWidth() , height: this.element.outerHeight() };
	
		// This is a especially ugly fix for strange blur events happening on mousemove events
		if (!this.currentHandle)
			this._focus(this.previousHandle, true); 

		this.offset = this.element.offset();
		
		this.handleOffset = this.currentHandle.offset();
		this.clickOffset = { top: e.pageY - this.handleOffset.top, left: e.pageX - this.handleOffset.left };
		
		this.firstValue = this.value();
		
		this._propagate('start', e);
		this._drag(e, handle);
		return true;
					
	},
	_stop: function(e) {
		this._propagate('stop', e);
		if (this.firstValue != this.value())
			this._propagate('change', e);
		// This is a especially ugly fix for strange blur events happening on mousemove events
		this._focus(this.currentHandle, true);
		return false;
	},
	_drag: function(e, handle) {

		var o = this.options;
		var position = { top: e.pageY - this.offset.top - this.clickOffset.top, left: e.pageX - this.offset.left - this.clickOffset.left};
		if(!this.currentHandle) this._focus(this.previousHandle, true); //This is a especially ugly fix for strange blur events happening on mousemove events

		position.left = this._translateLimits(position.left, "x");
		position.top = this._translateLimits(position.top, "y");
		
		if (o.stepping.x) {
			var value = this._convertValue(position.left, "x");
			value = Math.round(value / o.stepping.x) * o.stepping.x;
			position.left = this._translateValue(value, "x");	
		}
		if (o.stepping.y) {
			var value = this._convertValue(position.top, "y");
			value = Math.round(value / o.stepping.y) * o.stepping.y;
			position.top = this._translateValue(value, "y");	
		}
		
		position.left = this._translateRange(position.left, "x");
		position.top = this._translateRange(position.top, "y");

		if(o.axis != "vertical") this.currentHandle.css({ left: position.left });
		if(o.axis != "horizontal") this.currentHandle.css({ top: position.top });
		
		//Store the slider's value
		this.currentHandle.data("mouse").sliderValue = {
			x: Math.round(this._convertValue(position.left, "x")) || 0,
			y: Math.round(this._convertValue(position.top, "y")) || 0
		};
		
		if (this.rangeElement)
			this._updateRange();
		this._propagate('slide', e);
		return false;
	},
	
	moveTo: function(value, handle, noPropagation) {

		var o = this.options;

		// Prepare the outer size
		this.actualSize = { width: this.element.outerWidth() , height: this.element.outerHeight() };

		//If no handle has been passed, no current handle is available and we have multiple handles, return false
		if (handle == undefined && !this.currentHandle && this.handle.length != 1)
			return false; 
		
		//If only one handle is available, use it
		if (handle == undefined && !this.currentHandle)
			handle = 0;
		
		if (handle != undefined)
			this.currentHandle = this.previousHandle = $(this.handle[handle] || handle);


		if(value.x !== undefined && value.y !== undefined) {
			var x = value.x, y = value.y;
		} else {
			var x = value, y = value;
		}

		if(x !== undefined && x.constructor != Number) {
			var me = /^\-\=/.test(x), pe = /^\+\=/.test(x);
			if(me || pe) {
				x = this.value(null, "x") + parseInt(x.replace(me ? '=' : '+=', ''), 10);
			} else {
				x = isNaN(parseInt(x, 10)) ? undefined : parseInt(x, 10);
			}
		}
		
		if(y !== undefined && y.constructor != Number) {
			var me = /^\-\=/.test(y), pe = /^\+\=/.test(y);
			if(me || pe) {
				y = this.value(null, "y") + parseInt(y.replace(me ? '=' : '+=', ''), 10);
			} else {
				y = isNaN(parseInt(y, 10)) ? undefined : parseInt(y, 10);
			}
		}

		if(o.axis != "vertical" && x !== undefined) {
			if(o.stepping.x) x = Math.round(x / o.stepping.x) * o.stepping.x;
			x = this._translateValue(x, "x");
			x = this._translateLimits(x, "x");
			x = this._translateRange(x, "x");

			o.animate ? this.currentHandle.stop().animate({ left: x }, (Math.abs(parseInt(this.currentHandle.css("left")) - x)) * (!isNaN(parseInt(o.animate)) ? o.animate : 5)) : this.currentHandle.css({ left: x });
		}

		if(o.axis != "horizontal" && y !== undefined) {
			if(o.stepping.y) y = Math.round(y / o.stepping.y) * o.stepping.y;
			y = this._translateValue(y, "y");
			y = this._translateLimits(y, "y");
			y = this._translateRange(y, "y");
			o.animate ? this.currentHandle.stop().animate({ top: y }, (Math.abs(parseInt(this.currentHandle.css("top")) - y)) * (!isNaN(parseInt(o.animate)) ? o.animate : 5)) : this.currentHandle.css({ top: y });
		}
		
		if (this.rangeElement)
			this._updateRange();
			
		//Store the slider's value
		this.currentHandle.data("mouse").sliderValue = {
			x: Math.round(this._convertValue(x, "x")) || 0,
			y: Math.round(this._convertValue(y, "y")) || 0
		};
	
		if (!noPropagation) {
			this._propagate('start', null);
			this._propagate('stop', null);
			this._propagate('change', null);
			this._propagate("slide", null);
		}
	}
});

$.ui.slider.getter = "value";

$.ui.slider.defaults = {
	handle: ".ui-slider-handle",
	distance: 1,
	animate: false
};

})(jQuery);
