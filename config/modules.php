<?php

/**
 * Konfigurasi Modul IT Support System.
 *
 * Setiap modul didefinisikan di sini dengan nama, deskripsi,
 * ikon, route, permission yang dibutuhkan, dan warna kartu di dashboard.
 */
return [
    'ticketing' => [
        'name' => 'Ticketing System',
        'description' => 'Kelola tiket support IT — buat, track, dan selesaikan tiket.',
        'icon' => 'fas fa-ticket-alt',
        'route' => 'ticketing.index',
        'permission' => 'module.ticketing',
        'color' => '#4F46E5',
    ],

    'monitoring' => [
        'name' => 'Monitoring Jaringan',
        'description' => 'Pantau status jaringan, perangkat, dan terima alert real-time.',
        'icon' => 'fas fa-network-wired',
        'route' => 'monitoring.dashboard',
        'permission' => 'module.monitoring',
        'color' => '#059669',
    ],

    'asset' => [
        'name' => 'Management Asset IT',
        'description' => 'Kelola inventaris aset IT — laptop, printer, server, dll.',
        'icon' => 'fas fa-laptop',
        'route' => 'asset.index',
        'permission' => 'module.asset',
        'color' => '#D97706',
    ],

    'userguide' => [
        'name' => 'User Guide',
        'description' => 'Panduan penggunaan sistem dan knowledge base untuk user.',
        'icon' => 'fas fa-book-open',
        'route' => 'userguide.index',
        'permission' => 'module.userguide',
        'color' => '#DC2626',
    ],
];
