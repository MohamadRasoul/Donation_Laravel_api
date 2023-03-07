<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DonationPostResource;
use App\Models\DonationPost;
use Carbon\Carbon;

class UserController extends Controller
{
    public function donate(Request $request, DonationPost $donationPost)
    {
        // Data Validate
        $data = $request->validate([
            'amount'     => 'required',
        ]);
        $user = auth()->user();

        $user->donationPostsDonations()->attach($donationPost->id, [
            'amount'   => $request->amount
        ]);

        $donationPost->increment('amount_donated', $request->amount);

        // Return Response
        return response()->success(
            'user is added success',
            [
                "user" => new DonationPostResource($donationPost),
            ]
        );
    }

    public function sponsor(Request $request, DonationPost $donationPost)
    {
        // Data Validate
        $data = $request->validate([
            'month_count'      => 'required',
            'month_to_pay'     => 'required',
        ]);

        $user = auth()->user();

        $nextMonth = Carbon::parse($request->month_to_pay);

        for ($i = 1; $i <= $request->month_count; $i++) {
            
            $user->donationPostsSponsorShips()->attach($donationPost->id, [
                'amount'   => $donationPost->amount_required,
                'month_to_pay'   => $nextMonth
            ]);

            $nextMonth = $nextMonth->addMonth(1);
        }


        // dd($nextMonth->startOfMonth());
        $donationPost->update([
            'start_date' => $nextMonth->startOfMonth()->format('Y-m-d')
        ]);
        // Return Response
        return response()->success(
            'user is added success',
            [
                "user" => new DonationPostResource($donationPost),
            ]
        );
    }
}
