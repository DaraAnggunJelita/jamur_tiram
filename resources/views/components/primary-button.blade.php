<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-[#4F6146] hover:bg-[#37452F] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-[#4F6146] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 cursor-pointer']) }}>
    {{ $slot }}
</button>
