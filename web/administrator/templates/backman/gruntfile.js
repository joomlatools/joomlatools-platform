module.exports = function(grunt) {

    // measures the time each task takes
    require('time-grunt')(grunt);

    // load time-grunt and all grunt plugins found in the package.json
    require('jit-grunt')(grunt);

    var bsport = 5857; // JoomLaToolS

    // grunt config
    grunt.initConfig({

        // Grunt variables
        assetsPath: 'web/administrator/templates/backman',
        nookuAssetsPath: '../../../../../joomlatools-projects/nooku-framework/code/resources/assets',
        bsproxy: 'http://joomla.box/joomla-platform/web/administrator',

        // Iconfont
        webfont: {
            icons: {
                src: '<%= assetsPath %>/icons/svg/*.svg',
                dest: '<%= assetsPath %>/fonts/koowa-icons',
                destCss: '<%= assetsPath %>/scss/utilities',
                options: {
                    font: 'koowa-icons',
                    hashes: false,
                    stylesheet: 'scss',
                    relativeFontPath: '../fonts/icons/',
                    template: '<%= assetsPath %>/icons/template.css',
                    htmlDemo: false
                }
            }
        },


        // Compile sass files
        sass: {
            options: {
                outputStyle: 'compact'
            },
            dist: {
                files: {
                    '<%= assetsPath %>/css/admin.css': '<%= assetsPath %>/scss/admin.scss'
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
                src: '<%= assetsPath %>/css/*.css',
                dest: '<%= assetsPath %>/css/'
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
                    '<%= assetsPath %>/js/admin.js': [
                        'bower_components/footable/dist/footable.min.js',
                        '<%= assetsPath %>/scripts/jquery.floatThead.js',
                        '<%= assetsPath %>/scripts/off-canvas-menu.js',
                        '<%= assetsPath %>/scripts/main.js'
                    ]
                }
            }
        },

        // Browser Sync
        browserSync: {
            dev: {
                bsFiles: {
                    src : [
                        "<%= assetsPath %>/css/*.*"
                    ]
                },
                options: {
                    proxy: "<%= bsproxy %>",
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
                    '<%= assetsPath %>/icons/svg/*.svg'
                ],
                tasks: ['webfont', 'sass', 'autoprefixer'],
                options: {
                    interrupt: true,
                    atBegin: false
                }
            },
            sass: {
                files: [
                    '<%= assetsPath %>/scss/*.scss',
                    '<%= assetsPath %>/scss/**/*.scss',
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
                    '<%= assetsPath %>/scripts/*.js',
                    '<%= assetsPath %>/js/*.js'
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