<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Last production costs',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\BillMaterial',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'total',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'name'  => '',
                'total' => '',
            ],
            'translation_key' => 'billMaterial',
        ];

        $settings1['data'] = [];
        if (class_exists($settings1['model'])) {
            $settings1['data'] = $settings1['model']::latest()
                ->take($settings1['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings1)) {
            $settings1['fields'] = [];
        }

        $settings2 = [
            'chart_title'        => 'Production usage',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Models\Task',
            'group_by_field'     => 'name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '30',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'translation_key'    => 'task',
        ];

        $chart2 = new LaravelChart($settings2);

        return view('home', compact('chart2', 'settings1'));
    }
}
