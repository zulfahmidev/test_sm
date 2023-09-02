@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Tambah Data Pemesanan</h1>
  <div class="bg-white rounded px-6 lg:px-12 w-full lg:max-w-lg py-6 lg:py-10 shadow my-5">
    <a href="{{ route('booking.index') }}" class="flex text-gray-500 w-fit hover:text-blue-500 rounded mb-2 ">
      <div class="flex items-center px-2"><i class="fa fa-arrow-left fa-fw"></i></div>
      <div class="pr-3 py-2">Kembali</div>
    </a>
    <table class="table mt-3 text-center">
      <tr>
        <th>Status</th>
        <td class="capitalize">{{ translateStatus($booking->getStatus()) }}</td>
      </tr>
      <tr>
        <th>Pemesan</th>
        <td class="capitalize">{{ $booking->customer_name }}</td>
      </tr>
      <tr>
        <th>Plat Kendaraan</th>
        <td class="capitalize">{{ $booking->getVehicle()->plat }}</td>
      </tr>
      <tr>
        <th>Pengemudi</th>
        <td class="capitalize">{{ $booking->getDriver()->fullname }}</td>
      </tr>
      <tr>
        <th>Digunakan</th>
        <td class="capitalize">{{ $booking->usage_at }}</td>
      </tr>
      <tr>
        <th>Durasi</th>
        <td class="capitalize">{{ $booking->estimated_duration }}</td>
      </tr>
      <tr>
        <th>Penyetujui</th>
        <td class="capitalize">
          @foreach ($booking->getApprovers() as $approver)
            {{ $approver->fullname }} {{ ($loop->iteration < $booking->getApprovers()->count()) ? ', ' : '' }}
          @endforeach
        </td>
      </tr>
      <tr>
        <th>Note</th>
        <td class="capitalize">{{ $booking->note }}</td>
      </tr>
    </table>
    <div class="flex gap-2 mt-2">
      <a href="{{ route('booking.edit', ['booking' => $booking->id]) }}" class="flex justify-center py-2 w-full bg-green-400 hover:bg-green-500 cursor-pointer text-white rounded items-center">
        <i class="fa fa-edit"></i>
      </a>
      <form action="{{ route('booking.destroy', ['booking' => $booking->id]) }}" method="post" class="w-full">
        @csrf @method('DELETE')
        <button class="justify-center py-2 w-full bg-red-400 hover:bg-red-500 cursor-pointer text-white rounded" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
          <i class="fa fa-trash"></i>
        </button>
      </form>
    </div>
  </div>
@endsection