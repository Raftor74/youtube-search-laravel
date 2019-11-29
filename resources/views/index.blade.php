@extends('layouts.app')

@section('title', 'Главная')

@section('content_title', '')

@section('content')
    <div class="col-md-12 col-sm-12 text-center">
        <h1>Поиск видео на YouTube</h1>
    </div>
    <div class="col-md-8 offset-md-2 mt-5">
        <form action="{{ route('videoSearch') }}" method="post">
            {{ csrf_field() }}
            <div class="form-row">
                <div class="col-md-8">
                    <input type="text" name="query" class="form-control" placeholder="Название видео"
                           value="{{ $query }}">
                </div>
                <div class="col-md-2">
                    <select name="max_results" class="form-control">
                        @foreach($maxResultsList as $item)
                            @if($item['value'] === $maxResults)
                                <option value="{{ $item['value'] }}" selected>{{ $item['name'] }}</option>
                            @else
                                <option value="{{ $item['value'] }}">{{ $item['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info">Найти</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12 mt-5">
        <div class="row">
            @foreach($videoList as $video)
                <div class="col-md-4 mt-5">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $video->getImgUrl() }}" class="card-img-top" alt="{{ $video->getTitle() }}">
                        <div class="card-body">
                            <p class="card-text">{{ $video->getTitle() }}</p>
                            <a href="{{ $video->getUrl() }}" class="btn btn-primary" target="_blank">Смотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

