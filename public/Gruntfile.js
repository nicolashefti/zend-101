'use strict';

module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    banner : '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
    cssmin: {
      options: {
        banner : '<%= banner %>',
      },
      build: {
        src: 'css/style.css',
        dest: 'css/<%= pkg.name %>.min.js'
      }
    },
    watch  : {
      css: {
          files: ['css/*.css'],
          tasks: ['development-scss']
      },
    },
  });

  // Load the plugins
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  
  // Default task(s).
  grunt.registerTask('default', ['cssmin']);
  
  // Development tasks, triggered by watch
  grunt.registerTask('development-scss', ['cssmin']);

};
