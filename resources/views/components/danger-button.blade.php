<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-[#A0653D] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#8E5530] focus:outline-none focus:ring-2 focus:ring-[#A0653D] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-[#A0653D]/20 transform hover:-translate-y-0.5 cursor-pointer']) }}>
    {{ $slot }}
</button>
