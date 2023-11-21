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

<form method="post" action="{{ route('profile.send-notification', $user) }}">
    @csrf

    <label for="notification_text">Notification Text:</label>
    <textarea id="notification_text" name="notification_text" required></textarea>

    <button type="submit">Send Notification</button>
</form>



