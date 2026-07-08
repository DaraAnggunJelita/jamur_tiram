<section>
    <header class="pb-4 mb-6 border-b border-[#C9B896]/20">
        <h2 class="text-base font-black text-[#26201B] font-heading tracking-tight">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-xs text-[#8E6E4E] font-medium">
            {{ __('Perbarui nama dan alamat email akun Anda.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">{{ __('Nama Lengkap') }}</label>
            <input id="name" name="name" type="text"
                   value="{{ old('name', $user->name) }}"
                   class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium"
                   required autofocus autocomplete="name">
            <x-input-error class="mt-1" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs font-black text-[#6B4E36] uppercase tracking-widest font-heading mb-1.5">{{ __('Alamat Email') }}</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $user->email) }}"
                   class="block w-full rounded-xl border-[#C9B896]/60 bg-white shadow-2xs focus:border-[#4F6146] focus:ring-[#4F6146] text-sm py-2.5 text-[#362C24] font-medium font-mono-data"
                   required autocomplete="username">
            <x-input-error class="mt-1" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 bg-[#C9B896]/10 border border-[#C9B896]/40 rounded-xl">
                    <p class="text-xs text-[#6B4E36] font-medium">
                        {{ __('Alamat email Anda belum diverifikasi.') }}
                        <button form="send-verification" class="underline text-[#4F6146] hover:text-[#37452F] font-black transition">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-xs font-bold text-[#4F6146]">
                            {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="py-2.5 px-6 bg-[#4F6146] hover:bg-[#37452F] text-white text-xs font-black uppercase tracking-widest rounded-xl transition duration-150 shadow-md shadow-[#4F6146]/10 transform hover:-translate-y-0.5 cursor-pointer">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold text-[#4F6146]"
                >{{ __('Tersimpan!') }}</p>
            @endif
        </div>
    </form>
</section>
