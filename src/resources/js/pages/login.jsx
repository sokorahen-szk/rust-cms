import React, {useState} from "react";
import axios from "axios";
import Header from "../components/organisms/header";
import Input from "../components/atoms/input";
import Button from "../components/atoms/button";

export default function Login() {
    const [accountId, setAccountId] = useState("");
    const [password, setPassword] = useState("");
    const login = () => {
        axios.post("/api/auth/login", {
            account_id: accountId,
            password: password,
        })
        .then( (res) => {
            console.log(res.data)
        })
        .catch( (res) => {
            console.log(res.data)
        });
    }

    return (
        <>
            <Header title="rustサイト" />
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
                    <Button text="ログインする" color="orange" x={14} y={3} clickEvent={login} />
                </div>
            </div>
        </>
    )
}
