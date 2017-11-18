@extends('layouts.app')

@section('content')
  @if (Auth::check())

    <!-- ここにページ毎のコンテンツを書く -->
    <h1>タスク一覧</h1>
    
    @if (count($tasklists) > 0) <!-- レコード群の数が0より大きい -->
        <!-- theadの下に線 -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>タスク</th>
                </tr>  
            </thead>
            <tbody>
                @foreach($tasklists as $tasklist)<!-- 1つずつレコードを処理 -->
                    <tr>
                        <td>{!! link_to_route('tasklists.show', $tasklist->id, ['id' => $tasklist->id]) !!}</td>
                        <td>{{$tasklist->status}}</td><!-- レコードのcontentカラムを取得 -->
                        <td>{{$tasklist->content }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {!! link_to_route('tasklists.create','新規タスクの投稿',null,['class' => 'btn btn-primary']) !!}
  @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Tasklist</h1>
                {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
  @endif
    
@endsection