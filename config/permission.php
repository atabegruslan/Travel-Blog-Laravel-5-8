<?php

return [

    'features' => [
        'log' => [
            'log.read',
            'log.create',
            'log.update',
            'log.delete',
        ],
        'places' => [
            'destination' => [
                'destination.read',
                'destination.create',
                'destination.update',
                'destination.delete',
            ],
            'region' => [
                'region.read',
                'region.create',
                'region.update',
                'region.delete',
            ],
        ],
    ]
];
