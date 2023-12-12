import React from "react";
import clsx from 'clsx';

export default function Input(props) {
    const classes = clsx([
        "bg-gray-50",
        "border-gray-300",
        "border",
        "text-gray-900",
        "text-sm",
        "block",
        "w-full",
        "p-2",
    ])
    return (
        <>
            <input 
                type={props.type}
                id={props.id}
                className={classes}
                placeholder={props.placeholder}
                required={props.required}
            />
        </>
    )
}