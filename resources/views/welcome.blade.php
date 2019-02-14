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
        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="title m-b-md">
            Отримати посилання на сторінку "A"
        </div>

        <div class="subscribe">
            <form method="POST" action="{{ url('/') }}">
                 @csrf
                <input type="text" required="required" name="name" placeholder="ім'я"><br>
                <input type="email" required="required" name="email" placeholder="email"><br>
                <input type="submit" name="submit" value="підписатись"><br>
            </form>
        </div>

        @if (isset($subscribed) && $subscribed)
            <div class="bg-success">
                <p class="text-center">Ви підписані на сторінку "A"!</p>
                <p class="text-center"><a href="{{ url('a/'.$uniqueLink) }}" target="_blank">{{ url('a/'.$uniqueLink) }}</a></p>
            </div>
        @endif
        <a href="{{ url('/admin') }}" class="h4">Адмін панель</a>
    </div>
</div>
@endsection
