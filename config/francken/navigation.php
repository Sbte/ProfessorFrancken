<?php

declare(strict_types=1);

return [
    'menu' => [
        [
            'url' => '/study',
            'title' => 'Study',
            'subItems' => [
                ['url' => "/study/books", 'title' => 'Books', 'description' => 'Buy or sell second hand books', 'icon' => 'fas fa-book'],
                ['url' => "/study/research-groups", 'title' => 'Research Groups', 'description' => 'Find a research group for your bachelor or master thesis', 'icon' => 'fas fa-flask'],
                ['url' => "/study/representation/university-council", 'title' => 'University Council', 'description' => 'Read about the parties that represent students among the university', 'icon' => 'fas fa-user-tie'],
                ['url' => "/study/representation/faculty-council", 'title' => 'Faculty Council', 'description' => 'See who is representing students from the FSE', 'icon' => 'fas fa-person-booth'],
            ],
            'icon' => 'graduation-cap',
        ],
        [
            'url' => '/association',
            'title' => 'Association',
            'subItems' => [
                ['url' => "/association/news", 'title' => 'News', 'description' => 'The latest news from the association', 'icon' => 'fas fa-newspaper'],
                ['url' => "/association/history", 'title' => 'History', 'description' => 'Curious about the history of our association, read it here', 'icon' => 'far fa-clock'],
                ['url' => "/association/honorary-members", 'title' => 'Honorary members', 'description' => 'Francken knows two honnorary members: Francken and De Hosson', 'icon' => 'fas fa-award'],
                ['url' => "/association/boards", 'title' => 'Boards', 'description' => 'Current and previous board members', 'icon' => 'fas fa-user-tie'],
                ['url' => "/association/committees", 'title' => 'Committees', 'description' => 'Want to join a committee?', 'icon' => 'fas fa-users'],
                ['url' => "/association/francken-vrij", 'title' => 'Francken Vrij', 'description' => 'Our popular science magazine', 'icon' => 'fab fa-readme']
            ],
            //    'icon' => 'beer',
            'icon' => 'coffee',
        ],
        [
            'url' => '/career',
            'title' => 'Career',
            'subItems' => [
                // Job prospects
                ['url' => "/career/job-openings", 'title' => 'Job openings', 'icon' => 'fas fa-search-dollar', 'description' => 'Curious about your job opportunities, check these job openings!'],
                ['url' => "/career/companies", 'title' => 'Company profiles', 'icon' => 'fas fa-building', 'description' => ''],
                ['url' => "/career/events", 'title' => 'Career events', 'icon' => 'fas fa-calendar-check', 'description' => '']
            ],
            'icon' => 'suitcase',
        ],
        [
            'url' => '/association/photos',
            'title' => 'Photos',
            'subItems' => [],
            'icon' => 'camera',
        ],
    ],

    'admin-menu' => [
        [
            "name" => "Association",
            "url" => "association",
            "items" => [
                [
                    "name" => "News",
                    "url" => "news",
                    "works" => true,
                ],
                [
                    "name" => "Activities",
                    "url" => "activities",
                    "works" => false,
                ],
                [
                    "name" => "Open registrations",
                    "url" => "registration-requests",
                    "works" => true,
                ],
                [
                    "name" => "Members",
                    "url" => "members",
                    "works" => false,
                ],
                [
                    "name" => "Committees",
                    "url" => "committees",
                    "works" => false,
                ],
                [
                    "name" => "Francken Vrij",
                    "url" => "francken-vrij",
                    "works" => true,
                ],
            ]
        ],
        [
            "name" => "Study",
            "url" => "study",
            "items" => [
                [
                    "name" => "Research Groups",
                    "url" => "research-groups",
                    "works" => false,
                ],
                [
                    "name" => "Books",
                    "url" => "books",
                    "works" => false,
                ],
            ]
        ], [
            "name" => "Extern",
            "url" => "extern",
            "items" => [
                [
                    "name" => "Companies",
                    "url" => "companies",
                    "works" => false,
                ],
                [
                    "name" => "Events",
                    "url" => "events",
                    "works" => false,
                ],
                [
                    "name" => "Jop openings",
                    "url" => "jop-openings",
                    "works" => false,
                ],
                [
                    "name" => "Factsheet",
                    "url" => "fact-sheet",
                    "works" => true,
                ]
            ]
        ], [
            "name" => "Committees",
            "url" => "committees",
            "items" => [
                [
                    "name" => "Adtcie",
                    "url" => "adtcie",
                    "works" => false,
                ],
                [
                    "name" => "Borrelcie",
                    "url" => "borrelcie",
                    "works" => false,
                ],
                [
                    "name" => "Francken Vrij",
                    "url" => "francken-vrij",
                    "works" => false,
                ],
                [
                    "name" => "Brouwcie",
                    "url" => "brouwcie",
                    "works" => false,
                ],
                [
                    "name" => "Fotocie",
                    "url" => "fotocie",
                    "works" => false,
                ],
            ]
        ]
    ]
];
