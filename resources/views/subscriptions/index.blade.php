<x-layout>
    <div class="index_users">
        @foreach($subscriptions as $subscription)
            <div>
                <a href="{{route('users.show', ['user' => $subscription->id])}}" class="user_detail">
                    {{$subscription->name}}
                </a>
                <a href="{{route('users.unsubscribe', ['subscribed_user_id' => $subscription->id])}}"
                   class="red_text_class">
                    Unsubscribe
                </a>
            </div>
            <br>
        @endforeach
    </div>
</x-layout>
