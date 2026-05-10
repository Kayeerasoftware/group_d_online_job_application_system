@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <x-ui.page-header
        eyebrow="Administration"
        title="User management"
        description="Search users, change roles, and keep account controls organized in a single review table."
    />

    <x-ui.panel tone="inset" class="mt-6 p-5 md:p-6">
        <form class="flex flex-col gap-3 sm:flex-row" method="get" action="{{ route('admin.users.index') }}">
            <label class="flex-1 space-y-2 text-sm text-slate-300">
                <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Search</span>
                <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="search" value="{{ request('search') }}" placeholder="Name or email">
            </label>
            <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">Search</button>
        </form>
    </x-ui.panel>

    <x-ui.panel tone="inset" class="mt-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10 text-left">
                <thead class="bg-white/5 text-xs uppercase tracking-[0.3em] text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">User</th>
                        <th class="px-6 py-4 font-semibold">Role</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Counts</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($users as $user)
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-5 align-top">
                                <div class="space-y-1">
                                    <a href="{{ route('admin.users.show', $user) }}" class="text-base font-semibold text-white transition hover:text-cyan-300">{{ $user->name }}</a>
                                    <p class="text-sm text-slate-400">{{ $user->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">{{ $user->roleValue() }}</td>
                            <td class="px-6 py-5 align-top">
                                <span class="inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-slate-200">
                                    {{ $user->is_active ? 'Active' : 'Suspended' }}
                                </span>
                            </td>
                            <td class="px-6 py-5 align-top text-sm text-slate-300">
                                <div class="space-y-1">
                                    <p>{{ $user->jobs_count ?? 0 }} jobs</p>
                                    <p>{{ $user->applications_count ?? 0 }} applications</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 align-top">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <a class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-slate-100 transition hover:bg-white/10" href="{{ route('admin.users.show', $user) }}">
                                        View
                                    </a>
                                    <form class="flex items-center gap-2" method="post" action="{{ route('admin.users.role', $user) }}">
                                        @csrf
                                        @method('patch')
                                        <select class="rounded-2xl border border-white/10 bg-slate-950/80 px-3 py-2 text-sm text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" name="role">
                                            @foreach(['seeker','employer','admin'] as $role)
                                                <option value="{{ $role }}" @selected($user->roleValue() === $role)>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        <button class="rounded-2xl bg-cyan-400 px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">Save</button>
                                    </form>
                                    <button
                                        type="button"
                                        class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-slate-100 transition hover:bg-white/10"
                                        data-modal-open="suspend-user-{{ $user->id }}"
                                    >
                                        Suspend
                                    </button>
                                    <button
                                        type="button"
                                        class="rounded-2xl border border-rose-500/30 bg-rose-500/10 px-4 py-2.5 text-sm font-semibold text-rose-200 transition hover:bg-rose-500/20"
                                        data-modal-open="delete-user-{{ $user->id }}"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <x-ui.modal
                            id="suspend-user-{{ $user->id }}"
                            title="Suspend {{ $user->name }}?"
                            description="Suspended users will no longer be able to access the system until reactivated."
                        >
                            <form method="post" action="{{ route('admin.users.suspend', $user) }}" class="space-y-4">
                                @csrf
                                @method('patch')
                                <label class="block space-y-2 text-sm text-slate-300">
                                    <span class="block text-xs uppercase tracking-[0.3em] text-slate-500">Reason for suspension</span>
                                    <textarea
                                        name="reason"
                                        class="min-h-28 w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20"
                                        placeholder="Fake job posts, spam applications, policy violations..."
                                    ></textarea>
                                </label>
                                <div class="flex items-center justify-end gap-3">
                                    <button type="button" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" data-modal-close>
                                        Cancel
                                    </button>
                                    <button type="submit" class="rounded-2xl border border-amber-400/30 bg-amber-400/10 px-4 py-3 text-sm font-semibold text-amber-100 transition hover:bg-amber-400/20">
                                        Suspend user
                                    </button>
                                </div>
                            </form>
                        </x-ui.modal>

                        <x-ui.modal
                            id="delete-user-{{ $user->id }}"
                            title="Delete {{ $user->name }}?"
                            description="This permanently removes the account and related data from the admin workspace."
                        >
                            <form method="post" action="{{ route('admin.users.destroy', $user) }}" class="flex items-center justify-end gap-3">
                                @csrf
                                @method('delete')
                                <button type="button" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-slate-100 transition hover:bg-white/10" data-modal-close>
                                    Cancel
                                </button>
                                <button type="submit" class="rounded-2xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm font-semibold text-rose-200 transition hover:bg-rose-500/20">
                                    Delete user
                                </button>
                            </form>
                        </x-ui.modal>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10">
                                <x-ui.empty-state
                                    title="No users found"
                                    description="Adjust the search query or create new accounts through the registration workflow."
                                />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-ui.panel>

    <div class="mt-8">
        {{ $users->links() }}
    </div>
@endsection
