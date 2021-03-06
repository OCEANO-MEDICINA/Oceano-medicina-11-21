var data = [
  //{ id: '', color: '#3f297e', text: 'ALL IN', ikon: 'invert_colors' },
  { id: '', type: 'beca50', color: '#be0f34', text: 'BECA 50% <br> EN MKSAP', ikon: 'stars'},
  { id: '', type: 'quiz', color: '#06BF8C', text: '10% <span>OFF*</span>' },
  { id: '', type: 'ebook', color: '#1d61ac', text: 'Ebook <br>de regalo', ikon: 'redeem'},
  { id: '', type: 'book', color: '#169ed8', text: 'Bibliografía', ikon: 'book' },
  { id: '', type: 'quiz', color: '#06BF8C', text: '10% <span>OFF*</span>' },
  { id: '', type: 'quiz', color: '#209b6c', text: '20% <span>OFF*</span>' },
  { id: '', type: 'quiz', color: '#157359', text: '30% <span>OFF*</span>' },
  { id: '', type: 'ebook', color: '#1d61ac', text: 'Ebook <br>de regalo', ikon: 'redeem'},
  { id: '', type: 'quiz', color: '#06BF8C', text: '10% <span>OFF*</span>' },
  { id: '', type: 'replay', color: '#881f7e', text: 'TIRO GRATIS', ikon: 'replay' },
  { id: '', type: 'ebook', color: '#1d61ac', text: 'Ebook <br>de regalo', ikon: 'redeem'},

];

var RouletteWheel = function(el, items){
  this.$el = $(el);
  this.items = items || [];
  this._bis = false;
  this._angle = 0;
  this._index = 0;
  this.options = {
    angleOffset: -90
  }
}

_.extend(RouletteWheel.prototype, Backbone.Events);

RouletteWheel.prototype.spin = function(_index){
  
  var count = this.items.length;
  var delta = 360/count;
  var index = !isNaN(parseInt(_index))? parseInt(_index) : parseInt(Math.random()*count);
      
  var a = index * delta + ((this._bis)? 1440 : -1440);
  
  //a+=this.options.angleOffset;
  
  this._bis = !this._bis;
  this._angle = a;
  this._index = index;
  
  var $spinner = $(this.$el.find('.spinner'));
  
  var _onAnimationBegin = function(){
    this.$el.addClass('busy');
    this.trigger('spin:start',this);
  }
  
  var _onAnimationComplete = function(){
    this.$el.removeClass('busy');
    this.trigger('spin:end',this);
  }
  
  $spinner
  .velocity('stop')
  .velocity({
    rotateZ: a +'deg'
  },{
    easing: [20, 7],
    //easing: [200, 20],
    //easing: 'easeOutQuint',
    duration: 3000,
    begin: $.proxy(_onAnimationBegin,this),
    complete: $.proxy(_onAnimationComplete,this)
  });
  
}
  
RouletteWheel.prototype.render = function(){
  
  var $spinner = $(this.$el.find('.spinner'));
  var D = this.$el.width();
  var R = D*.5;

  var count = this.items.length;
  var delta = 360/count;
  
  for(var i=0; i<count; i++){
    
    var item = this.items[i];
    
    var color = item.color;
    var text = item.text;
    var ikon = item.ikon;
    
    var html = [];
    html.push('<div class="item" ');
    html.push('data-index="'+i+'" ');
    html.push('data-type="'+item.type+'" ');
    html.push('>');
    html.push('<span class="label">');
    if(ikon)
      html.push('<i class="material-icons">'+ikon+'</i>');
    html.push('<span class="text">'+text+'</span>');
    html.push('</span>');
    html.push('</div>');
    
    var $item = $(html.join(''));
    
    var borderTopWidth = D + D*0.0025; //0.0025 extra :D
    var deltaInRadians = delta * Math.PI / 180;
    var borderRightWidth = D / ( 1/Math.tan(deltaInRadians) );
    
    var r = delta*(count-i) + this.options.angleOffset - delta*.5;
    
    $item.css({
      borderTopWidth: borderTopWidth,
      borderRightWidth: borderRightWidth,
      transform: 'scale(2) rotate('+ r +'deg)',
      borderTopColor: color
    });
    
    var textHeight = parseInt(((2*Math.PI*R)/count)*.5);
        
    $item.find('.label').css({
      //transform: 'translateX('+ (textHeight) +'px) translateY('+  (-1 * R) +'px) rotateZ('+ (90 + delta*.5) +'deg)',
      transform: 'translateY('+ (D*-.25) +'px) translateX('+  (textHeight*1.03) +'px) rotateZ('+ (90 + delta*.5) +'deg)',
      height: textHeight+'px',
      lineHeight: textHeight+'px',
      textIndent: (R*.1)+'px'
    });
    
    $spinner.append($item);
       
  }
  
  $spinner.css({
    fontSize: parseInt(R*0.055)+'px'
  })
  
  //this.renderMarker();

  
}

RouletteWheel.prototype.renderMarker = function(){
  
  var $markers = $(this.$el.find('.markers'));
  var D = this.$el.width();
  var R = D*.5;

  var count = this.items.length;
  var delta = 360/count;
      
  var borderTopWidth = D + D*0.0025; //0.0025 extra :D
  var deltaInRadians = delta * Math.PI / 180;
  var borderRightWidth = (D / ( 1/Math.tan(deltaInRadians) ));

  var i = 0;  
  var $markerA = $('<div class="marker">');
  var $markerB = $('<div class="marker">');

  var rA = delta*(count-i-1) - delta*.5 + this.options.angleOffset;
  var rB = delta*(count-i+1) - delta*.5 + this.options.angleOffset;
    
  $markerA.css({
    borderTopWidth: borderTopWidth,
    borderRightWidth: borderRightWidth,
    transform: 'scale(2) rotate('+ rA +'deg)',
    borderTopColor: '#FFF'
  });
  $markerB.css({
    borderTopWidth: borderTopWidth,
    borderRightWidth: borderRightWidth,
    transform: 'scale(2) rotate('+ rB +'deg)',
    borderTopColor: '#FFF'
  })
  
  $markers.append($markerA);
  $markers.append($markerB);
  
}

RouletteWheel.prototype.bindEvents = function(){
  this.$el.find('.button').on('click', $.proxy(this.spin,this));
}


var spinner;
$(window).ready(function(){
  
  spinner = new RouletteWheel($('.roulette'), data);
  spinner.render();
  spinner.bindEvents();
  
  spinner.on('spin:start', function(r){ console.log('spin start!') });
  spinner.on('spin:end', function(r){ console.log('spin end! -->'+ r._index) });
  
})