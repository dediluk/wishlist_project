<x-layout>
    {{--    @section('title', $user->name)--}}
    <x-slot:title>
        {{ $user->name }}
        </x-slot>
        <div class="user_header">
            <h1 class="user_name">{{ $user->name }}</h1>
            @if(auth()->user() && auth()->user()->id != $user->id)
                @if(!auth()->user()->subscriptions->contains($user->id))
                    <a href="{{route('users.subscribe', ['subscribed_user_id'=> $user->id])}}" class="subscribe_button">
                        <button type="button" class="btn btn-info">Subscribe</button>
                    </a>
                @elseif(auth()->user()->subscriptions->contains($user->id))
                    <a href="{{route('users.unsubscribe', ['subscribed_user_id'=> $user->id])}}"
                       class="subscribe_button">
                        <button type="button" class="btn btn-danger">Unsubscribe</button>
                    </a>
                @endif
                @if(auth()->user()->hasRole('admin'))
                    <form action="{{route('users.change_role', ['id' => $user->id])}}" method="POST">
                        @csrf
                        <select name="users_role" class="form-select form-select-sm"
                                aria-label=".form-select-sm example"
                                onchange="this.form.submit()">
                            <option value="admin" @if($user->hasRole('admin')) selected @endif>Admin</option>
                            <option value="moderator" @if($user->hasRole('moderator')) selected @endif>Moderator
                            </option>
                            <option value="user" @if($user->hasRole('user')) selected @endif>User</option>
                        </select>
                    </form>
                @endif
            @endif


        </div>
        <div class="users_details_div">
            <div class="user_reserved_div">
                <h3>Reserved by {{$user->name}}:</h3>
                @if(!$reservationsForUsers)
                    User didn't reserve anything
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
                                <div id="collapse{{$collapseIndex}}"
                                     class="accordion-collapse collapse list_of_reservation"
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
                @foreach($userWishes as $wish)
                    <a href="{{route('wishes.show', ['wish' => $wish->wishId])}}"
                       class="wish_details">{{$wish->wish_title}} </a>
                    <br>
                    @can('canReserve', [$user])
                        @can('canUnreserveWish', [\App\Models\User::class, $wish])
                            <a class="red_text_class"
                               href="{{route('user_wish.unreservation', ['wishId' => $wish->wishId, 'userId' => $user->id])}}">unreserve</a>
                        @else
                            <a href="{{route('user_wish.reservation', ['wish_id' => $wish->wishId, 'user_id' => $user->id])}}"
                               @if ($wish->reservedByUsername)
                                   class="inactive_link"
                               @else
                                   class="green_text_class"
                                @endif><span>reserve</span></a>
                            @if($wish->reservedById)
                                @can('canViewReservationInfo', [\App\Models\User::class])
                                    (by
                                    <a href="{{route('users.show', ['user' => $wish->reservedById])}}"
                                       class="user_detail">
                                        {{$wish->reservedByUsername}}
                                    </a>
                                    )
                                @else
                                    (The wish has already been reserved)
                                @endcan
                            @endif
                        @endcan
                    @endcan

                    <br>
                @endforeach
            </div>

            <div class="user_created_wishes_div">
                <h3>Created wishes:</h3>
                @if(!count($user->createdWish))
                    User didn't create any wish
                @endif
                @foreach($user->createdWish as $wish)
                    <a href="{{route('wishes.show', ['wish' => $wish->id])}}"
                       class="wish_details">{{$wish->title}} </a>
                    <br>
                @endforeach
            </div>
        </div>
</x-layout>
