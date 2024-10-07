<?php

namespace Domain\Shipping\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ShippingService extends Model {

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'carrier_id',
    'parcel_type_id',
    'region_id',
    'price',
    'weekend_shipping'
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array {
    return [
      'ships_during_weekends' => 'boolean',
    ];
  }

  public function carrier(): HasOne {
    return $this->hasOne(Carrier::class, 'id', 'carrier_id');
  }

  public function parcelType(): HasOne {
    return $this->hasOne(ParcelType::class, 'id', 'parcel_type_id');
  }

  public function region(): HasOne {
    return $this->hasOne(Region::class, 'id', 'region_id');
  }

}
