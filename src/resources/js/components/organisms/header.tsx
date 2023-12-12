import React from "react";
import Button from "..//atoms/button"

export default function Header(props) {
    return (
    <header className="p-2 bg-gray-100">
        <div className="flex justify-between">
            <div className="py-2 text-md">
                <a href="/">{ props.title }</a>
            </div>
            <div>
                <Button text="ログイン" color="green" href="/login" x={5} y={2} />
                <Button text="新規登録" color="blue" x={5} y={2} />
            </div>
        </div>
    </header>
    )
}