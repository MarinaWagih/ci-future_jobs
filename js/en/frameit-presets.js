/*!
 * FrameIt jQuery Plugin Presets File
 * Version: 2.1
 * By: Geedmo
 * Created: 2/10/2012
 * Last update: 20/12/2012
 *
 * This a javascript definition file for
 * some preset that could be customized.
 * You can edit this file and drop all the presets
 * not used in the project to make it lightweight.
 */

var fipreset = {};
fipreset ['bubble-1'] = {
    preset: 'bubble-1',
	baseclass: 'frame-circle',
	config: [
		{
			top: 0.215,
			left: 0.1,
			radius: 0.3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 900,
			delay: 800
		},
		{
			radius: 0.5,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			shadow: false,
			duration: 500,
			delay: 1500,
			location: function(p) {
				 var d = this._radius * (0.5);
				 this.top = p.top + (d * Math.sin(70*3.14/180)); //  horizontal	
				 this.left = p.left + (d * Math.sin(10*3.14/180));  // vertical
				 return; 
				 }  
		},
		{
			radius: 0.7,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			shadow: false,
			duration: 1500,
			delay: 800,
			location: function(p) {
				 var d = this._radius * (0.55);
				 this.top = p.top - (d * Math.sin(30*3.14/180)); //  horizontal	
				 this.left = p.left + (d * Math.sin(90*3.14/180));  // vertical
				 return; 
				 }  
		},
		{
			radius: 0.35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 1500,
			location: function(p) {
				 var d = this._radius * (1);
				 this.top = p.top - (d * Math.sin(40*3.14/180)); //  horizontal	
				 this.left = p.left + (d * Math.sin(80*3.14/180));  // vertical
				 return; 
				 }
		},
		{
			radius: 0.45,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 100,
			location: function(p) {
				 var d = this._radius * (1.2);
				 this.top = p.top + (d * Math.sin(60*3.14/180)); //  horizontal	
				 this.left = p.left + (d * Math.sin(20*3.14/180));  // vertical
				 return; 
				 }
		}
	]
};
 
/*
 * bubble landscape
 */

fipreset ['bubble-2'] = {
    preset: 'bubble-2',
	baseclass: 'frame-circle',
	config: [
		{
			top: 0.4,
			left: 0.1,
			radius: 0.5,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 800,
			delay: 700
		},
		{
			radius: 0.5,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 800,
			delay: 1100,
			location: function(p) {
				 var d = this._radius * (1.6);
				 this.top = p.top	
				 this.left = p.left + d;
				 return; 
				 }  
		},
		{
			radius: 0.8,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 2100,
			easing: 'easeOutBounce',
			location: function(p) {
				 var d = this._radius * (0.7);
				 this.top = p.top - (this._radius - p._radius);	
				 this.left = p.left - d;
				 return; 
				 }  
		}
	]
};

/*
 * bubble landscape
 */

fipreset ['bubble-3'] = {
	preset: 'bubble-3',
	baseclass: 'frame-circle',
	config: [
		{
			top: .37,
			left: .6,
			radius: 0.55,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1000,
			shadow: false
		},
		{
			radius: 0.9,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1400,
			shadow: false,
			location: function(p) {
				 var d = this._radius * (.7);
				 this.top = p.top - (d * Math.sin(30*3.14/180)); //  horizontal	
				 this.left = p.left - d;
				 }  
		},
		{
			radius: 0.25,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 500,
			delay: 1900,
			location: function(p) {
				 var d = this._radius * (.5);
				 this.top = p.top - (d * Math.sin(21*3.14/180)); //  horizontal	
				 this.left = p.left - (d * Math.sin(5*3.14/180));  // vertical
				 }  
		}
	]
};

/*
 * bubble landscape
 */

fipreset ['bubble-4'] = {
    preset: 'bubble-4',
	baseclass: 'frame-circle',
	config: [
		{
			top: .4,
			left: .05,
			radius: 0.55,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1000,
			shadow: false
		},
		{
			radius: 0.9,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1400,
			shadow: false,
			location: function(p) {
				 var d = this._radius * (.7);
				 this.top = p.top - (d * Math.sin(30*3.14/180)); //  horizontal	
				 this.left = p.left + d * 0.6;
				 }  
		},
		{
			radius: 0.25,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 500,
			delay: 1900,
			location: function(p) {
				 var d = this._radius * (.5);
				 this.top = p.top - (d * Math.sin(20*3.14/180)); //  horizontal	
				 this.left = p.left + (d * 5);  // vertical
				 }  
		}
	]
};

/*
 * bubble landscape
 */

fipreset ['bubble-5'] = {
    preset: 'bubble-5',
	baseclass: 'frame-circle',
	cloud: true,
	config: [
		{
			top: 0.2,
			left: 0.05,
			radius: 0.6,
			bordersize: 0.03,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 500,
			delay: 1400
		},
		{
			top: 0.2,
			left: 0.6, 
			radius: 0.6,
			bordersize: 0.03,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 500,
			delay: 1600
		},
		{
			top: 0.1,
			left: 0.25,
			radius: 0.8,
			bordersize: 0.03,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 2100,
			easing: 'easeOutBounce'
		}
	]
};

fipreset ['bubble-6'] = {
    preset: 'bubble-6',
	baseclass: 'frame-circle',
	config: [
		{
			top: 0.1,
			left: 0.05,
			radius: 0.4,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1400
		},
		{
			top: 0.2,
			left: 0.3,
			radius: 0.4,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1800
		},
		{
			top: 0.3,
			left: 0.55, 
			radius: 0.4,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 2200
		}
	]
};

fipreset ['bubble-7'] = {
    preset: 'bubble-7',
	baseclass: 'frame-circle',
	config: [
		{
			top: 0.1,
			left: 0.6,
			radius: 0.4,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1400
		},
		{
			top: 0.2,
			left: 0.35,
			radius: 0.4,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1800
		},
		{
			top: 0.3,
			left: 0.1, 
			radius: 0.4,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 2200
		}
	]
};



fipreset ['bubble-8'] = {
    preset: 'bubble-8',
	baseclass: 'frame-circle',
	config: [
		{
			top: 0.1,
			left: 0.55,
			radius: 0.6,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1400
		},
		{
			top: 0.2,
			left: 0.3,
			radius: 0.4,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1800
		},
		{
			top: 0.25,
			left: 0.1, 
			radius: 0.3,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 2200
		}
	]
};

fipreset ['cloud-1'] = {
    preset: 'cloud-1',
	baseclass: 'frame-circle',
	cloud: true,
	config: [
		{
			top: 0.15,
			left: 0,
			radius: 0.5,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1400
		},
		{
			top: 0.2,
			left: 0.3,
			radius: 0.4,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1800
		},
		{
			top: 0.25,
			left: 0.55, 
			radius: 0.3,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 2200
		},
		{
			top: 0.3,
			left: 0.8, 
			radius: 0.2,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 2600
		}
	]
};

fipreset ['cloud-2'] = {
    preset: 'cloud-2',
	baseclass: 'frame-circle',
	cloud: true,
	config: [
		{
			top: 0.25,
			left: 0.1,
			radius: 0.3,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1400
		},
		{
			top: 0.2,
			left: 0.3,
			radius: 0.4,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1800
		},
		{
			top: 0.15,
			left: 0.5, 
			radius: 0.5,
			bordersize: 0.02,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 2200
		}
	]
};


fipreset['cloud-3'] = {
  preset:"cloud-3",
  cloud:true,
  baseclass:"frame-circle",  
  config: [{
    width:0.9,
    height:0.9,
    top:20,
    left:100,
    radius:0.8,
    bordersize:3,
    bordercolor:"#FFF",
    tinybordersize:1,
    tinybordercolor:"#AAA",
    direction:"bottom",
    duration:900,
    delay:800,
    location:function () {},
    easing:"easeOutElastic",
    shadow:true
},{
    width:0.9,
    height:0.9,
    top:20,
    left:200,
    radius:0.8,
    bordersize:3,
    bordercolor:"#FFF",
    tinybordersize:1,
    tinybordercolor:"#AAA",
    direction:"bottom",
    duration:900,
    delay:1000,
    location:function () {},
    easing:"easeOutElastic",
    shadow:true
},{
    width:0.9,
    height:0.9,
    top:20,
    left:300,
    radius:0.8,
    bordersize:3,
    bordercolor:"#FFF",
    tinybordersize:1,
    tinybordercolor:"#AAA",
    direction:"bottom",
    duration:900,
    delay:1200,
    location:function () {},
    easing:"easeOutElastic",
    shadow:true
}]} 

/*
 * circles
 * best fit: square images
 */

fipreset ['circles'] = {
    preset: 'circles',
	baseclass: 'frame-circle',
	cloud: false,
	config: [
		{// center top
			top: 0,
			left: .3,
			radius: 0.35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1000
		},
		{ // right top
			top: .15,
			left: 0.55,
			radius: 0.35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1000
		},
		{ //right bottom
			top: .45,
			left: 0.55,
			radius: 0.35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1000
		},  
		{ // center bottom
			top: .6,
			left: .3,
			radius: 0.35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1000
		},
		{ // left bottom
			top: .45,
			left: 0.05,
			radius: 0.35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1000
		},
		{ // left top
			top: .15,
			left: 0.05,
			radius: 0.35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1000
		},
		{ // center 
			top: .3,
			left: 0.3,
			radius: 0.35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 500,
			delay: 1000
		}
	]
};

fipreset ['social'] = {
    preset: 'social',
	baseclass: 'frame-circle',
	cloud: false,
	config: [
		{// center top
			top: 0.1,
			left: .4,
			radius: 0.15,
			bordersize: 0.01,
			bordercolor: '#d5d5d5',
			direction: 'top',
			duration: 700,
			delay: 1600,
			src: '',
			href: '#'
		},
		{ // right top
			top: .25,
			left: 0.65,
			radius: 0.15,
			bordersize: 0.01,
			bordercolor: '#d5d5d5',
			direction: 'right',
			duration: 700,
			delay: 1600,
			src: '',
			href: '#'
		},
		{ //right bottom
			top: .55,
			left: 0.65,
			radius: 0.15,
			bordersize: 0.01,
			bordercolor: '#d5d5d5',
			direction: 'right',
			duration: 700,
			delay: 1600,
			src: '',
			href: '#'
		},  
		{ // center bottom
			top: .7,
			left: .4,
			radius: 0.15,
			bordersize: 0.01,
			bordercolor: '#d5d5d5',
			direction: 'bottom',
			duration: 700,
			delay: 1600,
			src: '',
			href: '#'
		},
		{ // left bottom
			top: .55,
			left: 0.15,
			radius: 0.15,
			bordersize: 0.01,
			bordercolor: '#d5d5d5',
			direction: 'left',
			duration: 700,
			delay: 1600,
			src: '',
			href: '#'
		},
		{ // left top
			top: .25,
			left: 0.15,
			radius: 0.15,
			bordersize: 0.01,
			bordercolor: '#d5d5d5',
			direction: 'left',
			duration: 700,
			delay: 1600,
			src: '',
			href: '#'
		},
		{ // center 
			top: .3,
			left: 0.3,
			radius: 0.35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 800,
			delay: 800,
			src: ''
		}
	]
};


fipreset ['profile-1'] = {
    preset: 'profile-1',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.05,
			left: 0.1,
			width: .8,
			height: .5,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000,
			src: '',
			href: '#'
		},
		{
			top: 0.65,
			left: 0.35,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 1000,
			delay: 1000,
			src: '',
			href: '#'
		},
		{
			top: .65,
			left: 0,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 1000,
			delay: 1000,
			src: '',
			href: '#'
		},
		{
			top: 0.65,
			left: 0.7,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000,
			src: '',
			href: '#'
		}

	]
};

fipreset ['profile-2'] = {
    preset: 'profile-2',
	baseclass: 'frame-circle',
	config: [
		{
			top: 0,
			left: 0,
			radius: .8,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 800,
			src: ''
		},
		{
			top: .6,
			left: 0,
			radius: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 400,
			delay: 1400,
			src: '',
			href: '#'
		},		{
			top: 0.65,
			left: 0.35,
			radius: .3,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 400,
			delay: 2000,
			src: '',
			href: '#'
		},

		{
			top: 0.45,
			left: 0.65,
			radius: .3,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 800,
			delay: 2500,
			src: '',
			href: '#'
		}

	]
};


/*
 * preset portrait
 */ 	 
fipreset ['portrait-1'] = {
    preset: 'portrait-1',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.1,
			left: 0.1,
			width: .25,
			height: .7,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.1,
			left: 0.4,
			width: .525,
			height: .37,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.5,
			left: 0.4,
			width: .25,
			height: .39,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 900,
			delay: 1200
		},
		{
			top: 0.5,
			left: 0.7,
			width: .25,
			height: .33,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 500,
			delay: 1000
		}

	]
};



/*
 * preset portrait
 */ 	 
fipreset ['portrait-2'] = {
    preset: 'portrait-2',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.1,
			left: 0.2,
			width: .5,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.45,
			left: 0.15,
			width: .2,
			height: .35,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.45,
			left: 0.4,
			width: .3,
			height: .4,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 900,
			delay: 1200
		},
		{
			top: 0.1,
			left: 0.75,
			width: .2,
			height: .5,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 500,
			delay: 1000
		},
		{
			top: 0.65,
			left: 0.75,
			width: .2,
			height: .2,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 500,
			delay: 1000
		}
	]
};


/*
 * preset diptych
 */ 	 
fipreset ['diptych'] = {
	preset: 'diptych',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.1,
			left: 0.1,
			width: .4,
			height: .8,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.1,
			left: 0.55,
			width: .4,
			height: .8,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		}
	]
};

fipreset ['diptych-h'] = {
	preset: 'diptych-h',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.1,
			left: 0.1,
			width: .8,
			height: .4,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.55,
			left: 0.1,
			width: .8,
			height: .4,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		}
	]
};


/*
 * preset triptych
 */ 	 
fipreset ['triptych'] = {
	preset: 'triptych',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.15,
			left: 0.1,
			width: .25,
			height: .7,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000,
			shadow: true
		},
		{
			top: 0.1,
			left: 0.4,
			width: .25,
			height: .8,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500,
			shadow: true
		},
		{
			top: 0.15,
			left: 0.7,
			width: .25,
			height: .7,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000,
			shadow: true
		}
	]
};

fipreset ['triptych-h'] = {
	preset: 'triptych-h',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.1,
			left: 0.1,
			width: .75,
			height: .25,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000,
			shadow: true
		},
		{
			top: 0.4,
			left: 0.05,
			width: .85,
			height: .25,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500,
			shadow: true
		},
		{
			top: 0.7,
			left: 0.1,
			width: .75,
			height: .25,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000,
			shadow: true
		}
	]
};

/*
 * preset triptych square
 */ 	 
fipreset ['triptych-square'] = {
	preset: 'triptych-square',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.25,
			left: 0.1,
			width: .25,
			height: .25,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.25,
			left: 0.4,
			width: .25,
			height: .25,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.25,
			left: 0.7,
			width: .25,
			height: .25,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		}
	]
};


/*
 * preset quadriptych
 */ 	 
fipreset ['quadriptych'] = {
	preset: 'quadriptych',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.2,
			left: 0,
			width: .2,
			height: .6,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.1,
			left: 0.25,
			width: .2,
			height: .8,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.15,
			left: 0.5,
			width: .2,
			height: .8,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.2,
			left: 0.75,
			width: .2,
			height: .6,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		}
	]
};

fipreset ['quadriptych-h'] = {
	preset: 'quadriptych-h',
	baseclass: 'frame-square',
	config: [
		{
			top: 0,
			left: 0.2,
			width: .6,
			height: .2,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.25,
			left: 0.1,
			width: .8,
			height: .2,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.5,
			left: 0.15,
			width: .8,
			height: .2,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.75,
			left: 0.2,
			width: .6,
			height: .2,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		}
	]
};

/*
 * preset pentaptych
 */ 	
fipreset ['pentaptych'] = {
	preset: 'pentaptych',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.2,
			left: 0.05,
			width: .1,
			height: .6,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.1,
			left: 0.2,
			width: .15,
			height: .8,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.05,
			left: 0.4,
			width: .2,
			height: .9,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.1,
			left: 0.65,
			width: .15,
			height: .8,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.2,
			left: 0.85,
			width: .1,
			height: .6,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		}
	]
};

fipreset ['pentaptych-h'] = {
	preset: 'pentaptych-h',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.05,
			left: 0.2,
			width: .6,
			height: .1,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.2,
			left: 0.1,
			width: .8,
			height: .15,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.4,
			left: 0.05,
			width: .9,
			height: .2,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.65,
			left: 0.1,
			width: .8,
			height: .15,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.85,
			left: 0.2,
			width: .6,
			height: .1,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		}
	]
};


fipreset ['boxes'] = {
	preset: 'boxes',
	baseclass: 'frame-square',
	config: [
		{
			top: 0,
			left: 0,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0,
			left: 0.35,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0,
			left: 0.7,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 1000,
			delay: 1000
		},
		{
			top: .35,
			left: 0,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 800
		},
		{
			top: 0.35,
			left: 0.7,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 1000,
			delay: 1000
		},
		{
			top: .7,
			left: 0,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 800
		},
		{
			top: 0.7,
			left: 0.35,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.7,
			left: 0.7,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.2,
			left: 0.2,
			width: .6,
			height: .6,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		}
	]
};


fipreset ['boxes-2'] = {
	preset: 'boxes-2',
	baseclass: 'frame-square',
	config: [
		{
			top: 0.05,
			left: 0,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.05,
			left: 0.7,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 1000,
			delay: 1000
		},
		{
			top: .7,
			left: 0,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'right',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.7,
			left: 0.7,
			width: .3,
			height: .3,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'left',
			duration: 1000,
			delay: 1000
		},
		{
			top: 0.1,
			left: 0.2,
			width: .6,
			height: .4,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'top',
			duration: 1000,
			delay: 500
		},
		{
			top: 0.55,
			left: 0.2,
			width: .6,
			height: .4,
			bordersize: 0.01,
			bordercolor: '#FFF',
			direction: 'bottom',
			duration: 1000,
			delay: 500
		}

	]
};
