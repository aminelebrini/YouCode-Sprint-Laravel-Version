<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | YouCode Sprint</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen p-4">

    <div class="bg-gray-800 p-8 rounded-xl w-full max-w-md">
        <h1 class="text-white text-3xl mb-6 text-center font-bold">YouCode Sprint</h1>

        @if($errors->any())
            <div class="text-red-500 mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <input type="email" name="email" placeholder="Email" required
                class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none">
            <input type="password" name="password" placeholder="Mot de passe" required
                class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none">
            <button type="submit" class="w-full p-3 bg-cyan-500 text-white font-bold rounded-lg hover:bg-cyan-600 transition">
                Se connecter
            </button>
        </form>
    </div>

</body>
</html>
