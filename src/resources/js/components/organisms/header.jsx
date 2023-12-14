import React from "react";
import Button from "../atoms/button"
import Cookies from "js-cookie";

export default function Header(props) {
    const loginButtonNav = () => {
        return (
            <div>
                <Button text="ログイン" color="green" href="/login" px={5} py={2} mr={1} />
                <Button text="新規登録" color="blue" href="/register" px={5} py={2} />
            </div>
        )
    }
    const logoutButtonNav = () => {
        return (
            <div>
                <Button text="ログアウト" color="gray" clickEvent={logout} px={5} py={2} mr={1} />
            </div>
        )
    }

    const logout = () => {
        Cookies.remove("is_login");
        Cookies.remove("access_token");
        location.href = "/"
    }

    return (
    <header className="p-2 bg-gray-800">
        <div className="flex justify-between">
            <div className="py-2 text-lg text-white">
                <a href="/">{ props.title }</a>
            </div>
            {props.isLogin ? logoutButtonNav() : loginButtonNav()}
        </div>
    </header>
    )
}