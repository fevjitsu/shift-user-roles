(function ($) {
  "use strict";

  /**
   * All of the code for your admin-facing JavaScript source
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

  $(document).ready(() => {
    let list = document.getElementsByClassName("user_role_list");
    let user = undefined;
    let role = undefined;
    const checkForm = (user, role) => {
      $("#role_submit").prop("disabled", true);
      if (user) {
        if (user.length > 0) {
          if (role) {
            $("#role_submit").prop("disabled", false);
          }
        }
      }
    };
    const checkSelected = (user) => {
      if (user) {
        if (user.length > 0) {
          $("#user_role_email").val(user);
        }
      }
    };

    for (let inc = 0; inc < list.length; inc++) {
      list[inc].addEventListener("click", () => {
        user = document.getElementById(list[inc].id).textContent;
        checkSelected(user);
      });
    }

    $("#role_submit").prop("disabled", true);

    $("#user_role_email").change(() => {
      user = $("#user_role_email").val();
      checkForm(user, role);
    });
    $("#user_select_role").change(() => {
      role = $("#user_select_role").val();
      checkForm(user, role);
    });
  });
})(jQuery);
