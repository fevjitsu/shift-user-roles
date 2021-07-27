(function ($) {
  "use strict";

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  const onPopupLoad = (wrapper) => {
    if (wrapper.hasChildNodes()) {
      let loginPopup = document.getElementsByClassName("login_popup_content");
      let a = document.createElement("a");
      a.textContent = "Guest login";
      a.href = "#";
      a.addEventListener("click", () => {
        if (window.vibebp.settings.firebase_config)
          firebase
            .auth()
            .signInAnonymously()
            .then(() => {
              sessionStorage.setItem("guestLogin", true);
              window.location.href =
                "https://my.myshifter.io/shifter-directory/guestshiftpsych-team/#component=dashboard";
            })
            .catch((error) => {
              console.log(error);
            });
      });
      loginPopup[0].appendChild(a);
    }
  };

  let wrapper = undefined;
  let wrapperObserver = new MutationObserver(function (mutationRecords) {
    wrapper = document.getElementById("vibebp_login_wrapper");
    onPopupLoad(wrapper);
  });
  const observerConfig = {
    childList: true,
  };
  $(document).ready(() => {
    wrapper = document.getElementById("vibebp_login_wrapper");
    wrapperObserver.observe(wrapper, observerConfig);
  });

  $(document).ready(() => {
    let hasGuest = sessionStorage.getItem("guestLogin");
    let scripts = document.getElementsByTagName("script");
    if (hasGuest) {
      console.log("script child::\n", scripts[31].previousElementSibling());
      scripts[31].outerHTML = "";
    }
    console.log("Scripts :: \n", scripts);
  });
})(jQuery);
