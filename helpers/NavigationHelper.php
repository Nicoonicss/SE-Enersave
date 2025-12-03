<?php

class NavigationHelper
{
    public static function getNavItems(string $role): array
    {
        return match($role) {
            'COMMUNITY_USER' => [
                ['label' => 'Home', 'url' => '/home'],
                ['label' => 'Marketplace', 'url' => '/marketplace'],
                ['label' => 'Projects', 'url' => '/projects'],
                ['label' => 'Learn', 'url' => '/learn'],
                ['label' => 'Community', 'url' => '/community'],
            ],
            'SUPPLIER_INSTALLER' => [
                ['label' => 'Dashboard', 'url' => '/dashboard'],
                ['label' => 'Marketplace', 'url' => '/marketplace'],
                ['label' => 'Projects', 'url' => '/projects'],
                ['label' => 'Forum', 'url' => '/forum'],
                ['label' => 'Settings', 'url' => '/settings'],
            ],
            'EDUCATOR_ADVOCATE' => [
                ['label' => 'Home', 'url' => '/home'],
                ['label' => 'Learn', 'url' => '/learn'],
                ['label' => 'Forum', 'url' => '/forum'],
            ],
            'DONOR_NGO' => [
                ['label' => 'Home', 'url' => '/home'],
                ['label' => 'Projects', 'url' => '/projects'],
                ['label' => 'Community', 'url' => '/community'],
            ],
            'ADMIN' => [
                ['label' => 'Dashboard', 'url' => '/dashboard'],
                ['label' => 'Users', 'url' => '/users'],
                ['label' => 'Suppliers', 'url' => '/suppliers'],
                ['label' => 'Projects', 'url' => '/projects'],
                ['label' => 'Reports', 'url' => '/reports'],
            ],
            default => [
                ['label' => 'Home', 'url' => '/home'],
            ],
        };
    }
    
    public static function renderNavigation(string $role, string $currentPath = ''): string
    {
        $items = self::getNavItems($role);
        $html = '<nav class="nav">';
        
        foreach ($items as $item) {
            $active = ($currentPath === $item['url']) ? ' class="active"' : '';
            $html .= '<a' . $active . ' href="' . htmlspecialchars($item['url']) . '">' . htmlspecialchars($item['label']) . '</a>';
        }
        
        $html .= '<a href="/logout">Logout</a>';
        $html .= '</nav>';
        
        return $html;
    }
}

