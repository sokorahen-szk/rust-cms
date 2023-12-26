import React from 'react'
import clsx from 'clsx';

export default function Button(props) {
    const classes = clsx([
        "font-bold",
        `px-${props.px}`,
        `py-${props.py}`,
        `mr-${props.mr}`,
        "text-white",
        {"rounded": props.rounded},
        `bg-${props.color}-600`,
        {"opacity-50": props.disabled},
        !props.disabled ? `hover:bg-${props.color}-500` : "",
    ]);

    const render = () => {
        const button = (
            <button className={classes} onClick={props.clickEvent ? props.clickEvent : () => {}} disabled={props.disabled}>
                {props.children}
            </button>
        )

        if (props.href) {
            return (
                <a href={props.href}>{button}</a>
            )
        }

        return button
    }
    return (
        <>
            {render()}
        </>
    )
}