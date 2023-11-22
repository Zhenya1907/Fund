<h1>User Profile</h1>

    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>Phone: {{ $user->phone }}</p>

    <h2>Latest Payment</h2>
    @if ($user->lastPayment)
        <p>Amount: {{ $user->lastPayment->amount }}</p>
        <p>Provider: {{ $user->lastPayment->provider }}</p>
    @else
        <p>No payment</p>
    @endif

    <h2>Payments in Last 7 Days</h2>
    @if ($user->paymentsLast7Days->isNotEmpty())
        <ul>
            @foreach ($user->paymentsLast7Days as $payment)
                <li>
                    Amount: {{ $payment->amount }}, Provider: {{ $payment->provider }}
                </li>
            @endforeach
        </ul>
    @else
        <p>No payments in the last 7 days</p>
    @endif

<a href="{{route('profile.send-notification', $user)}}">Send notification</a>



