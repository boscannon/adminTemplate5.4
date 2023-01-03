@foreach($menu as $value)
<ul>
    <li>{{ __("backend.menu.{$value['title']}") }}
      @if(isset($value['child']))
        @include('backend.pages.roles.partials.child', [ 'menu' => $value['child'], 'actions' => $actions, 'data' => $data ])      
      @else
        <ul>
          @foreach($actions as $action)
            <li 
              data-id="{{ $action['permissions'].' '.$value['permissions'] }}" 
              data-jstree='{ "selected" : {{ isset($data) && $data->getPermissionNames()->search($action['permissions'].' '.$value['permissions']) !== false ? 'true' : 'false' }} }'
            >{{ $action["name"] }}</li>
          @endforeach  
        </ul>     
      @endif
    </li>
</ul>
@endforeach