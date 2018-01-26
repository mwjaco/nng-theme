var nextGen = nextGen || {};

nextGen.ready = function(callback) {
  if (document.attachEvent ? document.readyState === 'complete' : document.readyState !== 'loading'){
    callback();
  } else {
    document.addEventListener('DOMContentLoaded', callback);
  }
};

nextGen.buildGrid = function() {
  var items = Array.from(document.querySelectorAll('.city-picker__item'));
  var totalRows = Math.floor(items.length / 2.5);
  var i;

  for (i = 0; i <= totalRows; i++) {
    var shiftOddRowsBy;
    var  shiftEvenRowsBy;

    if (i === 0) {
      shiftOddRowsBy = 1;
      shiftEvenRowsBy = 2;
    } else if (i % 2 === 1) {
      shiftOddRowsBy = i + 2;
      shiftEvenRowsBy = i + 3;
    } else {
      shiftOddRowsBy = i + 3;
      shiftEvenRowsBy = i + 4;
    }

    // Arrange first three of every five into odd rows
    items
      .slice(5 * i, 5 * i + 3)
      .forEach(function(item) {
        item.style.gridRow = shiftOddRowsBy + ' / span 2';
      });

    // Arrange last two of five into even rows
    items
      .slice(5 * i + 3, 5 * i + 5)
      .forEach(function(item) {
        item.style.gridRow = shiftEvenRowsBy + ' / span 2';
      });
  }
};

nextGen.ready(function() {
  nextGen.buildGrid();
});