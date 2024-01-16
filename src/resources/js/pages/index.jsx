import React from "react";
import UserPostList from "../components/organisms/user_post_list";
import TwoColumnLayout from "../components/templates/two_column_layout";
import Tags from "../components/molecules/Tags";

export default function Index() {

    const mockTags = [
        {id: 1, color: "gray", value: "チーター", display_order: 1},
        {id: 2, color: "gray", value: "荒らし・嫌がらせ", display_order: 1},
        {id: 3, color: "gray", value: "ゴースティング", display_order: 1},
        {id: 4, color: "gray", value: "パス抜き", display_order: 1},
    ]

    const filterTags = (displayOrderNum) => {
        return mockTags.filter( (tag) => {
            return tag.display_order === displayOrderNum;
        });
    }

    return (
        <>
            <TwoColumnLayout
                content={
                <div className="mt-3">
                    <div className="mb-1">悪質ユーザー</div>
                    <Tags items={filterTags(1)} />
                    <div className="mt-2 mb-1">一般</div>
                    <Tags items={filterTags(2)} />
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
