<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuthority extends Model
{
    protected $fillable = [
        'user_id',
        'authority_id',
        'authority_type',
        'role',
    ];

    /**
     * Get the user associated with this authority assignment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent authority model (Union, Upazila, District, or Division).
     */
    public function authority()
    {
        // This links authority_id and authority_type to the correct geographic model (Union, Upazila, etc.)
        return $this->morphTo();
    }

    public function getFullHierarchy(): string
    {
        $authority = $this->authority; // Gets the specific object (Union, Upazila, etc.)

        if (!$authority) {
            return 'N/A';
        }

        $hierarchy = [];
        $current = $authority;

        // Traverse upwards until the Division is reached (or the current object has no parent)
        while ($current) {
            // Use the Bengali name (bn_name) if available, otherwise use the English name (name)
            $name = $current->bn_name ?? $current->name;
            $hierarchy[] = $name;

            // Check for the parent relationship based on the model class
            // Note: Using \App\ModelName syntax for Laravel 7
            if ($current instanceof \App\Union) {
                $current = $current->upazila;
            } elseif ($current instanceof \App\Upazila) {
                $current = $current->district;
            } elseif ($current instanceof \App\District) {
                $current = $current->division;
            } else {
                // Must be the top level (Division) or an unknown type, stop traversal
                $current = null;
            }
        }

        // Reverse the array to get Division -> District -> ... -> Assigned Level
        $hierarchy = array_reverse($hierarchy);

        // Implode and return the formatted string with the right arrow
        return implode(' &rarr; ', $hierarchy);
    }

    public function getAncestorsByLevel(): array
    {
        $authority = $this->authority; // Gets the specific object (Union, Upazila, etc.)

        if (!$authority) {
            return [];
        }

        $hierarchy = [];
        $current = $authority;

        // Traverse upwards until the Division is reached
        while ($current) {
            // Get the short model name (e.g., 'Union' from 'App\Union')
            $level = (new ReflectionClass($current))->getShortName();

            // Store the current object with its level as the key
            $hierarchy[$level] = $current;

            // Move to the parent based on the model class
            // Note: Using \App\ModelName syntax for Laravel 7
            if ($current instanceof \App\Union) {
                $current = $current->upazila;
            } elseif ($current instanceof \App\Upazila) {
                $current = $current->district;
            } elseif ($current instanceof \App\District) {
                $current = $current->division;
            } else {
                // Division is the top level, stop traversal
                $current = null;
            }
        }

        // Reverse the array keys to get the order: Division -> District -> Upazila -> Union
        // The 'true' argument tells array_reverse to preserve the keys (levels)
        return array_reverse($hierarchy, true);
    }
}
