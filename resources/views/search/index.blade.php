<x-layout>
    <div class="search_results">

        <div class="wishes_search_results index_wishes content_block">
            <h1>Wishes:</h1>
            <div class="index_wishes content_block">
                @foreach($searchResults['wishes'] as $wish)
                    {{--                <a href="{{route('wishes.show', ['wish' => $wish->id])}}">{{$wish->title}}</a>--}}
                    {{--                <br>--}}
                    <x-card :wish="$wish"></x-card>
                @endforeach
            </div>
        </div>
        <div class="users_results">
            <h1>Users:</h1>
            @foreach($searchResults['users'] as $user)
                <a href="{{route('users.show', ['user' => $user->id])}}">{{$user->name}}</a>
                <br>
            @endforeach
        </div>
    </div>
</x-layout>
