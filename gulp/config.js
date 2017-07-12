var util = require('gulp-util');

var production = util.env.production || util.env.prod || false;
var destPath = './';

var config = {
    env       : 'development',
    production: production,

    src: {
        root         : './',
        // templates    : 'src/templates',
        // templatesData: 'src/templates/data',
        // pagelist     : 'src/index.yaml',
        sass         : 'assets/css/scss',
        // path for sass files that will be generated automatically via some of tasks
        sassGen      : 'assets/css/scss/generated',
        js           : 'assets/js/source/',
        // img          : 'src/img',
        // svg          : 'src/img/svg',
        // icons        : 'src/icons',
        // path to png sources for sprite:png task
        // iconsPng     : 'src/icons',
        // path to svg sources for sprite:svg task
        // iconsSvg     : 'src/icons',
        // path to svg sources for iconfont task
        // iconsFont    : 'src/icons',
        // fonts        : 'src/fonts',
        // lib          : 'src/lib'
    },
    dest: {
        root : './',
        php  : destPath,
        css  : destPath + 'assets/css',
        js   : destPath + 'assets/js',
        img  : destPath + 'assets/img',
        fonts: destPath + 'assets/fonts',
        lib  : destPath + 'assets/lib'
    },

    setEnv: function(env) {
        if (typeof env !== 'string') return;
        this.env = env;
        this.production = env === 'production';
        process.env.NODE_ENV = env;
    },

    logEnv: function() {
        util.log(
            'Environment:',
            util.colors.white.bgRed(' ' + process.env.NODE_ENV + ' ')
        );
    },

    errorHandler: require('./util/handle-errors')
};

config.setEnv(production ? 'production' : 'development');

module.exports = config;
