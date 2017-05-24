<ul>
    @foreach ($courses as $course)
        <li>This is course {{ $course->id }} {{ $course->name }}</li>
    @endforeach
</ul>