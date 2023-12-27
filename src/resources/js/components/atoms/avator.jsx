import React from "react";
import clsx from 'clsx';

export default function Avator(props) {
    const classes = clsx([
        `w-${props.w}`,
        `h-${props.h}`,
        !props.block ? "inline" : "",
        props.rounded ? `rounded-full` : "",
    ]);
    return <img className={classes} src={props.src} />
}