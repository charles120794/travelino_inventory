<?php

namespace App\Http\Controllers\Bingo;

use App\Http\Controllers\Controller;

use App\Http\Traits\Accounts\UsersAccountTrait;
use App\Http\Traits\Accounts\UsersSettingTrait;
use App\Http\Traits\Settings\SystemMediaUploaderTrait;

use App\Model\Bingo\BingoCards;
use App\Model\Bingo\BingoCardsNumbers;

class BingoController extends Controller 
{

	use UsersAccountTrait, SystemMediaUploaderTrait, UsersSettingTrait;

	public function createCards()
	{
		// return 
		for ($i = 1; $i <= 100; $i++) { 

			$number = substr('00000',strlen($i)) . $i;

			BingoCards::insert([
				'card_no' => $number,
				'card_available' => 'yes',
				'status' => 1,
				'order_level' => $i + 1,
				'created_by' => 1,
				'created_date' => now(),
			]);

		}
	}

	public function createCardsNumbers()
	{
		// return 
		for ($a = 1; $a <= 100; $a++) { 

			$number = substr('00000',strlen($a)) . $a;

			$b = collect([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15])->shuffle();
			$i = collect([16,17,18,19,20,21,22,23,24,25,26,27,28,29,30])->shuffle()->shuffle();
			$n = collect([31,32,33,34,35,36,37,38,39,40,41,42,43,44,45])->shuffle()->shuffle()->shuffle();
			$g = collect([46,47,48,49,50,51,52,53,54,55,56,57,58,59,60])->shuffle()->shuffle()->shuffle()->shuffle();
			$o = collect([61,62,63,64,65,66,67,68,69,70,71,72,73,74,75])->shuffle()->shuffle()->shuffle()->shuffle()->shuffle();

			for ($x = 0; $x < 5; $x++) { 

				$test = [
					'number_card_id'  => $a,
					'number_card_b'   => $b[$x],
					'number_card_i'   => $i[$x],
					'number_card_n'   => $n[$x],
					'number_card_g'   => $g[$x],
					'number_card_o'   => $o[$x],
					'number_card_row' => $x + 1,
				];

				// BingoCardsNumbers::insert($test);

			}

		}

	}

	public function bingo()
	{
		$cards = BingoCards::get();

		return view('manage.bingo.cards')->with('cards', $cards);
	}

}