<div class="sidebar text-white" style="background-color: #787a7e;">
    <div class="p-3">

        @foreach($menus as $menu)

            {{-- Parent without submenu --}}
            @if(!$menu->subMenus || $menu->subMenus->isEmpty())

                <a href="{{ $menu->menu_route ? route($menu->menu_route) : '#' }}"
                   class="d-block text-white text-decoration-none mb-2">
                   
                    <i class="bi {{ $menu->menu_icon }} me-2"></i>
                    {{ $menu->menu_name }}
                </a>

            @else

                {{-- Parent with submenu --}}
                <a class="d-flex justify-content-between text-white text-decoration-none py-2"
                   data-bs-toggle="collapse"
                   href="#menu{{ $menu->id }}">
                   
                    <span>
                        <i class="bi {{ $menu->menu_icon }} me-2"></i>
                        {{ $menu->menu_name }}
                    </span>
                    <span>▾</span>
                </a>

                <div class="collapse ps-3" id="menu{{ $menu->id }}">
                    @foreach($menu->subMenus as $sub)
                        <a href="{{ route($sub->menu_route) }}"
                           class="d-block text-white-50 py-1 text-decoration-none">
                           
                            {{ $sub->menu_name }}
                        </a>
                    @endforeach
                </div>

            @endif

        @endforeach

        <hr class="text-secondary">

        <a href="{{ route('logout') }}"class="d-block text-danger text-decoration-none py-2" style="font-weight:bold;">
         Logout
        </a>

    </div>
</div>