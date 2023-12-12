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
    @inertia
</body>
</html>