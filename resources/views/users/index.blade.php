<x-layout>
    <div class="index_users content_block">
        @foreach($users as $user)
            <a href="{{route('users.show', ['user' => $user->id])}}"
               class="user_detail">
                {{$user->name}}
            </a>
            <br>
        @endforeach
    </div>
</x-layout>
