@extends('layouts.admin')
@section('title', 'Specializations')
@section('page-title', 'Specializations Management')

@section('content')
<div class="mb-stack-lg">
    <h2 class="font-headline-lg text-headline-lg text-primary mb-2">Specializations Management</h2>
    <p class="text-secondary body-md max-w-2xl">Define and organize the legal domains offered through the Justice & Legacy platform. Maintain institutional accuracy across all service listings.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
    <!-- Left: Add New Specialization -->
    <section class="lg:col-span-4 flex flex-col gap-6">
        <div class="bg-white border border-outline-variant p-6 rounded-xl shadow-sm sticky top-24">
            <div class="flex items-center gap-2 mb-6">
                <span class="material-symbols-outlined text-primary-container">add_box</span>
                <h3 class="font-headline-md text-headline-md text-primary">Add New</h3>
            </div>
            <form action="{{ route('admin.specializations.add') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block font-label-md text-primary mb-2">Specialization Name</label>
                    <input name="name" class="w-full h-12 px-4 border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary-container outline-none transition-all placeholder:text-secondary-fixed-dim" placeholder="e.g. Environmental Law" type="text" required/>
                </div>
                <div class="pt-2">
                    <button type="submit" class="w-full bg-primary py-4 text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">publish</span>
                        Add Specialization
                    </button>
                </div>
            </form>
            @if($errors->any())
                <div class="mt-4 bg-error-container p-3 rounded-lg text-sm text-on-error-container">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mt-8 pt-8 border-t border-outline-variant">
                <p class="text-caption text-secondary italic">Note: Changes here will propagate to the public directory and lawyer registration forms immediately.</p>
            </div>
        </div>
    </section>

    <!-- Right: Existing Specializations -->
    <section class="lg:col-span-8">
        <div class="bg-white border border-outline-variant rounded-xl overflow-hidden">
            <div class="px-8 py-6 border-b border-outline-variant flex justify-between items-center">
                <h3 class="font-headline-md text-headline-md text-primary">Existing Specializations</h3>
                <div class="flex gap-2">
                    <span class="px-3 py-1 bg-surface-container-high rounded-full text-caption font-bold text-secondary">Total: {{ $specializations->total() }}</span>
                </div>
            </div>
            @if($specializations->count() > 0)
            <div class="divide-y divide-outline-variant">
                @foreach($specializations as $spec)
                <div class="group px-8 py-6 flex items-center justify-between hover:bg-surface-container transition-colors">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-primary-fixed rounded flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">gavel</span>
                        </div>
                        <div>
                            <p class="font-bold text-body-lg text-primary">{{ $spec->name }}</p>
                            <p class="text-caption text-secondary uppercase tracking-wider">{{ $spec->status ?? 'Active' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4 opacity-0 group-hover:opacity-100 transition-opacity">
                        <form action="{{ route('admin.specializations.delete', $spec->id) }}" method="POST" onsubmit="return confirm('Delete this specialization?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-error hover:bg-error-container rounded transition-all">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="px-8 py-4 bg-surface-container-low flex items-center justify-between border-t border-outline-variant">
                <p class="text-caption text-secondary">Showing {{ $specializations->firstItem() }} to {{ $specializations->lastItem() }} of {{ $specializations->total() }}</p>
                <div class="flex gap-2">
                    {{ $specializations->links() }}
                </div>
            </div>
            @else
            <div class="p-stack-lg text-center">
                <span class="material-symbols-outlined text-6xl text-outline mb-4 block">category</span>
                <p class="text-secondary text-lg">No specializations defined yet.</p>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection