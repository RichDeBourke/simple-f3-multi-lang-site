const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

module.exports = {
    devtool: "source-map",
    mode: "production",
    entry: './css/app.js',
    output: {
        path: path.resolve(__dirname, 'css2'),
    },
    optimization: {
        minimizer: [
            // For webpack@5 you can use the `...` syntax to extend existing minimizers (i.e. `terser-webpack-plugin`), uncomment the next line
            // `...`,
            new CssMinimizerPlugin(),
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "style1.css"
        })
    ],
    module: {
        rules: [{
            test: /\.scss$/,
            use: [
                MiniCssExtractPlugin.loader,
                // Translates CSS into CommonJS
                "css-loader",
                "postcss-loader",
                // Compiles Sass to CSS
                "sass-loader"                
            ],
        }, ],
    },
};