<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'basic_c_r_m_access',
            ],
            [
                'id'    => 18,
                'title' => 'crm_status_create',
            ],
            [
                'id'    => 19,
                'title' => 'crm_status_edit',
            ],
            [
                'id'    => 20,
                'title' => 'crm_status_show',
            ],
            [
                'id'    => 21,
                'title' => 'crm_status_delete',
            ],
            [
                'id'    => 22,
                'title' => 'crm_status_access',
            ],
            [
                'id'    => 23,
                'title' => 'crm_customer_create',
            ],
            [
                'id'    => 24,
                'title' => 'crm_customer_edit',
            ],
            [
                'id'    => 25,
                'title' => 'crm_customer_show',
            ],
            [
                'id'    => 26,
                'title' => 'crm_customer_delete',
            ],
            [
                'id'    => 27,
                'title' => 'crm_customer_access',
            ],
            [
                'id'    => 28,
                'title' => 'crm_note_create',
            ],
            [
                'id'    => 29,
                'title' => 'crm_note_edit',
            ],
            [
                'id'    => 30,
                'title' => 'crm_note_show',
            ],
            [
                'id'    => 31,
                'title' => 'crm_note_delete',
            ],
            [
                'id'    => 32,
                'title' => 'crm_note_access',
            ],
            [
                'id'    => 33,
                'title' => 'crm_document_create',
            ],
            [
                'id'    => 34,
                'title' => 'crm_document_edit',
            ],
            [
                'id'    => 35,
                'title' => 'crm_document_show',
            ],
            [
                'id'    => 36,
                'title' => 'crm_document_delete',
            ],
            [
                'id'    => 37,
                'title' => 'crm_document_access',
            ],
            [
                'id'    => 38,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 39,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 40,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 41,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 42,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 43,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 44,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 45,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 46,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 47,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 48,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 49,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 50,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 51,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 52,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 53,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 54,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 55,
                'title' => 'task_create',
            ],
            [
                'id'    => 56,
                'title' => 'task_edit',
            ],
            [
                'id'    => 57,
                'title' => 'task_show',
            ],
            [
                'id'    => 58,
                'title' => 'task_delete',
            ],
            [
                'id'    => 59,
                'title' => 'task_access',
            ],
            [
                'id'    => 60,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 61,
                'title' => 'team_create',
            ],
            [
                'id'    => 62,
                'title' => 'team_edit',
            ],
            [
                'id'    => 63,
                'title' => 'team_show',
            ],
            [
                'id'    => 64,
                'title' => 'team_delete',
            ],
            [
                'id'    => 65,
                'title' => 'team_access',
            ],
            [
                'id'    => 66,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 67,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 68,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 69,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 70,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 71,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 72,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 73,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 74,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 75,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 76,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 77,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 78,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 79,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 80,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 81,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 82,
                'title' => 'asset_create',
            ],
            [
                'id'    => 83,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 84,
                'title' => 'asset_show',
            ],
            [
                'id'    => 85,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 86,
                'title' => 'asset_access',
            ],
            [
                'id'    => 87,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 88,
                'title' => 'time_management_access',
            ],
            [
                'id'    => 89,
                'title' => 'time_work_type_create',
            ],
            [
                'id'    => 90,
                'title' => 'time_work_type_edit',
            ],
            [
                'id'    => 91,
                'title' => 'time_work_type_show',
            ],
            [
                'id'    => 92,
                'title' => 'time_work_type_delete',
            ],
            [
                'id'    => 93,
                'title' => 'time_work_type_access',
            ],
            [
                'id'    => 94,
                'title' => 'time_project_create',
            ],
            [
                'id'    => 95,
                'title' => 'time_project_edit',
            ],
            [
                'id'    => 96,
                'title' => 'time_project_show',
            ],
            [
                'id'    => 97,
                'title' => 'time_project_delete',
            ],
            [
                'id'    => 98,
                'title' => 'time_project_access',
            ],
            [
                'id'    => 99,
                'title' => 'time_entry_create',
            ],
            [
                'id'    => 100,
                'title' => 'time_entry_edit',
            ],
            [
                'id'    => 101,
                'title' => 'time_entry_show',
            ],
            [
                'id'    => 102,
                'title' => 'time_entry_delete',
            ],
            [
                'id'    => 103,
                'title' => 'time_entry_access',
            ],
            [
                'id'    => 104,
                'title' => 'time_report_create',
            ],
            [
                'id'    => 105,
                'title' => 'time_report_edit',
            ],
            [
                'id'    => 106,
                'title' => 'time_report_show',
            ],
            [
                'id'    => 107,
                'title' => 'time_report_delete',
            ],
            [
                'id'    => 108,
                'title' => 'time_report_access',
            ],
            [
                'id'    => 109,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 110,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 111,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 112,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 113,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 114,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 115,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 116,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 117,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 118,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 119,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 120,
                'title' => 'warehouse_access',
            ],
            [
                'id'    => 121,
                'title' => 'product_access',
            ],
            [
                'id'    => 122,
                'title' => 'products_list_create',
            ],
            [
                'id'    => 123,
                'title' => 'products_list_edit',
            ],
            [
                'id'    => 124,
                'title' => 'products_list_show',
            ],
            [
                'id'    => 125,
                'title' => 'products_list_delete',
            ],
            [
                'id'    => 126,
                'title' => 'products_list_access',
            ],
            [
                'id'    => 127,
                'title' => 'warehouses_list_create',
            ],
            [
                'id'    => 128,
                'title' => 'warehouses_list_edit',
            ],
            [
                'id'    => 129,
                'title' => 'warehouses_list_show',
            ],
            [
                'id'    => 130,
                'title' => 'warehouses_list_delete',
            ],
            [
                'id'    => 131,
                'title' => 'warehouses_list_access',
            ],
            [
                'id'    => 132,
                'title' => 'receipt_note_create',
            ],
            [
                'id'    => 133,
                'title' => 'receipt_note_edit',
            ],
            [
                'id'    => 134,
                'title' => 'receipt_note_show',
            ],
            [
                'id'    => 135,
                'title' => 'receipt_note_delete',
            ],
            [
                'id'    => 136,
                'title' => 'receipt_note_access',
            ],
            [
                'id'    => 137,
                'title' => 'delivery_note_create',
            ],
            [
                'id'    => 138,
                'title' => 'delivery_note_edit',
            ],
            [
                'id'    => 139,
                'title' => 'delivery_note_show',
            ],
            [
                'id'    => 140,
                'title' => 'delivery_note_delete',
            ],
            [
                'id'    => 141,
                'title' => 'delivery_note_access',
            ],
            [
                'id'    => 142,
                'title' => 'warehouse_transfer_create',
            ],
            [
                'id'    => 143,
                'title' => 'warehouse_transfer_edit',
            ],
            [
                'id'    => 144,
                'title' => 'warehouse_transfer_show',
            ],
            [
                'id'    => 145,
                'title' => 'warehouse_transfer_delete',
            ],
            [
                'id'    => 146,
                'title' => 'warehouse_transfer_access',
            ],
            [
                'id'    => 147,
                'title' => 'packing_list_create',
            ],
            [
                'id'    => 148,
                'title' => 'packing_list_edit',
            ],
            [
                'id'    => 149,
                'title' => 'packing_list_show',
            ],
            [
                'id'    => 150,
                'title' => 'packing_list_delete',
            ],
            [
                'id'    => 151,
                'title' => 'packing_list_access',
            ],
            [
                'id'    => 152,
                'title' => 'pdf_invoice_create',
            ],
            [
                'id'    => 153,
                'title' => 'pdf_invoice_edit',
            ],
            [
                'id'    => 154,
                'title' => 'pdf_invoice_show',
            ],
            [
                'id'    => 155,
                'title' => 'pdf_invoice_delete',
            ],
            [
                'id'    => 156,
                'title' => 'pdf_invoice_access',
            ],
            [
                'id'    => 157,
                'title' => 'lot_tracking_access',
            ],
            [
                'id'    => 158,
                'title' => 'processing_access',
            ],
            [
                'id'    => 159,
                'title' => 'note_of_recepit_inter_process_create',
            ],
            [
                'id'    => 160,
                'title' => 'note_of_recepit_inter_process_edit',
            ],
            [
                'id'    => 161,
                'title' => 'note_of_recepit_inter_process_show',
            ],
            [
                'id'    => 162,
                'title' => 'note_of_recepit_inter_process_delete',
            ],
            [
                'id'    => 163,
                'title' => 'note_of_recepit_inter_process_access',
            ],
            [
                'id'    => 164,
                'title' => 'half_product_create',
            ],
            [
                'id'    => 165,
                'title' => 'half_product_edit',
            ],
            [
                'id'    => 166,
                'title' => 'half_product_show',
            ],
            [
                'id'    => 167,
                'title' => 'half_product_delete',
            ],
            [
                'id'    => 168,
                'title' => 'half_product_access',
            ],
            [
                'id'    => 169,
                'title' => 'oldest_item_create',
            ],
            [
                'id'    => 170,
                'title' => 'oldest_item_edit',
            ],
            [
                'id'    => 171,
                'title' => 'oldest_item_show',
            ],
            [
                'id'    => 172,
                'title' => 'oldest_item_delete',
            ],
            [
                'id'    => 173,
                'title' => 'oldest_item_access',
            ],
            [
                'id'    => 174,
                'title' => 'product_balance_create',
            ],
            [
                'id'    => 175,
                'title' => 'product_balance_edit',
            ],
            [
                'id'    => 176,
                'title' => 'product_balance_show',
            ],
            [
                'id'    => 177,
                'title' => 'product_balance_delete',
            ],
            [
                'id'    => 178,
                'title' => 'product_balance_access',
            ],
            [
                'id'    => 179,
                'title' => 'bill_material_create',
            ],
            [
                'id'    => 180,
                'title' => 'bill_material_edit',
            ],
            [
                'id'    => 181,
                'title' => 'bill_material_show',
            ],
            [
                'id'    => 182,
                'title' => 'bill_material_delete',
            ],
            [
                'id'    => 183,
                'title' => 'bill_material_access',
            ],
            [
                'id'    => 184,
                'title' => 'half_product_make_create',
            ],
            [
                'id'    => 185,
                'title' => 'half_product_make_edit',
            ],
            [
                'id'    => 186,
                'title' => 'half_product_make_show',
            ],
            [
                'id'    => 187,
                'title' => 'half_product_make_delete',
            ],
            [
                'id'    => 188,
                'title' => 'half_product_make_access',
            ],
            [
                'id'    => 189,
                'title' => 'lot_create_create',
            ],
            [
                'id'    => 190,
                'title' => 'lot_create_edit',
            ],
            [
                'id'    => 191,
                'title' => 'lot_create_show',
            ],
            [
                'id'    => 192,
                'title' => 'lot_create_delete',
            ],
            [
                'id'    => 193,
                'title' => 'lot_create_access',
            ],
            [
                'id'    => 194,
                'title' => 'lot_track_create',
            ],
            [
                'id'    => 195,
                'title' => 'lot_track_edit',
            ],
            [
                'id'    => 196,
                'title' => 'lot_track_show',
            ],
            [
                'id'    => 197,
                'title' => 'lot_track_delete',
            ],
            [
                'id'    => 198,
                'title' => 'lot_track_access',
            ],
            [
                'id'    => 199,
                'title' => 'production_order_create',
            ],
            [
                'id'    => 200,
                'title' => 'production_order_edit',
            ],
            [
                'id'    => 201,
                'title' => 'production_order_show',
            ],
            [
                'id'    => 202,
                'title' => 'production_order_delete',
            ],
            [
                'id'    => 203,
                'title' => 'production_order_access',
            ],
            [
                'id'    => 204,
                'title' => 'create_finished_product_create',
            ],
            [
                'id'    => 205,
                'title' => 'create_finished_product_edit',
            ],
            [
                'id'    => 206,
                'title' => 'create_finished_product_show',
            ],
            [
                'id'    => 207,
                'title' => 'create_finished_product_delete',
            ],
            [
                'id'    => 208,
                'title' => 'create_finished_product_access',
            ],
            [
                'id'    => 209,
                'title' => 'production_spent_create',
            ],
            [
                'id'    => 210,
                'title' => 'production_spent_edit',
            ],
            [
                'id'    => 211,
                'title' => 'production_spent_show',
            ],
            [
                'id'    => 212,
                'title' => 'production_spent_delete',
            ],
            [
                'id'    => 213,
                'title' => 'production_spent_access',
            ],
            [
                'id'    => 214,
                'title' => 'product_balance_processing_create',
            ],
            [
                'id'    => 215,
                'title' => 'product_balance_processing_edit',
            ],
            [
                'id'    => 216,
                'title' => 'product_balance_processing_show',
            ],
            [
                'id'    => 217,
                'title' => 'product_balance_processing_delete',
            ],
            [
                'id'    => 218,
                'title' => 'product_balance_processing_access',
            ],
            [
                'id'    => 219,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
