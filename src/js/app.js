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

      if (document.body.classList) {
        document.body.classList.toggle('body--nav-open');
      } else {
        document.body.className = nextGen.createClassList(document.body, 'body--nav-open');
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

nextGen.handleResize = function() {
  window.addEventListener('resize', function() {
    var smallDeviceWidth = 480;
    var viewportWidth = window.innerWidth;
    var toggleButton = document.querySelector('.nav__button');
    var navigation = document.querySelector('.nav__nav-bar');
    if (viewportWidth > smallDeviceWidth) {
      if (toggleButton.classList) {
        toggleButton.classList.remove('nav__button--active');
      } else {
        toggleButton.className = toggleButton.className.replace(new RegExp('(^|\\b)' + 'nav__button--active'.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      }

      if (navigation.classList) {
        navigation.classList.remove('nav__nav-bar--active');
      } else {
        navigation.className = document.body.className.replace(new RegExp('(^|\\b)' + 'nav__nav-bar--active'.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      }
    }
  })
}

nextGen.ready(function() {
  nextGen.fadeScreen();
  nextGen.toggleMenu();
  nextGen.toggleModal();
  nextGen.handleResize();
});