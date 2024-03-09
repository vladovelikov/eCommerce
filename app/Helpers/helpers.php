<?php

/** Set Sidebar item active */

function setActive(array $route)
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}

function isDiscounted($product): bool
{
    $currentDate = date('Y-m-d');

    if ($product->offer_price
        && $currentDate >= $product->offer_start_date
        && $currentDate <= $product->offer_end_date) {
        return true;
    }

    return false;
}

function productType(string $type): string
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;
        case 'best product':
            return 'Best';
            break;
        default:
            return '';

    }
}
