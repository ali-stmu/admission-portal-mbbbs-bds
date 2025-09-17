@extends('layouts.email')

@section('content')
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('assets/img/ShifaLogo.png') }}" alt="STMU Logo" style="max-height: 80px;">
        </div>

        <h1 style="color: #2d3748; text-align: center;">Welcome to Shifa Tameer-e-Millat University</h1>

        <p style="color: #4a5568;">Dear {{ $user->name }},</p>

        <p style="color: #4a5568;">Thank you for registering with Shifa Tameer-e-Millat University. We're excited to have you
            as part of our academic community.</p>

        <div style="background-color: #f7fafc; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <p style="color: #4a5568; margin: 0;">Here are your login credentials:</p>
            <p style="color: #4a5568; margin: 5px 0;"><strong>Email:</strong> {{ $user->email }}</p>
            <p style="color: #4a5568; margin: 5px 0;"><strong>Password:</strong> {{ $password }}</p>
        </div>



        <p style="color: #4a5568;">If you have any questions or need assistance, please don't hesitate to contact our
            support team.</p>

        <p style="color: #4a5568;">Best regards,<br>The STMU Team</p>

        <div style="margin-top: 30px; text-align: center; color: #718096; font-size: 12px;">
            <p>© {{ date('Y') }} Shifa Tameer-e-Millat University. All rights reserved.</p>
        </div>
    </div>
@endsection
