@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>
