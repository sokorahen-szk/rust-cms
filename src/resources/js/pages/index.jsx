import React from "react";
import UserPostList from "../components/organisms/user_post_list";
import TwoColumnLayout from "../components/templates/two_column_layout";

export default function Index() {
    return (
        <>
            <TwoColumnLayout
                content={
                <div>a</div>
                }
                left={
                    <>
                    <UserPostList />
                    </>
                }
            >
            </TwoColumnLayout>
        </>
    );
}
