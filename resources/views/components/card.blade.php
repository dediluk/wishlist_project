@props(['wish'])

<div {{ $attributes->merge(['class' => 'card card_index'])}} style="width: 18rem;">
    <div class="card-body">
        <a href="{{route('wishes.show', ['wish' => $wish->id])}}"><h5 class="card-title">{{$wish->title}}</h5></a>

        @if (isset($wish->categories))
            @foreach($wish->categories as $category)
                <h6 class="card-subtitle mb-2 text-muted">{{$category->title}}</h6>
            @endforeach
        @endif
        <p class="card-text">{{$wish->description}}</p>
    </div>
</div>

