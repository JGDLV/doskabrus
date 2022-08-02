const { src, dest, parallel, series, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync');
const uglify = require('gulp-uglify');
const plumber = require('gulp-plumber');
const cssnano = require('gulp-cssnano');
const pug = require('gulp-pug');
const spritesmith = require('gulp.spritesmith');
const svgSprite = require('gulp-svg-sprite');
const imagecomp = require('compress-images');
const del = require('del');

function browsersync() {
	browserSync.init({
		server: { baseDir: 'app/' },
		notify: false,
		online: true
	})
}

function styles() {
	return src('app/sass/**/*.sass')
		.pipe(sourcemaps.init())
		.pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
		.pipe(autoprefixer({
			overrideBrowserslist: ['last 8 versions'],
			browsers: [
				'Android >= 4',
				'Chrome >= 20',
				'Firefox >= 24',
				'Explorer >= 11',
				'iOS >= 6',
				'Opera >= 12',
				'Safari >= 6',
			],
		}))
		.pipe(concat('style.css'))
		.pipe(sourcemaps.write('.'))
		.pipe(dest('app/css/'))
		.pipe(browserSync.stream())
}

function html() {
	return src(['app/pug/*.pug', '!app/pug/**/_*.pug'])
		.pipe(plumber())
		.pipe(pug({ pretty: true }))
		.pipe(dest('app/'))
		.pipe(browserSync.stream())
}

function css() {
	return src('app/libs/**/*.css')
		.pipe(concat('libs.min.css'))
		.pipe(cssnano())
		.pipe(dest('app/css'));
}

function js() {
	return src('app/libs/**/*.js')
		.pipe(concat('libs.min.js'))
		.pipe(uglify())
		.pipe(dest('app/js/'))
		.pipe(browserSync.stream())
}

function js_reload() {
	return src('app/js/**/*.js')
		.pipe(browserSync.stream())
}

function png() {
	var spriteData = src('app/img/sprite/*.png').pipe(spritesmith({
		imgName: 'sprite.png',
		cssFormat: 'sass',
		cssName: 'sprite.sass',
		padding: 5
	}));
	spriteData.img.pipe(dest('app/img/'));
	spriteData.css.pipe(dest('app/sass/'));
}

function svg() {
	return src('app/img/sprite/*.svg')
		.pipe(svgSprite({
			mode: {
				stack: {
					sprite: '../sprite.svg'
				}
			},
		}))
		.pipe(dest('app/img/'));
}

async function images() {
	imagecomp(
		"app/img/*",
		"dist/img/",
		{ compress_force: false, statistic: true, autoupdate: true }, false,
		{ jpg: { engine: "mozjpeg", command: ["-quality", "85"] } },
		{ png: { engine: "pngquant", command: ["--quality=75-100", "-o"] } },
		{ svg: { engine: "svgo", command: "--multipass" } },
		{ gif: { engine: "gifsicle", command: ["--colors", "64", "--use-col=web"] } },
		function (err, completed) {
			if (completed === true) {
				browserSync.reload()
			}
		}
	)
}

function clear() {
	return del('dist/**/*', { force: true })
}

async function copy() {
	src([
		'app/css/**/*.css',
		'app/fonts/**/*',
		'app/img/**/*',
		'app/js/**/*',
		'app/*.html',
	], { base: 'app' })
		.pipe(dest('dist'))
}

function startwatch() {
	watch('app/**/*.pug', html);
	watch('app/**/*.sass', styles);
	watch('app/img/**/*', images);
	watch('app/libs/**/*.css', css);
	watch('app/libs/**/*.js', js);
	watch('app/js/**/*.js', js_reload);
	watch('app/img/sprite/*.svg', svg);
}

exports.build = series(clear, html, styles, copy)
exports.default = series(html, parallel(css, js, styles, png, svg, browsersync, startwatch))
