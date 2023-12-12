import React from "react";
import Header from "../components/organisms/header";
import Input from "../components/atoms/input";
import Button from "../components/atoms/button";

export default function Login() {
    return (
        <>
            <Header title="rustサイト" />
            <div className="container mx-auto max-w-xl p-2">
                <div className="pt-3">
                    <label for="account_id" class="block mb-2 text-md font-medium text-gray-900">アカウントID</label>
                    <Input type="text" id="account_id" placeholder="アカウントID" required/>
                </div>
                <div className="pt-3">
                    <label for="account_id" class="block mb-2 text-md font-medium text-gray-900">パスワード</label>
                    <Input type="password" id="password" placeholder="パスワード" required/>
                </div>
                <div className="flex justify-center pt-3">
                    <Button text="ログインする" color="orange" x={14} y={3} />
                </div>
            </div>
        </>
    )
}
