
var makeFriendlyName = function(string) {
	return string.replace(/-/g, ' ');
};

var small = "(a|an|and|as|at|but|by|en|for|if|in|of|on|or|the|to|v[.]?|via|vs[.]?)";
var punct = "([!\"#$%&'()*+,./:;<=>?@[\\\\\\]^_`{|}~-]*)";

this.titleCaps = function(title){
	var parts = [], split = /[:.;?!] |(?: |^)["Ò]/g, index = 0;

	while (true) {
		var m = split.exec(title);

		parts.push( title.substring(index, m ? m.index : title.length)
			.replace(/\b([A-Za-z][a-z.'Õ]*)\b/g, function(all){
				return /[A-Za-z]\.[A-Za-z]/.test(all) ? all : upper(all);
			})
			.replace(RegExp("\\b" + small + "\\b", "ig"), lower)
			.replace(RegExp("^" + punct + small + "\\b", "ig"), function(all, punct, word){
				return punct + upper(word);
			})
			.replace(RegExp("\\b" + small + punct + "$", "ig"), upper));

		index = split.lastIndex;

		if ( m ) parts.push( m[0] );
		else break;
	}

	return parts.join("").replace(/ V(s?)\. /ig, " v$1. ")
		.replace(/(['Õ])S\b/ig, "$1s")
		.replace(/\b(AT&T|Q&A)\b/ig, function(all){
			return all.toUpperCase();
		});
};

function lower(word){
	return word.toLowerCase();
}

function upper(word){
	return word.substr(0,1).toUpperCase() + word.substr(1);
}

var doTree = function(data) {

	var items = [];

	$.each(data, function(key, value) {

		var hasChildren = typeof value !== "string",
			item = {
				name: key.replace('.html', ''),
				order: 9999
			};

		// check if the name has a priority
		if ( item.name.match('^[0-9]+[.]') !== null ) {
			item.order = parseInt(item.name.split('.')[0]);
			item.name = item.name.substring(item.name.indexOf('.') + 1);
		}

		if ( hasChildren ) {
			item.children = doTree(value);
		}

		if ( ! hasChildren ) {

			item.path = value;

			$.get('/styleguide/templates/' + value).done(function(html) {
				item.html = html;
			});

		}

		item.name = titleCaps(makeFriendlyName(item.name));

		items.push(item);

	});

	// sort the items by their order
	items.sort(function(a, b) { return a.order - b.order });

	return items;

};

// get just files from the
var flattenTree = function(tree) {

	var files = [];

	if ( typeof tree.items !== "undefined" ) {

		$.each(tree.items, function(key, value) {

			if ( typeof value.filepath !== "undefined" ) {
				files.push(value);
			}

			if ( typeof value.items !== "undefined" ) {
				Array.prototype.push.apply(files, flattenTree(value));
			}

		});

	}

	return files;

};

// define the item component
Vue.component('tree', {
	template: '#item-template',
	props: {
		model: Object
	},
	methods: {
		hasChildren: function(items) {
			return typeof items.items !== "undefined";
		}
	}
});

// define the item pattern
Vue.component('pattern', {
	template: '#pattern-template',
	props: {
		model: Array
	},
	methods: {
		hasChildren: function(item) {
			return typeof item.items !== "undefined";
		}
	}
});

var css = null;

// boot up the demo
var demo = new Vue({

	el: 'body',

	ready: function() {
		this.fetchData();
	},

	data: {
		treeData: {items: {}},
		search: ''
	},

	computed: {
		flatTreeData: function () {
			return flattenTree(this.treeData);
		}
	},

	watch: {
		'treeData':  {
			handler: function() {
				this.applyCSS();
			},
			deep: true
		}
	},

	methods: {
		filterPatterns: function() {
			this.treeData = this.setFilter(this.treeData, this.search);
		},
		setFilter: function(map, search) {

			var re = new RegExp(search, "gi");

			$.each(map.items, function(key, value) {

				var changes = false;

				map.items[key].display = true;

				if ( map.items[key].name.match(re) === null ) {
					map.items[key].display = false;
				}

				if ( typeof map.items[key].items !== "undefined" ) {

					map.items[key] = this.setFilter(map.items[key], search);

					$.each(map.items[key].items, function(key, value) {

						if ( value.display === true ) {
							changes = true;
						}

					});

				}

				if ( changes === true ) {
					map.items[key].display = true;
				}

			}.bind(this));

			return map;

		},
		getCSS: function() {

			// set the CSS var to empty to signify it's no longer
			// null, and thus we don't need to keep re-fetching

			css = '';

			$.get('/assets/css/styles.min.css', function(data) {

				// apply the response to the css var
				css = data;

				// apply the styles
				this.applyCSS();

			}.bind(this));

		},
		applyCSS: function() {

			if ( css !== null ) {

				$('style[scoped]').html(css);

				var DOMContentLoaded_event = document.createEvent("Event");
				DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true);
				window.document.dispatchEvent(DOMContentLoaded_event);

			} else {
				this.getCSS();
			}

		},
		fetchData: function() {

			$.getJSON('./paths.json').done(function(data) {

				// apply the file structure to the vue app
				demo.treeData = data;

				demo.flatTreeData = flattenTree(data);

				this.$nextTick(function() {
					this.applyCSS();
				});

			}.bind(this));

		}
	}
});



