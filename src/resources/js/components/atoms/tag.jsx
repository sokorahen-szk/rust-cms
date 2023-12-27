import React from "react";
import clsx from 'clsx';

export default function Tag(props) {
    const classes = clsx([
        `bg-${props.color}-100`,
        `text-${props.color}-800`,
        "text-xs",
        "font-medium",
        "me-2",
        `mx-${props.mx}`,
        `px-${props.px}`,
        `py-${props.py}`,
        !props.block ? "inline" : "",
        props.rounded ? `rounded-full` : "",
    ]);
    return <span className={classes}>{props.children}</span>
}