/*!
 * FrameIt jQuery Plugin
 * http://geedmo.com
 *
 * Version: 2.1.0
 * Created: 2/10/2012
 * Updated: 20/12/2012
 *
 * Copyright (c) 2012, Geedmo. All rights reserved.
 * Released under CodeCanyon License: http://codecanyon.net/licenses
 *
 * Twitter: @geedmo
 */

;(function($, window){

    // FrameIt plugin default options
    var defaults = {
        global: {
            preset: 'default',
            doanimate: true,
            baseclass: 'frame-square',
            cloud: false,
            cbFinished: function(){},
            cbStarted: function(){},
            config: []
        },
        config: {
                width: 1,
                height: 1,
                top: 0,
                left: 0,
                radius: .8,
                bordersize: 3,
                bordercolor: '#FFF',
                tinybordersize: 1,
                tinybordercolor: '#AAA',
                direction: 'top',
                duration: 900,
                delay: 800,
                location: function() {},
                easing: 'easeOutQuint',
                shadow: false
                //src: '',
                //href: ''
            }
        };
    // plugin global attributes
    $.frameit = { 
            name : 'FrameIt',
            progressbar : 'FiProgressBar',
            frameindex : 'FrameIndex', 
            version : '1.2' ,
            defaults : defaults
        }

    /*
     * function: FrameIt object constructor
     * param: element a DOM object
     * param: options plugin options
     * param: sndopt second options, allows to alter
     *               first options 
     */
    function FrameIt(element, options, sndopt) {
        // auto reference the frameit object
        var f = this;
        
        // jQuery has an extend method that merges the 
        // contents of two or more objects, storing the 
        // result in the first object. The first object 
        // is generally empty because we don't want to alter 
        // the default options for future instances of the plugin
        this.o = $.extend(true, {}, $.frameit.defaults.global, options, sndopt);
        
        (options) ?
            $.each(options.config, function(i) {
                f.o.config[i] = $.extend(true, {}, $.frameit.defaults.config, options.config[i]);
            }) :
            f.o.config[0] = $.extend({}, $.frameit.defaults.config);
        
        // make a second extend to save original options
        this.useroptions = $.extend(true, {}, f.o);

        // put an identificator to the container element
        this.$el = $(element).addClass("frameit-container").css({ 'overflow': 'hidden', 'position': 'relative'});
        this.$el.data($.frameit.name, this)
        
        // checks for load  
        this.allFrameAnimated = false

        // load image then fires init method
        pre(init);
        
        /*
         * preloads all images within the frame preset
         * when all images are loaded executes callback 
         */
        function pre(allLoadedCallback) {
            
            var allImg = [],
                imgLoaded = 0,
                uncached = function (src) {
                    if (!src || src=='') return false;
                    var img = new Image();
                    img.src = src;
                    return !img.complete;
                },
                imgLoad = function(self, img) {
                    imgLoaded++;

                    self.naturalimgwd = img.width;
                    self.naturalimghg = img.height;

                    if (imgLoaded >= allImg.length) {
                        
                        f.$el.removeClass('loading');
                        f.o.cbStarted();
                          
                        allLoadedCallback.call(f);
                        
                        return false;
                    }
                }
            
            // gets all frame images
            $.each(f.o.config, function() {
                if (f.o.src || this.src) {
                    //allImg.push((f.o.src)? f.o : this)
                    allImg.push((this.src)? this : f.o)
                    if (typeof(this.src) != 'undefined' && this.src !== '') 
                    	this.hasOwnImage = true;
                    else
                    	this.hasOwnImage = false;
                }
            });

            f.$el.addClass('loading');
            $.each(allImg, function() {
                var img = new Image(),
                    self = this;
                if(uncached(this.src)) {
                    img.onload = function() {
                        imgLoad(self, img)
                    }
                    img.src = this.src || f.o.src;
                } else {
                    img.src =  this.src || f.o.src;
                    imgLoad(self, img)
                }
            });
            if(!allImg.length){
                imgLoad(f.o, '')
            }
        }
        
        function init() {
            
            // detect if browser support background-size property
            f.bgszSupport = bgsizeSupport();
            // represents all frames once they are configured
            this.frameItems = [];
            // process all image's attributes
            processImage();
            // iterate over each frame
            $.each(f.o.config, function(i) {
                
                // set the base class to each frame
                // we use later to evaluate properties
                if(!this.cssclass)
                    this.cssclass = f.o.baseclass;
                // here we process the frame options
                // it calculates the position and offsets
                // according to the attributes of the config object
                processFrame(this,i);
        
                // this function retrieves the offset setted
                // in the container div that allows to 
                // align the image in a desired position
                this.offset = getOffset(f.$el); 
                
                // prepares the frame according to all attributes computed
                // and appends it inside the container
                this.$item = drawFrame(this);
        
                // add frame configuration to the stack and prepare to be animated
                f.frameItems[i] = this;
                
                // attach frame config
                //this.$item.data($.frameit.config, this);
                this.$item.data($.frameit.frameindex, i);
                
            }); // end each item config
        
            // animate!
            animateFrame(f.frameItems);

        }; // init
        
        /*
         * Retrives an offset to the frame image
         * based on information given on the 
         * background position within the style
         * declaration for the container element
         */
        function getOffset(o) {
            var imgOffset = (o.css('background-position')) ? o.css('background-position').split(" ") : '0px 0px'.split(" ");
            return {
                    x: parseInt(imgOffset[0].replace("[a-zA-Z]","")),
                    y: parseInt(imgOffset[1].replace("[a-zA-Z]",""))
                }; 
        };

        /*
         * Process image properties
         * needed for locate the image and
         * get the best fit size inside the container
         */
        function processImage() {
            // if there is an image tag inside the container
            // and it has a src setted
            if(f.o.src && f.o.src != "")
            {

                // if container size if not setted resize it to the image size
                if (Math.floor(f.$el.height()) <= 0) { f.o.clearhg = true; f.$el.height(f.o.naturalimghg); } 
                if (Math.floor(f.$el.width()) <= 0)  { f.o.clearwd = true; f.$el.width(f.o.naturalimgwd ); }

                // get the container size
                f.o.containerwd = f.$el.width();
                f.o.containerhg = f.$el.height();

                // get the size of the visible area for the image we need this 
                // to not draw the image outside the parent container
                f.o.imghg =     ((f.o.naturalimgwd/f.o.naturalimghg < f.o.containerwd/f.o.containerhg) ? 
                                    f.o.containerhg :
                                    Math.ceil(f.o.containerwd/f.o.naturalimgwd * f.o.naturalimghg)); 

                f.o.imgwd =     ((f.o.naturalimgwd/f.o.naturalimghg < f.o.containerwd/f.o.containerhg) ? 
                                    Math.ceil(f.o.containerhg/f.o.naturalimghg * f.o.naturalimgwd) :
                                    f.o.containerwd);

            }
            else {
                // if no principal image takes the container size       
                f.o.imgwd = f.o.containerwd = f.$el.width();
                f.o.imghg = f.o.containerhg = f.$el.height();
            }
            // calculate margin for horizontal alingment inside the container
            f.o.marginleft = (f.o.containerwd > f.o.imgwd) ? (f.o.containerwd/2) - (f.o.imgwd/2) : 0;

        };

        /*
         * Process the frame information
         * Calculate the size and position based on values
         * setted in properties
         */
        function processFrame(c, idx) {
            // here we'll calculate the frame width and height          
            var framehg, framewd,
                bestfit = (f.o.imghg < f.o.imgwd) ? f.o.imghg : f.o.imgwd;

            if (c.bordersize > 0 && c.bordersize <= 1)
                c.bordersize = Math.floor((c.bordersize) * bestfit);
            
            if (isCircle(c)) {
                // convert radius % to pixels
                if(c.radius > 0 && c.radius <= 1) 
                    framehg = framewd = Math.floor((bestfit) * (c.radius));
                else
                    framehg = framewd = c.radius;
            } // if not, its a rectangle or a square
            else {
                framehg = c.height;
                framewd = c.width;
                if(framehg > 0 && framehg <= 1) framehg = Math.floor(f.o.imghg * framehg);
                if(framewd > 0 && framewd <= 1) framewd = Math.floor(f.o.imgwd * framewd);
            }

            // framehg and framewd are the same
            c._radius = framehg - c.bordersize *2 - c.tinybordersize *2; 
            // just if its not a circle
            c.framehg = framehg - c.bordersize *2 - c.tinybordersize *2; 
            c.framewd = framewd - c.bordersize *2 - c.tinybordersize *2;

            if(c.left > 1) f.o.marginleft = 0; // if not % unit, theres no center alignment 
            
            // here we call the function that locates 
            // the element to be drawed according to the 
            // location of the previous element.
            // first time passes the first element, 
            // next the previous element will be passed.
            // This function has the potencial to modify all   
            // attributes inside the object! Use with care! 
            if(typeof c.location == 'function') {
                c.location((idx > 0) ? f.frameItems[idx-1] : c); 
            }
            // calculate top and left positions
            if (c.top >= 0 && c.top <= 1)
                c.top = Math.floor(f.o.imghg * c.top) + c.tinybordersize;
            if (c.left >= 0 && c.left <= 1)
                c.left = Math.floor(f.o.imgwd * c.left) + f.o.marginleft + c.tinybordersize;            

            // if src set
            if( f.o.src && ! c.hasOwnImage ) {
                // save calculated image attributes inside the frame object
                c.imghg = f.o.imghg;
                c.imgwd = f.o.imgwd;

                // invert the offset and add border size for correct alingment
                c.scrollx = (-1) * (c.left + c.bordersize - c.tinybordersize) + f.o.marginleft;
                c.scrolly = (-1) * (c.top + c.bordersize - c.tinybordersize);
                
                c.src = f.o.src || '';
            }
            else {
                // the image has the same size as the frame
                c.imghg = c.framehg + c.tinybordersize*2;
                c.imgwd = c.framewd + c.tinybordersize*2;
                // and is locate at the top left corner
                c.scrolly = c.scrollx = -c.tinybordersize;
                c.src = c.src || '';
            }
        };
        
        /**
         * Detect support for CSS background-size.
         */
        function bgsizeSupport() {
            var a = document.createElement('a'),
                p = ['backgroundSize','MozBackgroundSize','WebkitbackgroundSize','ObackgroundSize'];
            for ( var i in p) if ( a.style[p[i]] !== undefined ) return true; 
            return false;       
        };
        
        /*
         * Draws a frame on the screen
         */
        function drawFrame(c, onupdate) {
            var $img, $frame, $panel;
            /* ie fix */
            onupdate = (typeof onupdate != 'undefined') ? true : false;  

            if(onupdate)
                $frame = c.$item
            else {
                if(c.href){
                    $frame = $('<a>')
                        .attr('href',c.href)
                        .css('display','block')
                        .addClass('frame-link')
                }
                else {
                    $frame = $("<div>");
                }
                
                $frame
                    .addClass(c.cssclass)
                    //.css({top: -9999, left: -9999}) /* 2.1 */
                
            }
            
            // create a new hidden frame 
            $frame.css({
                        'position': 'absolute',
                        'height':c.framehg,
                        'width':c.framewd 
                    })
            // if cloud effect, just draw a solid bg 
            if(f.o.cloud) {
                
                if(!onupdate) {
                    $panel = $('<div>')
                        .addClass(c.cssclass)
                        .addClass('fi-panel')
                } else {
                    $panel = $('.fi-panel',c.$item)
                }
                
                $panel.css({'position': 'absolute',
                            'background': c.bordercolor,
                            'height': c.framehg,
                            'width': c.framewd,
                            'background': c.bordercolor,
                            'border-color': c.bordercolor,
                            'border-width': c.bordersize,
                            'border-style': 'solid',
                            'z-index':2 
                        })
                
                $frame
                    .css({  'height': c.framehg+c.bordersize*2,
                            'width': c.framewd+c.bordersize*2,
                            'background': c.bordercolor
                    })
                // creates an image over the frame background
                $img = drawFrameImg(c, onupdate)
                
                if(!onupdate)
                    $frame.append($panel).append($img)
                
            }
            else {
            
                // if browser supports background-size
                // use this property
                if(f.bgszSupport) {
                    
                    $frame
                        .css({  
                                'background': 'url('+c.src+') no-repeat', 
                                'background-position': (c.offset.x + c.scrollx) + 'px ' + (c.offset.y + c.scrolly) + 'px',
                                'background-size': c.imgwd + 'px ' + c.imghg + 'px'
                            })
                        ;
                }
                else {
                    // if not, emulate the property adding an extra image tag
                    $img = (onupdate) ? $('img',c.$item) : $('<img/>');
                    $img.attr({ 
                                'src': c.src,
                                'width': c.imgwd,
                                'height': c.imghg 
                        })
                        .css({  
                                'top': (c.offset.y + c.scrolly),
                                'left': (c.offset.x + c.scrollx),
                                'position': 'absolute'
                        })

                    $frame.css('overflow','hidden')

                    if(!onupdate)
                        $frame.append($img) 
                }
                $frame.css({
                            'border-color': c.bordercolor,
                            'border-width': c.bordersize+'px',
                            'border-style': 'solid'
                        })
            }

            if(c.tinybordersize > 0){
                $frame.css('box-shadow', '0 0 0 ' + c.tinybordersize + 'px ' + c.tinybordercolor)
            }               

            // call the draw shadow function 
            if(f.o.shadow || c.shadow)
                drawShadow(c, $frame, onupdate);
            // return the new div created representing the frame
            return (onupdate) ? onupdate : $frame.appendTo(f.$el);          
        };
        
        /*
         * Draws the images. Called when cloud effect is true
         * It draws only the image over the frame 
         */
        function drawFrameImg(c, onupdate){
            var $img,
                $frame = (onupdate) ? $('.fi-cloud',c.$item) : $("<div>");
                
                if(!onupdate) {
                    $frame
                        .addClass(c.cssclass)
                        .addClass('fi-cloud')
                }

                $frame.css({'position': 'relative',
                            'z-index': 3,
                            'height': c.framehg,
                            'width': c.framewd,
                            'background': 'url('+c.src+') no-repeat',
                            'top': c.bordersize,
                            'left': c.bordersize
                        });

            if(f.bgszSupport) {
                $frame
                    .css('background-position', (c.offset.x + c.scrollx) + 'px ' + (c.offset.y + c.scrolly) + 'px')
                    .css('background-size',c.imgwd + 'px ' + c.imghg + 'px')
            }
            else {

                $img = (onupdate) ? $('img',c.$item) : $('<img/>')  
                // ifnot, emulate the property adding an extra image tag
                // inside the div frame
                $img.attr({ 'src': c.src,
                            'width': f.o.imgwd,
                            'height': f.o.imghg })
                    .css({  'position':  'relative', 
                            'top': (c.offset.y + c.scrolly),
                            'left': (c.offset.x + c.scrollx)
                        })
                    
                if(!onupdate)
                    $frame.css('overflow','hidden').append($img)
            }
            return $frame;
        };
        
        /*
         * Draws a shadow and sets the css attributes
         * calculated based on frame's size and position
         * Called only when shadow effect is true 
         */
        function drawShadow(c, $frame, onupdate) {
            var $shadow 
            if(isCircle(c)) {
                if( onupdate ) {
                    $('.source-shadow',$frame)
                        .css('margin-top', c.framehg - 68 + c.bordersize)
                        .css('width', c.framewd * (.5))
                } else {
                    $shadow = $("<div>")
                                .addClass('source-shadow')
                                .css({  'z-index': -1 ,
                                        'margin-top': c.framehg - 68 + c.bordersize,
                                        'width': c.framewd * (.5) 
                                }).appendTo($frame)
                }
            } else {
                if( onupdate ) {
                    $('.source-shadow',$frame)
                        .css( {
                            'width': c.framewd + c.bordersize*2,    
                            'height' :  c.framehg + c.bordersize
                        })
                } else {
                    $shadow = $("<div>")
                                .addClass('source-shadow')
                                .css({  'z-index': -1 ,
                                            //'margin-top': c.framehg - 68 + c.bordersize,
                                            'width': c.framewd + c.bordersize,
                                            'height' :  c.framehg + c.bordersize
                                    }).appendTo($frame)
                        //$frame.addClass('source-shadow');
                }
            }

            return $shadow
        };
        
        /*
         * Determines is a frame is drawe as a circle
         * based on his class
         */
        function isCircle(item){
            return (item.cssclass && item.cssclass.indexOf("circle") > 0)
        };
        

        /* -------------------------------
         * BEGIN OF PUBLIC METHODS
         ---------------------------------*/
        
        /*
         * updates all frames position 
         */
        this.fiUpdateFrames = function() {
            var i = 0;
            
            if(!this.frameItems)
                return
                
            processImage();
            
            for(i = 0; i < this.frameItems.length; i++) {
                
                this.frameItems[i].$item.stop(true)
                $.extend(this.frameItems[i], this.useroptions.config[i])

                processFrame(this.frameItems[i],i);

                drawFrame(this.frameItems[i], true)
                this.frameItems[i].$item.animate({
                        'top': this.frameItems[i].top,
                        'left': this.frameItems[i].left
                    }, frameAnimationEnd)
            }

        }
        
        this.load = function (cbLoaded) {
            if(typeof cbLoaded == 'function') {
                f.o.cbFinished = cbLoaded;
                if(this.finished)
                    f.o.cbFinished.call(this);
            }
        }
        /*
         * Removes all DOM objects representing frames
         * We use it when we need to redraw frames in
         * responsive enviroment 
         */
        this.fiRemove = function() {
            this.$el.removeData($.frameit.name);
            this.$el.children('div,a').stop(true).fadeOut(200,function(){$(this).remove()})
        };
        /* -------------------------------
         * END OF PUBLIC METHODS
         ---------------------------------*/        

        /*
         * Animates every frame according 
         * to his position on the screen
         */  
        function animateDirections(dir, it) {
            var cssProps, cssAnimate;
            switch(dir){
                case 'left': 
                    cssProps = {'top': it.top, 'left': -f.o.containerwd }
                    cssAnimate = { left: it.left }
                break;
                case 'bottom':
                    cssProps = {'left': it.left,'top': f.o.containerhg+it.framehg} 
                    cssAnimate = {'top': it.top }
                break;
                case 'right':
                    cssProps = {'top': it.top, 'left': f.o.containerwd+it.framewd}
                    cssAnimate = {'left': it.left }
                break;
                default: //case 'top':
                    cssProps = {'left': it.left, 'top': -f.o.containerhg }
                    cssAnimate = {'top': it.top }
                break;
            }
            it.$item
                .css(cssProps)
                .delay(it.delay)
                .animate(cssAnimate, it.duration, $.easing[it.easing]?it.easing:'linear', frameAnimationEnd)
        }

        /*
         * Animates all frames within the animation stack
         * passed by parameter. 
         * The stack must have a preconfigured frame with 
         * properties correctly setted.
         */
        function animateFrame(frameStack) {
            
            $.each(frameStack, function() {
                // here this represents the frame object 
                var it = this
                // check if frame has no animation setted
                if(!f.o.doanimate) {
                    // the frame its just positioned
                    it.$item
                        .hide()
                        .css({ 'top' : it.top*1, 'left' : it.left*1 })
                        .delay(300)
                        .fadeToggle('fast', frameAnimationEnd); // execute callback
                }
                else // manage direction for each frame 
                {
                    f.$el.queue(function() {
                                animateDirections(it.direction, it);
                                $(this).dequeue();
                            });
                }
            });
            // when reach end, star dequeue animations
            f.$el.dequeue();
            return;
        };
        /*
         * handles when frame animations end
         * and fires the a callback when all finished
         */
        function frameAnimationEnd() {
            f.animatedFrames = f.animatedFrames || 0;
            f.animatedFrames++;
            if(f.animatedFrames == f.frameItems.length){
                f.finished = true;
                f.o.cbFinished.call(f);
            }
            
        }

    } // end constructor
    
    /*
     * Adds a progress bar 
     * and handler for the slideshow timer
     */
    
    function ProgressBar ($el)  {
        
        this.barObj = $el.find('.frameit-probar');
        
        if( ! this.barObj.length ) {
            this.barObj = $('<span/>', {'class' :'frameit-probar'}).appendTo($el);
        }
        
        this.$el = $el;
        
        /* public methods */
          
        this.load = function(delay, complete) {
            
            this.cbComplete = complete;
            this.delay      = delay;
            this.target     = this.$el.width();
            
            this.start();
        },
        
        this.reset = function (){
            this.barObj.width(0);
            this.delay = 0;
        },
        
        this.pause = function(){
            this.barObj.stop(true, false);
        },
        
        this.start = function(){
            var that    = this,
                current = this.barObj.width(),
                resto   = (this.target - current) / this.target;

            this.barObj.animate({'width': this.target }, {
                duration: this.delay * resto,
                complete: function(){ 
                            that.reset(); 
                            that.cbComplete();
                    }
            })

            this.barObj.dequeue();
        }
    }
    
    /*
     * handles all slide in the slideshow
     */
    function fiSlideShow($el, p, snd) {
        var $images = $el.children('img').hide(),
            currentImg = 0, data, params, loopTimes, 
            fiObj, slidePaused = false, binded = false, 
            pBar = $el.data($.frameit.progressbar);
        
        if($images.length) {
            
            function startslide(){

                try { 
                    params = eval('({' + $images.eq(currentImg).attr('title') + '})')
                } catch(e) { params = {} }

                data =  $.extend({ // default slide options
                            loop: 1,
                            preset: 'default',
                            wait: 2000,
                            pauseonhover: false,
                            src: $images.eq(currentImg).attr('src') 
                        }, params);

                if (typeof loopTimes == 'undefined' && data.loop) { 
                    loopTimes = data.loop
                }
                
                // mouse detecto if pause on hover enabled
                if (data.pauseonhover && !binded) {
                    binded = true;
                    $el.mouseover(function() {
                            slidePaused = true;
                            pBar.pause();
                            return false;
                        })
                        .mouseleave(function(){
                            slidePaused = false;
                            pBar.start()
                            return false;
                        });
                }

                if(!slidePaused && loopTimes > 0) {
                    
                    // remove data if set
                    if($el.data($.frameit.name))
                        $el.data($.frameit.name).fiRemove();
                    
                    // creates new frames
                    // when all image area preload, load progressbar
                    fiObj = new FrameIt(   $el, 
                                           p || fipreset[data.preset], 
                                           $.extend({}, {
                                                src: data.src, 
                                                cbStarted: function(){
                                                        pBar.load(data.wait, startslide);
                                                }}, snd)
                     );
                    
                    // advance to next slide
                    nextslide();
                    
                }
                
                function nextslide() {
                    if ( ++currentImg == $images.length ) {
                        currentImg = 0; 
                        loopTimes --; 
                    }
                }
                
            }
            startslide();
        }               
    }
    /*
     * Plugin initialization
     * This code controls the plugin behavior
     */
    $.fn.frameit = function(p,s) {
        var frameitdata;

        // binds update frame position and size on resolution change
        $(window).bind('resize orientationchange', function() {
                var frameitdata = $('.frameit-container').data($.frameit.name);
                if(frameitdata) {
                    frameitdata.fiUpdateFrames();
                }
            });

        if((typeof p).match("object|undefined")) {
            return this.each(function () {
                frameitdata = $(this).data($.frameit.name);
                if(!frameitdata) {
                    $(this).data($.frameit.progressbar, new ProgressBar($(this)))
                    fiSlideShow($(this), p, s);
                }
            })
        }
        else {
            if(p === "data")
                return $(this).data($.frameit.name);
            else
                return this.each(function (i) {
                    frameitdata = $(this).data($.frameit.name);
                    if(frameitdata) {
                        switch(p) {
                            case "restart":
                                frameitdata.fiUpdateFrames();
                            break;
                            case "remove":
                                frameitdata.fiRemove();
                            break;
                        }
                    }
                });

        } // end switch
    };
    
})(jQuery, window);
