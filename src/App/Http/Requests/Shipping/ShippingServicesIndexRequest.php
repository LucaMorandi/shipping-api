<?php

namespace App\Http\Requests\Shipping;

use Carbon\Carbon;
use Domain\Shipping\Types\ParcelTypes;
use Domain\Shipping\Types\Regions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShippingServicesIndexRequest extends FormRequest  {

  private string $error_message = 'Please specify one or more of the following properties: region, parcel_type and / or date.';

  public function rules(): array {
    return [
      'date' => [
        'date',
        Rule::requiredIf(fn() => !$this->get('region') && !$this->get('parcel_type')),
      ],

      'region' => [
        'string',
        Rule::enum(Regions::class),
        Rule::requiredIf(fn() => !$this->get('date') && !$this->get('parcel_type')),
      ],

      'parcel_type' => [
        'string',
        Rule::enum(ParcelTypes::class),
        Rule::requiredIf(fn() => !$this->get('date') && !$this->get('region')),
      ],
    ];
  }

  /**
   * @return array<string, string>
   */
  public function messages(): array {
    return [
      'date.required' => $this->error_message,
      'region.required' => $this->error_message,
      'parcel_type.required' => $this->error_message,
    ];
  }

  public function getDate(): Carbon | null {
    return $this->validated('date') ? Carbon::parse($this->validated('date')) : null;
  }

  public function getRegion(): string | null {
    return $this->validated('region');
  }

  public function getParcelType(): string | null {
    return $this->validated('parcel_type');
  }

}
