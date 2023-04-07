<x-layout>
    <h1>{{$wish->title}}</h1>
    <br>
    <div class="wishes_details_div">
        <h3>{{$wish->description}}</h3>
        <span class="error_text">{{session('error')}}</span>
        <a href="{{route('users.show', ['user' => $wish->creatorUser->id])}}"
           class="user_detail">
            {{$wish->creatorUser->name}}
        </a>
        <a href="{{route('user_wish.wished', ['wish_id' => $wish->id])}}">I wish</a>
        <br>
        <h2>Categories:</h2>
        @foreach($wish->categories as $category)
            {{$category->title}}<br>
        @endforeach
        {{$wish->description}}

        <h2>Who wishes:</h2>
        @foreach($wish->usersWhoWish as $user)
            <a href="{{route('users.show', ['user' => $wish->creatorUser->id])}}"
               class="user_detail">
                {{$user->name}}
            </a>
            <br>
        @endforeach
        <form action="{{route('wishes.destroy', ['wish' => $wish->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</x-layout>


