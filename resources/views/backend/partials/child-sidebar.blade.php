@foreach($menu as $value)
  <li class="nav-main-item {{ request()->is('backend/'.$value['active']) ? ' open' : '' }}">
    @if(isset($value['child'])) 
      <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
        @isset($value['icon'])<i class="nav-main-link-icon {{ $value['icon'] }}"></i>@endisset
        <span class="nav-main-link-name">{{ __("backend.menu.{$value['title']}") }}</span>
      </a>                  
      <ul class="nav-main-submenu">         
        @include('backend.partials.child-sidebar', [ 'menu' => $value['child'] ])                                           
      </ul>
    @else      
      @if(in_array('read '.$value['permissions'], $permissions) || auth()->user()->super_admin)
      <a class="nav-main-link {{ request()->is('backend/'.$value['active']) || request()->is('backend/'.$value['active'].'/*') ? ' active' : '' }}" href="{{ route('backend.'.$value['name'].'.index') }}">
        @isset($value['icon'])<i class="nav-main-link-icon {{ $value['icon'] }}"></i>@endisset
        <span class="nav-main-link-name">{{ __("backend.menu.{$value['title']}") }}</span>                         
      </a>    
      @endif                
    @endif                      
  </li>
@endforeach
