<?php

declare(strict_types=1);

namespace Francken\Treasurer;

use Francken\Association\LegacyMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Francken\Treasurer\DeductionEmailToMember
 *
 * @property int $id
 * @property int $member_id
 * @property int $deduction_email_id
 * @property string $description
 * @property int $amount_in_cents
 * @property int $contained_errors
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Francken\Treasurer\DeductionEmail $deduction
 * @property-read mixed $amount
 * @property-read \Francken\Association\LegacyMember $member
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember whereAmountInCents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember whereContainedErrors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember whereDeductionEmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Francken\Treasurer\DeductionEmailToMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class DeductionEmailToMember extends Model
{
    protected $table = 'treasurer_deduction_email_to_members';
    protected $fillable = [
        'member_id',
        'description',
        'amount_in_cents',
        'contained_errors',
    ];

    public function getAmountAttribute()
    {
        return $this->amount_in_cents / 100;
    }
    public function member() : BelongsTo
    {
        return $this->belongsTo(LegacyMember::class, 'member_id');
    }

    public function deduction() : BelongsTo
    {
        return $this->belongsTo(DeductionEmail::class, 'deduction_email_id');
    }
}
