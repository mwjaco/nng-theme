var nextGen=nextGen||{};nextGen.ready=function(e){(document.attachEvent?"complete"===document.readyState:"loading"!==document.readyState)?e():document.addEventListener("DOMContentLoaded",e)},nextGen.createClassList=function(e,n){var t=e.className.split(" "),a=t.indexOf(n);return a>=0?t.splice(a,1):t.push(n),t.join(" ")},nextGen.toggleMenu=function(){var e=document.querySelector(".nav__button"),n=document.querySelector(".nav__nav-bar");e&&e.addEventListener("click",function(t){e.classList?e.classList.toggle("nav__button--active"):e.className=nextGen.createClassList(e,"nav__button--active"),n.classList?n.classList.toggle("nav__nav-bar--active"):n.className=nextGen.createClassList(n,"nav__nav-bar--active"),document.body.classList?document.body.classList.toggle("body--nav-open"):document.body.className=nextGen.createClassList(document.body,"body--nav-open"),t.preventDefault()})},nextGen.toggleModal=function(){var e=document.querySelectorAll(".contact-form");Array.prototype.forEach.call(e,function(e){e.addEventListener("click",function(e){e.stopPropagation()})});var n=document.querySelectorAll(".contact-form__state");Array.prototype.forEach.call(n,function(e){e.addEventListener("change",function(){this.checked?document.body.classList?document.body.classList.add("body--modal-open"):document.body.className+=" body--modal-open":document.body.classList?document.body.classList.remove("body--modal-open"):document.body.className=document.body.className.replace(new RegExp("(^|\\b)"+"body--modal-open".split(" ").join("|")+"(\\b|$)","gi")," ")})})},nextGen.fadeScreen=function(){var e=document.querySelectorAll(".contact-form__state"),n=document.querySelectorAll(".contact-form__fade-screen");Array.prototype.forEach.call(n,function(n){n.addEventListener("click",function(){Array.prototype.forEach.call(e,function(e){e.checked=!1}),document.body.classList?document.body.classList.remove("body--modal-open"):document.body.className=document.body.className.replace(new RegExp("(^|\\b)"+"body--modal-open".split(" ").join("|")+"(\\b|$)","gi")," ")})})},nextGen.handleResize=function(){window.addEventListener("resize",function(){var e=window.innerWidth,n=document.querySelector(".nav__button"),t=document.querySelector(".nav__nav-bar");e>480&&(n.classList?n.classList.remove("nav__button--active"):n.className=n.className.replace(new RegExp("(^|\\b)"+"nav__button--active".split(" ").join("|")+"(\\b|$)","gi")," "),t.classList?t.classList.remove("nav__nav-bar--active"):t.className=t.className.replace(new RegExp("(^|\\b)"+"nav__nav-bar--active".split(" ").join("|")+"(\\b|$)","gi")," "),document.body.classList?body.classList.remove("body--nav-open"):document.body.className=document.body.className.replace(new RegExp("(^|\\b)"+"body--nav-open".split(" ").join("|")+"(\\b|$)","gi")," "))})},nextGen.ready(function(){nextGen.fadeScreen(),nextGen.toggleMenu(),nextGen.toggleModal(),nextGen.handleResize()});
//# sourceMappingURL=bundle.js.map
