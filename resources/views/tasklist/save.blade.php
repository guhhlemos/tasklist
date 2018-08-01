@extends('layouts.app')

@section('content')

<script>

    $(function () {

        var task = null;

        @isset($task)
        task = @json($task);
        console.log(task);
        @endisset

        if (task) {
            $('#title').val(task.title);
            $('#description').val(task.description);
            $('#status').val(task.status.id);
        }

    });
    
</script>

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <h2 class="titulo">Task - <?php echo isset($task) ? 'Edit' : 'Create' ?></h2>

            <form method="POST">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input font-family="monospace" name="title" type="text" class="form-control" id="title" placeholder="title">
                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">description</label>
                    <input font-family="monospace" name="description" type="text" class="form-control" id="description" placeholder="description">
                    @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" id="status" required>
                        @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                    <span class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('tasklist') }}" class="btn btn-danger" role="button">Cancel</a>

            </form>

        </div>
    </div>
</div>
@endsection