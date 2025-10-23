@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Payments</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Stripe Session ID</th>
                    <th>Charge ID</th>
                    <th>Email</th>
                    <th>Card Last 4</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->stripe_session_id }}</td>
                        <td>{{ $payment->charge_id }}</td>
                        <td>{{ $payment->email }}</td>
                        <td>{{ $payment->card_last4 }}</td>
                        <td>{{ $payment->amount / 100 }}</td>
                        <td>{{ $payment->currency }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>{{ $payment->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
