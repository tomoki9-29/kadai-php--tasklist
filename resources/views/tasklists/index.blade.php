@extends('layouts.app')

@section('content')

<!-- ここにページ毎のコンテンツを書く -->
    <h1>タスク一覧</h1>
    
    @if (count($tasklists) > 0) <!-- レコード群の数が0より大きい -->
        <ul>
            @foreach($tasklists as $tasklist)<!-- 1つずつレコードを処理 -->
                <li>{!! link_to_route('tasklists.show', $tasklist->id, ['id' => $tasklist->id]) !!} : {{ $tasklist->content }}</li><!-- レコードのcontentカラムを取得 -->
            @endforeach
        </ul>
    @endif
    
    {!! link_to_route('tasklists.create','新規タスクの投稿') !!}
    
@endsection