module.exports = {
  entry: [__dirname + "/assets/sass/app.scss", __dirname + "/assets/js/app.js"],
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
          },
        },
      }
    ],
  },
};