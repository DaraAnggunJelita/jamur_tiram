<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-5 py-2.5 bg-[#E6DAC2]/40 border border-[#C9B896]/60 rounded-xl font-black text-xs text-[#6B4E36] uppercase tracking-widest hover:bg-[#E6DAC2]/80 focus:outline-none focus:ring-2 focus:ring-[#C9B896] focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
