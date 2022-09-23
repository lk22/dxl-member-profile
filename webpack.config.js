module.exports = {
  entry: [__dirname + "/assets/sass/app.scss"],
  mode: "production",
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: [],
      },
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
    ],
  },
};