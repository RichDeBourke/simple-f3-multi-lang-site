function defaultTask(cb) {
	// Place code for your default task here
	cb();
}

exports.default = defaultTask;

// Sass configuration
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('autoprefixer');
var postcss = require('gulp-postcss');
var cleanCSS = require('gulp-clean-css');

var sassinput = 'css/sass/**/*.scss';
var output = 'css/';

var sassOptions = {
	outputStyle: 'expanded'
};

gulp.task('sass', function () {
	return gulp
		.src(sassinput)
		.pipe(sourcemaps.init())
		.pipe(sass(sassOptions).on('error', sass.logError))
		.pipe(postcss([ autoprefixer() ]))
		.pipe(cleanCSS({ compatibility: 'ie9' }))
		.pipe(sourcemaps.write('../css'))
		.pipe(gulp.dest(output));
});

gulp.task('watchsass', function() {
	return gulp
		.watch(sassinput, gulp.series('sass'));
});

/* Stuff I'm saving
		.pipe(cleanCSS({debug: true}, (details) => {
			console.log(`${details.name}: ${details.stats.originalSize}`);
			console.log(`${details.name}: ${details.stats.minifiedSize}`);
		}))
*/
