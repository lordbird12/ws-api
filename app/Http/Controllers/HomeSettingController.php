<?php

namespace App\Http\Controllers;

use App\Models\HomeSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HomeSettingController extends Controller
{
    public function getList()
    {
        $Item = HomeSetting::get()->toarray();

        if (!empty($Item)) {

            for ($i = 0; $i < count($Item); $i++) {
                $Item[$i]['No'] = $i + 1;
            }
        }

        return $this->returnSuccess('เรียกดูข้อมูลสำเร็จ', $Item);
    }

    public function getPage(Request $request)
    {
        $columns = $request->columns;
        $length = $request->length;
        $order = $request->order;
        $search = $request->search;
        $start = $request->start;
        $page = $start / $length + 1;

        $Status = $request->status;

        $col = array('id', 'youtube', 'state1', 'state2', 'state3', 'state4', 'create_by', 'update_by', 'created_at', 'updated_at');

        $orderby = array('', 'youtube', 'state1', 'state2', 'state3', 'state4', 'create_by');

        $D = HomeSetting::select($col);

        if (isset($Status)) {
            $D->where('status', $Status);
        }

        if ($orderby[$order[0]['column']]) {
            $D->orderby($orderby[$order[0]['column']], $order[0]['dir']);
        }

        if ($search['value'] != '' && $search['value'] != null) {

            $D->Where(function ($query) use ($search, $col) {

                //search datatable
                $query->orWhere(function ($query) use ($search, $col) {
                    foreach ($col as &$c) {
                        $query->orWhere($c, 'like', '%' . $search['value'] . '%');
                    }
                });

                //search with
                // $query = $this->withPermission($query, $search);
            });
        }

        $d = $D->paginate($length, ['*'], 'page', $page);

        if ($d->isNotEmpty()) {

            //run no
            $No = (($page - 1) * $length);

            for ($i = 0; $i < count($d); $i++) {

                $No = $No + 1;
                $d[$i]->No = $No;
            }
        }

        return $this->returnSuccess('เรียกดูข้อมูลสำเร็จ', $d);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            $Item = new HomeSetting();
            $Item->youtube = $request->youtube;
            $Item->state1 = $request->state1;
            $Item->state2 = $request->state2;
            $Item->state3 = $request->state3;
            $Item->state4 = $request->state4;

            $Item->save();
            //

            //log
            $userId = "admin";
            $type = 'เพิ่มรายการ';
            $description = 'ผู้ใช้งาน ' . $userId . ' ได้ทำการ ' . $type . ' ' . $request->name;
            $this->Log($userId, $description, $type);
            //

            DB::commit();

            return $this->returnSuccess('ดำเนินการสำเร็จ', $Item);
        } catch (\Throwable $e) {

            DB::rollback();

            return $this->returnErrorData('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง ' . $e, 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Item = HomeSetting::where('id', $id)
            ->first();

        return $this->returnSuccess('เรียกดูข้อมูลสำเร็จ', $Item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeSetting $homeSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        DB::beginTransaction();

        try {

            $Item = HomeSetting::find($id);
            $Item->youtube = $request->youtube;
            $Item->state1 = $request->state1;
            $Item->state2 = $request->state2;
            $Item->state3 = $request->state3;
            $Item->state4 = $request->state4;

            $Item->save();

            //log
            $userId = "admin";
            $type = 'แก้ไขผู้ใช้งาน';
            $description = 'ผู้ใช้งาน ' . $userId . ' ได้ทำการ ' . $type . ' ' . $Item->username;
            $this->Log($userId, $description, $type);
            //

            DB::commit();

            return $this->returnUpdate('ดำเนินการสำเร็จ');
        } catch (\Throwable $e) {

            DB::rollback();

            return $this->returnErrorData('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง ', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeSetting  $homeSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeSetting $homeSetting)
    {
        //
    }
}
