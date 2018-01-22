function ready(callback) {
  if (document.attachEvent ? document.readyState === 'complete' : document.readyState !== 'loading'){
    callback();
  } else {
    document.addEventListener('DOMContentLoaded', callback);
  }
}

function updateRows() {
  var bodyStyle = window.getComputedStyle(document.querySelector('html'));
  var numOfRows = parseInt(bodyStyle.getPropertyValue('--numOfRows'));
  var totalItems = document.querySelectorAll('.city-picker__item').length;
  var totalRowsForItems = Math.floor(totalItems / 2.5);
  if (numOfRows !== totalRowsForItems) {
    document.documentElement.style.setProperty('--numOfRows', totalRowsForItems);
  }
}

ready(function() {
  updateRows();
});