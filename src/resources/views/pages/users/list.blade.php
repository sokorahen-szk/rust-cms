@extends('layouts.template')

@section('content')
<div class="container mx-auto max-w-5xl">
    <div class="p-2">

    <ul id="user_list" class="divide-y divide-gray-200">

    </ul>

    </div>
</div>
<script>
    $(() => {
        function listUser() {
            $.ajax({
                type: "GET",
                url: "/api/users",
            }).done( (res) => {
                console.log(res)
                res.data.forEach( (item) => {
            $("#user_list").append(`<li class="pb-3 py-4 user_list_item">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                <div class="flex-shrink-0">
                    <img class="w-28 h-28 rounded-full bg-gray-400">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-lg">
                        <a href="/users/${item.account_id}" class="hover:text-blue-800">${item.account_id}</a>
                    </p>
                    <p class="text-sm pt-2 text-gray-500">
                        作成日:${item.created_at}
                    </p>
                    <p class="text-sm pt-3">
                        <img class="w-5 h-5 rounded-full bg-gray-300 inline-flex">
                        <img class="w-5 h-5 rounded-full bg-gray-300 inline-flex">
                        <img class="w-5 h-5 rounded-full bg-gray-300 inline-flex">
                    </p>
                </div>
            </div>
            </li>`)
            })
            }).fail( () => {
                alert("error");
            })
        };

        listUser();
    })
</script>
@endsection