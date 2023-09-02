@extends('layouts.main')

@section('content')
  <h1 class="text-3xl">Kendaraan</h1>
  <div class="bg-white rounded px-6 lg:px-12 py-6 lg:py-10 shadow my-5">
    <div class="flex justify-between gap-2">
      <a href="{{ route('vehicle.create') }}" class="bg-blue-500 hover:bg-blue-600 cursor-pointer flex text-white rounded">
        <div class="flex items-center px-2"><i class="fa fa-plus fa-fw"></i></div>
        <div class="pr-3 py-2">Tambah</div>
      </a>
      <form action="" method="get">
        <div class="relative w-full max-w-xs">
            <input type="text" class="pl-3 pr-8 py-2 outline-none w-full focus:border-blue-400 rounded bg-gray-50 border border-gray-400" placeholder="search..." name="search">
            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"><i class="fa fa-search"></i></div>
          </div>
      </form>
    </div>
    <div class="overflow-y-scroll lg:overflow-hidden w-full">
      <table class="table mt-3 text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Plat</th>
            <th class="hidden lg:table-cell">Jenis</th>
            <th class="hidden lg:table-cell">Kepemilikan</th>
            <th class="hidden lg:table-cell">Kapasitas</th>
            <th>Kondisi</th>
            <th class="hidden lg:table-cell">Sunting</th>
            <th class="hidden lg:table-cell">Hapus</th>
            <th>Detail</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($vehicles as $vehicle)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $vehicle->plat }}</td>
            <td class="capitalize hidden lg:table-cell">{{ translateStatus($vehicle->transport_type) }}</td>
            <td class="capitalize hidden lg:table-cell">{{ translateStatus($vehicle->ownership_status) }}</td>
            <td class="hidden lg:table-cell">{{ $vehicle->capacity . ' ' .(($vehicle->transport_type == 'goods') ? 'Kg' : 'Orang') }}</td>
            <td class="capitalize">{{ translateStatus($vehicle->condition) }}</td>
            <td class="hidden lg:table-cell">
              <a href="{{ route('vehicle.edit', ['vehicle' => $vehicle->id]) }}" class="block justify-center py-2 w-full bg-green-400 hover:bg-green-500 cursor-pointer text-white rounded">
                <i class="fa fa-edit"></i>
              </a>
            </td>
            <td class="hidden lg:table-cell">
              <form action="{{ route('vehicle.destroy', ['vehicle' => $vehicle->id]) }}" method="post">
                @csrf @method('DELETE')
                <button class="justify-center py-2 w-full bg-red-400 hover:bg-red-500 cursor-pointer text-white rounded" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                  <i class="fa fa-trash"></i>
                </button>
              </form>
            </td>
            <td>
              <a href="{{ route('vehicle.show', ['vehicle' => $vehicle->id]) }}" class="block justify-center py-2 w-full bg-yellow-400 hover:bg-yellow-500 cursor-pointer text-white rounded">
                <i class="fa fa-eye"></i>
              </a>
            </td>
          </tr>
          @empty
            <tr>
              <td colspan="8" class="text-sm text-center">
                Data tidak tersedia.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- {{ $vehicles->links() }} --}}
    <div class="mt-3">
      {{ $vehicles->links('pagination::tailwind') }}
    </div>
    
  </div>
@endsection