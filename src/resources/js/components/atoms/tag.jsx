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
        `px-${props.px}`,
        `py-${props.py}`,
        !props.block ? "inline" : "",
        props.rounded ? `rounded-full` : "",
    ]);
    return <span className={classes}>{props.children}</span>
}