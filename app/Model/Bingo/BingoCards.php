<?php 

namespace App\Model\Bingo;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BingoCards extends Model
{

	protected $table = 'bingo_cards';

	protected $primaryKey = 'card_id';

	public $timestamps = false;

	public function cardsNumbers()
	{
		return $this->hasMany(new BingoCardsNumbers,'number_card_id','card_id');
	}

}