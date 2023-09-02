@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Sunting Data Pengemudi</h1>
  <div class="bg-white rounded px-6 lg:px-12 w-full lg:max-w-lg py-6 lg:py-10 shadow my-5">
    <a href="{{ route('driver.index') }}" class="flex text-gray-500 w-fit hover:text-blue-500 rounded mb-2 ">
      <div class="flex items-center px-2"><i class="fa fa-arrow-left fa-fw"></i></div>
      <div class="pr-3 py-2">Kembali</div>
    </a>
    <form action="{{ route('driver.update', ['driver' => $driver->id]) }}" method="post">
      @csrf @method('PUT')
      @csrf
      <div class="mb-2">
        <label for="fullname" class="mb-1 block">Nama Lengkap:</label>
        <input type="text" value="{{ $driver->fullname }}" placeholder="ketik disini..." class="input" id="fullname" name="fullname">
        @error('fullname')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="phone" class="mb-1 block">Nomor HP:</label>
        <input type="text" value="{{ $driver->phone }}" placeholder="ketik disini..." class="input" id="phone" name="phone">
        @error('phone')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="availability_status" class="mb-1 block">Ketersediaan:</label>
        <select name="availability_status" id="availability_status" class="input-select">
          <option value="yes"@if($driver->availability_status == 'yes') selected @endif>Ya</option>
          <option value="not"@if($driver->availability_status == 'not') selected @endif>Tidak</option>
        </select>
        @error('availability_status')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <button class="justify-center py-2 w-full bg-blue-500 hover:bg-blue-600 cursor-pointer text-white rounded">
        Simpan
      </button>
    </form>
  </div>
@endsection