<?php

namespace App\Http\Traits\Inventory\Maintenance;

use Session;
use Illuminate\Http\Request;
use App\Model\Inventory\maintenance\InventoryTableVariant;

trait InventoryVariationTrait
{
	public function inventory_create_variant($method, $id, $request)
	{
		if(!is_null($request->input('variant_name_1'))) {

			$itemVariant = new InventoryTableVariant;

			$itemVariant->variant_item        = $id;
			$itemVariant->variant_type        = 1;
			$itemVariant->variant_level       = 1;
			$itemVariant->variant_parent      = 0;
			$itemVariant->variant_code        = substr($request->input('variant_name_1'), 0,3);
			$itemVariant->variant_description = $request->input('variant_name_1');

			if( $itemVariant->save() ) {
				foreach ($request->option1 as $key => $value) {
					(new InventoryTableVariant)->insert([
						'variant_item'           => $id,
						'variant_type'           => 0,
						'variant_level'          => 2,
						'variant_parent'         => $itemVariant->variant_id,
						'variant_code'           => substr($value['option'], 0,3),
						'variant_description'    => $value['option'],
						/* Amount */
						// 'variant_purchase_price' = $value['purchase_price'];
						'variant_selling_price'  => $value['selling_price'],
						'variant_quantity'       => $value['quantity'],
						'variant_unit'           => $value['unit'],
					]);
				}
			}
		}

		if(!is_null($request->input('variant_name_2'))) {

			$itemVariant = new InventoryTableVariant;

			$itemVariant->variant_item        = $id;
			$itemVariant->variant_type        = 1;
			$itemVariant->variant_level       = 1;
			$itemVariant->variant_parent      = 0;
			$itemVariant->variant_code        = substr($request->input('variant_name_2'), 0,3);
			$itemVariant->variant_description = $request->input('variant_name_2');

			if( $itemVariant->save() ) {
				foreach ($request->option2 as $key => $value) {
					(new InventoryTableVariant)->insert([
						'variant_item'           => $id,
						'variant_type'           => 0,
						'variant_level'          => 2,
						'variant_parent'         => $itemVariant->variant_id,
						'variant_code'           => substr($value['option'], 0,3),
						'variant_description'    => $value['option'],
						/* Amount */
						// 'variant_purchase_price' = $value['purchase_price'];
						'variant_selling_price'  => $value['selling_price'],
						'variant_quantity'       => $value['quantity'],
						'variant_unit'           => $value['unit'],
					]);
				}
			}
		}
	}
}