import ClasslistPolyfill from './class-polyfill';

export default class MenuFilter {

	// pass in the table
	constructor(menu, search_input) {

		// set defaults
		// all nodes are selected by looking under the passed in table node
		// this prevents cross-contamination
		this.filter = '';
		this.menu = menu;
		this.dropdowns = menu.querySelectorAll('li[data-path-depth="0"]');
		this.menu_items = menu.querySelectorAll('[data-path-depth="1"] a');

		// set event listeners
		this.setSearch(search_input);

	}

	setSearch(search_input) {

		// add a click event listener to each
		search_input.addEventListener('input', () => {

			// update filter
			this.filter = search_input.value.toLowerCase();

			// then refresh the view
			this.refreshFilter();

		}, false);

	}

	refreshFilter() {

		// if there is a filter set
		if ( this.filter.length ) {

			ClasslistPolyfill.addClass(this.menu, 'search-active');

			// loop through each table row
			for ( let item of this.menu_items ) {

				// hide the row
				item.parentNode.style.display = 'none';

				// if the item matches the filter
				// display the item
				if ( item.textContent.toLowerCase().indexOf(this.filter) !== -1) {
					item.parentNode.style.display = 'block';
				}

			}

		}
		// otherwise reset all of the items
		else {

			ClasslistPolyfill.removeClass(this.menu, 'search-active');

			// loop through each table row
			for ( let item of this.menu_items ) {
				item.parentNode.style.display = 'block';
			}

		}

	}

	clearFilter() {

		// reset the filter
		this.filter = '';

		ClasslistPolyfill.removeClass(this.menu, 'search-active');

		// reset each table row
		for ( let item of this.menu_items ) {
			item.parentNode.style.display = 'block';
		}

	}

}
