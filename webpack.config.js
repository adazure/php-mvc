const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const isDevelopment = process.env.NODE_ENV === 'development'
module.exports = {
    entry: './src/js/app.js',
    output: {
        filename: 'app.js',
        path: path.resolve(__dirname, 'assets/js')
    },
    module: {
        rules:
            [
                {
                    test: /\.scss$/,
                    exclude: /node_modules/,
                    use: [
                        isDevelopment ? 'style-loader' : MiniCssExtractPlugin.loader,
                        {
                            loader: 'css-loader?url=false'
                        },
                        'sass-loader',
                    ],
                }, {
                    test: /\.js$/,
                    exclude: /(node_modules|bower_components)/,
                    use: {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env']
                        }
                    }
                }, { test: /\.(png|woff|woff2|eot|ttf|svg)$/, loader: 'url-loader?limit=100000' }
            ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/[name].css',
        })
    ],
    watch: true
};