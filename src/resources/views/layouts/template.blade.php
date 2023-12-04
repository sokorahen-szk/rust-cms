<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config("app.name") }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="p-2 bg-zinc-50">
        <div class="flex justify-between py-2">
            <div>
                <a href="/">{{ config('app.name') }}</a>
            </div>
            <div>
                <x-button-around color="cyan" text="ログイン" href="/login" />
                <x-button-around color="green" text="新規登録" href="/register" />
            </div>
        </div>
    </header>
    @yield("content")
</body>
</html>