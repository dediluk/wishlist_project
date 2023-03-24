@props(['wish'])

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{$wish->title}}</h5>
            @foreach($wish->categories as $category)
                <h6 class="card-subtitle mb-2 text-muted">{{$category->title}}</h6>
            @endforeach
            <p class="card-text">{{$wish->description}}</p>
        </div>
    </div>

