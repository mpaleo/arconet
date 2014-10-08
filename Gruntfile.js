module.exports = function(grunt){

	grunt.initConfig({

		// JS
		uglify:
		{
			options:
			{
				preserveComments: false,
				banner: '/*Michael Paleo*/\n$(document).ready(function(){',
				footer: '});'
			},
			login:
			{
				files:
				{
					'public/js/login-main.min.js': ['public/js/src/script-login.js']
				}
			},
			dashboard:
			{
				files:
				{
					'public/js/dashboard-main.min.js': ['public/js/src/bootstrap.min.js', 'public/js/src/script-dashboard.js']
				}
			}
		},

		// CSS
		cssmin:
		{
			options:
			{
				banner: '/*Michael Paleo*/'
			},
			login:
			{
				files:
				{
					'public/css/login-main.min.css': ['public/css/src/bootstrap.min.css', 'public/css/src/style-login.css']
				}
			},
			dashboard:
			{
				files:
				{
					'public/css/dashboard-main.min.css': ['public/css/src/bootstrap.min.css', 'public/css/src/style-dashboard.css'],
					'public/css/pace-theme.min.css': ['public/css/src/pace-theme.css']
				}
			}
		}

	});

	// Tasks
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	// Default task
	grunt.registerTask('default', ['uglify', 'cssmin']);
}
