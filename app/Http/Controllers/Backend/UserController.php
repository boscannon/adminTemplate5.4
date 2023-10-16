<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as crudModel;
use App\Models\Role;
use DataTables;
use Exception;
use DB;

class UserController extends Controller
{
    public function __construct(
        private readonly \App\Service\HttpService $httpService,
    ) {
        $this->name = 'users';
        $this->view = 'backend.'.$this->name;
        $this->rules = [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User'],
            'roles' => ['required', 'array'],
            'roles.*' => ['string', 'exists:App\Models\Role,id'],
            'password' => ['required', 'string', 'confirmed', 'min:6'],
            'status' => ['required', 'boolean'],
        ];
        $this->messages = [];
        $this->attributes = __("backend.{$this->name}");
    }

    public function index(Request $request)
    {
        $this->authorize('read '.$this->name);
        if ($request->ajax()) {
            $data = CrudModel::whereNotIn('email', explode(',', env('SUPER_ADMIN')));
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
        $roles = Role::all();
        return view($this->view.'.create', compact('roles'));
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

            $data = CrudModel::create(array_merge($validatedData, ['password' => bcrypt($request->password)]));
            $data->syncRoles($validatedData['roles']);

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
            'show' => true
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
        $data = CrudModel::findOrFail($id);
        $roles = Role::all();
        return view($this->view.'.edit',compact('data', 'roles'));
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
        $this->rules = array_merge($this->rules, [
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email,'.$id],
            'password'      => ['nullable', 'string', 'confirmed', 'min:6'],
        ]);
        $validatedData = $request->validate($this->rules, $this->messages, $this->attributes);

        try{
            DB::beginTransaction();

            if(isset($validatedData['password'])){
                $validatedData['password'] =  bcrypt($request->password);
            }else{
                unset($validatedData['password']);
            }
            $data = CrudModel::findOrFail($id);
            $data->update($validatedData);
            $data->syncRoles($validatedData['roles']);

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
}
