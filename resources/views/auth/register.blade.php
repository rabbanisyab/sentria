<x-guest-layout>

<div class="w-full max-w-md mx-auto">

    <div class="mb-8 text-center">
        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 backdrop-blur">
            <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6 text-white">
                <path d="M3 12c0-1.5 1.5-3 4-3s4 3 6 3 4-1.5 4-3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <path d="M3 17c0-1.5 1.5-3 4-3s4 3 6 3 4-1.5 4-3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                <circle cx="18" cy="7" r="3" stroke="currentColor" stroke-width="1.8"/>
            </svg>
        </div>
        <h1 class="font-display text-3xl font-semibold text-white">Sentria</h1>
        <p class="mt-2 text-sm text-brand-100/70">Smart Personal Finance Tracker</p>
    </div>

    <div class="card p-8">

        <div class="mb-6">
            <h2 class="font-display text-2xl font-semibold text-ink">Buat akun</h2>
            <p class="mt-1 text-sm text-ink-muted">Mulai kelola keuanganmu hari ini</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="name" value="Nama Lengkap" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="btn-primary w-full py-3">
                Daftar
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-ink-muted">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold text-brand-600 hover:text-brand-700">Masuk</a>
        </p>
    </div>
</div>

</x-guest-layout>
