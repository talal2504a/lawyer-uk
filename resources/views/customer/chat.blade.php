@extends('layouts.customer')

@section('title', 'Chat with ' . ($appointment->lawyer->name ?? 'Lawyer'))
@section('page-title', 'Chat')

@section('content')
<div class="space-y-6">
    {{-- Back Link --}}
    <a href="{{ route('customer.appointments') }}" class="inline-flex items-center gap-1 text-primary font-label-md hover:underline">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Back to Appointments
    </a>

    {{-- Chat Header --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-xl p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg">
            {{ substr($appointment->lawyer->name ?? 'L', 0, 1) }}
        </div>
        <div>
            <p class="font-bold text-on-surface">{{ $appointment->lawyer->name ?? 'Lawyer' }}</p>
            <p class="text-sm text-secondary">Case #C{{ $appointment->id }}
                @if($appointment->status === 'confirmed')
                    <span class="text-green-600 ml-2">· Confirmed</span>
                @elseif($appointment->status === 'pending')
                    <span class="text-yellow-600 ml-2">· Pending</span>
                @endif
            </p>
        </div>
    </div>

    {{-- Chat Messages --}}
    <div class="bg-surface-container-low border border-outline-variant rounded-xl p-6">
        <div id="chat-messages-{{ $appointment->id }}" class="space-y-4 mb-6 max-h-96 overflow-y-auto p-4 bg-surface-container rounded-lg min-h-[300px]">
            @forelse($appointment->chats->sortBy('created_at') as $chat)
                @if($chat->sender_id === Auth::id())
                    <div class="flex justify-end">
                        <div class="max-w-md p-3 rounded-2xl bg-primary text-on-primary rounded-br-none shadow-sm">
                            <p class="text-sm">{{ $chat->message }}</p>
                            <p class="text-xs mt-1 opacity-70">{{ \Carbon\Carbon::parse($chat->created_at)->format('h:i A') }}</p>
                        </div>
                    </div>
                @else
                    <div class="flex justify-start">
                        <div class="max-w-md p-3 rounded-2xl bg-surface-container-lowest border border-outline-variant text-on-surface rounded-bl-none shadow-sm">
                            <p class="text-xs text-primary font-label-md mb-1">{{ $chat->sender->name ?? 'Lawyer' }}</p>
                            <p class="text-sm">{{ $chat->message }}</p>
                            <p class="text-xs mt-1 text-secondary">{{ \Carbon\Carbon::parse($chat->created_at)->format('h:i A') }}</p>
                        </div>
                    </div>
                @endif
            @empty
                <div id="chat-empty-msg" class="text-center text-secondary py-12">
                    <span class="material-symbols-outlined text-5xl text-outline-variant">forum</span>
                    <p class="mt-3 text-sm">No messages yet. Start the conversation!</p>
                </div>
            @endforelse
        </div>

        {{-- Status bar --}}
        <div id="chat-status-bar" class="hidden text-xs text-center text-red-600 mb-2"></div>

        {{-- Chat Input --}}
        <form id="chat-form-{{ $appointment->id }}" class="flex items-end gap-3 bg-surface-container p-3 rounded-xl border border-outline-variant focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all">
            @csrf
            <textarea
                id="chat-input-{{ $appointment->id }}"
                class="flex-grow bg-transparent border-none focus:ring-0 py-2 resize-none text-sm min-h-[44px] max-h-32 text-on-surface placeholder-secondary"
                placeholder="Type your message..."
                rows="1"
            ></textarea>
            <button type="submit" id="chat-send-btn-{{ $appointment->id }}" class="bg-primary text-on-primary p-3 rounded-xl hover:opacity-90 transition-all flex items-center justify-center flex-shrink-0 disabled:opacity-50">
                <span class="material-symbols-outlined">send</span>
            </button>
        </form>
    </div>
</div>

{{-- Inline script - works with both direct load and AJAX navigation --}}
<script>
(function() {
    var APPOINTMENT_ID = {{ $appointment->id }};
    var CURRENT_USER_ID = {{ Auth::id() }};
    var CSRF_TOKEN = '{{ csrf_token() }}';
    var GET_URL = '{{ route("customer.chats.get", $appointment->id) }}';
    var SEND_URL = '{{ route("customer.chats.send", $appointment->id) }}';

    var chatMessages = document.getElementById('chat-messages-' + APPOINTMENT_ID);
    var chatForm     = document.getElementById('chat-form-' + APPOINTMENT_ID);
    var chatInput    = document.getElementById('chat-input-' + APPOINTMENT_ID);
    var sendBtn      = document.getElementById('chat-send-btn-' + APPOINTMENT_ID);
    var statusBar    = document.getElementById('chat-status-bar');

    // Scroll to bottom
    function scrollBottom() {
        if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    scrollBottom();

    // Auto-grow textarea
    if (chatInput) {
        chatInput.addEventListener('input', function() {
            this.style.height = '';
            this.style.height = this.scrollHeight + 'px';
        });
    }

    // Build one message HTML
    function buildMsgHtml(chat) {
        var mine = parseInt(chat.sender_id) === parseInt(CURRENT_USER_ID);
        var time = new Date(chat.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
        var msg  = (chat.message || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        if (mine) {
            return '<div class="flex justify-end">' +
                '<div class="max-w-md p-3 rounded-2xl bg-primary text-on-primary rounded-br-none shadow-sm">' +
                '<p class="text-sm">' + msg + '</p>' +
                '<p class="text-xs mt-1 opacity-70">' + time + '</p>' +
                '</div></div>';
        } else {
            var senderName = (chat.sender && chat.sender.name) ? chat.sender.name : 'Lawyer';
            return '<div class="flex justify-start">' +
                '<div class="max-w-md p-3 rounded-2xl bg-surface-container-lowest border border-outline-variant text-on-surface rounded-bl-none shadow-sm">' +
                '<p class="text-xs text-primary font-label-md mb-1">' + senderName + '</p>' +
                '<p class="text-sm">' + msg + '</p>' +
                '<p class="text-xs mt-1 text-secondary">' + time + '</p>' +
                '</div></div>';
        }
    }

    // Load all chats from server
    function loadChats() {
        var cacheBust = '?_t=' + Date.now();
        fetch(GET_URL + cacheBust, {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'Cache-Control': 'no-cache' }
        })
        .then(function(res) {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        })
        .then(function(data) {
            if (!chatMessages) return;
            if (!data.chats) return;
            chatMessages.innerHTML = '';
            if (data.chats.length === 0) {
                chatMessages.innerHTML = '<div class="text-center text-secondary py-12"><span class="material-symbols-outlined text-5xl text-outline-variant">forum</span><p class="mt-3 text-sm">No messages yet. Start the conversation!</p></div>';
                return;
            }
            data.chats.forEach(function(chat) {
                chatMessages.insertAdjacentHTML('beforeend', buildMsgHtml(chat));
            });
            scrollBottom();
        })
        .catch(function(err) {
            console.error('Chat load error:', err);
        });
    }

    // Send a message
    if (chatForm) {
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var message = chatInput ? chatInput.value.trim() : '';
            if (!message) return;

            if (sendBtn) sendBtn.disabled = true;
            if (statusBar) { statusBar.textContent = ''; statusBar.className = 'hidden text-xs text-center mb-2'; }

            var csrfMeta = document.querySelector('meta[name="csrf-token"]');
            var token = csrfMeta ? csrfMeta.content : CSRF_TOKEN;

            fetch(SEND_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: new URLSearchParams({ message: message, _token: token })
            })
            .then(function(res) {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.json();
            })
            .then(function(data) {
                if (data.success) {
                    if (chatInput) { chatInput.value = ''; chatInput.style.height = '44px'; }
                    loadChats();
                } else {
                    if (statusBar) {
                        statusBar.textContent = '❌ ' + (data.message || 'Failed to send');
                        statusBar.className = 'text-xs text-center text-red-600 mb-2';
                    }
                }
            })
            .catch(function(err) {
                console.error('Send error:', err);
                if (statusBar) {
                    statusBar.textContent = '❌ Network error. Dobara koshish karein.';
                    statusBar.className = 'text-xs text-center text-red-600 mb-2';
                }
            })
            .finally(function() {
                if (sendBtn) sendBtn.disabled = false;
            });
        });
    }

    // Auto-refresh every 4 seconds
    var chatRefreshTimer = setInterval(loadChats, 4000);

    // Clean up timer when navigating away
    window.addEventListener('beforeunload', function() { clearInterval(chatRefreshTimer); });
})();
</script>
@endsection