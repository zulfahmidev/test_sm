@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Sunting Data Kendaraan</h1>
  <div class="bg-white rounded px-6 lg:px-12 w-full lg:max-w-lg py-6 lg:py-10 shadow my-5">
    <a href="{{ route('vehicle.index') }}" class="flex text-gray-500 w-fit hover:text-blue-500 rounded mb-2 ">
      <div class="flex items-center px-2"><i class="fa fa-arrow-left fa-fw"></i></div>
      <div class="pr-3 py-2">Kembali</div>
    </a>
    <form action="{{ route('vehicle.update', ['vehicle' => $vehicle->id]) }}" method="post">
      @csrf @method('PUT')
      <div class="mb-2">
        <label for="plat" class="mb-1 block">Nomor Plat:</label>
        <input type="text" value="{{ $vehicle->plat }}" placeholder="ketik disini..." class="input" id="plat" name="plat">
        @error('plat')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="transport_type" class="mb-1 block">Jenis Angkutan:</label>
        <select name="transport_type" id="transport_type" class="input-select">
          <option value="passengers"@if($vehicle->transport_type == 'passangers') selected @endif>Penumpang</option>
          <option value="goods"@if($vehicle->transport_type == 'goods') selected @endif>Barang</option>
        </select>
        @error('transport_type')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="capacity" class="mb-1 block">Kapasitas:</label>
        <div class="input-note">* Satuan Angkutan: Barang = Kg, Penumpang = Orang </div>
        <input type="number" value="1" min="1" class="input" id="capacity" name="capacity">
        @error('capacity')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="ownership_status" class="mb-1 block">Kepemilikan:</label>
        <select name="ownership_status" id="ownership_status" class="input-select">
          <option value="owned"@if($vehicle->ownership_status == 'owned') selected @endif>Pribadi</option>
          <option value="leased"@if($vehicle->ownership_status == 'leased') selected @endif>Sewaan</option>
        </select>
        @error('ownership_status')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="condition" class="mb-1 block">Kondisi:</label>
        <select name="condition" id="condition" class="input-select">
          <option value="good"@if($vehicle->condition == 'good') selected @endif>Baik</option>
          <option value="repair"@if($vehicle->condition == 'repair') selected @endif>Perbaikan</option>
          <option value="damaged"@if($vehicle->condition == 'damaged') selected @endif>Rusak</option>
        </select>
        @error('condition')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <button class="justify-center py-2 w-full bg-blue-500 hover:bg-blue-600 cursor-pointer text-white rounded">
        Simpan
      </button>
    </form>
  </div>
@endsection