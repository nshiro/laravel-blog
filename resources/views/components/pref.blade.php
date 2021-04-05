@props([
    'message' => '選択して下さい',
    'default',
])

@php
$prefs = ['東京都', '千葉県', '埼玉県'];
@endphp

<select {{ $attributes->merge(['name' => 'pref', 'class' => 'aa']) }}>
    <option value="">{{ $message }}</option>
    @foreach ($prefs as $pref)
        <option value="{{ $pref }}" {{ $pref === $default ? 'selected' : '' }}>{{ $pref }}</option>
    @endforeach
</select>