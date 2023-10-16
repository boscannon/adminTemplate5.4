<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\TmpFile;
use Image;

class TmpFileController extends Controller
{
    public function __construct(
        private readonly \App\Service\HttpService $httpService,
    ) {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->all();

        try{
            foreach($validatedData as $value){
                $file = is_array($value) ? $value[0] : $value;
                $path = config('app.tmp').'/'.Str::random(20).time().uniqid().'.'.$file->getClientOriginalExtension();
                Image::make($file->getRealPath())->save($path);

                $data = [
                    'file_name' => $file->getClientOriginalName(),
                    'path' => $path,
                ];
                TmpFile::create($data);

                //超過一天就刪除
                $tmpFile = TmpFile::where('created_at', '<', date("Y-m-d H:i:s", strtotime('-1 day')));
                $tmpFile->each(function($item){
                    is_file($item->path) && unlink($item->path);
                });
                $tmpFile->delete();

                return response()->json($data);
            }

        } catch (Exception $e) {
            return $this->httpService->error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
