import React, {useState} from "react";
import Tag from "../atoms/tag";

export default function Tags(props) {
    const [selectedTag, setSelectedTag] = useState("");

    const clickEvent = (selectedTag) => {
        setSelectedTag(selectedTag.id);
        props.changeEvent(selectedTag.state ? selectedTag.id : 0);
    }

    return (
        <>
            {
                props.items.map( (item) => {
                    return (
                        <Tag
                            key={item.value}
                            color={item.color}
                            id={item.id}
                            selected={selectedTag}
                            px={2}
                            py={2}
                            mr={2}
                            rounded
                            clickEvent={clickEvent}
                        >{item.value}</Tag>
                    )
                })
            }
        </>
    )
}