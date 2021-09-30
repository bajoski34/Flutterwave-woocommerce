import React, { Component } from "react";
import FlwLogo from "../icons/flutterwave-logo.svg";

const Header = (props) => {
  return (
    <div className="woo_flw_header">
      <img className="woo_flutterwave_barter_logo" src={FlwLogo} />
      <h1 className="woo_flw_heading"> Payment Settings</h1>
    </div>
  );
};

export default Header;
