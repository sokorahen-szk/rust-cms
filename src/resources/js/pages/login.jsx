import React, {useState, useEffect} from "react";
import axios from "axios";
import Cookies from "js-cookie";

import Header from "../components/organisms/header";
import Input from "../components/atoms/input";
import Button from "../components/atoms/button";

export default function Login() {
    const [accountId, setAccountId] = useState("");
    const [password, setPassword] = useState("");
    const [isLoginButtonDisabled, setIsLoginButtonDisabled] = useState(true);

    useEffect( () => {
        if (accountId.length < 1 || password.length < 1) {
            setIsLoginButtonDisabled(true);
            return;
        }
        setIsLoginButtonDisabled(false);
    });

    const login = () => {
        axios.post("/api/auth/login", {
            account_id: accountId,
            password: password,
        })
        .then( (res) => {
            console.log(res)
            Cookies.set("is_login", true);
            Cookies.set("access_token", res.data.access_token);
            location.href = "/";
        })
        .catch( (res) => {
            console.log(res.data)
        });
    }

    return (
        <>
            <Header />
            <div className="container mx-auto max-w-xl p-2">
                <div className="pt-3">
                    <label htmlFor="account_id" className="block mb-2 text-md font-medium text-gray-900">アカウントID</label>
                    <Input type="text" id="account_id" placeholder="アカウントID" inputEvent={(e) => setAccountId(e.target.value)} required/>
                </div>
                <div className="pt-3">
                    <label htmlFor="password" className="block mb-2 text-md font-medium text-gray-900">パスワード</label>
                    <Input type="password" id="password" placeholder="パスワード" inputEvent={(e) => setPassword(e.target.value)} required/>
                </div>
                <div className="flex justify-center pt-3">
                    <Button color="orange" px={14} py={3} clickEvent={login} disabled={isLoginButtonDisabled}>ログインする</Button>
                </div>
            </div>
        </>
    )
}
