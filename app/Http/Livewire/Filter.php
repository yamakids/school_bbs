<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class Filter extends Component
{
	use WithPagination;

	public $searchTerm;
	public $searchCategory;
  public $currentPage = 1;

    public function render()
    {
			if( $this->searchCategory!=0){
	      $posts_search = Post::where(function($sub_query){
	        $sub_query->where('title', 'like',  '%'.$this->searchTerm.'%')
	                  ->orWhere('body', 'like', '%'.$this->searchTerm.'%');
	                })->where('category_id', '=',  $this->searchCategory)->orderBy('created_at', 'desc')->paginate(5);
        }else{
					$posts_search = Post::where(function($sub_query){
						$sub_query->where('title', 'like',  '%'.$this->searchTerm.'%')
											->orWhere('body', 'like', '%'.$this->searchTerm.'%');
										})->orderBy('created_at', 'desc')->paginate(5);
				}

      $search_result = '"'.$this->searchTerm.'"の検索結果'.$posts_search->total().'件';


			return view('livewire.filter')->with([
					'posts' => $posts_search,
					'search_result' => $search_result,
			]);

    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
    }
}
