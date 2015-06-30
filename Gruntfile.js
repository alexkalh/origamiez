module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    jshint: {
      options: {
        reporter: require('jshint-stylish')
      }
    },    
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %> */',
      },
      assets: {
        files: {          
          'assets/origamiez.min.js': 'assets/origamiez.js'
        }
      }
    },
    cssmin: {
      options: {
        keepSpecialComments: 0
      },
      target: {
        files: {
          'assets/origamiez.min.css': ['assets/origamiez.css']
        }
      }
    },
    concat: {
      options: {
        separator: '',
        stripBanners: true,
        banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %> */',
      },
      css: {
        src: ['css/bootstrap.css', 'css/bootstrap-theme.css', 'css/font-awesome.css', 'css/jquery.navgoco.css', 'css/jquery.poptrox.css', 'css/owl.carousel.css', 'css/owl.theme.css', 'css/owl.transitions.css', 'css/slidebars.css', 'css/superfish.css'],
        dest: 'assets/origamiez.css',
      },
      js:{
        src: ['js/modernizr.js', 'js/bootstrap.js', 'js/hoverIntent.js', 'js/jquery.easing.js', 'js/jquery.fitvids.js', 'js/jquery.navgoco.js', 'js/jquery.poptrox.js', 'js/jquery.transit.js', 'js/owl.carousel.js', 'js/slidebars.js', 'js/superfish.js', 'js/origamiez.init.js'],
        dest: 'assets/origamiez.js',
      }
    },    
    assets: ['Grunfile.js']
  });
  
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.registerTask('default', ['concat:css', 'concat:js', 'uglify', 'cssmin']);
  grunt.registerTask('js', ['concat:js', 'uglify']);
  grunt.registerTask('css', ['concat:css', 'cssmin']);
};