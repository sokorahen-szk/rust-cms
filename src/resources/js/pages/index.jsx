import React, {useState, useEffect} from "react";
import Cookies from "js-cookie";
import Header from "../components/organisms/header";

export default function Index() {
    const [isLogin, setIsLogin] = useState(false);
    useEffect( () => {
        setIsLogin(Cookies.get("is_login"))
    }, [])

    return (
        <>
            <Header title="rustサイト" isLogin={isLogin} />
            <div>
                a
            </div>
        </>
    );
}
