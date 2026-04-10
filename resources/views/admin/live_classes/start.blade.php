@extends('layouts.dashboard')

@section('title', 'Live Class')

@section('content')
    <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1" style="color:var(--pc-ink); font-weight:800;">{{ $liveClass->title }}</h1>
            <div class="text-muted">Live class room</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('admin.live-classes.index') }}">Back</a>
    </div>

    <div class="card pc-card">
        <div class="card-body">
            <div id="jitsi-container" style="height: 75vh; border-radius: 12px; overflow: hidden;"></div>
        </div>
    </div>

    <script src="https://{{ $jitsiDomain }}/external_api.js"></script>
    <script>
        (function () {
            const domain = @json($jitsiDomain);
            const roomName = @json($liveClass->meeting_room);
            const displayName = @json(auth()->user()->name);

            if (!window.JitsiMeetExternalAPI) {
                return;
            }

            new JitsiMeetExternalAPI(domain, {
                roomName,
                parentNode: document.querySelector('#jitsi-container'),
                userInfo: { displayName },
            });
        })();
    </script>
@endsection

