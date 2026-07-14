<button {{ $attributes->merge(['type' =>'button','class' =>'inline-flex items-center px-5 py-2.5 bg-[#E6DAC2]/40 border border-[#E5E7EB]/60 rounded-xl font-bold text-xs text-[#047857] hover:bg-[#E6DAC2]/80 focus:outline-none focus:ring-2 focus:ring-[#E5E7EB] focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer']) }}>
 {{ $slot }}
</button>
