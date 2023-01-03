<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use View;
use App\Models\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		if(env('SERVICE_HTTPS', 0)) \URL::forceScheme('https');
        $menuData = config('menu');

        View::composer(
            'backend/partials/sidebar', function($view) use ($menuData){
                $permissions = auth()->user()->getAllPermissions()->pluck('name')->all();
                $view->with(['menuData' => $menuData, 'permissions' => $permissions]);
            }
        );
        View::composer(
            '*', function($view) use ($menuData){
                $data = [
                    'titleData' => [],
                    'subTitleData' => '',
                    'routeNameData' => '',
                    'routeIdData' => '',
                    'permissionsData' => '',
                ];

                $checkmenuData = function($menuData) use (&$checkmenuData, &$data){
                    foreach($menuData as $value){
                        if(request()->is('backend/'.$value['active']) || request()->is('backend/'.$value['active'].'/*')){
                            $value['title'] = __("backend.menu.{$value['title']}");

                            $data['titleData'][] = $value['title']; 
                            $data['subTitleData'] = $value['title']; 
                            $data['routeNameData'] = $value['name'] ?? ''; 
                            $data['routeIdData'] = $value['routeId'] ?? ''; 
                            $data['permissionsData'] = $value['permissions'] ?? ''; 
                        }
                        if(isset($value['child'])){
                            $checkmenuData($value['child']);
                        }
                    }
                };

                $checkmenuData($menuData);
                $data['titleData'] = implode("/", $data['titleData']);
                $data['languageData'] = Language::all();

                $view->with($data);
            }
        );

        Paginator::useBootstrap();
    }
}
