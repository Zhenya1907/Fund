<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with(['lastPayment', 'paymentsLast7Days'])
            ->select('id', 'name', 'email', 'phone', 'created_at')
            ->paginate(2);

        $users->each(function ($user) {
            $user->last_payment_amount = optional($user->lastPayment)->amount;
            $user->payments_last_7_days_sum = $user->paymentsLast7DaysSum();
        });

        return view('users', compact('users'));
    }
}
