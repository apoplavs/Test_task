@extends('wrap')

@section('content')
<style>
    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 1.3em;
    }

    .subscribe input {
        margin: 10px auto;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
    .alert-danger {
        color: red;
    }
    .bg-success {
        color: green;
    }
</style>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="bg-success h1">
            <p class="text-center">Ви відписались від сторінки "A"!</p>
        </div>
        <a href="{{ url('/') }}" class="h4">На головну</a>
    </div>
</div>
@endsection