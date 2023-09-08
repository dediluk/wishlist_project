<x-layout>
    <x-slot:title>
        {{ $wish->title }}
        </x-slot>
    <div class="wishes_details_div">
        <h1>{{$wish->title}}</h1>
        <p class="wish_creator">Created by
            <a href="{{route('users.show', ['user' => $wish->creatorUser->id])}}" class="user_detail_wish_page">
                {{$wish->creatorUser->name}}
            </a>
        </p>
        <span class="error_text">{{session('error')}}</span>
        <div class="wish_manage_buttons">
            @if ($wish->usersWhoWish->contains(auth()->id()))
                <a href="{{route('user_wish.unwish', ['wish_id' => $wish->id])}}">
                    <button type="button" class="btn btn-warning">Unwish</button>
                </a>
            @else
                <a href="{{route('user_wish.wished', ['wish_id' => $wish->id])}}">
                    <button type="button" class="btn btn-success">I wish</button>
                </a>
            @endif
            @if(isset(auth()->user()->roles) && (auth()->user()->hasRole(['admin', 'moderator']) || auth()->user()->id == $wish->creatorUser->id))
                <form action="{{route('wishes.destroy', ['wish' => $wish->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endif
        </div>
        <br>
    </div>
    <div class="wishes_description">
        <h3 class="wish_description_title">Description:</h3>
        <p>{{$wish->description}}</p>

        <br>
        <h2>Categories:</h2>
        @foreach($wish->categories as $category)
            {{$category->title}}<br>
        @endforeach
        {{$wish->description}}

        @if(isset(auth()->user()->roles) && auth()->user()->hasRole(['admin', 'moderator']))
            <h2>Who wishes:</h2>
            @foreach($wish->usersWhoWish as $user)
                <a href="{{route('users.show', ['user' => $user->id])}}"
                   class="user_detail">
                    {{$user->name}}
                </a>
                <br>
            @endforeach
        @endif

    </div>
</x-layout>


