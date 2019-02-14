@extends('wrap')

@section('content')
        <style>
            .alert-danger {
                color: red;
            }
            .subscribers {
                font-size: .8em;
                margin: 10px auto;
                border-collapse: collapse;
            }
            .subscribers td {
                border: solid 1px black;
                margin: 0 20px;
                padding: 10px 5px;
            }
            .subscribers .delete input {
                color: red;
            }
            .subscribers .update input {
                color: green;
            }
            .new-subscribe {
                margin: 50px auto;
                align-items: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
                box-shadow: 0 0 10px rgba(0,0,0,0.5);
            }
            .new-subscribe input {
                margin: 15px 5px;
            }
            .text-center {
                text-align: center;
            }
        </style>

        @if (!$subscribers->isEmpty())
            <table class="subscribers">
                <tr>
                    <th>Ім'я</th>
                    <th>email</th>
                    <th>URL</th>
                    <th>Скасовано підписку</th>
                    <th>Дата підписки</th>
                    <th>Дата закінчення дії</th>
                    <th></th>
                </tr>

                @foreach ($subscribers as $subscriber)
                <tr>
                    <form method="POST" action="{{ url('/admin/'.$subscriber->url_token) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <td>{{ $subscriber->name }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>
                            <a href="{{ url('a/'.$subscriber->url_token) }}" target="_blank">{{ url('a/'.$subscriber->url_token) }}</a>
                        </td>
                        <td>
                            <label>
                                <input type="checkbox" {{ $subscriber->revoked==1 ? 'checked' : '' }} name="unsubscribed">
                                Скасовано підписку
                            </label>
                        </td>
                        <td>{{ $subscriber->added_on }}</td>
                        <td><input type="date" value="{{ $subscriber->expires_at }}" name="expires"></td>
                        <td class="update"><input type="submit" name="submit" value="Оновити"></td>
                    </form>

                    <form method="POST" action="{{ url('/admin/'.$subscriber->url_token) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <td class="delete">
                            <label>
                                <input type="submit" name="submit" value="Видалити">
                            </label>
                        </td>
                    </form>
                </tr>
                @endforeach
            </table>
        @else
        <h3 class="text-center">Немає жодної підписки</h3>    
        @endif

        <div class="new-subscribe">
            @if ($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              <br>  
            @endif
            
            <form method="POST" action="">
                @csrf
                <label>
                    Термін дії:
                    <input type="date" required="required" name="expires">
                </label>

                 <label>
                    <input type="checkbox" name="unsubscribed">
                    Скасовано підписку
                </label>

                <br>

                <label>
                    Ім'я:
                    <input type="text" required="required" name="name" placeholder="ім'я">
                </label>
                <label>
                    Email:
                    <input type="email" required="required" name="email" placeholder="email">
                </label>
                <br>
                <input type="submit" name="submit" value="Створити підписку">
            </form>  
        </div>
@endsection
