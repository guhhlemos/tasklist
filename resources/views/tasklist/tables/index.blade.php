<table class="table">
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">title</th>
            <th scope="col">description</th>
            <th scope="col">status</th>
            <th scope="col">created_at</th>
            <th scope="col">completed_at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr id="row_{{ $task->id }}">
            <td><a href="{{ route('tasklist_edit', $task->id) }}" class="btn btn-primary" role="button">Edit</a></td>
            <td>
                <form id="form2" method="POST" action="{{ route('tasklist_destroy', $task->id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger" form="form2">Delete</button>
                </form>
            </td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>
                @switch($task->status->name)
                @case('novo')
                <span class="badge badge-warning">{{ $task->status->name }}</span>
                @break

                @case('em andamento')
                <span class="badge badge-primary">{{ $task->status->name }}</span>
                @break

                @case('concluído')
                <span class="badge badge-success">{{ $task->status->name }}</span>
                @break

                @default
                <span class="badge badge-warning">{{ $task->status->name }}</span>
                @endswitch
            </td>
            <td>{{ $task->created_at }}</td>
            @if ( is_null($task->completed_at) )
            <td>-</td>
            @else
            <td>{{ $task->completed_at }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>