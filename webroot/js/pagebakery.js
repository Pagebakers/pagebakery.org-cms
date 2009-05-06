if(jQuery) (function($){
    
    // layout manager
    $.widget("pb.layout", {
        _init : function() {       
            // resetting the options because we need to recursively merge them...
    		this.options = $.extend(true, {},
    			$.widget.defaults,
    			$['pb']['layout'].defaults,
    			$.metadata && $.metadata.get(this.element)['layout'],
    			this.options);
            
            this.baseClass = '.' + this.widgetBaseClass + '-',
            
            this._initPanels();
            
            $('.pb-load-mask').fadeOut();
        },
        
        _initPanels : function() {
            var body = $('body');
            
            // init north panel
            var north = $(this.baseClass + 'north');
            if(north) {
                north.css({
                    position : 'fixed',
                    top : 0, 
                    left : 0,
                    height : parseInt(this.options.north.height) + 'px'
                });
                body.css({'padding-top' : north.height() + 'px'});
            }
            
            // init south panel
            var south = $(this.baseClass + 'south');
            if(south) {
                south.css({
                    position : 'fixed', 
                    bottom : 0, 
                    left : 0,
                    height : parseInt(this.options.south.height) + 'px'
                });
                body.css({'bottom-top' : south.height() + 'px'});
            }
            
            // offset to contract from east and west panels height
            var offset = (north.height() || 0) + (south.height() || 0);
            
            // init east panel
            var east = $(this.baseClass + 'east');
            if(east) {
                east.css({
                    position : 'fixed', 
                    top : offset + 'px' , 
                    right : 0, 
                    height : $(window).height() - offset + 'px',
                    width : parseInt(this.options.east.width) + 'px'
                });
                body.css({'padding-right' : east.width() + 'px'})
                
                $(window).resize(function(e) {
                    east.height($(this).height() - offset);
                });
            }
            
            // init west panel
            var west = $(this.baseClass + 'west');
            if(west) {
                west.css({
                    position : 'fixed', 
                    top : offset + 'px' , 
                    left : 0, 
                    height : $(window).height() - offset + 'px',
                    width : parseInt(this.options.east.width) + 'px'
                });
                body.css({'padding-left' : west.width() + 'px'})
                
                $(window).resize(function(e) {
                    west.height($(this).height() - offset);
                });
            }
            
            var center = $(this.baseClass + 'center');
            if(center) {
                center.height($(window).height() - offset);
                $(window).resize(function(e) {
                    center.height($(this).height() - offset);
                });
            }
        }
    });
    
    $.extend($.pb.layout, {
    	version: "0.1",
    	defaults: {
            north : {
                height : 50
            },
            east : {
                width : 200
            },
            west : {
                width : 200
            },
            south : {
                height : 20
            }
        }
    });

})(jQuery);

if(jQuery) (function($){

    // set defaults
    $.ui.dialog.defaults = $.extend($.ui.dialog.defaults, {
        resizable : false,
        modal : true,
        close: function(e) { $(this).remove(); },
        height : 'auto'
    });

    var Pagebakery = {
        url : function(url) {
            return Pagebakery.config.base + url.substr(1);
        },

        __ : function(text) {
            return text; // @todo translations..
        }
    }
    
    
    
    Pagebakery.Element = Class.extend({
        
        type : '',
        
        id : null,
        
        baseClass : 'pb-element',

        init : function(el) {            
            if(!el) return false;
            
            this.el = el;
            
            if(!this.id) {
                this.id = el.attr('id').replace('pb-element-', '');
            }
            
            this.el.wrap('<div class="' + this.baseClass + '-wrap"></div>');
            this.wrap = this.el.parent();
            if(!this.tbar) {
                this.tbar = this.initToolbar();
            }
        },

        initToolbar : function() {
            var self = this;
            var tbar = $('<div class="' + this.baseClass + '-tbar"></div>').prependTo(this.wrap);
            var editBtn = $('<a class="' + this.baseClass + '-edit">edit</a>').appendTo(tbar).click(function() {
                self.onEdit();
            });
            var deleteBtn = $('<a class="' + this.baseClass + '-delete">delete</a>').appendTo(tbar).click(function() {
                self.onDelete();
            });
            
            return tbar;
        },
        
        setId : function(id) {
            this.id = id;
            this.el.attr('id', id);
        },
        
        onEdit : function() {
            var self = this;
            
            var dialog = $('<div id="pb-element-edit-dialog"></div>').appendTo('body')
                .load(Pagebakery.url('/admin/elements/text/load'))
                .dialog();
        },

        onDelete : function() {
            var self = this;
            $.ajax({
                url : Pagebakery.url('/admin/pages/unbindElement.json'),
                type : 'POST',
                data : {id: this.id},
                success : function(msg) {
                    var json = $.evalJSON(msg);
                    if(json.success) {
                        self.destroy();
                    }
                }
            });
        },

        destroy : function() {
            this.wrap.remove();
            delete this;
        }
    });
    
    Pagebakery.Element.Text = Pagebakery.Element.extend({
        type : 'text'
    });

    
    /**
     *
     */
    Pagebakery.Elements = Class.extend({
        init: function(){
            this.initToolbar();
            this.initGroups();    
            this.initElements();
            this.initDropzones();
        },
        
        initGroups : function() {
            $('.pb-element-group ul').hide();
            $('.pb-element-group h4').toggle(
                function() {
                    $(this).addClass('pb-closed');
                    $(this).next().slideDown('normal');
                },
                function() {
                    $(this).removeClass('pb-closed');
                    $(this).next().slideUp('normal');
                }
            );
        },
        
        initToolbar : function() {
            this.toolbar = $('#pb-elements-toolbar');
            
            this.toolbar.find('.pb-element').each(function(i) {
                $(this).find('a').click(function(e){ e.preventDefault(); });
                $(this).draggable({
                    revert : 'invalid',
                    zIndex : 1000,
                    helper : 'clone',
                    scope : 'elements'
                });
                $(this).disableSelection();
            });
        },
        
        initDropzones : function() {
            var self = this;

            this.containers = $('.ct').droppable({
                scope : 'elements',
                hoverClass : 'pb-accept-drop',
                drop : function(e, ui) {
                    var source = ui.draggable.find('a:first');
                    var element = self.initElement(source.attr('class'));
                    var id =  source.attr('href').replace('#', '');
                    
                    if(element) {
                        element.wrap.appendTo($(this));
                        $.ajax({
                            url : Pagebakery.url('/admin/pages/bindElement.json'),
                            type : 'POST',
                            data : {element_id: id, page_id: Pagebakery.data.Page.id, container : $(this).attr('id')},
                            success : function(msg) {
                                var json = $.evalJSON(msg);
                                if(json.success) {
                                    element.setId(json.id);
                                } else {
                                    element.destroy();
                                }
                            },
                            error : function() {
                                element.destroy();
                            }
                        });
                    }          
                }

            });
        },
        
        initElements : function() {
            var self = this;

            if(!this.containers) {
                this.containers = $('.ct');
            }
            
            this.containers.sortable({
                handle : '.pb-element-tbar',
                connectWith : $('.ct'),
                update : function(e, ui) {
                    var source = ui.draggable;
                    console.log(ui);
                    console.log(e);
                }
            });

            var elements = this.containers.find('[class^="pb-element"]');
            elements.each(function(i) {
                self.initElement($(this));
            });
        },
        
        initElement : function(el) {
            if(typeof el !== 'object') {
                el = $('<div class="' + el + '"></div>');
            }
            switch(el.attr('class')) {
                case 'pb-element-text' :
                    return new Pagebakery.Element.Text(el);
                default :
                    return false;
            }
        }
    });

    window.Pagebakery = Pagebakery;
    
})(jQuery);

$(document).ready(function () {
	$('body').layout({
	   north : {
	       height : 80
	   }
	});
	
	new Pagebakery.Elements();
});
