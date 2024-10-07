<?php

namespace Domain\Shipping\Models;

use Illuminate\Database\Eloquent\Model;

class ParcelType extends Model {

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
  ];

}
