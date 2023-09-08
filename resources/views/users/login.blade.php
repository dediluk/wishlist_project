<x-layout>
    <x-slot:title>
        Login
        </x-slot>
<form action="{{route('users.authenticate')}}" method="POST">
    @csrf
    <div class="email">
        <label for="email">
            Email
        </label>
        <input
            type="email"
            name="email"
            {{--            value="{{old('email')}}"--}}
        />
    </div>
    <div class="password">
        <label for="password">
            Password
        </label>
        <input
            type="password"
            name="password"
            {{--            value="{{old('name')}}"--}}
        />
    </div>
    <button type="submit">
        Submit
    </button>
</form>
</x-layout>
