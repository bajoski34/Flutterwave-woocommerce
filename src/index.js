var flwurlParams = new URLSearchParams(window.location.search);
const getQparamsCheck = (params) => {
  return (
    params.has("tab") &&
    params.has("section") &&
    params.get("section") == "rave"
  );
};

import React from "react";
import ReactDOM from "react-dom";
import App from "./App";

if (getQparamsCheck(flwurlParams)) {
  setTimeout(() => {
    document.querySelector(".wrap").style.background = "#ffffff";
    document.querySelector(".wrap").innerHTML =
      '<div id="flw-settings-page">Flutterwave Woocommerce settings page </div>';
    document.addEventListener("DOMContentLoaded", function () {
      document.getElementsByTagName("h1")[0].innerHTML = "";
      let flw_heading = document.createElement("h3");
      flw_heading.classList.add("woo_flw_heading");
      flw_heading.innerHTML = "Payment Settings";
      document.getElementsByTagName("h1")[0].appendChild(flw_heading);
      let flw_logo = document.createElement("img");
      flw_logo.src = flutterwave_data.logo_src;
      flw_logo.style.marginRight = "25px";
      console.log(flw_logo);
      flw_heading.before(flw_logo);
      var element = document.getElementById("flw-settings-page");
      if (typeof element !== "undefined" && element !== null) {
        ReactDOM.render(<App />, document.getElementById("flw-settings-page"));
      }
    });
  }, 300);
}
