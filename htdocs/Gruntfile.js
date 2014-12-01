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
    compass: {
      dist: {
        options: {
            config: 'config.rb',
        }
      }
    },
    watch  : {
      css: {
          files: ['scss/*.scss'],
          tasks: ['development-scss']
      },
    },
  });

  // Load the plugins
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-compass');
  
  // Default tasks
  grunt.registerTask('default', ['compass']);
  
  // Deployment tasks
  grunt.registerTask('deployment', ['compass']);
  
  // Development tasks, triggered by watch
  grunt.registerTask('development-scss', ['compass']);

};
