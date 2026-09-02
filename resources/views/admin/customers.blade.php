@extends('layouts.admin')
@section('title', 'Manage Customers')
@section('page-title', 'Manage Customers')

@section('content')
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between mb-stack-lg gap-4">
    <div>
        <h2 class="font-headline-lg text-headline-lg text-primary mb-2">Manage Customers</h2>
        <p class="text-secondary font-body-md">Oversee and manage the institutional customer base of Justice & Legacy.</p>
    </div>
    <div class="bg-surface-container-high px-6 py-4 rounded-xl border border-outline-variant flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">group</span>
        </div>
        <div>
            <p class="text-caption uppercase tracking-widest text-secondary font-bold">Total Customers</p>
            <p class="font-headline-md text-headline-md text-on-surface">{{ $customers->total() }}</p>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="bg-white rounded-xl border border-outline-variant overflow-hidden shadow-sm">
    @if($customers->count() > 0)
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-surface-container-low border-b border-outline-variant">
                <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider">Customer Name</th>
                <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider">Contact Information</th>
                <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider">City</th>
                <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider">Join Date</th>
                <th class="px-6 py-4 font-label-md text-secondary uppercase tracking-wider text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant">
            @foreach($customers as $customer)
            <tr class="hover:bg-surface-container-lowest transition-colors group">
                <td class="px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary-fixed-dim text-primary flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr($customer->name, 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-bold text-on-surface">{{ $customer->name }}</p>
                            <p class="text-caption text-secondary">ID: JL-{{ $customer->created_at->format('Y') }}-{{ str_pad($customer->id, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-5">
                    <p class="text-on-surface font-medium">{{ $customer->email }}</p>
                    <p class="text-caption text-secondary">{{ $customer->mobile ?? 'N/A' }}</p>
                </td>
                <td class="px-6 py-5">
                    <span class="px-3 py-1 bg-surface-container-high rounded-full text-label-md text-on-surface-variant">{{ $customer->city ? ucwords(strtolower($customer->city)) : 'N/A' }}</span>
                </td>
                <td class="px-6 py-5 text-secondary">{{ $customer->created_at->format('d M Y') }}</td>
                <td class="px-6 py-5 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <form action="{{ route('admin.customers.delete', $customer->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this customer?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-secondary hover:text-error hover:bg-error-container rounded-lg transition-all">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 bg-surface-container-low border-t border-outline-variant flex items-center justify-between">
        <p class="text-caption text-secondary">Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} customers</p>
        <div class="flex gap-2">
            {{ $customers->links() }}
        </div>
    </div>
    @else
    <div class="p-stack-lg text-center">
        <span class="material-symbols-outlined text-6xl text-outline mb-4 block">group_off</span>
        <p class="text-secondary text-lg">No customers registered yet.</p>
    </div>
    @endif
</div>
@endsection