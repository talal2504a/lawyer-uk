@extends('layouts.lawyer')
@section('title', 'Case #C' . $appointment->id)
@section('page-title', 'Case Request Detail')

@section('content')
<div class="mb-gutter">
    <a href="{{ route('lawyer.dashboard') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span> Back to Dashboard
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-10 gap-gutter pb-32">
    <aside class="md:col-span-4 space-y-gutter">
        <section class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl shadow-sm">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-20 h-20 rounded-full bg-primary-container/10 flex items-center justify-center border-2 border-primary overflow-hidden">
                    <span class="material-symbols-outlined text-primary text-4xl">person</span>
                </div>
                <div>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">{{ $appointment->customer->name ?? 'N/A' }}</h3>
                    <div class="flex items-center text-tertiary">
                        <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="font-label-md ml-1">Verified Client</span>
                    </div>
                </div>
            </div>
            <div class="space-y-4 pt-4 border-t border-outline-variant">
                <div class="flex justify-between gap-4"><span class="text-on-surface-variant font-label-md">Email</span><span class="text-on-surface text-right">{{ $appointment->customer->email ?? 'N/A' }}</span></div>
                <div class="flex justify-between gap-4"><span class="text-on-surface-variant font-label-md">Phone</span><span class="text-on-surface text-right">{{ $appointment->customer->mobile ?? 'N/A' }}</span></div>
                <div class="flex justify-between gap-4"><span class="text-on-surface-variant font-label-md">Location</span><span class="text-on-surface text-right">{{ $appointment->city ?? $appointment->customer->city ?? 'N/A' }}</span></div>
                <div class="flex justify-between gap-4 items-center">
                    <span class="text-on-surface-variant font-label-md">Status</span>
                    @php
                        $statusColors = [
                            'pending' => 'bg-tertiary-fixed/30 text-tertiary',
                            'confirmed' => 'bg-primary-fixed/30 text-on-primary-fixed-variant',
                            'completed' => 'bg-primary-container/10 text-primary-container',
                            'cancelled' => 'bg-error-container/30 text-on-error-container',
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full font-label-md {{ $statusColors[$appointment->status] ?? 'bg-surface-container text-on-surface-variant' }}">{{ ucfirst($appointment->status) }}</span>
                </div>
            </div>
        </section>

        <section class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl shadow-sm">
            <div class="flex items-center gap-2 mb-4">
                <span class="material-symbols-outlined text-primary">attach_file</span>
                <h3 class="font-headline-md text-headline-md text-on-surface">Supporting Documents</h3>
            </div>
            @if($appointment->attachment_path)
                <a href="{{ Storage::url($appointment->attachment_path) }}" target="_blank" class="flex items-center justify-between p-3 bg-surface-container-low rounded-lg group hover:bg-surface-container-high transition-colors">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">description</span>
                        <div><p class="font-label-md text-on-surface">Case attachment</p><p class="text-caption text-on-surface-variant">Uploaded by customer</p></div>
                    </div>
                    <span class="material-symbols-outlined text-primary opacity-0 group-hover:opacity-100 transition-opacity">visibility</span>
                </a>
            @else
                <div class="p-4 bg-surface-container-low rounded-lg text-center text-on-surface-variant">
                    <span class="material-symbols-outlined text-4xl text-outline block mb-2">folder_off</span>
                    <p class="text-sm">No documents attached.</p>
                </div>
            @endif
        </section>
    </aside>

    <section class="md:col-span-6 space-y-gutter">
        <div class="bg-surface-container-lowest border border-outline-variant p-8 rounded-xl shadow-sm">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-primary mb-2">{{ $appointment->case_type ?? 'General Legal Matter' }}</h2>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full font-label-md">Case #C{{ $appointment->id }}</span>
                        @if($appointment->budget)
                            <span class="px-3 py-1 bg-tertiary-fixed/30 text-tertiary rounded-full font-label-md">PKR {{ number_format($appointment->budget) }} Budget</span>
                        @endif
                    </div>
                </div>
                <div class="text-right"><p class="text-caption text-on-surface-variant uppercase tracking-widest mb-1">Request Date</p><p class="font-label-md text-on-surface">{{ $appointment->created_at->format('M d, Y') }}</p></div>
            </div>

            <p class="text-body-md text-on-surface-variant leading-relaxed mb-8">{{ $appointment->message ?? 'No description provided.' }}</p>

            @if($appointment->status === 'confirmed')
                <div class="border border-primary-fixed rounded-lg p-4 bg-primary-fixed/20 mb-6">
                    <h4 class="font-label-md text-primary flex items-center gap-2 mb-2"><span class="material-symbols-outlined text-[20px]">event_available</span> Meeting Scheduled</h4>
                    <p class="text-on-surface-variant">{{ optional($appointment->appointment_date)->format('M d, Y') }} at {{ $appointment->time_slot ? date('h:i A', strtotime($appointment->time_slot)) : 'N/A' }} — {{ $appointment->meeting_mode ?? 'In-Person' }}</p>
                    @if($appointment->meeting_location)<p class="text-on-surface-variant mt-1">Location / Link: {{ $appointment->meeting_location }}</p>@endif
                </div>
            @elseif($appointment->status === 'cancelled')
                <div class="border border-error-container rounded-lg p-4 bg-error-container/20 mb-6">
                    <h4 class="font-label-md text-error flex items-center gap-2 mb-2"><span class="material-symbols-outlined text-[20px]">block</span> Case Rejected</h4>
                    <p class="text-on-surface-variant">{{ $appointment->rejection_reason ?? 'No reason provided.' }}</p>
                </div>
            @endif

            <div id="chat" class="border border-outline-variant rounded-lg p-4 bg-surface-bright">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-label-md text-primary flex items-center gap-2"><span class="material-symbols-outlined text-[20px]">forum</span> Case Chat</h4>
                    <span class="text-caption text-on-surface-variant">Privileged communication</span>
                </div>
                <div id="chat-messages-{{ $appointment->id }}" class="space-y-3 mb-4 max-h-80 overflow-y-auto p-4 bg-[radial-gradient(#e1e3e4_1px,transparent_1px)] [background-size:20px_20px] rounded-lg">
                    @foreach($appointment->chats as $chat)
                        <div class="flex {{ $chat->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-md p-3 rounded-[16px] shadow-sm {{ $chat->sender_id === Auth::id() ? 'bg-primary-container text-on-primary rounded-tr-none' : 'bg-surface-container-lowest border border-outline-variant text-on-surface rounded-tl-none' }}">
                                <p class="text-body-md">{{ $chat->message }}</p>
                                @if($chat->attachment_path)<a href="{{ Storage::url($chat->attachment_path) }}" class="text-xs underline mt-1 block" target="_blank">View Attachment</a>@endif
                                <p class="text-caption mt-1 opacity-70">{{ $chat->created_at->format('h:i A') }}</p>
                            </div>
                        </div>
                    @endforeach
                    @if($appointment->chats->count() === 0)<div id="chat-empty" class="text-center text-on-surface-variant">No messages yet. Start the conversation!</div>@endif
                </div>
                <form id="chat-form-{{ $appointment->id }}" onsubmit="return window.submitLawyerChat ? window.submitLawyerChat(event, {{ $appointment->id }}) : false" class="flex items-end gap-stack-sm bg-surface-container-low p-2 rounded-xl border border-outline-variant focus-within:border-primary-container focus-within:ring-1 focus-within:ring-primary-container transition-all">
                    @csrf
                    <textarea id="chat-input-{{ $appointment->id }}" class="flex-grow bg-transparent border-none focus:ring-0 py-2 resize-none font-body-md text-body-md min-h-[40px] max-h-32" placeholder="Type your legal inquiry or update..." rows="1"></textarea>
                    <button type="submit" id="chat-send-btn-{{ $appointment->id }}" class="bg-primary-container text-on-primary p-3 rounded-lg shadow-sm hover:opacity-90 active:scale-95 transition-all flex items-center justify-center"><span class="material-symbols-outlined">send</span><span class="ml-2 font-label-md text-label-md hidden sm:inline">Send</span></button>
                </form>
            </div>
        </div>
    </section>
</div>

@if($appointment->status === 'pending')
<div class="fixed bottom-0 left-64 right-0 bg-surface-container-lowest border-t border-outline-variant p-6 z-30 shadow-[0_-10px_25px_rgba(0,0,0,0.05)]">
    <div class="max-w-container-max mx-auto flex items-center justify-end gap-gutter px-margin-desktop">
        <button id="reject" onclick="openRejectModal()" class="px-8 py-3 border-2 border-error text-error hover:bg-error-container/20 font-bold rounded-lg transition-all active:scale-95">REJECT CASE</button>
        <button onclick="openAcceptModal()" class="px-12 py-3 bg-primary-container text-white hover:bg-primary font-bold rounded-lg transition-all shadow-md active:scale-95 flex items-center gap-3"><span class="material-symbols-outlined">check_circle</span> ACCEPT CASE</button>
    </div>
</div>

<div class="fixed inset-0 z-50 hidden items-center justify-center p-margin-mobile modal-blur bg-on-surface/40" id="acceptCaseModal">
    <div class="bg-surface-container-lowest w-full max-w-2xl rounded-lg shadow-2xl overflow-hidden border-t-[4px] border-primary-container">
        <div class="px-gutter py-stack-md border-b border-outline-variant flex justify-between items-center bg-surface-bright">
            <div><h2 class="font-headline-md text-headline-md text-primary">ACCEPT CASE - Adv. {{ Auth::user()->name }}</h2><p class="font-label-md text-label-md text-on-surface-variant flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">gavel</span> Case #C{{ $appointment->id }}: {{ $appointment->case_type ?? 'Legal Matter' }}</p></div>
            <button class="text-on-surface-variant hover:text-error transition-colors" onclick="closeAcceptModal()" type="button"><span class="material-symbols-outlined">close</span></button>
        </div>
        @if($errors->any())
            <div class="bg-error-container border border-error text-on-error-container px-4 py-3 rounded-xl mt-2 mx-gutter text-sm">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('lawyer.case.accept', $appointment->id) }}" method="POST" class="px-gutter py-gutter space-y-stack-md">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                <div class="space-y-2"><label class="block font-label-md text-label-md text-on-surface-variant">Scheduled Date</label><input class="w-full h-[48px] border border-outline-variant rounded px-4 bg-surface-container-low text-on-surface font-body-md focus:border-primary" type="date" name="appointment_date" required></div>
                <div class="space-y-2"><label class="block font-label-md text-label-md text-on-surface-variant">Preferred Time</label><input class="w-full h-[48px] border border-outline-variant rounded px-4 bg-surface-container-low text-on-surface font-body-md focus:border-primary" type="time" name="time_slot" required></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
                <div class="space-y-2"><label class="block font-label-md text-label-md text-on-surface-variant">Consultation Mode</label><select name="meeting_mode" class="w-full h-[48px] border border-outline-variant rounded px-4 bg-surface-container-low text-on-surface font-body-md" required><option value="In-Person">In-Person</option><option value="Video Call">Video Call</option><option value="Phone Call">Phone Call</option></select></div>
                <div class="space-y-2"><label class="block font-label-md text-label-md text-on-surface-variant">Location / Link</label><input class="w-full h-[48px] border border-outline-variant rounded px-4 bg-surface-container-low text-on-surface font-body-md" name="meeting_location" placeholder="Office 402, High Court Chambers" type="text" value="{{ Auth::user()->lawyer->address ?? '' }}"></div>
            </div>
            <div class="bg-surface-container p-4 rounded-lg border border-outline-variant">
                <h3 class="font-label-md text-label-md text-primary uppercase tracking-wider mb-4">Financial Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2"><label class="block font-label-md text-label-md text-on-surface-variant">Consultation Fee (PKR)</label><input class="w-full h-[48px] border border-outline-variant rounded px-4 bg-surface-container-lowest font-body-md" name="consultation_fee" type="number" step="0.01" value="{{ Auth::user()->lawyer->consultation_fee ?? 6000 }}" required></div>
                    <div class="space-y-2"><label class="block font-label-md text-label-md text-on-surface-variant">Advance Required (PKR)</label><input class="w-full h-[48px] border border-outline-variant rounded px-4 bg-surface-container-lowest font-body-md" name="advance_required" type="number" step="0.01" value="{{ (Auth::user()->lawyer->consultation_fee ?? 6000) / 2 }}" required></div>
                </div>
            </div>
            <div class="space-y-2"><label class="block font-label-md text-label-md text-on-surface-variant">Message to Customer (Optional)</label><textarea class="w-full border border-outline-variant rounded p-4 bg-surface-container-low font-body-md resize-none" name="message" rows="3">Aapka case accept hai. Please confirm the schedule.</textarea></div>
            <div class="flex flex-col-reverse md:flex-row justify-end gap-4 pt-4"><button class="px-8 py-3 text-primary font-label-md hover:underline transition-all opacity-80 hover:opacity-100" onclick="closeAcceptModal()" type="button">CANCEL</button><button class="bg-primary text-on-primary px-8 py-3 rounded font-label-md hover:bg-on-primary-fixed-variant transition-all shadow-sm active:scale-95" type="submit">CONFIRM & SEND TO CUSTOMER</button></div>
        </form>
    </div>
</div>

<div class="fixed inset-0 z-50 hidden items-center justify-center p-4 modal-blur bg-on-surface/20" id="rejectModal">
    <div class="w-full max-w-lg bg-surface-container-lowest rounded-xl overflow-hidden shadow-2xl border-t-4 border-primary">
        <form action="{{ route('lawyer.case.reject', $appointment->id) }}" method="POST" class="p-stack-md flex flex-col gap-4">
            @csrf
            <div class="flex items-start gap-4"><div class="flex-shrink-0 w-12 h-12 rounded-full bg-error-container flex items-center justify-center"><span class="material-symbols-outlined text-error text-[28px]">warning</span></div><div class="flex-1"><h2 class="font-headline-md text-headline-md text-on-surface">Are you sure you want to reject this case?</h2><p class="text-body-md text-on-surface-variant mt-1">This action will notify the client and remove the case from your pending queue.</p></div></div>
            <div class="space-y-stack-sm mt-4">
                <p class="font-label-md text-label-md text-on-surface mb-2">Reason for rejection:</p>
                @php $reasons = ['Not within my area of specialization','Current workload is too high','Budget does not meet firm standards','Conflict of interest identified','Other / Custom reason']; @endphp
                <div class="space-y-2">@foreach($reasons as $index => $reason)<label class="flex items-center gap-3 p-3 rounded-lg border border-outline-variant cursor-pointer hover:bg-surface-container-low transition-colors group"><input class="w-5 h-5 text-primary border-outline focus:ring-primary" name="rejection_reason" type="radio" value="{{ $reason }}" {{ $index === 0 ? 'checked' : '' }}><span class="text-body-md text-on-surface group-hover:text-primary">{{ $reason }}</span></label>@endforeach</div>
            </div>
            <div class="mt-4"><label class="font-label-md text-label-md text-on-surface block mb-2" for="referral">Suggest another lawyer (Optional):</label><select class="w-full h-12 pl-4 pr-10 border border-outline-variant rounded-lg bg-surface appearance-none focus:border-primary focus:ring-2 focus:ring-primary-container text-body-md" id="referral" name="suggested_lawyer_id"><option value="">No recommendation</option>@foreach($lawyers as $otherLawyer)<option value="{{ $otherLawyer->id }}">{{ $otherLawyer->name }}</option>@endforeach</select></div>
            <div class="flex flex-col sm:flex-row gap-3 mt-6 pt-4 border-t border-outline-variant"><button class="flex-1 px-6 py-3 border-2 border-error text-error font-bold rounded-lg hover:bg-error/5 transition-all active:scale-95" type="submit">CONFIRM REJECT</button><button class="flex-1 px-6 py-3 text-on-surface-variant hover:text-primary font-semibold transition-all" onclick="closeRejectModal()" type="button">CANCEL</button></div>
        </form>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>.modal-blur { backdrop-filter: blur(8px); }</style>
@endpush

<script>
// Modal functions - global scope
function openAcceptModal(){const m=document.getElementById('acceptCaseModal');if(m){m.classList.remove('hidden');m.classList.add('flex');}}
function closeAcceptModal(){const m=document.getElementById('acceptCaseModal');if(m){m.classList.add('hidden');m.classList.remove('flex');}}
function openRejectModal(){const m=document.getElementById('rejectModal');if(m){m.classList.remove('hidden');m.classList.add('flex');}}
function closeRejectModal(){const m=document.getElementById('rejectModal');if(m){m.classList.add('hidden');m.classList.remove('flex');}}

// Chat logic — inline so works with AJAX navigation too
(function() {
    var APPOINTMENT_ID = {{ $appointment->id }};
    var CURRENT_USER_ID = {{ Auth::id() }};
    var GET_URL  = '{{ route("lawyer.chats.get",  $appointment->id) }}';
    var SEND_URL = '{{ route("lawyer.chats.send", $appointment->id) }}';

    var chatMessages = document.getElementById('chat-messages-' + APPOINTMENT_ID);
    var chatInput    = document.getElementById('chat-input-' + APPOINTMENT_ID);

    function scrollBottom() { if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight; }
    scrollBottom();

    if (chatInput) {
        chatInput.addEventListener('input', function() {
            this.style.height = ''; this.style.height = this.scrollHeight + 'px';
        });
    }

    function buildMsg(chat) {
        var mine = parseInt(chat.sender_id) === parseInt(CURRENT_USER_ID);
        var time = new Date(chat.created_at).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
        var msg  = (chat.message || '').replace(/</g,'&lt;').replace(/>/g,'&gt;');
        var attach = chat.attachment_path
            ? '<a href="/storage/' + chat.attachment_path + '" class="text-xs underline mt-1 block" target="_blank">View Attachment</a>'
            : '';
        var cls = mine
            ? 'bg-primary-container text-on-primary rounded-tr-none'
            : 'bg-surface-container-lowest border border-outline-variant text-on-surface rounded-tl-none';
        return '<div class="flex ' + (mine ? 'justify-end' : 'justify-start') + '">' +
               '<div class="max-w-md p-3 rounded-[16px] shadow-sm ' + cls + '">' +
               '<p class="text-body-md">' + msg + '</p>' + attach +
               '<p class="text-caption mt-1 opacity-70">' + time + '</p>' +
               '</div></div>';
    }

    window.loadLawyerChats = function() {
        if (!chatMessages) return;
        var cacheBust = '?_t=' + Date.now();
        fetch(GET_URL + cacheBust, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'Cache-Control': 'no-cache' } })
        .then(function(res) { if (!res.ok) throw new Error('HTTP ' + res.status); return res.json(); })
        .then(function(data) {
            if (!data.chats) return;
            chatMessages.innerHTML = '';
            if (data.chats.length === 0) {
                chatMessages.innerHTML = '<div class="text-center text-on-surface-variant py-8">No messages yet. Start the conversation!</div>';
                return;
            }
            data.chats.forEach(function(chat) { chatMessages.insertAdjacentHTML('beforeend', buildMsg(chat)); });
            scrollBottom();
        })
        .catch(function(err) { console.error('Chat load error:', err); });
    };

    window.submitLawyerChat = function(e, id) {
        e.preventDefault();
        var input = document.getElementById('chat-input-' + id);
        var btn = document.getElementById('chat-send-btn-' + id);
        var message = input ? input.value.trim() : '';
        if (!message) return false;
        
        if (btn) btn.disabled = true;
        var csrfMeta = document.querySelector('meta[name="csrf-token"]');
        var token = csrfMeta ? csrfMeta.content : '{{ csrf_token() }}';
        
        fetch(SEND_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
            body: new URLSearchParams({ message: message, _token: token })
        })
        .then(function(res) { if (!res.ok) throw new Error('HTTP ' + res.status); return res.json(); })
        .then(function(data) {
            if (data.success) {
                if (input) { input.value = ''; input.style.height = '40px'; }
                window.loadLawyerChats();
            } else {
                alert('Message send nahi hua: ' + (data.message || 'Error'));
            }
        })
        .catch(function(err) {
            console.error('Send error:', err);
            alert('Network error. Dobara koshish karein.');
        })
        .finally(function() { if (btn) btn.disabled = false; });
        
        return false;
    };

    if (window.lawyerChatTimer) clearInterval(window.lawyerChatTimer);
    window.lawyerChatTimer = setInterval(window.loadLawyerChats, 4000);
})();
</script>