<?php

namespace App\Http\Traits\Inventory\Activity;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\activity\InventoryActivityIssue;
use App\Model\Inventory\activity\InventoryActivityIssueDetails;
use App\Http\Controllers\Common\CommonServiceController as CommenService;

trait InventoryIssuanceTrait
{
	public function inventory_create_issuance($method, $id, $request)
	{

		$issuance = new InventoryActivityIssue;

		$issuance->issue_code 		          = $request->input('issue_code');
		$issuance->issue_particulars          = $request->input('issue_particulars');
		$issuance->issue_date 		          = $request->input('issue_date');
		// $issuance->issue_type				 = $request->input('');
		$issuance->issue_department           = $request->input('issue_department_id');
		// $issuance->issue_warehouse 	         = $request->input('');
		// $issuance->issue_total_quantity       = $request->input(''); 
		// $issuance->issue_total_selling_price  = $request->input('');
		$issuance->issue_total_purchase_price = $request->input('issue_total_price');
		$issuance->issue_by                   = $request->input('issue_by_id');
		$issuance->issue_to                   = $request->input('issue_to_id');
		$issuance->created_by                 = $this->thisUser()->users_id;
		$issuance->created_date               = (new CommenService)->dateTimeToday('Y-m-d h:i:s');

		if($issuance->save()) {
			
			$product_total_quantity = [];

			foreach ($request->product as $key => $value) {

				InventoryActivityIssueDetails::insert([
					'detail_issue_id'       => $issuance->issue_id,
					'detail_item'           => $value['product_id'],
					'detail_unit'           => $value['product_unit_id'],
					'detail_variant'        => $value['product_variant'],
					'detail_quantity'       => $value['product_quantity'],
					'detail_selling_price'  => $value['product_price'],
					'detail_purchase_price' => 0.00,
				]);

				$product_total_quantity[] = $value['product_quantity'];

			}

			InventoryActivityIssue::where('issue_id',$issuance->issue_id)->update([
				'issue_total_quantity' => array_sum($product_total_quantity),
			]);

			$request->session()->flash('success','Issuance successfully created');
			return back();

		}

	}

}