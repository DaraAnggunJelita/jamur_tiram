<button {{ $attributes->merge(['type' =>'submit','class' =>'inline-flex items-center px-5 py-2.5 bg-[#F59E0B] border border-transparent rounded-xl font-bold text-xs text-white hover:bg-[#8E5530] focus:outline-none focus:ring-2 focus:ring-[#F59E0B] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-[#F59E0B]/20 transform hover:-translate-y-0.5 cursor-pointer']) }}>
 {{ $slot }}
</button>
