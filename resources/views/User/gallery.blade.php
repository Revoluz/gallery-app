                {{-- gallery image item --}}
                @foreach ($images as $image)
                    <a href="{{ route('images.show', ['image' => $image->id]) }}" class="d-block ">
                        <img class="w-100 shadow-sm" src="{{ $image->images() }}" alt="" />
                    </a>
                @endforeach
