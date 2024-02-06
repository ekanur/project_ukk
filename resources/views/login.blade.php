<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    <div class="main-bg h-screen flex">
        <div class="grow"></div>
        <div class="grow bg-white flex py-6 px-24 justify-center flex-col">
            <div class="text-xxl">LOGIN</div>
            @csrf
            @if ($errors->any())
                <div class="text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif  
            <form action={{route('login.store')}} method="POST">
                @csrf
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="rounded-lg p-1 w-full border-2 border-black" placeholder="Masukan email">
                </div>
                <div class="mt-4">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="rounded-lg p-1 w-full border-2 border-black" placeholder="Masukan password">
                </div>
                <div class="mt-4">
                    <button type="submit" class="main-bg text-white p-2 w-full rounded-lg">Login</button>
                </div>
            </form>
            <div class="mt-4">tidak punya akun? <a href="/register/create" class="text-blue-400">daftar sekarang</a></div>
        </div>
        <div class="grow"></div>
    </div>
</body>
</html>