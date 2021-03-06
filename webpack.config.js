const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
  entry: { 
    main: './src/scripts/index.tsx',
    block: './src/blocks/block.js'
  },
  output: {
    path: path.resolve(__dirname, 'themes/boiler-room/assets'),
    filename: '[name].js'
  },

  devtool: 'source-map',

  // resolve: {
  //   extensions: ['.ts', '.tsx', '.js', '.json']
  // },

  module: {
    rules: [
      {
        test: /\.tsx?$/,
        exclude: /node_modules/,
        loader: 'awesome-typescript-loader'
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader"
        }
      },
      {
        enforce: 'pre',
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'source-map-loader'
      },
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract(
          {
            use: ['css-loader', 'sass-loader'],
            fallback: 'style-loader'
          })
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin({filename: '[name].css'})
  ],
  // To do: Create copy step from node_modules to allow for external loading of React.
  // externals: {
  //   'react': 'React',
  //   'react-dom': 'ReactDOM'
  // }
};
