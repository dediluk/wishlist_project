<x-layout>
    <x-slot:title>
        Registration
        </x-slot>
<form method="POST" action="{{route('users.store')}}">
    @csrf
    <div class="name">
        <label for="name">
            Name
        </label>
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="name"
{{--            value="{{old('username')}}"--}}
        />
    </div>
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
    <div class="password_confirmation">
        <label for="password_confirmation">
            Confirm password
        </label>
        <input
            type="password"
            name="password_confirmation"
{{--            value="{{old('name')}}"--}}
        />
    </div>

    <button type="submit">Submit</button>
</form>
</x-layout>
