@include('includes.row', $user) //include variable send




{{-- bu dosya resources/views/layout.blade.php içinde biz resources/views/layouts/maine genişletiyoruz --}}
@extends('layouts.main')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- Task: change the layout from layouts/app.blade.php --}}
                    {{-- to layouts/main.blade.php --}}
                    Please change layout.
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- $key örneği --}}
@foreach ($users as $key => $user)
    {{-- Task: only every second row should have "bg-red-100" --}}
    <tr class="bg-red-100">
        <td>{{-- Task: add row number here: 1, 2, etc. --}}</td>
    <tr @if ($key++ % 2) class="bg-red-100" @endif>
        {{-- Task: add row number here: 1, 2, etc. --}}
        <td>{{ $key }}</td>
        <td>{{ $user->name }}</td>
        {{-- Task: only the FIRST row should have email with "font-bold" --}}
        <td class="font-bold">{{ $user->email }}</td>
        <td @if ($key == 1) class="font-bold" @endif>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
    </tr>
@endforeach


{{-- forelse örneği --}}
@forelse ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
    </tr>

@empty
    <tr>
        <td colspan="3">No content.</td>
    </tr>
@endforelse

{{-- asset örneği --}}
<img src="{{ asset('logo.png') }}" alt="">


{{-- variable checker örneği (varibale yoksa default yazı yazar) --}}
<title>{{ $metaTitle ?? 'Deafult Title' }}</title> 
