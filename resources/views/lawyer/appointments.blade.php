@extends('layouts.lawyer')
@section('title', 'Appointments')
@section('page-title', 'My Appointments')

@section('content')
<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-gutter mb-stack-lg">
    <div>
        <h1 class="font-headline-xl text-headline-xl text-primary mb-2">Appointments</h1>
        <p class="font-body-lg text-on-surface-variant max-w-2xl">Manage your scheduled consultations and client meetings.</p>
    </div>
</div>

<!-- Statistics Cards -->
<section class="grid grid-cols-1 md:grid-cols-4 gap-gutter mb-stack-lg">
    <div class="bg-surface-container-lowest border border-outline-variant p-gutter rounded-xl hover:shadow-sm transition-all group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-primary/5 rounded-lg group-hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined text-primary">event</span>
            </div>
        </div>
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Total</p>
        <h3 class="text-headline-xl font-headline-xl text-primary mt-1">{{ $appointments->total() }}</h3>
    </div>
    <div class="bg-surface-container-lowest border border-outline-variant p-gutter rounded-xl hover:shadow-sm transition-all group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-tertiary/5 rounded-lg group-hover:bg-tertiary/10 transition-colors">
                <span class="material-symbols-outlined text-tertiary">schedule</span>
            </div>
        </div>
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Pending</p>
        <h3 class="text-headline-xl font-headline-xl text-tertiary mt-1">{{ $appointments->where('status', 'pending')->count() }}</h3>
    </div>
    <div class="bg-surface-container-lowest border border-outline-variant p-gutter rounded-xl hover:shadow-sm transition-all group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-primary-container/5 rounded-lg group-hover:bg-primary-container/10 transition-colors">
                <span class="material-symbols-outlined text-primary-container">check_circle</span>
            </div>
        </div>
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Confirmed</p>
        <h3 class="text-headline-xl font-headline-xl text-primary-container mt-1">{{ $appointments->where('status', 'confirmed')->count() }}</h3>
    </div>
    <div class="bg-surface-container-lowest border border-outline-variant p-gutter rounded-xl hover:shadow-sm transition-all group">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-error/5 rounded-lg group-hover:bg-error/10 transition-colors">
                <span class="material-symbols-outlined text-error">cancel</span>
            </div>
        </div>
        <p class="text-label-md font-label-md text-on-surface-variant uppercase tracking-wider">Cancelled</p>
        <h3 class="text-headline-xl font-headline-xl text-error mt-1">{{ $appointments->where('status', 'cancelled')->count() }}</h3>
    </div>
</section>

<!-- Appointments Table -->
<section class="mb-stack-lg">
    <div class="flex justify-between items-end mb-gutter">
        <div>
            <span class="text-label-md font-label-md text-primary tracking-[0.2em] uppercase">Consultation Schedule</span>
            <h2 class="font-headline-lg text-headline-lg mt-2">ALL APPOINTMENTS</h2>
        </div>
    </div>

    @if($appointments->count() > 0)
        <div class="bg-white border border-outline-variant rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-outline-variant bg-surface-container-low">
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Customer</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Date</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Time</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Type</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Status</th>
                            <th class="text-left py-3 px-4 font-label-md text-on-surface-variant uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr class="border-b border-outline-variant hover:bg-surface-bright transition-colors">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-primary-container/20 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-primary text-sm">person</span>
                                        </div>
                                        <span class="font-label-md text-on-surface">{{ $appointment->customer->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-on-surface-variant">{{ optional($appointment->appointment_date)->format('M d, Y') ?? 'Not scheduled' }}</td>
                                <td class="py-3 px-4 text-on-surface-variant">{{ $appointment->time_slot ? date('h:i A', strtotime($appointment->time_slot)) : 'N/A' }}</td>
                                <td class="py-3 px-4">
                                    <span class="text-on-surface-variant">{{ $appointment->meeting_mode ?? 'In-Person' }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-tertiary-fixed/30 text-tertiary',
                                            'confirmed' => 'bg-primary-fixed/30 text-on-primary-fixed-variant',
                                            'completed' => 'bg-primary-container/10 text-primary-container',
                                            'cancelled' => 'bg-error-container/30 text-on-error-container',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full font-label-md text-[10px] uppercase font-bold {{ $statusColors[$appointment->status] ?? 'bg-surface-container text-on-surface-variant' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex gap-2">
                                        <form action="{{ route('lawyer.appointments.status', $appointment->id) }}" method="POST" class="flex gap-2 items-center">
                                            @csrf
                                            <select name="status" class="border border-outline-variant rounded-lg px-2 py-1.5 text-xs bg-surface-container-low focus:ring-primary focus:border-primary">
                                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <button type="submit" class="bg-primary-container text-on-primary px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-primary transition-all">
                                                Update
                                            </button>
                                        </form>
                                        <button type="button" onclick="openLawyerChatModal({{ $appointment->id }}, '{{ addslashes($appointment->customer->name ?? 'Client') }}')" class="flex items-center gap-1 bg-primary/10 text-primary px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-primary hover:text-on-primary transition-all">
                                            <span class="material-symbols-outlined text-[16px]">chat</span> Chat
                                        </button>
                                        <a href="{{ route('lawyer.case.detail', $appointment->id) }}" class="text-primary font-bold hover:underline text-xs px-2 py-1.5">
                                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">
            {{ $appointments->links() }}
        </div>
    @else
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg text-center">
            <span class="material-symbols-outlined text-6xl text-outline mb-4 block">event_busy</span>
            <h3 class="font-headline-md text-headline-md text-on-surface-variant mb-2">No Appointments Yet</h3>
            <p class="text-body-md text-on-surface-variant">Your upcoming consultations will appear here.</p>
        </div>
    @endif
</section>

    {{-- ===== INLINE CHAT MODAL ===== --}}
    <div id="lawyer-chat-modal" class="hidden fixed inset-0 z-[9999] items-center justify-center bg-black/50 p-4">
        <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl flex flex-col" style="max-height: 80vh;">
            <div class="flex items-center justify-between p-4 border-b border-outline-variant">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary-container/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">person</span>
                    </div>
                    <div>
                        <p id="lawyer-chat-cname" class="font-bold text-on-surface text-sm">Client</p>
                        <p id="lawyer-chat-cid" class="text-xs text-on-surface-variant">Case</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="hidden md:inline text-[10px] uppercase font-bold text-green-600 tracking-wider">● Live (3s)</span>
                    <button type="button" onclick="closeLawyerChatModal()" class="p-2 rounded-full hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-on-surface-variant">close</span>
                    </button>
                </div>
            </div>
            <div id="lawyer-chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3 bg-surface-container min-h-[280px]"></div>
            <div id="lawyer-chat-status" class="hidden text-xs text-center text-error py-1"></div>
            <form id="lawyer-chat-form" class="flex items-end gap-2 p-3 border-t border-outline-variant">
                <textarea id="lawyer-chat-input" rows="1" placeholder="Type your message..." class="flex-1 resize-none border border-outline-variant rounded-xl px-3 py-2 text-sm bg-surface-container-lowest focus:ring-primary focus:border-primary outline-none"></textarea>
                <button type="submit" id="lawyer-chat-send-btn" class="bg-primary text-on-primary rounded-xl px-4 py-2 font-bold text-sm hover:bg-primary-container transition-all flex items-center">
                    <span class="material-symbols-outlined text-[18px]">send</span>
                </button>
            </form>
        </div>
    </div>

    <script>
    (function() {
        var modal = document.getElementById('lawyer-chat-modal');
        var msgBox = document.getElementById('lawyer-chat-messages');
        var input = document.getElementById('lawyer-chat-input');
        var form = document.getElementById('lawyer-chat-form');
        var sendBtn = document.getElementById('lawyer-chat-send-btn');
        var statusBar = document.getElementById('lawyer-chat-status');
        var csrf = '{{ csrf_token() }}';
        var myId = '{{ auth()->id() }}';
        var currentId = null, lastCount = -1, timer = null;

        function esc(s) { return (s || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

        function buildMsg(chat) {
            var mine = parseInt(chat.sender_id) === parseInt(myId);
            var time = new Date(chat.created_at).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
            var bubble = mine
                ? '<div class="max-w-[75%] px-3 py-2 rounded-2xl rounded-br-none bg-primary text-on-primary shadow-sm"><p class="text-sm">' + esc(chat.message) + '</p><p class="text-[10px] mt-1 opacity-70 text-right">' + time + '</p></div>'
                : '<div class="max-w-[75%] px-3 py-2 rounded-2xl rounded-bl-none bg-white border border-outline-variant text-on-surface shadow-sm"><p class="text-[10px] text-primary font-bold mb-0.5">' + esc(chat.sender ? chat.sender.name : 'Client') + '</p><p class="text-sm">' + esc(chat.message) + '</p><p class="text-[10px] mt-1 text-on-surface-variant">' + time + '</p></div>';
            return '<div class="flex ' + (mine ? 'justify-end' : 'justify-start') + '">' + bubble + '</div>';
        }

        function loadChats(silent) {
            if (!currentId) return;
            fetch('/lawyer/chats/' + currentId + '?_t=' + Date.now(), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'Cache-Control': 'no-cache' }
            })
            .then(function(r) { if (!r.ok) throw new Error('HTTP ' + r.status); return r.json(); })
            .then(function(data) {
                if (!data.chats || !currentId) return;
                if (data.chats.length !== lastCount) {
                    lastCount = data.chats.length;
                    msgBox.innerHTML = '';
                    if (data.chats.length === 0) {
                        msgBox.innerHTML = '<div class="text-center text-on-surface-variant py-10 text-sm">No messages yet. Say hello! 👋</div>';
                    } else {
                        data.chats.forEach(function(c) { msgBox.insertAdjacentHTML('beforeend', buildMsg(c)); });
                    }
                    msgBox.scrollTop = msgBox.scrollHeight;
                }
                if (statusBar) statusBar.className = 'hidden';
            })
            .catch(function(err) {
                if (!silent && statusBar) { statusBar.textContent = 'Connection issue — retrying...'; statusBar.className = 'text-xs text-center text-error py-1'; }
            });
        }

        window.openLawyerChatModal = function(id, name) {
            currentId = id; lastCount = -1;
            document.getElementById('lawyer-chat-cname').textContent = name;
            document.getElementById('lawyer-chat-cid').textContent = 'Case #C' + id;
            modal.className = 'fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 p-4';
            msgBox.innerHTML = '<div class="text-center text-on-surface-variant py-10 text-sm">Loading chat...</div>';
            loadChats(false);
            if (timer) clearInterval(timer);
            timer = setInterval(function() { loadChats(true); }, 3000);
            setTimeout(function() { if (input) input.focus(); }, 100);
        };

        window.closeLawyerChatModal = function() {
            modal.className = 'hidden fixed inset-0 z-[9999] items-center justify-center bg-black/50 p-4';
            currentId = null;
            if (timer) { clearInterval(timer); timer = null; }
        };

        modal.addEventListener('click', function(e) { if (e.target === modal) closeLawyerChatModal(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape' && currentId) closeLawyerChatModal(); });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var message = input.value.trim();
            if (!message || !currentId) return;
            sendBtn.disabled = true;
            fetch('/lawyer/chats/' + currentId + '/send', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' },
                body: new URLSearchParams({ message: message, _token: csrf })
            })
            .then(function(r) { if (!r.ok) throw new Error('HTTP ' + r.status); return r.json(); })
            .then(function(data) {
                if (data.success) { input.value = ''; input.style.height = 'auto'; loadChats(true); }
                else if (statusBar) { statusBar.textContent = '❌ ' + (data.message || 'Send failed'); statusBar.className = 'text-xs text-center text-error py-1'; }
            })
            .catch(function() {
                if (statusBar) { statusBar.textContent = '❌ Network error — try again'; statusBar.className = 'text-xs text-center text-error py-1'; }
            })
            .finally(function() { sendBtn.disabled = false; });
        });

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); form.requestSubmit(); }
        });
        input.addEventListener('input', function() { input.style.height = 'auto'; input.style.height = Math.min(input.scrollHeight, 100) + 'px'; });
    })();
    </script>
@endsection