import axios from "axios";
import React, {useState, useEffect} from "react";
import TwoColumnLayout from "../components/templates/two_column_layout";
import Button from "../components/atoms/button";
import Avator from "../components/atoms/avator";
import Loading from "../components/atoms/loading";

export default function Index() {
    const [posts, setPosts] = useState([]);
    const [isLoadingPost, setLoadingPost] = useState(true);
    useEffect( () => {
        fetchPost();
    }, []);
    const fetchPost = () => {
        axios.get("/api/posts", {params: {
                limit: 5,
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
        <>
            <TwoColumnLayout
                content={
                <div>a</div>
                }
                left={
                    <div>
                        <h3 className="text-xl pt-3 pb-3 px-2 border-y">
                            募集
                        </h3>
                        <div>
                            <Loading rounded w={12} h={12} mt={2} color="gray" isLoading={isLoadingPost} />
                            <ul className="mb-3">
                            {
                                posts.map( (post) => {
                                    return (
                                    <li key={post.id} className="pt-2 px-2 cursor-pointer hover:bg-gray-100">
                                        <div>
                                            <Avator src={post.user.avator_image} w={8} h={8} rounded />
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
                            <div className="text-center">
                                <Button color="gray" px={20} py={2} rounded none={isLoadingPost}>もっと見る</Button>
                            </div>
                        </div>
                    </div>
                }
            >
            </TwoColumnLayout>
        </>
    );
}
