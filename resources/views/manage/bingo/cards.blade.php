@extends('main.bingo')

@section('content')

<div id="app">
	{{-- <example-component></example-component> --}}
</div>

<div class="container mx-auto">

	<style type="text/css">
		@media print {
		  	.print-cards {
		  		page-break-after: always;
		  	}
		}	
	</style>

	<div class="flex flex-wrap"> 

		@foreach(collect($cards)->chunk(4) as $key => $card)

			<div class="print-cards">

				@foreach($card as $bingo)

					<table class="border m-1">
						<thead class="border-4 border-teal-800">
							<tr>
								<td class="py-3 text-center font-extrabold text-5xl text-teal-800">B</td>
								<td class="py-3 text-center font-extrabold text-5xl text-teal-800">I</td>
								<td class="py-3 text-center font-extrabold text-5xl text-teal-800">N</td>
								<td class="py-3 text-center font-extrabold text-5xl text-teal-800">G</td>
								<td class="py-3 text-center font-extrabold text-5xl text-teal-800">O</td>
							</tr>
						</thead>
						<tbody class="border-4 border-teal-800">
							@foreach($bingo->cardsNumbers as $numbers)
								<tr>
									<td class="border-4 border-teal-800 py-1 px-1 text-center font-bold text-5xl text-teal-800 rounded-3xl">{{ $numbers->number_card_b }}</td>
									<td class="border-4 border-teal-800 py-1 px-1 text-center font-bold text-5xl text-teal-800 rounded-3xl">{{ $numbers->number_card_i }}</td>
									@if($numbers->number_card_n === 0)
									<td class="border-4 border-teal-800 py-1 px-1 text-center font-bold text-3xl text-teal-700 rounded-3xl">FREE</td>
									@else
									<td class="border-4 border-teal-800 py-1 px-1 text-center font-bold text-5xl text-teal-800 rounded-3xl">{{ $numbers->number_card_n }}</td>
									@endif
									<td class="border-4 border-teal-800 py-1 px-1 text-center font-bold text-5xl text-teal-800 rounded-3xl">{{ $numbers->number_card_g }}</td>
									<td class="border-4 border-teal-800 py-1 px-1 text-center font-bold text-5xl text-teal-800 rounded-3xl">{{ $numbers->number_card_o }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>

				@endforeach
				
			</div>

		@endforeach

	</div>

</div>

@endsection
