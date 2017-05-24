<ul>
    @foreach ($studies as $study)
        <li>This is study {{ $study->id }} {{ $study->name }}</li>
    @endforeach
</ul>