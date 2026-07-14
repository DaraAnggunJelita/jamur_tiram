@props(['value'])

<label {{ $attributes->merge(['class' =>'block text-xs font-bold text-[#047857] mb-1.5']) }}>
 {{ $value ?? $slot }}
</label>
