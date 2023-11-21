<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
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
