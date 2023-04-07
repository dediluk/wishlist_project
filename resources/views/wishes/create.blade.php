<x-layout>
    <form action="{{route('wishes.store')}}" method="POST">
        @csrf
        <label for="title">
            Title
        </label>
        <input
            type="text"
            name="title"
            {{--            value="{{old('name')}}"--}}
        />
        <label for="description">
            Description
        </label>
        <input
            type="text"
            name="description"
            {{--            value="{{old('name')}}"--}}
        />
        <button type="submit">Create</button>
    </form>
</x-layout>
