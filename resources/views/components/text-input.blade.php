@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' =>'border-[#E5E7EB]/60 bg-white focus:border-[#059669] focus:ring-[#059669] rounded-xl shadow-2xs text-[#374151] font-medium text-sm py-2.5']) }}>
