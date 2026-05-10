@extends('layouts.app')

@section('title', 'Edit Employer Profile')

@section('content')
    <x-ui.page-header
        eyebrow="Employer profile"
        title="Edit company profile"
        description="Keep your company information, website, and verification details organized for applicants and administrators."
    />

    <form class="mt-6 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]" method="post" action="{{ route('employer.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <x-ui.panel tone="inset" class="p-5 md:p-6">
            <div class="grid gap-5 md:grid-cols-2">
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="company_name">Company name</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="company_name" name="company_name" value="{{ old('company_name', $profile->company_name) }}">
                </div>
                <div class="space-y-2 md:col-span-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="company_description">Company description</label>
                    <textarea class="min-h-40 w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="company_description" name="company_description" rows="4" placeholder="Describe what your company does">{{ old('company_description', $profile->company_description) }}</textarea>
                </div>
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="company_website">Company website</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="company_website" name="company_website" value="{{ old('company_website', $profile->company_website) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="industry">Industry</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="industry" name="industry" value="{{ old('industry', $profile->industry) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="tax_id">Tax ID</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="tax_id" name="tax_id" value="{{ old('tax_id', $profile->tax_id) }}">
                </div>
                <label class="flex items-center gap-3 text-sm text-slate-300">
                    <input class="h-4 w-4 rounded border-white/20 bg-slate-950 text-cyan-400 focus:ring-cyan-400/20" type="checkbox" name="verified_by_admin" value="1" @checked($profile->verified_by_admin)>
                    Verified by admin
                </label>
            </div>
        </x-ui.panel>

        <div class="space-y-6">
            <x-ui.panel tone="soft" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Branding</p>
                <div class="mt-4 space-y-2">
                    <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="company_logo">Company logo</label>
                    <input class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 file:mr-4 file:rounded-full file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-950 hover:file:bg-cyan-300" id="company_logo" name="company_logo" type="file">
                </div>
            </x-ui.panel>

            <x-ui.panel tone="soft" class="p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/70">Profile tips</p>
                <ul class="mt-4 space-y-3 text-sm leading-7 text-slate-300">
                    <li>Use a short company summary so candidates can understand your brand fast.</li>
                    <li>Add a real website and logo to improve trust and consistency.</li>
                    <li>Mark the profile verified only after internal review.</li>
                </ul>
            </x-ui.panel>

            <div class="flex items-center justify-end">
                <button class="inline-flex items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">Save profile</button>
            </div>
        </div>
    </form>
@endsection
