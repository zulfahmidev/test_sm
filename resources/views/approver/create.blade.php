@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Tambah Data Pengemudi</h1>
  <div class="bg-white rounded px-6 lg:px-12 w-full lg:max-w-lg py-6 lg:py-10 shadow my-5">
    <a href="{{ route('approver.index') }}" class="flex text-gray-500 w-fit hover:text-blue-500 rounded mb-2 ">
      <div class="flex items-center px-2"><i class="fa fa-arrow-left fa-fw"></i></div>
      <div class="pr-3 py-2">Kembali</div>
    </a>
    <form action="{{ route('approver.store') }}" method="post">
      @csrf
      <div class="mb-2">
        <label for="fullname" class="mb-1 block">Nama Lengkap:</label>
        <input type="text" placeholder="ketik disini..." class="input" id="fullname" name="fullname">
        @error('fullname')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="position" class="mb-1 block">Jabatan:</label>
        <input type="text" placeholder="ketik disini..." class="input" id="position" name="position">
        @error('position')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="username" class="mb-1 block">Username:</label>
        <input type="text" placeholder="ketik disini..." class="input" id="username" name="username">
        @error('username')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="password" class="mb-1 block">Password:</label>
        <input type="password" placeholder="ketik disini..." class="input" id="password" name="password">
        @error('password')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <button class="justify-center py-2 w-full bg-blue-500 hover:bg-blue-600 cursor-pointer text-white rounded">
        Simpan
      </button>
    </form>
  </div>
@endsection