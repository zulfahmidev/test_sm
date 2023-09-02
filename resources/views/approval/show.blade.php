@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Detail Pemesanan</h1>
  <div class="bg-white rounded px-6 lg:px-12 w-full lg:max-w-lg py-6 lg:py-10 shadow my-5">
    <a href="{{ route('approval.index') }}" class="flex text-gray-500 w-fit hover:text-blue-500 rounded mb-2 ">
      <div class="flex items-center px-2"><i class="fa fa-arrow-left fa-fw"></i></div>
      <div class="pr-3 py-2">Kembali</div>
    </a>
    <table class="table mt-3 text-center">
      <tr>
        <th>Status</th>
        <td>
          <form action="{{ route('approval.update', ['approval' => $approval->id]) }}" method="post" id="status">
            @csrf @method('PUT')
            <select name="status" onchange="document.querySelector('#status').submit()" class="px-3 py-2 w-full 
              @if($approval->status == 'approved') bg-green-500 @elseif($approval->status == 'rejected') bg-red-500 @else bg-gray-500 @endif rounded text-white outline-none">
              <option class="bg-white text-black" @if($approval->status == 'panding') selected @endif value="panding">Panding</option>
              <option class="bg-white text-black" @if($approval->status == 'approved') selected @endif value="approved">Disetujui</option>
              <option class="bg-white text-black" @if($approval->status == 'rejected') selected @endif value="rejected">Ditolak</option>
            </select>
          </form>
        </td>
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
    
  </div>
@endsection