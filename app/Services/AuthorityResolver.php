<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

/**
 * AuthorityResolver
 * Takes an Authority Model instance (e.g., Union, Upazila) and traces its
 * hierarchy up to the highest level (e.g., Division), returning an array
 * of names keyed by the authority type (e.g., 'Union' => 'Name').
 *
 * NOTE: This requires all models (Union, Upazila, District, etc.) to have
 * a 'parent' relationship defined, linking to the next level up.
 */
class AuthorityResolver
{
    /**
     * @var Model The starting authority model instance (e.g., a specific Union object).
     */
    protected $startAuthority;

    /**
     * Constructor
     * @param Model $startAuthority
     */
    public function __construct(Model $startAuthority)
    {
        $this->startAuthority = $startAuthority;
    }

    /**
     * Resolves the full administrative hierarchy names.
     *
     * @return array An associative array of hierarchy names.
     */
    public function getHierarchyNamesByLevel(): array
    {
        $hierarchy = [];
        $currentAuthority = $this->startAuthority;

        // Loop upwards through the hierarchy until 'parent' is null (top level)
        while ($currentAuthority) {
            // 1. Get the class short name (e.g., 'Union', 'Upazila')
            $fullClassName = get_class($currentAuthority);
            
            // In Laravel 7, ReflectionClass is the simplest way to get the short name
            $reflection = new ReflectionClass($fullClassName);
            $type = $reflection->getShortName();

            // 2. Store the authority's name with its type as the key
            $hierarchy[$type] = $currentAuthority->name;

            // 3. Move to the next level up using the 'parent' relationship
            // The relationship method must be named 'parent' on the models
            $currentAuthority = $currentAuthority->parent;
        }

        // Reverse the array so the highest level (e.g., Division) comes first.
        return array_reverse($hierarchy);
    }
}
