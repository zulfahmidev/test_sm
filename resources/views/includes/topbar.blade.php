<div class="h-16 bg-blue-500 flex justify-between items-center px-4 lg:px-8 sticky top-0">
  <div>
    <div class="h-12 w-12 active:bg-white/20 rounded-full text-3xl text-white flex justify-center items-center lg:hidden" onclick="toggleSidebar()">
      <i class="fa fa-bars"></i>
    </div>
  </div>
  <div class="flex gap-2 items-center">
    <div class="text-white/75 text-sm capitalize">{{ auth()->user()->role }}</div>
    <div class="h-6 border-r border-white/50"></div>
    <div class="text-white text-lg capitalize">{{ auth()->user()->fullname }}</div>
  </div>
</div>