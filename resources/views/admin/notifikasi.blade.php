@extends('layouts.admin')

@section('title', 'Notifikasi - Admin Dashboard')

@section('content')
<h2 class="text-2xl font-bold mb-6">Notifikasi</h2>

<!-- Notification Cards -->
<div class="space-y-4">

  @foreach ($notifications as $notification)
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="font-bold text-xl">{{$notification->title}}</h3>
    <p class="text-lg text-gray-600 mt-2">{{$notification->message}}</p>
    <span class="text-sm text-gray-500 mt-2 block">{{$notification->created_at->format('d F Y, h:i A')}}</span>
  </div>
  @endforeach


</div>
@endsection