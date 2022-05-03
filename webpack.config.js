const defaultConfig = require('@wordpress/scripts/config/webpack.config');

const {
    getWebpackEntryPoints,
} = require('@wordpress/scripts/utils');

defaultConfig.entry = function () {
    let entrypoints = getWebpackEntryPoints();
    entrypoints['css/all'] = './src/scss/all.scss';
    return entrypoints;
}

module.exports = defaultConfig;
