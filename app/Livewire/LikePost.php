<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
	public $post;
	public $isLiked;
	public $likes;

	public function mount() {
		// esto es un constructor

		$this -> isLiked = $this -> post -> checkLike( auth() -> user() );
		$this -> likes = $this -> post->likes->count();
	}

    public function render()
    {
        return view('livewire.like-post');
    }

	public function like() {

		if ( $this -> post -> checkLike( auth() -> user() ) ) {
			$this -> post -> likes() -> where( 'user_id', auth() -> user() -> id) -> delete();
			$this -> isLiked = false;
			$this -> likes--;
		} else {
			$this -> post -> likes() -> create([
				'user_id' => auth() -> user() -> id
			]);
			$this -> isLiked = true;
			$this -> likes++;
		}

	}
}
