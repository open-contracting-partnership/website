import ClasslistPolyfill from './class-polyfill';

class Styleguide {

	constructor() {

		this.options = {
			previews: this.checkPreviews(),
		};

		this.modal = document.querySelector('.aigis-contents__preview');

		// create a template modal wrapper
		// this will be cloned to wrap the single component preview code
		this.modal_template = document.createElement('div');
		ClasslistPolyfill.addClass(this.modal_template, 'aigis-modal__item');

		// initialise the page
		this.initialiseStyleguide();

	}

	checkPreviews() {

		const preview_array = Array.from(document.querySelectorAll('.aigis-preview'));

		return preview_array.length ? true : false;

	}

	openModal() {
		ClasslistPolyfill.addClass(document.body, 'aigis-modal--active');
	}

	closeModal() {

		// fix the URL
		history.pushState("", document.title, window.location.pathname + window.location.search);

		ClasslistPolyfill.removeClass(document.body, 'aigis-modal--active');

	}

	checkHash() {

		// get the URL hash
		const hash = window.location.hash;
		let preview;

		// if there is a hash
		if ( hash ) {

			// check that the hash relates to an element
			preview = document.querySelector(hash);

			// if it does, open the single component view
			if ( preview !== null ) {
				this.addPreview(preview);
			}

		}
		// else close the modal
		else {
			this.closeModal();
		}

	}

	setMainActiveClass() {

		// search up through the menu to expand the current dropdown
		let current_item = document.querySelector('.aigis-header__navigation > ul:first-child [data-tree-current]');

		if ( current_item !== null ) {

			let searching = true;

			// search up through the menu items
			// until the top level
			while (searching) {

				// if the current item is the top-level parent
				// set active class and stop searching
				if ( current_item.getAttribute('data-path-depth') === '0' ) {

					ClasslistPolyfill.addClass(current_item, 'is-active');

					searching = false;

				}
				else {
					current_item = current_item.parentNode;
				}

			}

		}

	}

	setSubActiveClass() {

		// search up through the menu to expand the current dropdown
		let current_item = document.querySelector('.aigis-header__sub-navigation [data-tree-current]');

		if ( current_item !== null ) {
			ClasslistPolyfill.addClass(current_item, 'is-active');
		}

	}

	createSubNav() {

		const current_menu = document.querySelector('.aigis-header__navigation li[data-path-depth="0"].is-active > ul');
		const sub_nav = document.querySelector('.aigis-header__sub-navigation');

		if ( current_menu !== null ) {
			sub_nav.innerHTML = current_menu.innerHTML;
		}

	}

	/**
	 * hash_selector: the selected element using the URL hash as an ID
	 */
	addPreview(hash_selector) {

		let current_item = hash_selector.nextElementSibling;

		let searching = true;

		// search through next siblings
		// until the preview code is found
		while ( searching ) {

			if ( ClasslistPolyfill.hasClass(current_item, 'aigis-preview') === true ) {

				searching = false;

				// clone in the modal template wrapper
				let modal_item = this.modal_template.cloneNode();

				// set the modal html as the current preview code
				modal_item.innerHTML = current_item.innerHTML;

				// append the modal wrapper
				this.modal.innerHTML = modal_item.innerHTML;

				this.openModal();

			}
			else {
				current_item = current_item.nextElementSibling;
			}

		}

	}

	setPreviewLinks() {

		const link_icon = document.querySelector('.link-icon');

		// setup the hash anchor element
		let link_template = document.createElement('a');
		link_template.appendChild(link_icon.cloneNode(true));
		ClasslistPolyfill.addClass(link_template, 'preview-link');

		// get all preview titles
		const preview_titles = Array.from( document.querySelectorAll('.aigis-module > [id]') );

		// loop through each title
		preview_titles.forEach(title => {

			// get the title id
			// replace all non-alphanumeric characters with dashes
			// e.g. spaces, ampersands
			// convert it to lowercase
			const new_title_id = title.id
				.replace(/\W+/g, '-')
				.toLowerCase();

			// replace the title id with the new clean version
			title.id = new_title_id;

			// clone the hash anchor
			let title_link = link_template.cloneNode(true);

			// apply the current id as the href
			title_link.href = `#${new_title_id}`;

			// if there's a hash already and the same link has been clicked
			// re-open the modal
			title_link.addEventListener('click', (event) => {

				if ( event.currentTarget.hash === window.location.hash ) {
					this.openModal();
				}

			}, false);

			// append the anchor to the title
			title.appendChild(title_link);

		});

	}

	setupPreviews() {

		// add a listener for a hash change
		window.addEventListener('hashchange', () => {
			this.checkHash();
		});

		// setup the preview links next to the titles
		this.setPreviewLinks();

		// check to see if we've loaded in with a hash link
		this.checkHash();

		document.querySelector('.aigis-header__close').addEventListener('click', this.closeModal, false);

	}

	setupColors() {

		let colors = Array.from(document.querySelectorAll('.aigis-preview > .aigis-colorpalette'));

		if ( colors.length ) {

			colors.forEach(color => {
				ClasslistPolyfill.addClass(color.parentNode, 'aigis-preview--color');
			});

		}

	}

	initialiseStyleguide() {

		this.setMainActiveClass();
		this.createSubNav();
		this.setSubActiveClass();
		this.setupColors();

		if ( this.options.previews ) {
			this.setupPreviews();
		}

	}

}

// wrap this all in an IIFE
// doesn't pollute the global scope
(() => {

	// create a new instance of the Styleguide class
	const app = new Styleguide();

})();
