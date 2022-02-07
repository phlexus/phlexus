<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Translations\Database\Models;

use Phalcon\Mvc\Model;

/**
 * Class Translation
 *
 * @package Phlexus\Libraries\Translations\Database\Models
 */
class Translation extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    public $id;

    public $key;

    public $translation;

    public $textTypeId;

    public $languageId;

    public $pageId;

    public $active;

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->setSource('translation');

        $this->hasOne('textTypeId', TextType::class, 'id', [
            'alias'    => 'TextType',
            'reusable' => true,
        ]);

        $this->hasOne('languageId', Language::class, 'id', [
            'alias'    => 'Language',
            'reusable' => true,
        ]);

        $this->hasOne('pageId', Page::class, 'id', [
            'alias'    => 'Page',
            'reusable' => true,
        ]);
    }

    
    /**
     * Get translation by Page and Type
     * 
     * @param string $page     Page to translate
     * @param string $type     Type to translate
     * @param string $Language Language to use
     * 
     * @return array
     */
    public static function getTranslationsType(string $page, string $type, string $language): array
    {
        $translations = self::query()
            ->join('TextType', '\Phlexus\Libraries\Translations\Database\Models\Translation.textTypeId = TextType.id')
            ->join('Page', '\Phlexus\Libraries\Translations\Database\Models\Translation.pageId = Page.id')
            ->join('Language', ' \Phlexus\Libraries\Translations\Database\Models\Translation.languageId = Language.id')
            ->where('TextType.type = :textType: AND Page.name = :pageName: AND Language.language = :language:', [
                'textType' => $type,
                'pageName' => $page,
                'language' => $language
            ])
            ->execute();

        var_dump($translations);
        exit();
    }
}
