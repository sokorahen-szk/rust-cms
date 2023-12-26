import axios from "axios";
import React, {useState, useEffect} from "react";
import TwoColumnTemplate from "../components/templates/two_column_template";
import Button from "../components/atoms/button";

export default function Index() {
    const [posts, setPosts] = useState([]);
    useEffect( () => {
        fetchPost();
    }, []);
    const fetchPost = () => {
        axios.get("/api/posts", {params: {
                limit: 3,
            }
        })
        .then( (res) => {
            console.log(res.data.data)
            setPosts(res.data.data)
        })
        .catch( (res) => {
            console.log(res.data)
        });
    }

    return (
        <>
            <TwoColumnTemplate
                content={
                <div>a</div>
                }
                left={
                    <div>
                        <h3 className="text-xl pt-3 pb-1 px-1 border-y">
                            募集
                        </h3>
                        <div>
                            <ul className="mb-3">
                            {
                                posts.map( (post) => {
                                    return (
                                    <li key={post.id} className="pt-2 pl-1 pr-1 cursor-pointer hover:bg-gray-100">
                                        <div>
                                            <img className="w-10 h-10 rounded-full inline" src={post.user.avator_image} />
                                            <p className="inline-block ml-2">{post.user.account_id}</p>
                                        </div>
                                        <div className="p-2 text-sm">
                                            {post.message}
                                        </div>
                                    </li>
                                    );
                                })
                            }
                            </ul>
                            <Button text="aaaa" color="gray" px={3} py={2}>もっと読む</Button>
                        </div>
                    </div>
                }
            >
            </TwoColumnTemplate>
        </>
    );
}
