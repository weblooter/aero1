/* jshint esversion: 6 */
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
    // mode: development
    mode: 'production',

    // Можно переключить приоритет, чтобы использовать глобально-установленные пакеты и не плодить дубли node_modules в разных проектах
    resolve: {
        modules: ['node_modules', process.env.NODE_PATH,]
        // modules: [process.env.NODE_PATH, 'node_modules',]
    },
    resolveLoader: {
        modules: ['node_modules', process.env.NODE_PATH,]
        // modules: [process.env.NODE_PATH, 'node_modules',]
    },
    performance: {
        maxEntrypointSize: 1024 * 1024,
        assetFilter: function (assetFilename) {
            return assetFilename.endsWith('.js');
        }
    },

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
                            // переключить для старой/новой версии postcss-loader
                            plugins: () => [
                                require('autoprefixer')
                            ],
                            // postcssOptions: {
                            //     plugins: [
                            //         'autoprefixer'
                            //     ],
                            // },
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