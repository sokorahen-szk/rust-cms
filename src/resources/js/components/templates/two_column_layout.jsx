import React from "react";
import Header from "../organisms/header";

export default function TwoColumnLayout({content, left}) {
    return <>
        <Header />
        <div className="container mx-auto">
            <div className="grid grid-cols-3">
                <div className="md:col-span-2 col-span-3">
                    {content}
                </div>
                <div className="md:col-span-1 col-span-3">
                    {left}
                </div>
            </div>
        </div>
    </>
}