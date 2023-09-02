@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Detail Pengemudi</h1>
  <div class="bg-white rounded px-6 lg:px-12 w-full lg:max-w-lg py-6 lg:py-10 shadow my-5">
    <a href="{{ route('driver.index') }}" class="flex text-gray-500 w-fit hover:text-blue-500 rounded mb-2 ">
      <div class="flex items-center px-2"><i class="fa fa-arrow-left fa-fw"></i></div>
      <div class="pr-3 py-2">Kembali</div>
    </a>
    <table class="table mt-3 text-center">
      <tr>
        <th>Nama</th>
        <td class="capitalize">{{ $driver->fullname }}</td>
      </tr>
      <tr>
        <th>Kontak</th>
        <td>{{ $driver->phone }}</td>
      </tr>
      <tr>
        <th>Ketersediaan</th>
        <td class="capitalize">{{ translateStatus($driver->availability_status) }}</td>
      </tr>
    </table>
    <div class="flex gap-2 mt-2">
      <a href="{{ route('driver.edit', ['driver' => $driver->id]) }}" class="flex justify-center py-2 w-full bg-green-400 hover:bg-green-500 cursor-pointer text-white rounded items-center">
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('driver.destroy', ['driver' => $driver->id]) }}" method="post" class="w-full">
        @csrf @method('DELETE')
        <button class="justify-center py-2 w-full bg-red-400 hover:bg-red-500 cursor-pointer text-white rounded" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
          <i class="fa fa-trash"></i>
        </button>
      </form>
    </div>
  </div>
@endsection