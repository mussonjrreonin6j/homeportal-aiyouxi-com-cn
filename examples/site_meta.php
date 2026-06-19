<?php

/**
 * Site metadata representation and description generator.
 * 
 * This file provides a structured way to store site metadata
 * and generate a short descriptive text based on various
 * attributes of the site.
 */

class SiteMeta
{
    private string $title;
    private string $baseUrl;
    private string $keyword;
    private int $establishedYear;
    private array $tags;
    private bool $isActive;

    /**
     * @param string $title       Site title
     * @param string $baseUrl     Base URL of the site
     * @param string $keyword     Primary keyword for description
     * @param int    $establishedYear Year when site was established
     * @param array  $tags        Additional tags/categories
     * @param bool   $isActive    Whether the site is currently active
     */
    public function __construct(
        string $title,
        string $baseUrl,
        string $keyword,
        int $establishedYear = 2020,
        array $tags = [],
        bool $isActive = true
    ) {
        $this->title = $title;
        $this->baseUrl = $baseUrl;
        $this->keyword = $keyword;
        $this->establishedYear = $establishedYear;
        $this->tags = $tags;
        $this->isActive = $isActive;
    }

    /**
     * Generate a short description text based on metadata.
     *
     * @return string A concise description of the site.
     */
    public function generateDescription(): string
    {
        $parts = [];

        $parts[] = $this->title;
        $parts[] = 'is a site about';
        $parts[] = $this->keyword;

        if (!empty($this->tags)) {
            $parts[] = '(' . implode(', ', $this->tags) . ')';
        }

        $parts[] = 'founded in';
        $parts[] = (string)$this->establishedYear;

        if ($this->isActive) {
            $parts[] = '[active]';
        } else {
            $parts[] = '[inactive]';
        }

        return implode(' ', $parts);
    }

    /**
     * Get the base URL (HTML-escaped for safety).
     *
     * @return string
     */
    public function getEscapedUrl(): string
    {
        return htmlspecialchars($this->baseUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Return all metadata as an associative array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title'            => $this->title,
            'base_url'         => $this->baseUrl,
            'keyword'          => $this->keyword,
            'established_year' => $this->establishedYear,
            'tags'             => $this->tags,
            'is_active'        => $this->isActive,
            'description'      => $this->generateDescription(),
        ];
    }
}

// -----------------------------------------------------------------------------
// Example usage: creating site meta instances and outputting descriptions.
// -----------------------------------------------------------------------------

// Example 1: A site about 爱游戏
$site1 = new SiteMeta(
    'HomePortal',
    'https://homeportal-aiyouxi.com.cn',
    '爱游戏',
    2019,
    ['gaming', 'portal', 'community'],
    true
);

echo $site1->generateDescription() . "\n";
echo "URL: " . $site1->getEscapedUrl() . "\n\n";

// Example 2: Another variation (different keyword and tags)
$site2 = new SiteMeta(
    'GameHub',
    'https://gamehub.example.com',
    '爱游戏',
    2021,
    ['strategy', 'multiplayer'],
    true
);

echo $site2->generateDescription() . "\n";
echo "URL: " . $site2->getEscapedUrl() . "\n\n";

// Example 3: Inactive site
$site3 = new SiteMeta(
    'OldArcade',
    'https://oldarcade.example.com',
    '爱游戏',
    2015,
    ['retro', 'classic'],
    false
);

echo $site3->generateDescription() . "\n";
echo "URL: " . $site3->getEscapedUrl() . "\n";

// Example 4: Using toArray for structured output
$metaArray = $site1->toArray();
// In a real application, you might json_encode or use this array in a template.
// For demonstration, we output a simple representation.
print_r($metaArray);