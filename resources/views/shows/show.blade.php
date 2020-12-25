@extends('layout')

@section('content')
    <div class="container mt-4">

            <h1 class="h5 mb-4">
                {{ $post->title }}
            </h1>

           @if($post->upload_image)
            <div>
            	<img src="{{ $post->upload_image->file_path }}"  class="mb-4"/>
            </div>
           @endif

            <p class="mb-5">
                {!! nl2br(e($post->body)) !!}
            </p>


            <section>
                <h2 class="h5 mb-4">
                    コメント
                </h2>


                @forelse($post->comments as $comment)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>

                        <p>
                            {{$comment->user->name}}
                        </p>

                        @if($comment->upload_image)
                         <div  class="mt-2">
                           <img src="{{ Storage::url($comment->upload_image->file_path) }}"/>
                         </div>
                        @endif

                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>
        </div>
    </div>
@endsection
