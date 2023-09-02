@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Tambah Data Pemesanan</h1>
  <div class="bg-white rounded px-6 lg:px-12 w-full lg:max-w-lg py-6 lg:py-10 shadow my-5">
    <a href="{{ route('booking.index') }}" class="flex text-gray-500 w-fit hover:text-blue-500 rounded mb-2 ">
      <div class="flex items-center px-2"><i class="fa fa-arrow-left fa-fw"></i></div>
      <div class="pr-3 py-2">Kembali</div>
    </a>
    <form action="{{ route('booking.store') }}" method="post">
      @csrf
      <div class="mb-2">
        <label for="customer_name" class="mb-1 block">Pemesan:</label>
        <input type="text" placeholder="ketik disini..." class="input" id="customer_name" name="customer_name">
        @error('customer_name')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="usage_at" class="mb-1 block">Tanggal Digunakan:</label>
        <input type="datetime-local" placeholder="ketik disini..." class="input" id="usage_at" name="usage_at">
        @error('usage_at')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="estimated_duration" class="mb-1 block">Durasi Digunakan:</label>
        <div class="input-note">* Menggunakan satuan Hari </div>
        <input type="number" placeholder="ketik disini..." value="1" min="1" class="input" id="estimated_duration" name="estimated_duration">
        @error('estimated_duration')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-2">
        <label for="note" class="mb-1 block">Catatan:</label>
        <textarea name="note" placeholder="ketik disini..." id="note" class="input" cols="30" rows="5"></textarea>
        @error('note')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2">
        <label for="vehicle_id" class="mb-1 block">Kendaraan:</label>
        <input type="hidden" name="vehicle_id" id="vehicle_id">
        <div class="px-3 py-2 bg-gray-50 border border-gray-400 rounded flex justify-between items-center cursor-pointer" id="vehicle_select" onclick="vehicleOptions()">
          <span>Pilih Kendaraan</span>
          <i class="fa fa-angle-down"></i>
        </div>

        <div class="bg-gray-50 border border-gray-400 rounded mt-2 shadow-lg hidden" id="vehicleOptions">
          <div class="p-2">
            <input type="text" class="input" placeholder="cari kendaraan..." oninput="getVhhicles(this.value, '.vehicles')">
          </div>
          <div class="vehicles">
            <div class="px-3 py-2 [&:nth-child(even)]:bg-blue-100 [&:nth-child(odd)]:bg-blue-50 [&:nth-child(even)]:hover:bg-blue-200 [&:nth-child(odd)]:hover:bg-blue-200 flex justify-between hover:bg-blue-200 cursor-pointer">No Items</div>`
          </div>
        </div>

        @error('vehicle_id')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2">
        <label for="driver_id" class="mb-1 block">Pengemudi:</label>
        <input type="hidden" name="driver_id" id="driver_id">
        <div class="px-3 py-2 bg-gray-50 border border-gray-400 rounded flex justify-between items-center cursor-pointer" id="driver_select" onclick="driverOptions()">
          <span>Pilih Pengemudi</span>
          <i class="fa fa-angle-down"></i>
        </div>

        <div class="bg-gray-50 border border-gray-400 rounded mt-2 shadow-lg hidden" id="driverOptions">
          <div class="p-2">
            <input type="text" class="input" placeholder="cari pengemudi..." oninput="getDrivers(this.value, '.drivers')">
          </div>
          <div class="drivers">
            <div class="px-3 py-2 [&:nth-child(even)]:bg-blue-100 [&:nth-child(odd)]:bg-blue-50 [&:nth-child(even)]:hover:bg-blue-200 [&:nth-child(odd)]:hover:bg-blue-200 flex justify-between hover:bg-blue-200 cursor-pointer">No Items</div>`
          </div>
        </div>

        @error('driver_id')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2">
        <label for="user_id" class="mb-1 block">Penyetujui:</label>
        <div class="px-3 py-2 bg-gray-50 border border-gray-400 rounded flex justify-between items-center cursor-pointer" id="approver_select" onclick="approverOptions()">
          <span>Pilih Penyetujui</span>
          <i class="fa fa-angle-down"></i>
        </div>

        <div class="bg-gray-50 border border-gray-400 rounded mt-2 shadow-lg hidden" id="approverOptions">
          <div class="p-2">
            <input type="text" class="input" placeholder="cari penyetujui..." oninput="getApprovers(this.value)">
          </div>
          <div class="approvers">
            <div class="px-3 py-2 [&:nth-child(even)]:bg-blue-100 [&:nth-child(odd)]:bg-blue-50 [&:nth-child(even)]:hover:bg-blue-200 [&:nth-child(odd)]:hover:bg-blue-200 flex justify-between hover:bg-blue-200 cursor-pointer">No Items</div>`
          </div>
        </div>

        <div id="approvers" class="flex flex-wrap gap-2 mt-2"></div>

        @error('user_id')
        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
        @enderror
      </div>


      <button class="justify-center py-2 w-full bg-blue-500 hover:bg-blue-600 cursor-pointer text-white rounded" onclick="submitBooking(event)">
        Simpan
      </button>
    </form>
  </div>
@endsection