<x-layout>
    <div class="user_header">
        <h1 class="user_name">{{ $user->name }}</h1>
        {{--        {{var_dump(auth()->user()->subscriptions->contains($user->id))}}--}}
        @if(auth()->user() && auth()->user()->id != $user->id)
            @if(!auth()->user()->subscriptions->contains($user->id))
                <a href="{{route('users.subscribe', ['subscribed_user_id'=> $user->id])}}" class="subscribe_button">
                    <button type="button" class="btn btn-info">Subscribe</button>
                </a>
            @elseif(auth()->user()->subscriptions->contains($user->id))
                <a href="{{route('users.unsubscribe', ['subscribed_user_id'=> $user->id])}}" class="subscribe_button">
                    <button type="button" class="btn btn-danger">Unsubscribe</button>
                </a>
            @endif
        @endif


    </div>
    <div class="users_details_div">
        <div class="user_reserved_div">
            <h3>Reserved by {{$user->name}}:</h3>
            @if(!$reservationsForUsers)
                You didn't reserve anything
            @endif
            <div class="index_wishes user_reservations">
                <div class="accordion" id="accordionExample">
                    @php $collapseIndex = 0 @endphp
                    @foreach($reservationsForUsers as $key => $value)
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="heading{{$collapseIndex}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$collapseIndex}}" aria-expanded="false"
                                        aria-controls="collapse{{$collapseIndex}}">
                                    {{$key}} ({{count($value)}})
                                </button>
                            </h3>
                            <div id="collapse{{$collapseIndex}}" class="accordion-collapse collapse list_of_reservation"
                                 aria-labelledby="heading{{$collapseIndex}}"
                                 data-bs-parent="#accordionExample">
                                <div class="accordion-body reserved_wishes_accordion">
                                    @foreach($value as $item)
                                        <a href="{{route('wishes.show', ['wish' => $item[0]])}}">{{$item[1]}}</a>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                            @php $collapseIndex++ @endphp
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="user_wished_div">
            <h3>{{$user->name}}'s wishes:</h3>
            @foreach($user->wishedWish as $wish)
                <a href="{{route('wishes.show', ['wish' => $wish->id])}}"
                   class="wish_details">{{$wish->title}} </a>
                <br>
                @if($user->id != auth()->id() && auth()->id())
                    <a href="{{route('user_wish.reservation', ['wish_id' => $wish->id, 'user_id' => $user->id])}}">reserve</a>
                    -
                    <a href="{{route('user_wish.wished', ['wish_id' => $wish->id])}}">I wish</a>
                @endif

                <br>
            @endforeach
        </div>

        <div class="user_created_wishes_div">
            <h3>Created wishes:</h3>
            @if(!count($user->createdWish))
                You didn't create any wish
            @endif
            @foreach($user->createdWish as $wish)
                <a href="{{route('wishes.show', ['wish' => $wish->id])}}"
                   class="wish_details">{{$wish->title}} </a>
                <br>
            @endforeach
        </div>
    </div>
</x-layout>
