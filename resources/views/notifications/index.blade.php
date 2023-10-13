<x-layout>
    <div class="notification-hub">
        <button type="button" class="btn btn-danger" id="clean-notification">Danger</button>
        @foreach($notifications['unReadNotifications'] as $notification)
            {{$notification->markAsRead()}}
            <div
                    @if($notification->data['subscription_type'] === 'subscribe')
                        class="alert alert-success"
                    @else
                        class="alert alert-warning"
                    @endif
                    role="alert">
                {{$notification->created_at}}
                <span
                        class="notification-text">
                                <a href="{{route('users.show', ['user' => $notification->data['subscriber_user_id']])}}"
                                   class="user_detail">{{$notification->data['subscriber_user_name']}}</a>
            @if($notification->data['subscription_type'] === 'subscribe')
                        subscribed to you!</span>
                @else
                    unsubscribed!</span>
                @endif
            </div>
        @endforeach

        @if(!count($notifications['unReadNotifications']))
            There are no new notifications
        @endif

        <hr>

        @foreach($notifications['readNotifications'] as $notification)
            <div class="alert alert-secondary" role="alert">
                {{$notification->created_at}}
                <span
                        class="notification-text">
                                <a href="{{route('users.show', ['user' => $notification->data['subscriber_user_id']])}}"
                                   class="user_detail">{{$notification->data['subscriber_user_name']}}</a>
                @if($notification->data['subscription_type'] === 'subscribe')
                        subscribed to you!
                    @else
                        unsubscribed!
                    @endif
            </span>
            </div>
        @endforeach
    </div>
</x-layout>
