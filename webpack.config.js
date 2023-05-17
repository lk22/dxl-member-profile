module.exports = {
  entry: {
    app: './assets/js/app.js',
    user: './assets/js/modules/user.js',
    event: './assets/js/modules/event.js',
    game: './assets/js/modules/game.js'
  },
  output: {
    path: __dirname + "/dist/assets/js/",
    filename: "[name].min.js",
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