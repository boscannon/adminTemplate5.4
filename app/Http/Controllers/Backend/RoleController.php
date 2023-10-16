<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role as crudModel;
use Spatie\Permission\Models\Permission;
use DataTables;
use Exception;
use DB;

class RoleController extends Controller
{
    public function __construct(
        private readonly \App\Service\HttpService $httpService,
    ) {
        $this->name = 'roles';
        $this->view = 'backend.'.$this->name;
        $this->rules = [
            'name' => ['required', 'string', 'max:50', 'unique:App\Models\Role,name'],
            'permissions' => ['nullable', 'array'],
        ];
        $this->messages = [];
        $this->attributes = __("backend.{$this->name}");
        $this->actions = [
            [ 'name' => 'read', 'permissions' => 'read' ],
            [ 'name' => 'create', 'permissions' => 'create' ],
            [ 'name' => 'edit', 'permissions' => 'edit' ],
            [ 'name' => 'delete', 'permissions' => 'delete' ],
        ];
    }

    public function index(Request $request)
    {
        $this->authorize('read '.$this->name);
        if ($request->ajax()) {
            $data = CrudModel::query();
            return Datatables::eloquent($data)
                ->make(true);
        }
        return view($this->view.'.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create '.$this->name);
        return view($this->view.'.create')->with('actions', $this->actions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create '.$this->name);
        $validatedData = $request->validate($this->rules, $this->messages, $this->attributes);

        try{
            DB::beginTransaction();

            $data = CrudModel::create(array_merge($validatedData, ['guard_name' => config('fortify.guard')]));
            $data->syncPermissions($this->syncPermissions($validatedData['permissions'] ?? []));

            DB::commit();
            return response()->json(['message' => __('create').__('success')]);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->httpService->error($e);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $this->authorize('read '.$this->name);

        $data = CrudModel::findOrFail($id);
        if (request()->ajax()) {
            return $data;
        }

        return view($this->view.'.edit')->with([
            'data' => $data,
            'show' => true,
            'actions' => $this->actions,
        ]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $this->authorize('edit '.$this->name);

        return view($this->view.'.edit')->with([
            'data' => CrudModel::findOrFail($id),
            'actions' => $this->actions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('edit '.$this->name);
        $this->rules['name'] = ['required', 'string', 'max:50', "unique:App\Models\Role,name,$id"];
        $validatedData = $request->validate($this->rules, $this->messages, $this->attributes);
        try{
            DB::beginTransaction();

            $data = CrudModel::findOrFail($id);
            $data->update($validatedData);
            $data->syncPermissions($this->syncPermissions($validatedData['permissions']));

            DB::commit();
            return response()->json(['message' => __('edit').__('success')]);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->httpService->error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete '.$this->name);
        try{
            $data = CrudModel::findOrFail($id);
            $data->delete();
            return response()->json(['message' => __('delete').__('success')]);
        } catch (Exception $e) {
            return $this->httpService->error($e);
        }
    }

    /**
     * status  the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $id)
    {
        $this->authorize('edit '.$this->name);
        $validatedData = $request->validate(['status' => ['required', 'boolean']], [], ['status' => __('status'),]);

        try{
            $data = CrudModel::findOrFail($id);
            $data->update($validatedData);
            return response()->json(['message' => __('edit').__('success')]);
        } catch (Exception $e) {
            return $this->httpService->error($e);
        }
    }

    /**
     * status  the specified resource in storage.
     *
     * @param  array  $permissions
     */
    public function syncPermissions($permissions = [])
    {
        $menu = collect();
        $checkmenuData = function($menuData) use (&$checkmenuData, &$menu){
            foreach($menuData as $value){
                if(isset($value['child'])){
                    $checkmenuData($value['child']);
                }else{
                    collect(array_merge($value['add_action'] ?? [], ($value['actions'] ?? $this->actions)))->each(function ($action) use ($value, &$menu) {
                        $menu->push("{$action['permissions']} {$value['permissions']}");
                    });
                }
            }
        };
        $checkmenuData(array_merge(config('menu'), config('exceptionPermissions') ?? []));

        $data = [];
        foreach($permissions as $permission){
            if($menu->search($permission) !== false){
                Permission::updateOrCreate(['name' => $permission], ['name' => $permission, 'guard_name' => 'admin']);
                $data[] = $permission;
            }
        }

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select(Request $request)
    {
        if ($request->ajax()) {
            $data = CrudModel::where('name', 'like', "%{$request->search}%")
                ->select(['id', 'name'])
                ->limit(200)
                ->get();
            return $data;
        }
    }
}
