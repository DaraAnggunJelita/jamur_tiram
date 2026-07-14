<section>
 <header class="pb-4 mb-6 border-b border-[#E5E7EB]/20">
 <h2 class="text-base font-bold text-[#064E3B]">
 {{ __('Perbarui Kata Sandi') }}
 </h2>
 <p class="mt-1 text-xs text-[#6B7280] font-medium">
 {{ __('Gunakan kata sandi yang panjang dan acak agar akun Anda tetap aman.') }}
 </p>
 </header>

 <form method="post" action="{{ route('password.update') }}" class="space-y-5">
 @csrf
 @method('put')

 <div>
 <label for="update_password_current_password" class="block text-xs font-bold text-[#047857] mb-1.5">{{ __('Kata Sandi Saat Ini') }}</label>
 <input id="update_password_current_password" name="current_password" type="password"
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium"
 autocomplete="current-password">
 <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
 </div>

 <div>
 <label for="update_password_password" class="block text-xs font-bold text-[#047857] mb-1.5">{{ __('Kata Sandi Baru') }}</label>
 <input id="update_password_password" name="password" type="password"
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium"
 autocomplete="new-password">
 <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
 </div>

 <div>
 <label for="update_password_password_confirmation" class="block text-xs font-bold text-[#047857] mb-1.5">{{ __('Konfirmasi Kata Sandi Baru') }}</label>
 <input id="update_password_password_confirmation" name="password_confirmation" type="password"
 class="block w-full rounded-xl border-[#E5E7EB]/60 bg-white shadow-2xs focus:border-[#059669] focus:ring-[#059669] text-sm py-2.5 text-[#374151] font-medium"
 autocomplete="new-password">
 <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
 </div>

 <div class="flex items-center gap-4 pt-2">
 <button type="submit"
 class="py-2.5 px-6 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl transition duration-150 shadow-md shadow-[#059669]/10 transform hover:-translate-y-0.5 cursor-pointer">
 {{ __('Simpan Kata Sandi') }}
 </button>

 @if (session('status') ==='password-updated')
 <p
 x-data="{ show: true }"
 x-show="show"
 x-transition
 x-init="setTimeout(() => show = false, 2000)"
 class="text-xs font-bold text-[#059669]"
 >{{ __('Tersimpan!') }}</p>
 @endif
 </div>
 </form>
</section>
