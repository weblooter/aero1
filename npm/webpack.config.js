/* jshint esversion: 6 */
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
    mode: 'production', //development
    entry: './webpack/webpack.js',
    output: {
        path: path.resolve(__dirname, '../local/templates/vedrov/assets/js/'), // в какую папку выгружать - ./js
        filename: '_bundle.js', // как называть выходные файлы - _vendors.bundle.js и _app.bundle.js
        library: 'myApp'
    },
    module: {
        rules: [ // Правила обработки файлов
            { // Для css
                test: /\.(css|sass|scss)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader?url=false',
                        options: {
                            importLoaders: 2,
                            sourceMap: true,
							url: false
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            plugins: () => [
                                require('autoprefixer')
                            ],
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/_bundle.css',
            chunkFilename: '[id].css',
            ignoreOrder: false,
        })
    ]
};