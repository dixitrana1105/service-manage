@props(['section'])

@php
    $data = \App\Models\ThemeSection::where('section', $section)->first();
@endphp

@if($data)
    <section class="section-{{ $section }}"
        style="background-image: url('{{ asset($data->image) }}'); background-size: cover;">
        <div class="container text-white text-center py-5">
            <h2>{{ $data->title }}</h2>
            <p>{{ $data->subtitle }}</p>
        </div>
    </section>
@endif