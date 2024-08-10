<!-- resources/views/dashboard/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    @dd($user)
    <div>
        <h1>Welcome, {{ $user->name }}</h1>
        <p>Your email: {{ $user->email }}</p>
    </div>
@endsection