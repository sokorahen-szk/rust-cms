@extends('layouts.template')

@section('content')
<div class="container mx-auto max-w-xl">
<div class="p-2">
    <div class="pt-3">
        <label for="account_id" class="block mb-2 text-md font-medium text-gray-900">アカウントID</label>
        <input type="text" name="account_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm block w-full p-2" placeholder="アカウントID">
    </div>
    <div class="pt-3">
        <label for="password" class="block mb-2 text-smdm font-medium text-gray-900">パスワード</label>
        <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm block w-full p-2" placeholder="アカウントID">
    </div>
    <div class="flex justify-center pt-3">
        <button class="bg-orange-500 hover:bg-orange-600 text-white text-xl font-bold p-3">
            ログインする
        </button>
    </div>
</div>
</div>
@endsection