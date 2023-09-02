@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Tambah Data Kendaraan</h1>
  <div class="bg-white rounded px-6 lg:px-12 w-full lg:max-w-lg py-6 lg:py-10 shadow my-5">
    <a href="{{ route('vehicle.index') }}" class="flex text-gray-500 w-fit hover:text-blue-500 rounded mb-2 ">
      <div class="flex items-center px-2"><i class="fa fa-arrow-left fa-fw"></i></div>
      <div class="pr-3 py-2">Kembali</div>
    </a>
    <table class="table mt-3 text-center">
      <tr>
        <th>Plat</th>
        <td>{{ $vehicle->plat }}</td>
      </tr>
      <tr>
        <th>Jenis</th>
        <td class="capitalize">{{ translateStatus($vehicle->transport_type) }}</td>
      </tr>
      <tr>
        <th>Kapasitas</th>
        <td>{{ $vehicle->capacity }}</td>
      </tr>
      <tr>
        <th>Kepemilikan</th>
        <td class="capitalize">{{ translateStatus($vehicle->ownership_status) }}</td>
      </tr>
      <tr>
        <th>Kondisi</th>
        <td class="capitalize">{{ translateStatus($vehicle->condition) }}</td>
      </tr>
    </table>
    <div class="flex gap-2 mt-2">
      <a href="{{ route('vehicle.edit', ['vehicle' => $vehicle->id]) }}" class="flex justify-center py-2 w-full bg-green-400 hover:bg-green-500 cursor-pointer text-white rounded items-center">
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('vehicle.destroy', ['vehicle' => $vehicle->id]) }}" method="post" class="w-full">
        @csrf @method('DELETE')
        <button class="justify-center py-2 w-full bg-red-400 hover:bg-red-500 cursor-pointer text-white rounded" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
          <i class="fa fa-trash"></i>
        </button>
      </form>
    </div>
  </div>
@endsection