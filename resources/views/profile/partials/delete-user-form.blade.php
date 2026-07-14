<section class="space-y-6">
 <header class="pb-4 mb-2 border-b border-[#F59E0B]/20">
 <h2 class="text-base font-bold text-[#F59E0B]">
 {{ __('Hapus Akun') }}
 </h2>
 <p class="mt-1 text-xs text-[#6B7280] font-medium">
 {{ __('Setelah akun Anda dihapus, semua data dan sumber daya akan dihapus secara permanen. Harap unduh data penting sebelum melanjutkan.') }}
 </p>
 </header>

 <x-danger-button
 x-data=""
 x-on:click.prevent="$dispatch('open-modal','confirm-user-deletion')"
 class="!bg-[#F59E0B] hover:!bg-[#8E5530] !text-white !text-xs !font-bold ! ! !px-5 !py-2.5 !rounded-xl !transition !duration-150 !shadow-md"
 >{{ __('Hapus Akun') }}</x-danger-button>

 <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
 <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
 @csrf
 @method('delete')

 <h2 class="text-base font-bold text-[#064E3B]">
 {{ __('Apakah Anda yakin ingin menghapus akun?') }}
 </h2>

 <p class="mt-2 text-xs text-[#6B7280] font-medium leading-relaxed">
 {{ __('Setelah akun dihapus, semua data akan hilang secara permanen. Masukkan kata sandi untuk mengkonfirmasi.') }}
 </p>

 <div class="mt-6">
 <label for="password" class="sr-only">{{ __('Kata Sandi') }}</label>
 <input
 id="password"
 name="password"
 type="password"
 class="block w-3/4 rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#F59E0B] focus:ring-[#F59E0B] text-sm py-2.5 text-[#374151] font-medium"
 placeholder="{{ __('Kata Sandi') }}"
 >
 <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
 </div>

 <div class="mt-6 flex justify-end gap-3">
 <button type="button"
 x-on:click="$dispatch('close')"
 class="px-5 py-2.5 text-sm font-bold text-[#6B7280] hover:text-[#064E3B] transition cursor-pointer">
 {{ __('Batal') }}
 </button>

 <button type="submit"
 class="py-2.5 px-5 bg-[#F59E0B] hover:bg-[#8E5530] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#F59E0B]/20 transform hover:-translate-y-0.5 cursor-pointer">
 {{ __('Hapus Akun') }}
 </button>
 </div>
 </form>
 </x-modal>
</section>
