<?php

return [

    'roles'           => [
        [
            'id'          => 1,
            'name'        => 'админ',
            'title'       => 'Администратор',
        ],
        [
            'id'          => 2,
            'name'        => 'user',
            'title'       => 'Пользователь',
        ],
        [
            'id'          => 3,
            'name'        => 'asc',
            'title'       => 'АСЦ',
        ],
    ],
    'permissions'     => [
        ["id" => "1", "title" => "Админка - Роли", "name" => "admin.roles", "description" => "Админка - Роли"],
        ["id" => "2", "title" => "Админка - Разрешения", "name" => "admin.permissions", "description" => "Админка - Разрешения"],
        //
        ["id" => "3", "title" => "Скачать", "name" => "download", "description" => "Скачать"],
        //
        ["id" => "4", "title" => "В корзину", "name" => "buy", "description" => "В корзину"],
        ["id" => "5", "title" => "Отчеты по ремонту", "name" => "repairs", "description" => "Отчеты по ремонту"],
        ["id" => "6", "title" => "Заказы", "name" => "orders", "description" => "Заказы"],
        ["id" => "7", "title" => "Инженеры", "name" => "engineers", "description" => "Инженеры"],
        ["id" => "8", "title" => "Торговые организации", "name" => "trades", "description" => "Торговые организации"],
        ["id" => "9", "title" => "Ввод в эксплуатацию", "name" => "launches", "description" => "Ввод в эксплуатацию"],
        ["id" => "10", "title" => "Акты", "name" => "acts", "description" => "Акты"],
        ["id" => "11", "title" => "Стоимость дороги и работ", "name" => "costs", "description" => "Стоимость дороги и работ"],
        ["id" => "12", "title" => "Файлы", "name" => "files", "description" => "Файлы"],
    ],
    'permission_role' => [
        ["permission_id" => "1", "role_id" => "1"],
        ["permission_id" => "2", "role_id" => "1"],
        //
        ["permission_id" => "3", "role_id" => "2"],
        //
        ["permission_id" => "4", "role_id" => "3"],
        ["permission_id" => "5", "role_id" => "3"],
        ["permission_id" => "6", "role_id" => "3"],
        ["permission_id" => "7", "role_id" => "3"],
        ["permission_id" => "8", "role_id" => "3"],
        ["permission_id" => "9", "role_id" => "3"],
        ["permission_id" => "10", "role_id" => "3"],
        ["permission_id" => "11", "role_id" => "3"],
        ["permission_id" => "12", "role_id" => "3"],

    ],

];