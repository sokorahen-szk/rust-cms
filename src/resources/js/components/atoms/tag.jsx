import React from "react";
import clsx from 'clsx';

export default function Tag(props) {
    const classes = clsx([
        props.color && props.color.indexOf("[") === -1 ?
        `bg-${props.color}-100 text-${props.color}-800` : `bg-${props.color} text-white`,
        "text-xs",
        "font-medium",
        `mx-${props.mx}`,
        `ml-${props.ml}`,
        `mr-${props.mr}`,
        `px-${props.px}`,
        `py-${props.py}`,
        !props.disabled && props.clickEvent ? "cursor-pointer" : "",
        !props.disabled && props.clickEvent ? `hover:bg-${props.color}-300`:"",
        !props.block ? "inline" : "",
        props.rounded ? "rounded-full" : "",
        {"opacity-50": props.disabled},
    ]);
    return <span className={classes} onClick={props.clickEvent ? props.clickEvent : () => {}}>{props.children}</span>
}