@extends('master')

@section('style')
    @yield('style')
@endsection

<section class="flex h-screen overflow-hidden">
    <x-admin-sidebar />

    <main class="flex-1 flex flex-col overflow-hidden px-6 py-2 gap-4">
        <x-admin-navbar />
        @yield('main')
        {{ $slot ?? '' }}
    </main>
</section>

