import React from "react";
import Tag from "../atoms/tag";

export default function Tags(props) {
    return (
        <>
            {
                props.items.map( (item) => {
                    return (
                        <Tag
                            key={item.value}
                            color={item.color}
                            px={2}
                            py={2}
                            ml={2}
                            rounded
                        >{item.value}</Tag>
                    )
                })
            }
        </>
    )
}