
@php
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Auth;
@endphp
  <div>
    <input type="text"  class="form-control" placeholder="キーワードを入力してください" wire:model="searchTerm" />
     @isset($search_result)
     <h5 class="card-title">{{ $search_result }}</h5>
     @endisset
     <select class="form-control"  wire:model="searchCategory">
         <option selected="">選択する</option>
         <option value="1">1.小学校</option>
         <option value="2">2.中学校</option>
         <option value="3">3.高校</option>
         <option value="4">4.専門学校・大学</option>
         <option value="5">5.その他</option>
     </select>
    <div class="container mt-4">
     @if(Auth::id())
      <div class="mb-4">
          <a href="{{ route('posts.create') }}" class="btn btn-primary">
              投稿を新規作成する
          </a>
      </div>
     @endif
        @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-header">
                    <span class="mr-2">
                      {{ $post->title }}
                   </span>
                   <span>
                      カテゴリ―  {{ $post->category->category_name }}
                   </span>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {!! nl2br(e(str::limit($post->body, 200))) !!}
                    </p>
                   @if(Auth::id())
                   <a class="card-link" href="{{ route('posts.show', $post) }}">
                       続きを読む
                   </a>
                   @else
                   <a class="card-link" href="{{ route('shows.show', $post) }}">
                       続きを読む
                   </a>
                   @endif
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $post->created_at->format('Y.m.d') }}
                    </span>

                    <span class="mr-2">
                        投稿者 {{ $post->user->name }}
                    </span>

                    @if ($post->comments->count())
                        <span class="badge badge-primary">
                            コメント {{ $post->comments->count() }}件
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center mb-5">
            {{$posts-> links('livewire.livewire-pagination')}}
        </div>
    </div>
  </div>
