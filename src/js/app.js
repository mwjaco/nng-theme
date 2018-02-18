var nextGen = nextGen || {};

nextGen.ready = function(callback) {
  if (document.attachEvent ? document.readyState === 'complete' : document.readyState !== 'loading'){
    callback();
  } else {
    document.addEventListener('DOMContentLoaded', callback);
  }
};

nextGen.createClassList = function(el, className) {
  var classes = el.className.split(' ');
  var existingIndex = classes.indexOf(className);

  if (existingIndex >= 0)
    classes.splice(existingIndex, 1);
  else
    classes.push(className);

  return classes.join(' ');
}

nextGen.toggleMenu = function() {
  var toggleButton = document.querySelector('.nav__button');
  var navigation = document.querySelector('.nav__nav-bar');
  if (toggleButton) {
    toggleButton.addEventListener('click', function(e) {
      if (toggleButton.classList) {
        toggleButton.classList.toggle('nav__button--active')
      } else {
        toggleButton.className = nextGen.createClassList(toggleButton, 'nav__button--active');
      }

      if (navigation.classList) {
        navigation.classList.toggle('nav__nav-bar--active')
      } else {
        navigation.className = nextGen.createClassList(navigation, 'nav__nav-bar--active');
      }
      e.preventDefault();
    });
  }
}

nextGen.toggleModal = function() {
  var modals = document.querySelectorAll('.contact-form');
  Array.prototype.forEach.call(modals, function(modal) {
    modal.addEventListener('click', function(e) {
      e.stopPropagation();
    })
  })

  var toggleStates = document.querySelectorAll('.contact-form__state');
  Array.prototype.forEach.call(toggleStates, function(toggleState) {
    toggleState.addEventListener('change', function() {
      if (this.checked) {
        if (document.body.classList) {
          document.body.classList.add('body--modal-open');
        } else {
          document.body.className += ' ' + 'body--modal-open';
        }
      } else {
        if (document.body.classList) {
          document.body.classList.remove('body--modal-open');
        } else {
          document.body.className = document.body.className.replace(new RegExp('(^|\\b)' + 'body--modal-open'.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        }
      }
    });
  });
}

nextGen.fadeScreen = function() {
  var toggleStates = document.querySelectorAll('.contact-form__state');
  var fadeScreens = document.querySelectorAll('.contact-form__fade-screen');
  Array.prototype.forEach.call(fadeScreens, function(fadeScreen) {
    fadeScreen.addEventListener('click', function() {
      Array.prototype.forEach.call(toggleStates, function(toggle) {
        toggle.checked = false;
      });


      if (document.body.classList) {
        document.body.classList.remove('body--modal-open');
      } else {
        document.body.className = document.body.className.replace(new RegExp('(^|\\b)' + 'body--modal-open'.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      }
    });
  });
}

nextGen.buildGrid = function() {  
  var items = Array.from(document.querySelectorAll('.city-picker__item'));
  if (items.length === 0) {
    return;
  }
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
    items.slice(5 * i, 5 * i + 3)
      .forEach(function(item) {
        item.style.gridRow = shiftOddRowsBy + ' / span 2';
      });

    // Arrange last two of five into even rows
    items.slice(5 * i + 3, 5 * i + 5)
      .forEach(function(item) {
        item.style.gridRow = shiftEvenRowsBy + ' / span 2';
      });
  }
};

nextGen.buildLandingPage = function() {
  // Round up all the items excluding the big diamond
  var items = Array.from(document.querySelectorAll('.landing__item:not(:first-of-type)'));
  if (items.length === 0) {
    return;
  }
  var bottomLineBreak = document.querySelector('.landing__line-break-wrapper--bottom');
  var totalRows = Math.floor(items.length / 1.5) || 1;
  var i;

  for (i = 0; i < totalRows; i++) {
    var shiftOddRowsBy = 4;
    var shiftEvenRowsBy = 5;
    shiftOddRowsBy = shiftOddRowsBy + (i * 2);
    shiftEvenRowsBy = shiftEvenRowsBy + (i * 2);

    // Arrange first two of every three into odd rows
    items.slice(3 * i, 3 * i + 2)
      .forEach(function(item) {
        item.style.gridRow = shiftOddRowsBy + '/ span 2';
      });

    // Arrange the third of every three into even rows;
    items.slice(3 * i + 2, 3 * i + 3)
      .forEach(function(item) {
        item.style.gridRow = shiftEvenRowsBy + ' / span 2';
      });
  }

  if (items.length % 3 === 0) {
    bottomLineBreak.style.display = 'none';
  } else {
    bottomLineBreak.style.gridRow = totalRows + 3 + '/ -1';
  }
};

nextGen.ready(function() {
  nextGen.fadeScreen();
  nextGen.buildLandingPage();
  nextGen.buildGrid();
  nextGen.toggleMenu();
  nextGen.toggleModal();
});