var webpack = require('webpack');
var path = require('path');

const config = {
	entry: {
		'main': './assets/js/main.js',
		'impact-stories': './assets/js/impact-stories.js'
	},
	output: {
		filename: '[name].min.js'
	},
	module: {
		rules: [
			{
				test: /\.vue$/,
				loader: 'vue-loader'
			},
            {
                test: /\.js$/, // include .js files
                exclude: /node_modules/, // exclude any and all files in the node_modules folder
                loader: "babel-loader"
            },
            {
                test: /\.json$/, // include .js files
                exclude: /node_modules/, // exclude any and all files in the node_modules folder
                loader: "json"
            }
        ]
	},
	resolve: {
		extensions: ['.js'],
		alias: {
			vue: 'vue/dist/vue.esm.js'
		}
	},
	plugins: [
    	new webpack.optimize.UglifyJsPlugin({
    		compress: { warnings: false }
    	})
	]
};

module.exports = config;
