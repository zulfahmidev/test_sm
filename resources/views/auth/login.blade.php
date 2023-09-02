<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class="w-96 p-5 bg-white rounded shadow">
    <div class="text-xl text-center my-2 font-bold text-blue-500">Pemesanan Kendaraan</div>
    <div class="text-sm text-center">Selamat datang kembali, silahkan login!</div>
    @if (session('error'))
    <div class="py-2 px-3 mt-3 border-red-400 border bg-red-100 text-sm rounded text-red-600">
      {{ session('error') }}
    </div>
    @endif
    <form action="{{ route('auth.login') }}" class="mt-3" method="post">
      @csrf
      <div class="mb-2">
        <input type="text" class="py-2 px-3 border border-gray-400 bg-gray-50 rounded outline-none w-full text-center" placeholder="Username" name="username">
        @error('username')
        <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <input type="password" class="py-2 px-3 border border-gray-400 bg-gray-50 rounded outline-none w-full text-center" placeholder="Password" name="password">
        @error('password')
        <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
        @enderror
      </div>
      <button class="py-2 px-3 bg-blue-500 rounded text-center w-full text-white hover:bg-blue-600">Login</button>
    </form>
  </div>
</body>
</html>