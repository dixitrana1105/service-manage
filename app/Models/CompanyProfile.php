<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CompanyProfile extends Model
{
    use HasFactory;
    protected $table = 'company_profiles'; // Specify the table name if it's different from the model name 

    protected $fillable = [
        'company_name',
        'company_logo',
        'company_tagline',
        'website_url',
        'industry_type',
        'company_description',
        'phone_number',
        'email_address',
        'fax_number',
        'office_address',
        'social_media_links',
    ];

    /**
     * Set the company logo path in the database.
     * Automatically handle storage path for the company logo.
     */
    public function setCompanyLogoAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['company_logo'] = $value; // Already a string (path)
        } else {
            // If file is being uploaded, store it in 'public/company_logos'
            $this->attributes['company_logo'] = $value ? $value->store('new_company_logos', 'public') : null;
        }
    }

    /**
     * Get the full URL of the company logo.
     * This assumes that the logo is stored in the public folder and is publicly accessible.
     */
    public function getCompanyLogoUrlAttribute()
    {
        return $this->company_logo ? Storage::url($this->company_logo) : null;
    }
}
