@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Persetujuan</h1>
  <div class="bg-white rounded px-6 lg:px-12 py-6 lg:py-10 shadow my-5">
    <div class="flex justify-between gap-2">
      <form action="" method="get" class="relative w-full max-w-md">
        <input type="text" class="pl-3 pr-8 py-2 outline-none w-full focus:border-blue-400 rounded bg-gray-50 border border-gray-400" placeholder="search..." name="search">
        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa fa-search"></i></div>
      </form>
    </div>
    <div class="overflow-y-scroll lg:overflow-hidden w-full">
      <table class="table mt-3 text-center">
        <thead>
          <tr>
            <th>#</th>
            <th class="lg:hidden">Status</th>
            <th>Pemesan</th>
            <th>Kendaraan</th>
            <th class="hidden lg:table-cell">Pengemudi</th>
            <th>Tanggal</th>
            <th class="hidden lg:table-cell">Durasi</th>
            <th class="hidden lg:table-cell">Status</th>
            <th>Detail</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($approvals as $approval)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="lg:hidden capitalize">{{ translateStatus($approval->status) }}</td>
            <td class="capitalize">{{ $approval->customer_name }}</td>
            <td>{{ $approval->plat }}</td>
            <td class="capitalize hidden lg:table-cell">{{ $approval->driver_name }}</td>
            <td>{{ $approval->usage_at }}</td>
            <td class="hidden lg:table-cell">{{ $approval->estimated_duration }} Hari</td>
            <td class="hidden lg:table-cell">
              <form action="{{ route('approval.update', ['approval' => $approval->id]) }}" method="post" id="status">
                @csrf @method('PUT')
                <select name="status" onchange="document.querySelector('#status').submit()" class="px-3 py-2 
                  @if($approval->status == 'approved') bg-green-500 @elseif($approval->status == 'rejected') bg-red-500 @else bg-gray-500 @endif rounded text-white outline-none">
                  <option class="bg-white text-black" @if($approval->status == 'panding') selected @endif value="panding">Panding</option>
                  <option class="bg-white text-black" @if($approval->status == 'approved') selected @endif value="approved">Disetujui</option>
                  <option class="bg-white text-black" @if($approval->status == 'rejected') selected @endif value="rejected">Ditolak</option>
                </select>
              </form>
            </td>
            <td>
              <a href="{{ route('approval.show', ['approval' => $approval->id]) }}" class="block justify-center py-2 w-full bg-yellow-400 hover:bg-yellow-500 cursor-pointer text-white rounded">
                <i class="fa fa-eye"></i>
              </a>
            </td>
          </tr>
          @empty
            <tr>
              <td colspan="9" class="text-sm text-center">
                Data tidak tersedia.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $approvals->links('pagination::tailwind') }}
    </div>
    
  </div>
@endsection