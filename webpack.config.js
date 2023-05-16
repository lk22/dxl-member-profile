module.exports = {
  entry: "./assets/js/app.js",
  output: {
    path: __dirname + "/dist/assets/js/",
    filename: "app.min.js",
  },
  mode: "production",
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [
          {
            loader: "file-loader",
            options: { outputPath: "assets/css/", name: "[name].min.css" },
          },
          "sass-loader",
        ],
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"],
            targets: [
              'last 2 versions',
              'not dead',
              '> 0.2%',
              'not ie 11'
            ],
          },
        },
      }
    ],
  },
};