@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                 <div class="user-wrapper">
                    <ul class="users">
                           @foreach($user as $users)
                           <li class="user" id="{{ $users->user_id }}">
                            {{--will show unread count notification--}}
                                @if($users->unread)
                                   <span class="pending">{{ $users->unread }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-body">
                                        <p class="name">{{ $users->user_name }}</p>
                                        <p class="email">{{ $users->user_email }}</p>
                                    </div>
                                </div>
                            </li>
                       @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
@endsection