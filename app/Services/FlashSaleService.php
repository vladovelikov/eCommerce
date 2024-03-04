<?php

namespace App\Services;

use App\Models\FlashSale;
use App\Models\Product;

class FlashSaleService
{

    //TODO: add cron for updating the offer_price, offer_start_date, and offer_end_date if flash sale is valid for current date

    public function saveFlashSale(array $flashSaleData)
    {
        $flashSaleData['products'] = implode(";", $flashSaleData['products']);
        $flashSale = FlashSale::create($flashSaleData);

        $productsIds = explode(";", $flashSale->products);

        $currentDate = date('Y-m-d');

        if (!($currentDate >= $flashSale->start_date && $currentDate <= $flashSale->end_date)) {
            $flashSale->discount_percentage = null;
        }

        $this->updateProductDetails($productsIds, $flashSale->start_date, $flashSale->end_date, $flashSale->discount_percentage);
    }

    public function updateFlashSale(array $flashSaleData, string $id)
    {
        $flashSale = FlashSale::findOrFail($id);
        $oldProductsIds = explode(";", $flashSale->products);
        $flashSale->fill($flashSaleData);
        $flashSale->products = implode(";", $flashSaleData['products']);
        $flashSale->save();

        $currentDate = date('Y-m-d');

        if (!($currentDate >= $flashSale->start_date && $currentDate <= $flashSale->end_date)) {
            $flashSale->discount_percentage = null;
        }

        //setting the new values for the discounted products
        $this->updateProductDetails($flashSaleData['products'], $flashSale->start_date, $flashSale->end_date, $flashSale->discount_percentage);

        //reverting offer start date and end date to null for the removed products
        $removedProductsIds = array_diff($oldProductsIds, $flashSaleData['products']);
        if (!empty($removedProductsIds)) {
            $this->updateProductDetails($removedProductsIds, null, null); // Resetting offer start and end dates for removed products
        }

    }

    public function deleteFlashSale(string $id)
    {
        $flashSale = FlashSale::findOrFail($id);
        $productsIds = explode(";", $flashSale->products);

        //reverting the products offer start date and end date to null
        $this->updateProductDetails($productsIds, null, null);

        $flashSale->delete();
    }

    private function updateProductDetails(array $productsIds, $offerStartDate, $offerEndDate, $discountPercentage = null)
    {
        $products = Product::whereIn('id', $productsIds)->get();

        if ($products) {
            foreach ($products as $product) {
                // Applying the discount if available
                if ($discountPercentage && $discountPercentage > 0) {
                    $discountAmount = $product->price * ($discountPercentage / 100);
                    $product->offer_price = $product->price - $discountAmount;
                }

                $product->offer_start_date = $offerStartDate;
                $product->offer_end_date = $offerEndDate;

                $product->save();
            }
        }
    }
}
