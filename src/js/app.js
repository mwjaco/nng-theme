var nextGen = nextGen || {};

nextGen.ready = function(callback) {
  if (document.attachEvent ? document.readyState === 'complete' : document.readyState !== 'loading'){
    callback();
  } else {
    document.addEventListener('DOMContentLoaded', callback);
  }
};

nextGen.updateRows = function() {
  var bodyStyle = window.getComputedStyle(document.querySelector('body'));
  var numOfRows = parseInt(bodyStyle.getPropertyValue('--numOfRows'));
  var numOfItems = parseInt(bodyStyle.getPropertyValue('--numOfItems'));
  var totalItems = document.querySelectorAll('.city-picker__item').length;
  var totalRowsForItems = Math.floor(totalItems / 2.5);
  if (numOfItems !== totalItems) {
    document.documentElement.style.setProperty('--numOfItems', numOfItems);
  }
  if (numOfRows !== totalRowsForItems) {
    document.documentElement.style.setProperty('--numOfRows', totalRowsForItems * 2);
  }
};

nextGen.buildGrid = function() {
  var items = Array.from(document.querySelectorAll('.city-picker__item'));
  var n = Math.floor(items.length / 2.5);
  var counter;

  for (counter = 0; counter <= n; counter++) {
    if (counter && counter % 2 === 0) {
      var duo = items.slice(5 * counter + 3, 5 * counter + 5);
      duo.forEach(function(node, i) {
        node.style.gridRow = counter + 2 + ' / span 2';
      });
    } else {
      var trio = items.slice(5 * counter, 5 * counter + 3);
     trio.forEach(function(node, i) {
        node.style.gridRow = counter + ' / span 2';
      });
    }
  }
};

nextGen.ready(function() {
  nextGen.buildGrid();
});