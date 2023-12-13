import React from 'react'
import clsx from 'clsx';

export default function Button(props) {
    const classes = clsx([
        `bg-${props.color}-600`,
        `hover:bg-${props.color}-500`,
        "text-white",
        "font-bold",
        `px-${props.x}`,
        `py-${props.y}`,
        {"rounded": props.rounded}
    ])

    const click = () => {
        props.clickEvent();
    }

    const render = () => {
        const button = (
            <button className={classes} onClick={click}>
                { props.text }
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