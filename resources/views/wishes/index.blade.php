<x-layout>
    <div class="create_wish_div">
        <a href="{{route('wishes.create')}}" class="">
            <button type="button" class="btn btn-success">Create wish</button>
        </a>
    </div>
    <div class="index_wishes content_block">
        @foreach($wishes as $wish)
            <x-card :wish="$wish"></x-card>
        @endforeach
    </div>
</x-layout>
