@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[#C9B896]/60 bg-white focus:border-[#4F6146] focus:ring-[#4F6146] rounded-xl shadow-2xs text-[#362C24] font-medium text-sm py-2.5']) }}>
