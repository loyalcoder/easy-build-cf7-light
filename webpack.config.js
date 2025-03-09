const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  entry: {
    main: './src/index.js', // Main entry file
    admin: './src/admin/index.js', // Admin entry file
    adminAjax: './src/admin/admin-ajax.js', // Admin entry file
    sync: './src/admin/sync.js' // Admin entry file
  },
  output: {
    filename: '[name].bundle.js', // Output JavaScript files with entry name
    path: path.resolve(__dirname, 'assets/dist'), // Output directory
  },
  module: {
    rules: [
      {
        test: /\.scss$/, // Process SCSS files
        use: [
          MiniCssExtractPlugin.loader, // Extract CSS into a file
          'css-loader', // Translates CSS into CommonJS
          'sass-loader', // Compiles SCSS to CSS
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name].css', // Output CSS files with entry name
    }),
  ],
  externals: {
    jquery: 'jQuery', // Treat jQuery as an external dependency
  },
  mode: 'development', // Set mode to development
};
