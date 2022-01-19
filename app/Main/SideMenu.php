<?php

namespace App\Main;

class SideMenu {
	public static function menu() {
		return [
			'dashboard' => [
				'icon' => 'home',
				'title' => 'Dashboard',
				'route_name' => 'admin.dashboard',
				'params' => [
					'layout' => 'side-menu',
				]
			],
			'invoice' => [
				'icon' => 'file-text',
				'title' => 'Invoices',
				'route_name' => 'admin.invoice.index',
				'params' => [
					'layout' => 'side-menu',
				]
			],
			'tasks' => [
				'icon' => 'coffee',
				'title' => 'Tasks',
				'route_name' => 'admin.task.index',
				'params' => [
					'layout' => 'side-menu',
				]
			],
			'project' => [
				'icon' => 'command',
				'title' => 'Projects',
				'route_name' => 'admin.project.index',
				'params' => [
					'layout' => 'side-menu',
				]
			],
			'customer' => [
				'icon' => 'book-open',
				'title' => 'Customers',
				'route_name' => 'admin.customer.index',
				'params' => [
					'layout' => 'side-menu',
				]
			],
            'company' => [
                'icon' => 'flag',
                'title' => 'Companies',
                'route_name' => 'admin.company.index',
                'params' => [
                    'layout' => 'side-menu',
                ]
            ],
		];
	}
}
