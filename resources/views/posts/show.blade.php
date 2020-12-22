<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <a href="http://127.0.0.1:8000/dashboard">投稿一覧に戻る</a>
      </h2>
      <link
          rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous"
      >
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
  </x-slot>
    <div class="container mt-4">
      @if($id == $post->user_id)
        <div class="border p-4">
            <div class="mb-4 text-right">
               <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">
                   編集する
               </a>
               <form
                   style="display: inline-block;"
                   method="POST"
                   action="{{ route('posts.destroy', ['post' => $post]) }}"
               >
                   @csrf
                   @method('DELETE')

                   <button class="btn btn-danger">削除する</button>
               </form>
            </div>
        @endif
            <h1 class="h5 mb-4">
                {{ $post->title }}
            </h1>

            @if($post->upload_image)
             <div>
             	<img src="{{ Storage::url($post->upload_image->file_path) }}" class="mb-4"/>
             </div>
            @endif


            <p class="mb-5">
                {!! nl2br(e($post->body)) !!}
            </p>

            @if($post->users()->where('user_id', Auth::id())->exists())
                <div class="col-md-3">
                  <form action="{{ route('unfavorites', $post) }}" method="POST">
                     @csrf
                     <input type="submit" value="&#xf165;いいね取り消す" class="fas btn btn-danger">
                  </form>
                 </div>
            @else
                <div class="col-md-3">
                  <form action="{{ route('favorites', $post) }}" method="POST">
                    @csrf
                    <input type="submit" value="&#xf164;いいね" class="fas btn btn-success">
                  </form>
                 </div>
             @endif

             <div class="row justify-content-center">
                <p>いいね数：{{ $post->users()->count() }}</p>
            </div>

            <section>
                <h2 class="h5 mb-4">
                    コメント
                </h2>
                <form class="mb-4" method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input
                        name="post_id"
                        type="hidden"
                        value="{{ $post->id }}"
                    >

                    <input
                        name="user_id"
                        type="hidden"
                        value="{{ $id }}"
                    >

                    <div class="form-group">
                        <label for="image">
                            画像
                        </label>
                        <input
                            id="image"
                            name="image"
                            class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                            value="{{ old('image') }}"
                            type="file"
                            accept="image/png, image/jpeg"
                        >
                        @if ($errors->has('image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="body">
                            本文
                        </label>

                        <textarea
                            id="body"
                            name="body"
                            class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                            rows="4"
                        >{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            コメントする
                        </button>
                    </div>
                </form>

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
</x-app-layout>
