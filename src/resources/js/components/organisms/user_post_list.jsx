import axios from "axios";
import dayjs from "dayjs";
import React, {useState, useEffect} from "react";
import Button from "../atoms/button";
import Avator from "../atoms/avator";
import Loading from "../atoms/loading";
import Tag from "../atoms/tag";

export default function UserPostList(props) {
    const [posts, setPosts] = useState([]);
    const [isLoadingPost, setLoadingPost] = useState(true);
    useEffect( () => {
        fetchPost();
    }, []);
    const fetchPost = () => {
        axios.get("/api/posts", {params: {
                limit: props.userPostLimit || 3,
            }
        })
        .then( (res) => {
            setPosts(res.data.data);
            setLoadingPost(false);
        })
        .catch( (res) => {
            console.log(res.data);
        });
    }
    return (
        <div>
            <h3 className="text-xl pt-3 pb-3 px-2 border-y">
                募集
            </h3>
            <div>
                <Loading rounded w={12} h={12} mt={2} color="gray" isLoading={isLoadingPost} />
                <ul>
                {
                    posts.map( (post) => {
                        return (
                        <li key={post.id} className="pt-2 px-2 py-3 cursor-pointer hover:bg-gray-100">
                            <div>
                                <Avator src={post.user.avator_image} w={8} h={8} rounded />
                                <p className="inline-block ml-2">{post.user.account_id}</p>
                                <Tag color="indigo" px={1} py={1} mx={2}>{post.platform}</Tag>
                            </div>
                            <div className="p-2 text-sm">
                                {post.message}
                            </div>
                            <div className="text-sm text-gray-700">
                                <p>投稿日:{dayjs(post.created_at).format("YYYY/MM/DD hh:mm:ss")}</p>
                                <p className="mt-2"><Tag color="blue" px={3} py={1} rounded>{post.category}</Tag></p>
                            </div>
                        </li>
                        );
                    })
                }
                </ul>
                <div className="text-center py-2">
                    <Button color="gray" px={20} py={2} rounded none={isLoadingPost}>もっと見る</Button>
                </div>
            </div>
        </div>
    )
}