<?php

namespace App\Http\Controllers;

use App\Models\SpendIncomeCategory;
use App\Models\SpendIncomeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpendIncomeRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $spend_income_records = DB::table('spend_income_records')->join('spend_income_categories', 'spend_income_categories.id', '=', 'spend_income_records.category_id')->where('user_id', '=', $request->user()->id);

        $type = $request->query('type');

        if ($type) {
            $spend_income_records = $spend_income_records->where('record_type_id', '=', intval($type));
        }

        $date_start = $request->query('date_start', null);
        if ($date_start) {
            $spend_income_records = $spend_income_records->where('record_time', '>=', $date_start);
        }

        $date_end = $request->query('date_end', null);
        if ($date_end) {
            $spend_income_records = $spend_income_records->where('record_time', '<=',$date_end);
        }

        return response()->json($spend_income_records->select('spend_income_records.*', 'spend_income_categories.category_name', 'spend_income_categories.record_type_id')->orderBy('record_time')->get());
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
        $validatedData = $request->validate([
            'task_name' => ['required'],
            'record_time' => ['required', 'date'],
            'category_id' => ['required', 'exists:spend_income_categories,id'],
            'sum' => ['required', 'min:0']
        ]);

        $spend_record = new SpendIncomeRecord($request->only(['task_name', 'record_time', 'category_id', 'sum']));

        $spend_record->save();

        // Log::info(implode(" ", $request->all()));

        return response()->json(['ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpendIncomeRecord  $spendIncomeRecord
     * @return \Illuminate\Http\Response
     */
    public function show(SpendIncomeRecord $spendIncomeRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpendIncomeRecord  $spendIncomeRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(SpendIncomeRecord $spendIncomeRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpendIncomeRecord  $spendIncomeRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpendIncomeRecord $spendIncomeRecord)
    {
        $validatedData = $request->validate([
            'id' => ['required'],
            'task_name' => [''],
            'record_time' => ['date'],
            'category_id' => ['exists:spend_income_categories,id'],
            'sum' => ['min:0']
        ]);

        $spend_record = SpendIncomeRecord::find($validatedData['id']);

        $spend_record->update($validatedData);

        $spend_record->save();

        Log::info(implode(" ", $validatedData));

        return response()->json(['ok']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpendIncomeRecord  $spendIncomeRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        SpendIncomeRecord::find($id)->delete();
        Log::info($id);
        return response()->json(['status' => 'deleted']);
    }
}
