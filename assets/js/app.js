import "bootstrap";

import ProfileEvent from './modules/Event'
import ProfileUser from './modules/User'
import ProfileGame from "./modules/Game"

(($) => {

  $(document).on('ready', function() {
    $('.nav-toggler').on('click', (e) => {
      console.log("clicked");
      $('.nav-list').addClass('active');
    });

    $('.close-button').on('click', (e) => {
      $('.nav-list').removeClass('active');
    })

      if ( window.localStorage.getItem('theme') && window.localStorage.getItem('theme_color')) {
        const appTheme = localStorage.getItem('theme');
        const appThemeColor = localStorage.getItem('theme_color');
        $('.dxl-btn, a, button, input, select, label').addClass('theme-' + appTheme);
      }
      ProfileEvent.init()
      ProfileUser.init()
      ProfileGame.init();
    })
})(jQuery);