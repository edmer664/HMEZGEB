<?php

namespace App\Http\Controllers;

use App\Actions\CreateReferral;
use App\Http\Requests\StoreReferralRequest;
use App\Http\Requests\StoreAdvancedReferralRequest;
use App\Models\Referral;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class ReferralsController extends Controller
{
    public function index()
    {
        $referrals = Referral::where('user_id', Auth::id())->get();

        return view('referrals.index', [
            'referrals' => $referrals,
        ]);
    }

    public function storeNormalReferral(StoreReferralRequest $request)
    {
        $validated = $request->validated();

        CreateReferral::run($validated, 'normal');

        return 'Successfully created a referral.';
    }

    public function storeAdvancedReferral(StoreAdvancedReferralRequest $request)
    {
        $validated = $request->validated();

        // return $validated;

        // TODO: Review where to add account type.

        $referral = CreateReferral::run($validated, 'advanced');

        Subscription::create([
            'referral_id' => $referral->id,
            'account_type' => $validated['account_type'],
            'account_limit' => $validated['account_type'] == 'admin' 
                ? $validated['number_of_accounts'] 
                : 1,
            'trial_from' => $validated['trial_date_start'],
            'trial_to' => $validated['trial_date_end'],
        ]);

        return 'Successfuly created an advanced referral.';
    }
}