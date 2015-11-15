module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        bowercopy: {
            options: {
                srcPrefix: 'bower_components',
                destPrefix: 'web/assets'
            },
            scripts: {
                files: {
                }
            },
            stylesheets: {
                files: {
                    'css/bootstrap.css': 'bootstrap/dist/css/bootstrap.css',
                    'css/bootstrap-tour.css': 'bootstrap-tour/build/css/bootstrap-tour.css',
                    'css/jqueryui-timepicker-addon.css': 'jqueryui-timepicker-addon/src/jquery-ui-timepicker-addon.css',
                    'css/jquery-ui.css': 'jquery-ui/themes/base/jquery-ui.css',
                }
            },
        },
        uglify : {
            lib: {
                files: {
                    'web/js/bundled.min.js': [
                        'bower_components/jquery/dist/jquery.js',
                        'src/AppBundle/Resources/public/js/*'
                    ]
                }
            }
        },
        concat: {
            options: {
                stripBanners: true
            },
            css: {
                src: [
                    'web/assets/css/*.css',
                ],
                dest: 'web/css/bundled.css'
            }
        },
        copy: {
            images: {
                expand: true,
                cwd: 'src/MY/FrontendBundle/Resources/public/images',
                src: '*',
                dest: 'web/assets/images/'
            }
        }
    });

    // grunt.loadNpmTasks('grunt-bowercopy');
    // grunt.loadNpmTasks('grunt-contrib-concat');
    // grunt.loadNpmTasks('grunt-contrib-copy');
    // grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    //grunt.registerTask('default', ['bowercopy','copy', 'concat', 'cssmin', 'uglify']);
    grunt.registerTask('default', ['uglify']);
};
