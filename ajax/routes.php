<?
return [
    /*
    'note_load_aside_page' => [
        'path' => '/note/load-aside-page/{section_id}/{page_num}/',
        'handler' => \Local\Core\Ajax\Handler\Note::class.'::loadPage',
        'methods' => ['POST'],
        'args' => [
            'section_id' => '([0-9]+)',
            'page_num' => '([0-9]+)'
        ]
    ],
    */

    /**
     * @see \Local\Core\Ajax\Handler\Consult::shortForm()
     */
    'consult_short_form' => [
        'path' => '/consult/short-form/',
        'handler' => \Local\Core\Ajax\Handler\Consult::class.'::shortForm',
        'methods' => ['POST']
    ],

    /**
     * @see \Local\Core\Ajax\Handler\Consult::createAnswer()
     */
    'consult_form_send_ask' => [
        'path' => '/consult/form-send-ask/',
        'handler' => \Local\Core\Ajax\Handler\Consult::class.'::createAnswer',
        'methods' => ['POST']
    ],

    /**
     * @see \Local\Core\Ajax\Handler\Consult::freeConsult()
     */
    'consult_free_consult' => [
        'path' => '/consult/free-consult/',
        'handler' => \Local\Core\Ajax\Handler\Consult::class.'::freeConsult',
        'methods' => ['POST']
    ],


    /**
     * @see \Local\Core\Ajax\Handler\Services::createReview()
     */
    'services_form_review' => [
        'path' => '/services/form-review/',
        'handler' => \Local\Core\Ajax\Handler\Services::class.'::createReview',
        'methods' => ['POST']
    ],
];