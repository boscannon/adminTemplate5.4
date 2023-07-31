@foreach($menu as $value)
<ul>
    <li>{{ __("backend.menu.{$value['title']}") }}
      @if(isset($value['child']))
        @include('backend.roles.partials.child', [ 'menu' => $value['child'], 'actions' => $actions, 'data' => $data ])
      @else
        <ul>
          @foreach($actions as $action)
            <li
              data-id="{{ $action['permissions'].' '.$value['permissions'] }}"
              @if($data->super_admin)
                data-jstree='{ "selected" : true }'
              @else
                data-jstree='{ "selected" : {{ isset($data) && $data->hasPermissionTo("{$action['permissions']} {$value['permissions']}") }} }'
              @endif
            >{{ __($action["name"]) }}</li>
          @endforeach
        </ul>
      @endif
    </li>
</ul>
@endforeach