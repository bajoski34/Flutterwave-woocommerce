import React, { Component } from "react";

const Select = (props) => {
  return (
    <div className="settingItem">
      <label className="lb">{props.name}</label>
      <select className="flw-inputs">
        <option>Pop up - (keep payment experience on the website)</option>
        <option>Redirect - (redirected a hosted page)</option>
      </select>
      <p className="hookInstruct">
        {
          "Choice of payment style to use. Either inline or redirect (Default: Inline)"
        }
      </p>
    </div>
  );
};

export default Select;
