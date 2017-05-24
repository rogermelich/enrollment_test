<ul>
    @foreach ($classrooms as $classroom)
        <li>This is classroom {{ $classroom->id }} {{ $classroom->name }}</li>
    @endforeach
</ul>