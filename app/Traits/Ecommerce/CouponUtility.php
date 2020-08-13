<?php

namespace Programmit\Traits\Ecommerce;

trait CouponUtility
{    

    public function couponDD()
    {
        dd('Coupon Traut DD');
    }

    public function createCoupon($data)
    {
        $coupon = new \App\ServiceCoupon;
        $coupon->created_by_user_id = $data['created_by_user_id'];
        $coupon->owned_by_user_id = $data['owned_by_user_id'];
        $coupon->service_package_id = $data['service_package_id'];
        $coupon->service_coupon_discount_type_id = $data['service_coupon_discount_type_id'];
        $coupon->amount_value = $data['amount_value'];
        $coupon->percent_value = $data['percent_value'];
        $coupon->label = $data['label'];
        $coupon->secret_value = $data['secret_value'];
        $coupon->note = $data['note'];
        $coupon->expires_at = $data['expires_at'];
        $coupon->infinite_usage = $data['infinite_usage'];
        $coupon->service_coupon_status_id = $data['service_coupon_status_id'];

        if($coupon->save())
        {
            return $coupon;
        }

        return false;
    }

    public function couponCalculateValue($coupon_secret_value, $price_of_object = null, $addValueToOwner =false)
    {
        if($price_of_object == null)
            return (object) [
                'status' => 404,
                'erorr_message' => 'Price of object is empty.',
             ];

        $coupon = \App\ServiceCoupon::where('secret_value', $coupon_secret_value)->where('service_coupon_status_id', 1)->first();
        if($coupon)
        {
            $discountType = null;
            $discountedValue = 0;
            $orginalNetValue = null;
            $netValue = null;
            

            // checking coupon type
            if($coupon->service_coupon_discount_type_id == 1) // discount type is by amount
            {
                $discountType = 1;
                $discountedValue = $coupon->amount_value;
                $orginalNetValue = ($price_of_object - $discountedValue);
                $discountView = 'discount by $' . $discountedValue;

            }
            else if($coupon->service_coupon_discount_type_id == 2)  // discount type is by percent
            {
                $discountType = 1;
                $discountedValue = ($servicePackagePlan->rate * $coupon->percent_value) / 100;
                $orginalNetValue = $price_of_object - $discountedValue;
                $rateToPay = $servicePackagePlan->rate - $discountedValue;
                $discountView = 'discount by ' . $discountedValue . '%';
            }

            $netValue = $orginalNetValue;
            if($orginalNetValue < 0 )
            {
                $netValue = 0;
            }

            if($addValueToOwner)
            {
                $couponOwnder = \App\User::where('owned_by_user_id', $coupon->user_id)->first();
                $couponOwnder->money_balance = ($couponOwnder->money_balance + 25.00);
                $couponOwnder->save();                
            }

             return (object) [
                'id' => $coupon->id,
                'discount_type' => $discountType,
                'discount_view' => $discountView,
                'object_price' => $price_of_object,
                'discount_value' => $discountedValue,
                'orginal_net_value' => $orginalNetValue,
                'net_value' => $netValue,
                'status' => 200,
                'erorr_message' => '',
             ];
        }
        else
        {
            return (object) [
                'status' => 404,
                'erorr_message' => "Coupon isn't found.",
             ];
        }

    }

    public function genRandomCouponSecret()
    {
        $length1 = 4;
        $length2 = 5;
        $extra = '';

        $characters = '0123456789&ABCDEFGHIJK@LMNOPQRSTUVWXYZ#';
        $characters_length = strlen($characters)-1;
        $characters_split = '_!@#$-';
        $characters_split_length = strlen($characters_split)-1;

        $secret = '';

        for ($p = 0; $p < $length1; $p++) {
            $secret .= $characters[mt_rand(0, $characters_length)];
        }

        $secret .= $characters_split[mt_rand(0, $characters_split_length)];

        for ($p = 0; $p < $length2; $p++) {
            $secret .= $characters[mt_rand(0, $characters_length)];
        }

        return $secret;
    }

    public function genCouponSecret()
    {
        while(true)
        {
            $s = $this->genRandomCouponSecret();
            $c = \App\ServiceCoupon::where('secret_value', $s)->first();
            if(!$c)
                break;
        }
        
        return $s;
    }

}