<x-app-layout>

    <x-slot name="header">Dashboard</x-slot>

    @php
        $palette = ['#5B42DB', '#3B82F6', '#D946EF', '#14B8A6', '#F59E0B', '#A78BFA', '#EC4899', '#22C55E'];

        $buildDonut = function ($rows) use ($palette) {
            $total = $rows->sum('total');
            $stops = [];
            $legend = [];
            $cursor = 0;

            foreach ($rows as $i => $row) {
                if ($total <= 0) break;
                $pct = $row->total / $total;
                $deg = $pct * 360;
                $color = $palette[$i % count($palette)];
                $stops[] = "{$color} {$cursor}deg " . ($cursor + $deg) . 'deg';
                $legend[] = [
                    'name' => $row->category?->name ?? 'Lainnya',
                    'total' => $row->total,
                    'pct' => round($pct * 100),
                    'color' => $color,
                ];
                $cursor += $deg;
            }

            return [
                'gradient' => count($stops) ? implode(', ', $stops) : '#EDEBFA 0deg 360deg',
                'legend' => $legend,
                'total' => $total,
            ];
        };

        $expenseDonut = $buildDonut($expenseByCategory);
        $incomeDonut = $buildDonut($incomeByCategory);
    @endphp

    <div class="space-y-6" x-data="{ metric: 'expense' }">

        {{-- Greeting --}}
        <div>
            <h1 class="font-display text-xl font-semibold text-ink">Halo, {{ auth()->user()->name }} 👋</h1>
        </div>

        {{-- Period selector --}}
        <div class="card flex items-center justify-between px-3 py-2.5">
            <a href="{{ route('dashboard', ['month' => $prevPeriod->month, 'year' => $prevPeriod->year]) }}"
               class="flex h-9 w-9 items-center justify-center rounded-lg text-ink-muted transition hover:bg-brand-50 hover:text-brand-600">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>

            <div class="text-center">
                <p class="text-[11px] font-medium uppercase tracking-wider text-ink-soft">Periode</p>
                <p class="font-display text-sm font-semibold text-ink">
                    {{ $periodStart->translatedFormat('d M Y') }} – {{ $periodEnd->translatedFormat('d M Y') }}
                </p>
            </div>

            <a href="{{ route('dashboard', ['month' => $nextPeriod->month, 'year' => $nextPeriod->year]) }}"
               class="flex h-9 w-9 items-center justify-center rounded-lg text-ink-muted transition hover:bg-brand-50 hover:text-brand-600">
                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- Total / Income / Expense chips --}}
        <div class="-mx-4 flex gap-3 overflow-x-auto px-4 pb-1 sm:mx-0 sm:grid sm:grid-cols-3 sm:px-0">
            <div class="w-40 shrink-0 rounded-2xl bg-gradient-to-br from-brand-900 via-brand-700 to-violet-600 p-4 text-white shadow-glow sm:w-auto">
                <p class="text-[11px] uppercase tracking-wider text-brand-100/70">Total Aset</p>
                <p class="mt-1.5 font-display text-lg font-semibold tabular-nums">Rp {{ number_format($totalAssets, 0, ',', '.') }}</p>
            </div>
            <div class="card w-40 shrink-0 p-4 sm:w-auto">
                <p class="text-[11px] uppercase tracking-wider text-ink-soft">Income</p>
                <p class="mt-1.5 font-display text-lg font-semibold tabular-nums text-emerald-600">Rp {{ number_format($income, 0, ',', '.') }}</p>
            </div>
            <div class="card w-40 shrink-0 p-4 sm:w-auto">
                <p class="text-[11px] uppercase tracking-wider text-ink-soft">Expense</p>
                <p class="mt-1.5 font-display text-lg font-semibold tabular-nums text-rose-600">Rp {{ number_format($expense, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Assets by account --}}
        <div>
            <div class="mb-3 flex items-center justify-between">
                <h2 class="font-display text-base font-semibold text-ink">Assets by Account</h2>
                <a href="{{ route('accounts.index') }}" class="text-sm font-medium text-brand-600 hover:text-brand-700">Semua</a>
            </div>

            <div class="-mx-4 flex gap-3 overflow-x-auto px-4 pb-1 sm:mx-0 sm:px-0">
                @forelse($accounts as $account)
                    <div class="card flex w-36 shrink-0 flex-col gap-2 p-4">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-50 text-brand-600">
                            @if($account->type == 'bank')
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke="currentColor" class="h-4.5 w-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9L12 4.5 20.25 9M4.5 10.5h15M6 10.5v7.5M10.5 10.5v7.5M15 10.5v7.5M19.5 10.5v7.5M3.75 18h16.5"/></svg>
                            @elseif($account->type == 'ewallet')
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke="currentColor" class="h-4.5 w-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75A2.25 2.25 0 014.5 4.5h15A2.25 2.25 0 0121.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V6.75zm13.5 5.25h3"/></svg>
                            @elseif($account->type == 'cash')
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke="currentColor" class="h-4.5 w-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.5h19.5v9H2.25v-9zm3 3h.008v.008H5.25V10.5z"/></svg>
                            @else
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke="currentColor" class="h-4.5 w-4.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5v10.5H3.75V6.75zm1.5 3h13.5"/></svg>
                            @endif
                        </div>
                        <p class="truncate text-sm font-medium text-ink">{{ $account->name }}</p>
                        <p class="font-display text-sm font-semibold tabular-nums text-ink">Rp {{ number_format($account->balance, 0, ',', '.') }}</p>
                    </div>
                @empty
                    <p class="py-4 text-sm text-ink-muted">Belum ada akun.</p>
                @endforelse
            </div>
        </div>

        {{-- Analytics by category --}}
        <div class="card p-5">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="font-display text-base font-semibold text-ink">Analytics by Kategori</h2>
                <div class="flex rounded-full bg-canvas p-1">
                    <button
                        @click="metric = 'income'"
                        :class="metric === 'income' ? 'bg-white shadow-sm text-emerald-600' : 'text-ink-muted'"
                        class="rounded-full px-3 py-1 text-xs font-semibold transition">Income</button>
                    <button
                        @click="metric = 'expense'"
                        :class="metric === 'expense' ? 'bg-white shadow-sm text-rose-600' : 'text-ink-muted'"
                        class="rounded-full px-3 py-1 text-xs font-semibold transition">Expense</button>
                </div>
            </div>

            @foreach(['expense' => $expenseDonut, 'income' => $incomeDonut] as $key => $donut)
                <div x-show="metric === '{{ $key }}'" x-cloak class="flex flex-col items-center gap-6 sm:flex-row sm:items-center">
                    <div
                        class="h-40 w-40 shrink-0 rounded-full"
                        style="background: conic-gradient({{ $donut['gradient'] }});"
                    >
                        <div class="flex h-full w-full items-center justify-center">
                            <div class="flex h-24 w-24 flex-col items-center justify-center rounded-full bg-white text-center shadow-sm">
                                <span class="text-[10px] text-ink-soft">Total</span>
                                <span class="font-display text-xs font-semibold text-ink">Rp {{ number_format($donut['total'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="w-full space-y-2">
                        @forelse($donut['legend'] as $item)
                            <div class="flex items-center justify-between text-sm">
                                <span class="flex items-center gap-2 text-ink-muted">
                                    <span class="h-2.5 w-2.5 rounded-full" style="background:{{ $item['color'] }}"></span>
                                    {{ $item['name'] }}
                                </span>
                                <span class="font-medium text-ink">{{ $item['pct'] }}%</span>
                            </div>
                        @empty
                            <p class="text-sm text-ink-muted">Belum ada data {{ $key == 'income' ? 'pemasukan' : 'pengeluaran' }} periode ini.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Recent Transactions --}}
        <div class="card p-5">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="font-display text-base font-semibold text-ink">Recent Transaction</h2>
                <a href="{{ route('history.index') }}" class="text-sm font-medium text-brand-600 hover:text-brand-700">Lihat semua</a>
            </div>

            <div class="space-y-3">
                @forelse($recentTransactions as $transaction)
                    <div class="flex items-center gap-3 rounded-xl border border-black/5 p-3.5">
                        @if($transaction->type == 'income')
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0-6 6m6-6 6 6"/></svg>
                            </span>
                        @elseif($transaction->type == 'expense')
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-rose-50 text-rose-600">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m0 0-6-6m6 6 6-6"/></svg>
                            </span>
                        @else
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-50 text-brand-600">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h11l-3-3M17 17H6l3 3"/></svg>
                            </span>
                        @endif

                        <div class="min-w-0 flex-1">
                            @if($transaction->type == 'transfer')
                                <p class="truncate text-sm font-medium text-ink">{{ $transaction->fromAccount?->name }} → {{ $transaction->toAccount?->name }}</p>
                            @else
                                <p class="truncate text-sm font-medium text-ink">{{ $transaction->category?->name }}</p>
                                @if($transaction->description)
                                    <p class="truncate text-xs text-ink-muted">{{ $transaction->description }}</p>
                                @endif
                            @endif
                        </div>

                        @if($transaction->type == 'income')
                            <p class="shrink-0 font-display text-sm font-semibold tabular-nums text-emerald-600">+Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                        @elseif($transaction->type == 'expense')
                            <p class="shrink-0 font-display text-sm font-semibold tabular-nums text-rose-600">-Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                        @else
                            <p class="shrink-0 font-display text-sm font-semibold tabular-nums text-brand-600">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                        @endif
                    </div>
                @empty
                    <p class="py-6 text-center text-sm text-ink-muted">Belum ada transaksi.</p>
                @endforelse
            </div>
        </div>
    </div>

</x-app-layout>
