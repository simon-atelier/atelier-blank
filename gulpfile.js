const gulp = require('gulp'),
	 { series, parallel } = require('gulp'),
	 dartSass = require('sass'),
	 gulpSass = require('gulp-sass'),
	 sass = gulpSass(dartSass),
	 exec = require('child_process').exec,
	 prompt = require('gulp-prompt'),
	 gutil = require('gulp-util'),
	 filter = require('gulp-filter'),
	 touch = require('gulp-touch-cmd'),
	 plugin = require('gulp-load-plugins')(),
	 browserSync = require('browser-sync').create(),
	 babel = require('gulp-babel'),
	 ftp = require( 'vinyl-ftp' );

gulp.task( 'deploy', function () {
    var conn = ftp.create( {
        host:     'ADD HOST HERE',
        user:     'ADD USERNAME HERE',
        password: 'ADD PASSWORD HERE',
        parallel: 10,
        log:      gutil.log
    } );
 
    var globs = [
        '**',
        '!node_modules/**',
        '!acf-json/**',
        '!block.sh'
    ];
 
    return gulp.src( globs, { base: '.', buffer: false } )
        .pipe( conn.newer( '/public_html/wp-content/themes/atelier-blank' ) ) // only upload newer files
        .pipe( conn.dest( '/public_html/wp-content/themes/atelier-blank' ) );
 
} );

gulp.task('block', function(cb) {
  	exec("sh block.sh", function (err, stdout, stderr) {
	    console.log(stdout);
	    console.log(stderr);
	    cb(err);
	})
})

// Select Foundation components, remove components project will not use
const FOUNDATION = 'node_modules/foundation-sites';
const SOURCE = {
	scripts: [
		// Load what input
	    'node_modules/what-input/dist/what-input.js',

		// Foundation core - needed if you want to use any of the components below
		FOUNDATION + '/dist/js/plugins/foundation.core.js',
		FOUNDATION + '/dist/js/plugins/foundation.util.*.js',

		// Pick the components you need
		FOUNDATION + '/dist/js/plugins/foundation.abide.js',
		FOUNDATION + '/dist/js/plugins/foundation.accordion.js',
		FOUNDATION + '/dist/js/plugins/foundation.accordionMenu.js',
		FOUNDATION + '/dist/js/plugins/foundation.drilldown.js',
		FOUNDATION + '/dist/js/plugins/foundation.dropdown.js',
		FOUNDATION + '/dist/js/plugins/foundation.dropdownMenu.js',
		FOUNDATION + '/dist/js/plugins/foundation.equalizer.js',
		FOUNDATION + '/dist/js/plugins/foundation.interchange.js',
		FOUNDATION + '/dist/js/plugins/foundation.offcanvas.js',
		// FOUNDATION + '/dist/js/plugins/foundation.orbit.js',
		FOUNDATION + '/dist/js/plugins/foundation.responsiveMenu.js',
		FOUNDATION + '/dist/js/plugins/foundation.responsiveToggle.js',
		FOUNDATION + '/dist/js/plugins/foundation.reveal.js',
		// FOUNDATION + '/dist/js/plugins/foundation.slider.js',
		FOUNDATION + '/dist/js/plugins/foundation.smoothScroll.js',
		// FOUNDATION + '/dist/js/plugins/foundation.magellan.js',
		FOUNDATION + '/dist/js/plugins/foundation.sticky.js',
		FOUNDATION + '/dist/js/plugins/foundation.tabs.js',
		FOUNDATION + '/dist/js/plugins/foundation.responsiveAccordionTabs.js',
		FOUNDATION + '/dist/js/plugins/foundation.toggler.js',
		FOUNDATION + '/dist/js/plugins/foundation.tooltip.js',

		// Place custom JS here, files will be concantonated, minified if ran with --production
		'assets/scripts/js/**/*.js',
    ],

	// Scss files will be concantonated, minified if ran with --production
	styles: 'assets/styles/scss/**/*.scss',

	acf: 'acf/blocks/**/*.scss',

	// Images placed here will be optimized
	images: 'assets/images/src/**/*',

	php: '**/*.php'
};

const ASSETS = {
	acf: 'acf/blocks/',
	styles: 'assets/styles/',
	scripts: 'assets/scripts/',
	images: 'assets/images/',
	all: 'assets/'
};

const JSHINT_CONFIG = {
	"node": true,
	"globals": {
		"document": true,
		"window": true,
		"jQuery": true,
		"$": true,
		"Foundation": true
	}
};

// GULP FUNCTIONS
// JSHint, concat, and minify JavaScript
gulp.task('scripts', function() {

	// Use a custom filter so we only lint custom JS
	const CUSTOMFILTER = filter(ASSETS.scripts + 'js/**/*.js', {restore: true});

	return gulp.src(SOURCE.scripts)
		.pipe(plugin.plumber(function(error) {
            gutil.log(gutil.colors.red(error.message));
            this.emit('end');
        }))
		.pipe(plugin.sourcemaps.init())
		.pipe(babel())
		.pipe(CUSTOMFILTER)
			.pipe(plugin.jshint(JSHINT_CONFIG))
			.pipe(plugin.jshint.reporter('jshint-stylish'))
			.pipe(CUSTOMFILTER.restore)
		.pipe(plugin.concat('scripts.js'))
		.pipe(plugin.uglify())
		.pipe(plugin.sourcemaps.write('.')) // Creates sourcemap for minified JS
		.pipe(gulp.dest(ASSETS.scripts))
});

// Compile Sass, Autoprefix and minify
gulp.task('styles', function() {
	return gulp.src(SOURCE.styles)
    	.pipe(sass.sync({outputStyle: 'compressed'}).on('error', sass.logError))
    	.pipe(gulp.dest(ASSETS.styles));
});

gulp.task('styles-full', function() {
	return gulp.src(SOURCE.styles)
		.pipe(plugin.plumber(function(error) {
            gutil.log(gutil.colors.red(error.message));
            this.emit('end');
        }))
		.pipe(plugin.sourcemaps.init())
		.pipe(sass.sync())
		.pipe(plugin.autoprefixer())
		.pipe(plugin.cssnano({safe: true, minifyFontValues: {removeQuotes: false}}))
		.pipe(plugin.sourcemaps.write('.'))
		.pipe(gulp.dest(ASSETS.styles))
		.pipe(touch())
		.pipe(browserSync.reload({
          stream: true
        }));
});

gulp.task('acf', function() {
	return gulp.src(SOURCE.acf)
		.pipe(plugin.plumber(function(error) {
            gutil.log(gutil.colors.red(error.message));
            this.emit('end');
        }))
		.pipe(plugin.sourcemaps.init())
		.pipe(sass.sync())
		.pipe(plugin.autoprefixer())
		.pipe(plugin.cssnano({safe: true, minifyFontValues: {removeQuotes: false}}))
		.pipe(plugin.sourcemaps.write('.'))
		.pipe(gulp.dest(ASSETS.acf))
		.pipe(touch())
		.pipe(browserSync.reload({
          stream: true
        }));
});

// Optimize images, move into assets directory
gulp.task('images', function() {
	return gulp.src(SOURCE.images)
		.pipe(plugin.imagemin())
		.pipe(gulp.dest(ASSETS.images))
});

 gulp.task( 'translate', function () {
     return gulp.src( SOURCE.php )
         .pipe(plugin.wpPot( {
             domain: 'atelier_wp',
             package: 'Atelier'
         } ))
        .pipe(gulp.dest('file.pot'));
 });

// Browser-Sync watch files and inject changes
gulp.task('browsersync', function() {

    // Watch these files
    var files = [
    	SOURCE.php,
    ];

    browserSync.init(files, {
	    proxy: LOCAL_URL,
    });

    gulp.watch(SOURCE.styles, gulp.parallel('styles'));
    gulp.watch(SOURCE.scripts, gulp.parallel('scripts')).on('change', browserSync.reload);
    gulp.watch(SOURCE.images, gulp.parallel('images'));

});

// Watch files for changes (without Browser-Sync)
gulp.task('watch', function() {

	// Watch .scss files
	gulp.watch(SOURCE.styles, gulp.parallel('styles'));

	// Watch .scss acf files
	gulp.watch(SOURCE.acf, gulp.parallel('acf'));

	// Watch scripts files
	gulp.watch(SOURCE.scripts, gulp.parallel('scripts'));

	// Watch images files
	gulp.watch(SOURCE.images, gulp.parallel('images'));

});

// Run styles, scripts and foundation-js
gulp.task('default', gulp.parallel('styles', 'scripts', 'images', 'acf', 'styles-full', 'deploy'));