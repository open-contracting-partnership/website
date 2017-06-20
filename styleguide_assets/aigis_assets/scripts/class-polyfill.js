export default class ClasslistPolyfill {

	static addClass(el, className) {

		if ( el.classList ) {
			el.classList.add(className);
		} else {
			el.className += ' ' + className;
		}
	}

	static removeClass(el, className) {

		if ( el.classList ) {
			el.classList.remove(className);
		} else {
			el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
		}
	}

	static toggleClass(el, className) {

		if ( el.classList ) {
			el.classList.toggle(className);
		} else {
			let classes = el.className.split(' ');
			let existingIndex = classes.indexOf(className);

			if (existingIndex >= 0) {
				classes.splice(existingIndex, 1);
			} else {
				classes.push(className);
			}

			el.className = classes.join(' ');
		}
	}

	static hasClass(el, className) {

		if ( el.classList ) {
			return el.classList.contains(className);
		} else {
			return new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
		}
	}
}
