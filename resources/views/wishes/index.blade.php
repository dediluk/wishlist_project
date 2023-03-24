<x-layout>
    <div class="index_wishes content_block">
        @foreach($wishes as $wish)
            <x-card :wish="$wish"></x-card>
        @endforeach
    </div>
</x-layout>
