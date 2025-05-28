<?php
if (! function_exists('sortable_link')) {
    function sortable_link($column, $label) {
        $sort = request('sort');
        $direction = request('direction', 'asc');
        $newDirection = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';

        $url = request()->fullUrlWithQuery(['sort' => $column, 'direction' => $newDirection]);

        $icon = '';
        if ($sort === $column) {
            $icon = $direction === 'asc' ? '↑' : '↓';
        }

        return '<a href="' . $url . '">' . $label . ' ' . $icon . '</a>';
    }
}
?>