module.exports = function(grunt) {

    // measures the time each task takes
    require('time-grunt')(grunt);

    // load time-grunt and all grunt plugins found in the package.json
    require('jit-grunt')(grunt);

    var bsport = 5857; // JoomLaToolS

    // grunt config
    grunt.initConfig({

        // Grunt variables
        nookuAssetsPath: '../../../../../joomlatools-projects/nooku-framework/code/resources/assets',

        // Iconfont
        webfont: {
            icons: {
                src: 'icons/svg/*.svg',
                dest: 'fonts/koowa-icons',
                destCss: 'scss/utilities',
                options: {
                    font: 'koowa-icons',
                    hashes: false,
                    stylesheet: 'scss',
                    relativeFontPath: '../fonts/icons/',
                    template: 'icons/template.css',
                    htmlDemo: false
                }
            }
        },


        // Compile sass files
        sass: {
            options: {
                outputStyle: 'compact',
                includePaths: [
                    'bower_components', // bower
                    'node_modules' // npm
                ]
            },
            dist: {
                files: {
                    'css/admin.css': 'scss/admin.scss'
                }
            }
        },


        // Autoprefixer
        autoprefixer: {
            options: {
                browsers: ['> 5%', 'last 2 versions']
            },
            files: {
                expand: true,
                flatten: true,
                src: 'css/*.css',
                dest: 'css/'
            }
        },


        // Uglify
        uglify: {
            options: {
                sourceMap: true,
                preserveComments: 'some' // preserve @license tags
            },
            build: {
                files: {
                    'js/admin.js': [
                        'bower_components/kodekit-ui/dist/js/min/admin.js',
                        'scripts/main.js'
                    ],
                    'js/jquery.js': [
                        'bower_components/kodekit-ui/dist/js/min/jquery.js'
                    ],
                    'js/modernizr.js': [
                        'bower_components/kodekit-ui/dist/js/min/modernizr.js'
                    ]
                }
            }
        },

        // Browser Sync
        browserSync: {
            dev: {
                bsFiles: {
                    src : [
                        "css/*.*"
                    ]
                },
                options: {
                    proxy: "http://joomla.box/joomlatools-platform/web/administrator/",
                    port: bsport,
                    open: true,
                    notify: false,
                    watchTask: true,
                    injectChanges: false
                }
            }
        },


        // Shell commands
        shell: {
            updateCanIUse: {
                command: 'npm update caniuse-db'
            }
        },


        // Watch files
        watch: {
            fontcustom: {
                files: [
                    'icons/svg/*.svg'
                ],
                tasks: ['webfont', 'sass', 'autoprefixer'],
                options: {
                    interrupt: true,
                    atBegin: false
                }
            },
            sass: {
                files: [
                    'scss/*.scss',
                    'scss/**/*.scss',
                    '<%= nookuAssetsPath %>/scss/*.scss',
                    '<%= nookuAssetsPath %>/scss/**/*.scss'
                ],
                tasks: ['sass', 'autoprefixer'],
                options: {
                    interrupt: true,
                    atBegin: true
                }
            },
            javascript: {
                files: [
                    'scripts/*.js'
                ],
                tasks: ['uglify'],
                options: {
                    interrupt: true,
                    atBegin: true
                }
            }
        }


    });

    // The dev task will be used during development
    grunt.registerTask('default', ['shell', 'browserSync', 'watch']);

};
