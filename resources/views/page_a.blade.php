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

    .unsubscribe input {
        margin: 10px auto;
        color: red;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
    .alert-danger {
        color: red;
    }
</style>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            сторінкa "A"
        </div>

        <div class="unsubscribe">
            <form method="POST" action="">
                 @csrf
                 {{ method_field('PUT') }}
                <input type="submit" name="submit" value="Скасувати підписку на дану сторінку"><br>
            </form>
        </div>
    </div>
</div>
@endsection
