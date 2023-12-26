import React, {useState, useEffect} from "react";
import Cookies from "js-cookie";
import Button from "../atoms/button"

const title = "rustサイト"

export default function Header() {
    const [isLogin, setIsLogin] = useState(false);
    useEffect( () => {
        setIsLogin(Cookies.get("is_login"))
    }, [])

    const loginButtonNav = () => {
        return (
            <div>
                <Button color="green" href="/login" px={5} py={2} mr={1}>ログイン</Button>
                <Button color="blue" href="/register" px={5} py={2}>新規登録</Button>
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
                <a href="/">{ title }</a>
            </div>
            {isLogin ? logoutButtonNav() : loginButtonNav()}
        </div>
    </header>
    )
}