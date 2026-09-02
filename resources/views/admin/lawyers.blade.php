@extends('layouts.admin')
@section('title', 'Manage Lawyers')
@section('page-title', 'Lawyer Management')

@section('content')
<!-- Header Section -->
<section class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
    <div>
        <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Lawyer Management</h2>
        <p class="font-body-md text-body-md text-secondary">Verify, approve, and manage legal professionals across the jurisdiction.</p>
    </div>
</section>

<!-- Stats Bento Row -->
<section class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-surface-container-low p-6 border border-outline-variant rounded-xl stat-card-glow">
        <div class="flex justify-between items-start mb-4">
            <span class="material-symbols-outlined text-primary bg-primary-fixed/30 p-2 rounded-lg">person_search</span>
            <span class="text-primary text-sm font-bold">{{ $lawyers->total() }}</span>
        </div>
        <h3 class="text-secondary font-label-md text-label-md mb-1">Total Lawyers</h3>
        <p class="font-headline-md text-headline-md text-on-surface">{{ $lawyers->total() }}</p>
    </div>
    <div class="bg-surface-container-low p-6 border border-outline-variant rounded-xl stat-card-glow">
        <div class="flex justify-between items-start mb-4">
            <span class="material-symbols-outlined text-[#006633] bg-[#006633]/10 p-2 rounded-lg">verified_user</span>
        </div>
        <h3 class="text-secondary font-label-md text-label-md mb-1">Approved</h3>
        <p class="font-headline-md text-headline-md text-on-surface">{{ $lawyers->where('is_approved', 1)->count() }}</p>
    </div>
    <div class="bg-surface-container-low p-6 border border-outline-variant rounded-xl stat-card-glow">
        <div class="flex justify-between items-start mb-4">
            <span class="material-symbols-outlined text-[#C5A059] bg-[#C5A059]/10 p-2 rounded-lg">pending_actions</span>
        </div>
        <h3 class="text-secondary font-label-md text-label-md mb-1">Pending Review</h3>
        <p class="font-headline-md text-headline-md text-on-surface">{{ $lawyers->where('is_approved', 0)->count() }}</p>
    </div>
    <div class="bg-surface-container-low p-6 border border-outline-variant rounded-xl stat-card-glow">
        <div class="flex justify-between items-start mb-4">
            <span class="material-symbols-outlined text-error bg-error-container p-2 rounded-lg">block</span>
        </div>
        <h3 class="text-secondary font-label-md text-label-md mb-1">Rejected/Suspended</h3>
        <p class="font-headline-md text-headline-md text-on-surface">0</p>
    </div>
</section>

<!-- Lawyer Table -->
<section class="bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        @if($lawyers->count() > 0)
        <table class="w-full border-collapse">
            <thead class="bg-surface-container-low border-b border-outline-variant">
                <tr>
                    <th class="text-left px-6 py-4 font-label-md text-label-md text-secondary">Lawyer Details</th>
                    <th class="text-left px-6 py-4 font-label-md text-label-md text-secondary">Specialization</th>
                    <th class="text-left px-6 py-4 font-label-md text-label-md text-secondary">Experience</th>
                    <th class="text-left px-6 py-4 font-label-md text-label-md text-secondary">Status</th>
                    <th class="text-right px-6 py-4 font-label-md text-label-md text-secondary">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/30">
                @foreach($lawyers as $lawyer)
                <tr class="hover:bg-surface-container-lowest transition-colors group {{ !$lawyer->is_approved ? 'bg-tertiary-container/5' : '' }}">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-primary-fixed/20 flex items-center justify-center text-primary border border-outline-variant">
                                <span class="material-symbols-outlined">account_balance</span>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="font-semibold text-on-surface">{{ $lawyer->user->name ?? 'N/A' }}</p>
                                    @if($lawyer->is_approved)
                                        <span class="material-symbols-outlined text-primary text-base" style="font-variation-settings: 'FILL' 1;" title="Verified Professional">verified</span>
                                    @endif
                                </div>
                                <p class="text-sm text-secondary">{{ $lawyer->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <p class="text-on-surface font-medium">{{ $lawyer->specialization ?? 'General' }}</p>
                    </td>
                    <td class="px-6 py-5 text-on-surface">{{ $lawyer->experience ?? 0 }}+ years</td>
                    <td class="px-6 py-5">
                        @if($lawyer->is_approved)
                            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold border border-primary/20">Approved</span>
                        @else
                            <span class="bg-[#C5A059]/10 text-[#C5A059] px-3 py-1 rounded-full text-xs font-bold border border-[#C5A059]/20">Pending Review</span>
                        @endif
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            @if(!$lawyer->is_approved)
                                <form action="{{ route('admin.lawyers.approve', $lawyer->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-primary text-white rounded font-label-md text-xs hover:bg-primary-container transition-colors shadow-sm">Approve</button>
                                </form>
                                <form action="{{ route('admin.lawyers.reject', $lawyer->id) }}" method="POST" class="inline" onsubmit="return confirm('Reject this lawyer?')">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 bg-white border border-error text-error rounded font-label-md text-xs hover:bg-error-container transition-colors">Reject</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.lawyers.delete', $lawyer->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this lawyer?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 hover:bg-error-container rounded-lg text-error transition-colors" title="Delete">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4 flex items-center justify-between border-t border-outline-variant bg-surface-bright">
            <p class="text-sm text-secondary font-body-md">Showing {{ $lawyers->firstItem() }} to {{ $lawyers->lastItem() }} of {{ $lawyers->total() }} lawyers</p>
            <div class="flex gap-2">
                {{ $lawyers->links() }}
            </div>
        </div>
        @else
        <div class="p-stack-lg text-center">
            <span class="material-symbols-outlined text-6xl text-outline mb-4 block">gavel</span>
            <p class="text-secondary text-lg">No lawyers registered yet.</p>
        </div>
        @endif
    </div>
</section>
@endsection