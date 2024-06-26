var gulp   = require('gulp');
var server = require('browser-sync').create();
var util   = require('gulp-util');
var config = require('../config');

// in CL 'gulp server --open' to open current project in browser
// in CL 'gulp server --tunnel siteName' to make project available over http://siteName.localtunnel.me

gulp.task('server', function() {
    server.init({
        proxy: "wellwhere.lm",
        host: "wellwhere.lm",
        // server: {
        //     baseDir: !config.production ? [config.dest.root, config.src.root] : config.dest.root,
        //     directory: false,
        //     serveStaticOptions: {
        //         extensions: ['html']
        //     }
        // },
        files: [
            config.dest.php + '**/*.php',
            config.dest.css + '/*.css',
            config.dest.img + '/**/*'
        ],
        port: util.env.port || 8080,
        logLevel: 'info', // 'debug', 'info', 'silent', 'warn'
        logConnections: false,
        logFileChanges: true,
        open: Boolean(util.env.open),
        notify: false,
        ghostMode: false,
        cors: true
        // online: Boolean(util.env.tunnel),
        // injectChanges: true,
        // tunnel: util.env.tunnel || null
    });
});

module.exports = server;
