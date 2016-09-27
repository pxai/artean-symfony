
    var xmlns = "http://www.w3.org/2000/svg",
    xlinkns = "http://www.w3.org/1999/xlink";
    var w = window,
    d = document,
    e = d.documentElement,
    g = d.getElementsByTagName('body')[0],
    width = w.innerWidth || e.clientWidth || g.clientWidth,
    height = w.innerHeight|| e.clientHeight|| g.clientHeight;
    
    console.log(width + ' ' + height);
//var width  = 1024,
//    height = 800;
var starfield = document.getElementById("starfield");
function randomBase(min, max) {
  return Math.random() * (max - min) + min;
}
function randomPos(max) {
 console.log('Entered here randomPos');
  return Math.floor(randomBase(-50, max+50));
}
function randomScale(min, max) {
 console.log('Entered here');
  return parseFloat(randomBase(min, max).toFixed(2));
}
function randomScaleNamed(name) {
 console.log('Entered here randomScale');

  var scale;
  switch(name) {
  case 'star': scale = randomScale(0.3, 0.8); break;
  case 'burst': scale = randomScale(0.4, 0.9); break;
  case 'steeler': scale = randomScale(1.1, 2.0); break;
  default: scale = 1.0; }
  return scale;
}
function addElement(name) {
  var g   = document.createElementNS(xmlns, "g"),
      use = document.createElementNS(xmlns, "use"),
      t   = 'translate(' + randomPos(width) + ',' + randomPos(height) + ') ' +
            'scale(' + randomScaleNamed(name) + ')';
  use.setAttributeNS(null, "class", name);
  use.setAttributeNS(xlinkns, "xlink:href", "#" + name);
  g.setAttributeNS(null, "transform", t);
  g.appendChild(use);
  starfield.appendChild(g);
}
function addElements(name, count) {
  while (count -= 1) { addElement(name); }
}

addElements('steeler', 15);
addElements('burst', 15);
addElements('star', 50);