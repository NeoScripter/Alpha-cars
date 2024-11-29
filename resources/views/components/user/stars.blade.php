@props(['totalStars' => 2.5])

@php
    // Calculate the number of full, half, and empty stars
    $fullStars = floor($totalStars);
    $halfStars = $totalStars - $fullStars >= 0.5 ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStars;
@endphp

{{-- Render full stars --}}
@for ($i = 0; $i < $fullStars; $i++)
    <img src="{{ asset('images/svgs/yellow-star.svg') }}" alt="" aria-hidden>
@endfor

{{-- Render half star if applicable --}}
@if ($halfStars)
    <img src="{{ asset('images/svgs/half-star.svg') }}" alt="" aria-hidden>
@endif

{{-- Render empty stars --}}
@for ($i = 0; $i < $emptyStars; $i++)
    <img src="{{ asset('images/svgs/white-star.svg') }}" alt="" aria-hidden>
@endfor
