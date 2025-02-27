<?php

namespace App\Models\Settings\ChartOfAccounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccounts extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'chart_of_account_category_id',
        'chart_of_account_no',
        'account_name',
        'current_balance',
        'status',
    ];

    public function journalPostings()
    {
        return $this->hasMany(JournalPostings::class, 'chart_of_accounts_id','id');
    }
    public function periodOfAccounts()
    {
        return $this->hasMany(PeriodOfAccounts::class, 'chart_of_accounts_id','id');
    }

    public function bankAccount()
    {
        return $this->hasOne(BankAccounts::class, 'chart_of_accounts_id','id');
    }

    public function category()
    {
        return $this->hasOne(ChartOfAccountCategory::class, 'id','chart_of_account_category_id');
    }

}
