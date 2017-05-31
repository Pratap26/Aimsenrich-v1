@extends('layouts.base')

@section('body')
<script type="text/javascript" src="//player.wowza.com/player/latest/wowzaplayer.min.js"></script>
<div class="sessionContainer">
    @if($session->status == true)   
    	<p class="sessionTitle">{{ $session->title }}</p>
    	<div id="playerElement" class="sessionStream"></div>
        @if(Auth::check())
            @if( ($session->author_id == Auth::user()->userId) || (Auth::user()->role >= 2) ) 
                <form action="{{ route('session.update', $session->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="session_id" value="{{ $session->id }}">
                    <button type="submit" class="btn btn-primary">
                        End live session
                    </button>
                </form>
            @endif
        @endif
    @else
        <p class="sessionTitle">This session has already ended</p>
    @endif
</div>
<script type="text/javascript">
WowzaPlayer.create('playerElement',
    {
    "license":"PLAY1-3rGVw-RjJdN-TDhzX-N4nau-73hWf",
    "title":"",
    "description":"",
    "sourceURL":"http%3A%2F%2F172.16.3.93%3A1935%2Flive%2FmyStream%2Fplaylist.m3u8",
    "autoPlay":false,
    "volume":"75",
    "mute":false,
    "loop":false,
    "audioOnly":false,
    "uiShowQuickRewind":true,
    "uiQuickRewindSeconds":"30"
    }
);
</script>
</script>
@endsection