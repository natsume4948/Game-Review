@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="ja">
    <header>
        <meta charset="utf-8">
        <title>Game Reviews</title>
    </header>
    <body>
        <h1>ランキング</h1>
        <div class="row">
            <div class="col-sm-10">
                
                <table class="table">
                <tr class="nav-item">
                        <th class="text-center nav-item"><a href="{{ route('rankingu.get') }}" class="nav-link">週間</a></th>
                        <th class="text-center nav-item"><a href="{{ route('monthly.get') }}" class="nav-link">月間</a></th>
                        <th class="text-center nav-item"><a href="{{ route('yearly.get') }}" class="nav-link">年間</a></th>
                        
                </tr>
                @foreach($yearly as $rankingu)
                <tr class="table-bordered">
                    <td>{{ $rankingu->game->name }}</td>
                    <td>{{ $rankingu->score }}</td>
                    <td>{{ $rankingu->content }}</td>
                </tr>
                @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
@endsection