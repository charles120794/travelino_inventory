<?php 

namespace App\Model\Bingo;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BingoCardsNumbers extends Model
{

	protected $table = 'bingo_cards_numbers';

	protected $primaryKey = 'number_id';

	public $timestamps = false;

}