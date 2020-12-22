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
  </x-slot>
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                投稿の編集
            </h1>

            <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <fieldset class="mb-4">
                    <div class="form-group">
                        <label for="title">
                            タイトル
                        </label>
                        <input
                            id="title"
                            name="title"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            value="{{ old('title') ?: $post->title }}"
                            type="text"
                        >
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                      <label for="category_id">
                        category
                      </label>
                      <select class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" id="category_id" name="category_id">
                          <option selected=''>選択する</option>
                          <option value="1" @if($post->category_id=='1') selected @endif>1.小学校</option>
                          <option value="2" @if($post->category_id=='2') selected @endif>2.中学校</option>
                          <option value="3" @if($post->category_id=='3') selected @endif>3.高校</option>
                          <option value="4" @if($post->category_id=='4') selected @endif>4.専門学校・大学</option>
                          <option value="5" @if($post->category_id=='5') selected @endif>5.その他</option>
                      </select>
                      @if ($errors->has('category_id'))
                          <div class="invalid-feedback">
                              {{ $errors->first('category_id') }}
                          </div>
                      @endif
                    </div>

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
                        >{{ old('body') ?: $post->body }}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>

                    <input type="hidden" name="user_id" value="{{ $post->user_id }}">

                    <div class="mt-5">
                        <a class="btn btn-secondary" href="{{ route('posts.show', ['post' => $post]) }}">
                            キャンセル
                        </a>

                        <button type="submit" class="btn btn-primary">
                            更新する
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</x-app-layout>
