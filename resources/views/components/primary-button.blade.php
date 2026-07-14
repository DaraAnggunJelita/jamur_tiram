<button {{ $attributes->merge(['type' =>'submit','class' =>'inline-flex items-center px-6 py-2.5 bg-[#059669] hover:bg-[#047857] border border-transparent rounded-xl font-bold text-xs text-white focus:outline-none focus:ring-2 focus:ring-[#059669] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-[#059669]/10 transform hover:-translate-y-0.5 cursor-pointer']) }}>
 {{ $slot }}
</button>
