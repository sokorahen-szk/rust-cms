import React from "react";
import UserPostList from "../components/organisms/user_post_list";
import TwoColumnLayout from "../components/templates/two_column_layout";
import Tags from "../components/molecules/Tags";

export default function Index() {

    const mockTags = [
        {color: "red", value: "チーター"},
        {color: "red", value: "荒らし・嫌がらせ"},
        {color: "red", value: "ゴースティング"},
        {color: "red", value: "パス抜き"},
    ]

    return (
        <>
            <TwoColumnLayout
                content={
                <div className="mt-3">
                    <Tags items={mockTags} />
                </div>
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
