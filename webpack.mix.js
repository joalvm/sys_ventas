const mix = require('laravel-mix');
const fs = require('fs');
const path = require('path');
const webpack = require('webpack');

const STYLE_TARGET_PATH = 'public/static/css/';
const SCRIPT_TARGET_PATH = 'public/static/js/';

const MODULES_PATH = path.resolve(__dirname, 'node_modules/');
const ASSETS_TARGET = 'public/static/assets/';

function getFiles(directory) {
    const dir = path.resolve(__dirname, directory);
    let files = [];

    fs.readdirSync(dir).forEach((item) => {
        let file = path.resolve(dir, item);

        if (fs.lstatSync(file).isDirectory()) {
            files.push(...getFiles(path.resolve(directory, item)));
        } else {
            files.push(file);
        }
    });

    return files;
}

function compileSass(sassDir) {
    const sassFiles = getFiles(sassDir);

    for (let i = 0; i < sassFiles.length; i++) {
        let file = sassFiles[i];
        let mainDir = path.dirname(file).replace(path.resolve(__dirname, sassDir), '');
        let relativePath = path.relative(__dirname, file);

        if (file.includes('bootstrap')) {
            continue;
        }

        mix.sass(relativePath, path.normalize(STYLE_TARGET_PATH + mainDir));
    }
}

function compileTs(jsDir) {
    const jsFiles = getFiles(jsDir);

    for (let i = 0; i < jsFiles.length; i++) {
        let file = jsFiles[i];
        let mainDir = path.dirname(file).replace(path.resolve(__dirname, jsDir), '');
        let relativePath = path.relative(__dirname, file);

        mix.ts(relativePath, path.normalize(SCRIPT_TARGET_PATH + mainDir));
    }
}

function moveAssets(modules) {
    for (let i = 0; i < modules.length; i++) {
        let module = modules[i];
        const from = path.resolve(MODULES_PATH, module.path);
        const to = path.resolve(ASSETS_TARGET, module.name);

        if ((module.isDirectory || false)) {
            mix.copyDirectory(from, to);

            continue;
        }

        mix.copy(from, to);
    }
}

mix.disableSuccessNotifications();

mix.browserSync({
    proxy: 'http://sysventas.local/',
    open: false,
});

mix.webpackConfig({
    externals: {
        '@popperjs/core': 'Popper'
    }
});


compileSass('src/scss');
compileTs('src/ts');
moveAssets([
    {
        name: 'bootstrap-icons',
        path: 'bootstrap-icons/font',
        isDirectory: true
    },
    {
        name: 'popperjs',
        path: '@popperjs/core/dist/umd/popper.min.js'
    },
    {
        name: 'normalize',
        path: 'normalize.css/normalize.css'
    }
]);

console.log(mix);
