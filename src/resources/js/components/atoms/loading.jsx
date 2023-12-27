import React from "react";
import clsx from 'clsx';

export default function Loading(props) {
    const classes = clsx([
        `w-${props.w}`,
        `h-${props.h}`,
        `mt-${props.mt}`,
        "animate-spin",
        "border-4",
        `border-${props.color}-500`,
        "border-t-transparent",
        props.rounded ? `rounded-full` : "",
        props.isLoading ? "" : "hidden",
    ]);
    return (
    <div className="flex justify-center" aria-label="loading">
        <div className={classes}></div>
    </div>
    )
}