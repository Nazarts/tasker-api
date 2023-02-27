<?php

namespace App\Http\Controllers;

use App\Models\SpendIncomeCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SpendIncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $spend_income_categories = SpendIncomeCategory::all()->where('user_id', '=', $request->user()->id);

        $type = $request->query('type', null);

        if ($type != null) {
            $spend_income_categories = $spend_income_categories->where('record_type_id', $type);
        }

        return response()->json($spend_income_categories->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedCategory = $request->validate([
            'category_name' => ['required', 'unique:spend_income_categories'], 
            'record_type_id' => ['required', 'exists:record_types,id']
        ]);
        $validatedCategory['user_id'] = $request->user()->id;

        Log::info(json_encode($validatedCategory));

        $category = new SpendIncomeCategory($validatedCategory);

        Log::info(json_encode($category));

        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['status' => 'deleted']);
    }
}
