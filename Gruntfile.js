module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        bowercopy: {
	        options: {
				clean: true,
                runBower: false,
                destPrefix: ''
	        },

            
    			frontEnd: {
    				files: {
                        '.' : 'front-end-boilerplate'
    				}
    			},
                styleguide: {
                    files: {
                        'styleguide/core' : 'style-guide-core'
                    }
                },
            

            
    			wordpress: {
    				files: {
    					'.' : 'wordpress-boilerplate'
    				}
    			}
            
	    }

    });

	grunt.loadNpmTasks('grunt-bowercopy');

    grunt.registerTask('initialise', ['bowercopy']);
};
