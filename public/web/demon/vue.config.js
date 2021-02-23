module.exports = {
  devServer: {
    proxy: {
      '/login': {
        target: 'http://localhost/',
        ws: true,
        changeOrigin: true
      },
      '/item': {
        target: 'http://localhost/',
        ws: true,
        changeOrigin: true
      }
    }
  }
}
