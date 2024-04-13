@props (['id', 'label', 'type' => 'text', 'model', 'live' => 'true', 'size' => 'sm', 'placeholder'])

@php
$placeholder = (!empty($placeholder)) ? $placeholder : '';
@endphp

<div class="flex justify-between items-center">
    <label for="{{ $id }}" class="input-label">{{ $label }}</label>
</div>
<input type="{{ $type }}" id="{{ $id }}" {{ $live === 'true' ? 'wire:model.live='.$model : 'wire:model='.$model }} {{ $attributes->merge(['class' => "input input-".$size]) }}>
<x-input-error :messages="$errors->get($model)" class="text-xs text-red-500 mt-2"/>
