<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 12.9.18
 * Time: 14:10
 */

namespace App\Services;


class FilterService
{
    public function sortable($label, $sort_by, $default = false)
    {
        $sorted_by = request()->query('sort_by', $default ? $sort_by : null);
        $sorted_order = request()->query('sort_order', 'asc');

        $action = substr(request()->route()->getActionName(), 21);

        return (
            '<a href="' . action($action, url_params(['sort_by' => $sort_by, 'sort_order' => $sorted_order == 'asc' ? 'desc' : 'asc'])) . '">' .
            ($sorted_by == $sort_by ? ('<i class="fa fa-sort-amount-' . $sorted_order . '" aria-hidden="true"></i>&nbsp;'): null) . $label .
            '</a>'
        );
    }

    public function sortableLink($label, $sort_by, $action, $params)
    {
        $params['sort_by'] = $sort_by;
        return '<a href="' . action($action, $params) . '">' . $label . '</a>';
    }

    public function filterable($label, $filter_by, $options)
    {
        $dropId = 'dropdownFilter' . str_replace(' ', '', ucwords(str_replace('_', ' ', $filter_by)));

        $action = substr(request()->route()->getActionName(), 21);
        $selected = request()->query($filter_by);

        $reseted_params = url_params();
        unset($reseted_params[$filter_by]);

        $renderedOptions = '';
        foreach ($options as $key => $value) {
            $renderedOptions .=
                '<li>' .
                '<a href = "' . action($action, url_params([$filter_by => $key])) . '" >' . $value . '</a >' .
                '</li >';
        }

        return (
            '<span>' . $label . '</span>' .
            '<div class="form-filter">' .
            '<div class="dropdown">' .
            '<button class="btn btn-white btn-sort dropdown-toggle" type="button" id="' . $dropId . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >' .
            ($selected !== null ? $options[$selected] : __("general.all")) .
            '<i class="material-icons">expand_more</i>' .
            '</button>' .
            '<ul class="dropdown-menu" aria-labelledby = "' . $dropId . '" >' .
            '<li>' .
            '<a href = "' . action($action, $reseted_params) . '" >Všechny</a >' .
            '</li >' .
            $renderedOptions .
            '</ul>' .
            '</div>' .
            '</div>'
        );
    }

    public function sortableFilterable($label, $sortfilter_by, $options, $default = false)
    {
        $dropId = 'dropdownFilter' . str_replace(' ', '', ucwords(str_replace('_', ' ', $sortfilter_by)));

        $action = substr(request()->route()->getActionName(), 21);
        $selected = request()->query($sortfilter_by);

        $reseted_params = url_params();
        unset($reseted_params[$sortfilter_by]);

        $renderedOptions = '';
        foreach ($options as $key => $value) {
            $renderedOptions .=
                '<li>' .
                '<a href = "' . action($action, url_params([$sortfilter_by => $key])) . '" >' . $value . '</a >' .
                '</li >';
        }


        $sorted_by = request()->query('sort_by', $default ? $sortfilter_by : null);
        $sorted_order = request()->query('sort_order', 'asc');

        $action = substr(request()->route()->getActionName(), 21);

        return (
            '<a href="' . action($action, url_params(['sort_by' => $sortfilter_by, 'sort_order' => $sorted_order == 'asc' ? 'desc' : 'asc'])) . '">' .
            $label .
            (
            $sorted_by == $sortfilter_by
                ?
                (
                $sorted_order == 'asc' ?
                    '<i style="transform:rotateX(180deg)" class="material-icons">sort</i>'
                    :
                    '<i class="material-icons">sort</i>'
                )
                : null
            ) .
            '</a>' .
            '<div class="form-filter">' .
            '<div class="dropdown">' .
            '<button class="btn btn-white btn-sort dropdown-toggle" type="button" id="' . $dropId . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >' .
            ($selected !== null ? $options[$selected] : 'Vsetky') .
            '<i class="material-icons">expand_more</i>' .
            '</button>' .
            '<ul class="dropdown-menu" aria-labelledby = "' . $dropId . '" >' .
            '<li>' .
            '<a href = "' . action($action, $reseted_params) . '" >Vsetky</a >' .
            '</li >' .
            $renderedOptions .
            '</ul>' .
            '</div>' .
            '</div>'
        );
    }

    public function searchable($search_by)
    {
        $searched_token = request()->query($search_by);

        $params = '';
        foreach (request()->query() as $key => $value) {
            if ($key != $search_by)
                $params .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
        }

        $action = substr(request()->route()->getActionName(), 21);
        return (
            '<form action="' . action($action, request()->route()->parameters()) . '"class="form-filter">' .
            $params .
            '<input class="form-control" name="' . $search_by . '" value="' . $searched_token . '">' .
            '<button type = "submit" class="filter-submit">' .
            '<i class="material-icons">search</i>' .
            '</button>' .
            '</form>'
        );
    }
}