<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Package extends Model
{
    protected $collection = 'packages';

    protected $fillable = [
        'transaction_id',
        'customer_name',
        'customer_code',
        'transaction_amount',
        'transaction_discount',
        'transaction_additional_field',
        'transaction_payment_type',
        'transaction_state',
        'transaction_code',
        'transaction_order',
        'location_id',
        'organization_id',
        'created_at',
        'updated_at',
        'transaction_payment_type_name',
        'transaction_cash_amount',
        'transaction_cash_change',
        // Atribut dari customer_attribute
        'customer_attribute.Nama_Sales',
        'customer_attribute.TOP',
        'customer_attribute.Jenis_Pelanggan',
        // Atribut dari connote
        'connote.connote_id',
        'connote.connote_number',
        'connote.connote_service',
        'connote.connote_service_price',
        'connote.connote_amount',
        'connote.connote_code',
        'connote.connote_booking_code',
        'connote.connote_order',
        'connote.connote_state',
        'connote.connote_state_id',
        'connote.zone_code_from',
        'connote.zone_code_to',
        'connote.surcharge_amount',
        'connote.actual_weight',
        'connote.volume_weight',
        'connote.chargeable_weight',
        'connote.created_at',
        'connote.updated_at',
        'connote.organization_id',
        'connote.location_id',
        'connote.connote_total_package',
        'connote.connote_surcharge_amount',
        'connote.connote_sla_day',
        'connote.location_name',
        'connote.location_type',
        'connote.source_tariff_db',
        'connote.id_source_tariff',
        'connote.pod',
        // Atribut dari origin_data
        'origin_data.customer_name',
        'origin_data.customer_address',
        'origin_data.customer_email',
        'origin_data.customer_phone',
        'origin_data.customer_address_detail',
        'origin_data.customer_zip_code',
        'origin_data.zone_code',
        'origin_data.organization_id',
        'origin_data.location_id',
        // Atribut dari destination_data
        'destination_data.customer_name',
        'destination_data.customer_address',
        'destination_data.customer_email',
        'destination_data.customer_phone',
        'destination_data.customer_address_detail',
        'destination_data.customer_zip_code',
        'destination_data.zone_code',
        'destination_data.organization_id',
        'destination_data.location_id',
        // Atribut dari koli_data
        'koli_data.*',
        // Atribut custom_field
        'custom_field.*',
        // Atribut dari currentLocation
        'currentLocation.name',
        'currentLocation.code',
        'currentLocation.type',
    ];
}
