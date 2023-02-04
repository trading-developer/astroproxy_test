<?php

namespace App\Http\Resources\Payment;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Payment
 */
class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'comment' => $this->comment,
            'status' => $this->getStatusName(),
            'total' => $this->total,
            'is_autopay' => $this->is_autopay,
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->diffForHumans() : '-',
        ];
    }
}
