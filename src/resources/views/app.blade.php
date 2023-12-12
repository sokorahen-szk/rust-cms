<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config("app.name") }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @inertiaHead
    @viteReactRefresh
    @vite(["resources/js/app.jsx"])
</head>
<body>
    <header class="p-2 bg-zinc-50">
        <div class="flex justify-between py-2">
            <div>
                <a href="/">{{ config('app.name') }}</a>
            </div>
            <div id="login-nav">
                <a href="/login">      
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-1 rounded">
                        ログイン
                    </button>
                </a>
                <a href="/register">      
                    <button class="bg-green-600 hover:bg-green-700 text-white font-bold px-4 py-1 rounded">
                        新規登録
                    </button>
                </a>
            </div>
            <div id="logout-nav" class="hidden">
                <a href="/register">      
                    <button class="bg-green-600 hover:bg-green-700 text-white font-bold px-4 py-1 rounded">
                    ログアウト
                    </button>
                </a>
            </div>
        </div>
    </header>
    @inertia
</body>
</html>