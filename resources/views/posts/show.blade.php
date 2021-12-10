@extends('layouts.app')

@section('title', $post['title'])

@section('content')
@if($post['is_new'])
<div>A new block post using if!</div>
@elseif(!$post['is_new'])
<div>Not new</div>
@endif

@unless($post['is_new'])
<div>It is an old post...using unless</div>
@endunless

<h1>{{ $post['title'] }}</h1>
<p>{{ $post['content'] }}</p>
@endsection