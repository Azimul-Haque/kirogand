<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificates';

    /**
     * The attributes that are mass assignable.
     * The 'data_payload' stores all unique certificate data as JSON.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'local_office_id',
        'certificate_type'
        'recipient_user_id',
        'status',
        'unique_serial',
        'data_payload',
        'issued_at',
    ];

    /**
     * The attributes that should be cast.
     * Casting 'data_payload' to 'array' is the most important part of this setup.
     * This makes JSON data usable as a standard PHP array/object in the controller and views.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_payload' => 'array',
        'issued_at' => 'datetime',
    ];

    /**
     * Define the relationship to the Recipient (User) model.
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }
    public function localOffice()
    {
        return $this->belongsTo(LocalOffice::class);
    }

    /**
     * Accessor to get the full verification URL for the QR code.
     * @return string
     */
    public function getVerificationUrlAttribute(): string
    {
        // Change 'verify' to your actual verification route
        return url("/verify/{$this->unique_serial}");
    }
}
