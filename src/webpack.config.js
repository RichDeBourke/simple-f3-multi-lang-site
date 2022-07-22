const path = require('path');

module.exports = {
    devtool: "source-map",
    entry: './js/app.js',
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'js')
    },
    target: ['web', 'es5'],
    module: {
        rules: [{
            test: /\.m?js$/,
            exclude: /node_modules/,
            use: {
                loader: 'babel-loader',
                options: {
                    presets: [
                        ['@babel/preset-env', {
                            targets: "defaults"
                        }]
                    ]
                }
            }
        }]
    }
};