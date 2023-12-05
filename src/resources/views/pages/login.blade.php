@extends('layouts.template')

@section('content')
<div class="container mx-auto max-w-xl">
<div class="p-2">

    <div role="alert" class="alert hidden">
        <div class="border border-red-400 bg-red-100 p-3 text-red-700">
        ログインに失敗しました。
        </div>
    </div>

    <div class="pt-3">
        <label for="account_id" class="block mb-2 text-md font-medium text-gray-900">アカウントID</label>
        <input type="text" id="account_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm block w-full p-2" placeholder="アカウントID" required>
    </div>
    <div class="pt-3">
        <label for="password" class="block mb-2 text-smdm font-medium text-gray-900">パスワード</label>
        <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm block w-full p-2" placeholder="アカウントID" required>
    </div>
    <div class="flex justify-center pt-3">
        <button id="login" class="bg-orange-500 hover:bg-orange-600 text-white text-xl font-bold p-3">
            ログインする
        </button>
    </div>
</div>
</div>
<script>
    $(() => {
        $("#login").on("click", () => {
            $.ajax({
                type: "POST",
                url: "/api/auth/login",
                data: { account_id: $("#account_id").val(), password: $("#password").val() }
            }).done( (res) => {
                Cookies.set("access_token", res.access_token);
            }).fail( () => {
                $(".alert").removeClass("hidden");
            })
        });
    })
</script>
@endsection