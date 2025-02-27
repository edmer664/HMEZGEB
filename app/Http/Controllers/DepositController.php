<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings\ChartOfAccounts\ChartOfAccounts;

class DepositController extends Controller
{
    /**
     * Shows the deposit page of customers / banking menu.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('customer.deposit.index');
    }

    /******* AJAX ***********/

    public function ajaxSearchBank($query)
    {
        return ChartOfAccounts::select(
                'chart_of_accounts.id as value',
                'chart_of_accounts.chart_of_account_category_id',
                'chart_of_accounts.chart_of_account_no',
                'chart_of_accounts.account_name',
                'bank_accounts.bank_branch',
                'bank_accounts.bank_account_number',
                'bank_accounts.bank_account_type',
                'chart_of_account_categories.category',
                'chart_of_account_categories.normal_balance',
            )
            ->leftJoin('chart_of_account_categories', 'chart_of_accounts.chart_of_account_category_id', '=', 'chart_of_account_categories.id')
            ->leftJoin('bank_accounts', 'chart_of_accounts.id', '=', 'bank_accounts.chart_of_account_id')
            ->where('chart_of_account_categories.category' , '=', 'Cash')
            ->where('bank_accounts.bank_account_number' , '!=', NULL)
            ->where(function($sql) use ($query) {
                $sql->where('chart_of_accounts.account_name', 'LIKE', "%{$query}%")
                    ->orWhere('chart_of_accounts.chart_of_account_no', 'LIKE', "%{$query}%")
                    ->orWhere('bank_accounts.bank_account_number', 'LIKE', "%{$query}%")
                    ->orWhere('bank_accounts.bank_branch', 'LIKE', "%{$query}%");
            })
            ->get();
    }

}
