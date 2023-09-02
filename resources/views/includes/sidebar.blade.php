<div class="min-h-screen bg-white w-18 lg:w-96 hidden lg:block" id="sidebar">

  <!-- Sidebar Header -->
  <div class="h-16 w-full bg-blue-500 border-r border-white/20 flex items-center justify-center text-center text-white">
    <span class="text-3xl font-bold lg:hidden">
      <i class="fa fa-cogs"></i>
    </span>
    <span class="text-xl font-bold hidden lg:block">
      Pemesanan Kendaraan
    </span>
  </div>
  <!-- End Sidebar Header -->

  @foreach (getSidebarNavs() as $nav)
  <!-- Sidebar Item -->
  @if (in_array(auth()->user()->role, $nav['roles']))
  <a href="{{ route($nav['route']) }}" class="h-16 w-full flex flex-col lg:flex-row justify-center lg:justify-start items-center text-gray-400 cursor-pointer hover:text-blue-500 {{ ($nav['path'] == "/".getCurrentPage()) ? 'sidebar-active' : '' }}">
    <div class="w-18 flex items-center justify-center">
      <i class="fa text-xl fa-{{ $nav['icon'] }}"></i>
    </div>
    <span class="text-x mt-2 lg:text-base lg:mt-0">{{ $nav['title'] }}</span>
  </a>
  @endif
  <!-- End Sidebar Item -->
  @endforeach

  <!-- Devider -->
  <div class="border-t border-gray-200 w-11/12 m-auto"></div>
  <!-- End Devider -->

  <form action="{{ route('auth.logout') }}" method="POST">
    @csrf
    <button class="h-16 w-full flex flex-col lg:flex-row justify-center lg:justify-start items-center text-gray-400 cursor-pointer hover:text-blue-500">
      <div class="w-18 flex items-center justify-center">
        <i class="fa text-xl fa-sign-out-alt"></i>
      </div>
      <span class="text-x mt-2 lg:text-base lg:mt-0">Logout</span>
    </button>
  </form>

</div>