<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audit as crudModel;
use DataTables;
use Exception;

class AuditController extends Controller
{
    public function __construct(
        private readonly \App\Service\HttpService $httpService,
    ) {
        $this->name = 'audits';
        $this->view = 'backend.'.$this->name;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CrudModel::with(['user'])
            ->when($request->has('table'), function($query) use ($request) {
                $query->where('table', $request->table);
            })
            ->when($request->has('table_id'), function($query) use ($request) {
                $query->where('table_id', $request->table_id);
            });

            return Datatables::eloquent($data)
                ->addColumn('menu', function($model) {
                    return __("backend.menu.{$model->table}") ?? $model->table;
                })
                ->toJson();
        }
        return view($this->view.'.index');
    }
}
