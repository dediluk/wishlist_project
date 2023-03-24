<x-layout>
    <h1>{{ $user->name }}</h1>
    <a href="{{route('users.create')}}">Create user</a>
    <h2>Reserved by you:</h2>
    @foreach($reservedWishes as $reservation)
        <a href="{{route('wishes.show', ['wish' => $reservation->wish_id])}}"
           class="wish_details">
            {{$reservation->title}}
        </a>
        for
        <a href="{{route('users.show', ['user' => $reservation->user_id])}}"
           class="user_detail">
            {{$reservation->name}}
        </a>
        <br>
    @endforeach

    <h2>User wishes:</h2>
    @foreach($user->wishedWish as $wish)
        <a href="{{route('wishes.show', ['wish' => $wish->id])}}"
           class="wish_details">{{$wish->title}} </a>
        <br>
        @if($user->id != auth()->id() && auth()->id())
            <a href="{{route('user_wish.reservation', ['wish_id' => $wish->id, 'user_id' => $user->id])}}">reserve</a> -
            <a href="{{route('user_wish.wished', ['wish_id' => $wish->id])}}">I wish</a>
        @endif

        <br>
    @endforeach

    <h2>Created wishes:</h2>
    @foreach($user->createdWish as $wish)
        <a href="{{route('wishes.show', ['wish' => $wish->id])}}"
           class="wish_details">{{$wish->title}} </a>
        <br>
    @endforeach
</x-layout>
