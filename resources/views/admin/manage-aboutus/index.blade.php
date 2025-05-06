@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>About Us List</h4>
            <a href="{{ route('admin.aboutus.create') }}" class="btn btn-success">Add About Us</a>
        </div>

        <div class="row">
            @foreach ($aboutus as $item)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                    @if($item->image)
                                <img src="{{ asset($item->image) }}" alt="About Image"
                                class="card-img-top" height="200" alt="About Image">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">
                                {{ Str::limit($item->description, 100) }}
                                @if (strlen($item->description) > 100)
                                    <button class="btn btn-link p-0 text-primary" onclick="toggleMore(this)">More Info</button>
                                    <span class="d-none more-text">{{ $item->description }}</span>
                                @endif
                            </p>
                            <form action="{{ route('admin.aboutus.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleMore(btn) {
            const moreText = btn.nextElementSibling;
            btn.previousSibling.textContent = moreText.textContent;
            btn.remove();
        }
    </script>
@endsection