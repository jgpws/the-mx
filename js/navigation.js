/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, submenuButton, menu, links, subMenus, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	
	// set initial menu state here, instead of CSS file, in case JavaScript is turned off in browser.
	var windowWidth = window.innerWidth;
	var submenuButton = document.querySelectorAll( '.main-navigation .menu-down-arrow' );
	
	window.addEventListener( 'resize', function(event) {
		var windowWidth = window.innerWidth;
		if (timeOut != null) {
			clearTimeout(timeOut);
		}
		
		var timeOut = setTimeout(function() {
			if (windowWidth < 600) {
				menu.style.display = 'none';
				for (var i = 0; i < submenuButton.length; i++) {
					submenuButton[i].style.display = 'none';
				}
			} else {
				menu.style.display = 'flex';
				for (var i = 0; i < submenuButton.length; i++) {
					submenuButton[i].style.display = 'inline';
				}
			}
		}, 250 );
	} );
	
	window.addEventListener( 'load', function(event) {
		var windowWidth = window.innerWidth;
		if ( windowWidth < 600 ) {
			menu.style.display = 'none';
			for ( var i = 0; i < submenuButton.length; i++ ) {
				submenuButton[i].style.display = 'none';
			}
		} else {
			menu.style.display = 'flex';
			for ( var i = 0; i < submenuButton.length; i++ ) {
				submenuButton[i].style.display = 'inline';
			}
		}
	} );
	
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = toggleMenu;
	
	function toggleMenu() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
			menu.style.display = 'none';
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
			menu.style.display = 'flex';
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )();
