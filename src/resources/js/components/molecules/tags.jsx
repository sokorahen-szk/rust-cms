import React from "react";
import Tag from "../atoms/tag";

export default function Tags(props) {
    const event = () => {
        console.log("A")
    }
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
                            mr={2}
                            rounded
                            clickEvent={event}
                        >{item.value}</Tag>
                    )
                })
            }
        </>
    )
}