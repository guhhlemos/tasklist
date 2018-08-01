@extends('layouts.app')

@section('content')

<script>
    $(function () {

        console.log(@json($tasks));

    });
</script>

<div class="container">

    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success" id="mensagem_status">
                {{ session('id') }}: {{ session('status') }}
            </div>
            @endif

            <a href="{{ route('tasklist_create') }}" class="btn btn-success" role="button" style="">New</a>
            
        </div>
    </div>

    <div class="table-container table-responsive">
        @include('tasklist.tables.index')
    </div>

</div>
@endsection