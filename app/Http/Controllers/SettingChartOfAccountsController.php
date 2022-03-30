<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccounts;
use App\Models\ChartOfAccountCategory;;
use Illuminate\Http\Request;

class SettingChartOfAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.chart_of_account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coa = json_decode($request->coa_category, true);
        
        // To get the category_id of coa, use
        // $coa[0]['value'];
        // other related info such as type, category name,
        // can be seen by changing `value` to its corresponding
        // column name.

        ChartOfAccounts::create([
            'chart_of_account_category_id' => $coa[0]['value'],
            'chart_of_account_no' => $request->coa_number,
            'name' => $request->coa_name,
        ]);

        return back()->with('success', 'Successfully stored new Chart of Account.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChartOfAccounts  $chartOfAccounts
     * @return \Illuminate\Http\Response
     */
    public function show(ChartOfAccounts $chartOfAccounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChartOfAccounts  $chartOfAccounts
     * @return \Illuminate\Http\Response
     */
    public function edit(ChartOfAccounts $chartOfAccounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChartOfAccounts  $chartOfAccounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChartOfAccounts $chartOfAccounts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChartOfAccounts  $chartOfAccounts
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChartOfAccounts $chartOfAccounts)
    {
        //
    }

    /*======================================================*/

    public function ajaxSearchCategories($query)
    {
        $categories = ChartOfAccountCategory::select(
            'id as value', 
            'category',
            'type',
            'normal_balance')
            ->where('category', 'LIKE', '%' . $query . '%')->get();
        return $categories;
    }
}
