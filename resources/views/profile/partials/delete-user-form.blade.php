<section class="space-y-6">
    <header class="pb-4 mb-2 border-b border-[#A0653D]/20">
        <h2 class="text-base font-black text-[#A0653D] font-heading tracking-tight">
            {{ __('Hapus Akun') }}
        </h2>
        <p class="mt-1 text-xs text-[#8E6E4E] font-medium">
            {{ __('Setelah akun Anda dihapus, semua data dan sumber daya akan dihapus secara permanen. Harap unduh data penting sebelum melanjutkan.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="!bg-[#A0653D] hover:!bg-[#8E5530] !text-white !text-xs !font-black !uppercase !tracking-widest !px-5 !py-2.5 !rounded-xl !transition !duration-150 !shadow-md"
    >{{ __('Hapus Akun') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-base font-black text-[#26201B] font-heading tracking-tight">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h2>

            <p class="mt-2 text-xs text-[#8E6E4E] font-medium leading-relaxed">
                {{ __('Setelah akun dihapus, semua data akan hilang secara permanen. Masukkan kata sandi untuk mengkonfirmasi.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Kata Sandi') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-3/4 rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#A0653D] focus:ring-[#A0653D] text-sm py-2.5 text-[#362C24] font-medium"
                    placeholder="{{ __('Kata Sandi') }}"
                >
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-5 py-2.5 text-sm font-bold text-[#8E6E4E] hover:text-[#26201B] transition cursor-pointer">
                    {{ __('Batal') }}
                </button>

                <button type="submit"
                        class="py-2.5 px-5 bg-[#A0653D] hover:bg-[#8E5530] text-white text-xs font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#A0653D]/20 transform hover:-translate-y-0.5 cursor-pointer">
                    {{ __('Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
