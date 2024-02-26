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
                'title' => 'client_create',
            ],
            [
                'id'    => 18,
                'title' => 'client_edit',
            ],
            [
                'id'    => 19,
                'title' => 'client_show',
            ],
            [
                'id'    => 20,
                'title' => 'client_delete',
            ],
            [
                'id'    => 21,
                'title' => 'client_access',
            ],
            [
                'id'    => 22,
                'title' => 'boat_create',
            ],
            [
                'id'    => 23,
                'title' => 'boat_edit',
            ],
            [
                'id'    => 24,
                'title' => 'boat_show',
            ],
            [
                'id'    => 25,
                'title' => 'boat_delete',
            ],
            [
                'id'    => 26,
                'title' => 'boat_access',
            ],
            [
                'id'    => 27,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 28,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 29,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 30,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 31,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 32,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 33,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 34,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 35,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 36,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 37,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 38,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 39,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 40,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 41,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 42,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 43,
                'title' => 'work_access',
            ],
            [
                'id'    => 44,
                'title' => 'wlog_create',
            ],
            [
                'id'    => 45,
                'title' => 'wlog_edit',
            ],
            [
                'id'    => 46,
                'title' => 'wlog_show',
            ],
            [
                'id'    => 47,
                'title' => 'wlog_delete',
            ],
            [
                'id'    => 48,
                'title' => 'wlog_access',
            ],
            [
                'id'    => 49,
                'title' => 'wlist_create',
            ],
            [
                'id'    => 50,
                'title' => 'wlist_edit',
            ],
            [
                'id'    => 51,
                'title' => 'wlist_show',
            ],
            [
                'id'    => 52,
                'title' => 'wlist_delete',
            ],
            [
                'id'    => 53,
                'title' => 'wlist_access',
            ],
            [
                'id'    => 54,
                'title' => 'to_do_create',
            ],
            [
                'id'    => 55,
                'title' => 'to_do_edit',
            ],
            [
                'id'    => 56,
                'title' => 'to_do_show',
            ],
            [
                'id'    => 57,
                'title' => 'to_do_delete',
            ],
            [
                'id'    => 58,
                'title' => 'to_do_access',
            ],
            [
                'id'    => 59,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 60,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 61,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 62,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 63,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 64,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 65,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 66,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 67,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 68,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 69,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 70,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 71,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 72,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 73,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 74,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 75,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 76,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 77,
                'title' => 'product_create',
            ],
            [
                'id'    => 78,
                'title' => 'product_edit',
            ],
            [
                'id'    => 79,
                'title' => 'product_show',
            ],
            [
                'id'    => 80,
                'title' => 'product_delete',
            ],
            [
                'id'    => 81,
                'title' => 'product_access',
            ],
            [
                'id'    => 82,
                'title' => 'marina_create',
            ],
            [
                'id'    => 83,
                'title' => 'marina_edit',
            ],
            [
                'id'    => 84,
                'title' => 'marina_show',
            ],
            [
                'id'    => 85,
                'title' => 'marina_delete',
            ],
            [
                'id'    => 86,
                'title' => 'marina_access',
            ],
            [
                'id'    => 87,
                'title' => 'contact_management_access',
            ],
            [
                'id'    => 88,
                'title' => 'contact_company_create',
            ],
            [
                'id'    => 89,
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => 90,
                'title' => 'contact_company_show',
            ],
            [
                'id'    => 91,
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => 92,
                'title' => 'contact_company_access',
            ],
            [
                'id'    => 93,
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => 94,
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => 95,
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => 96,
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => 97,
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => 98,
                'title' => 'employee_create',
            ],
            [
                'id'    => 99,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 100,
                'title' => 'employee_show',
            ],
            [
                'id'    => 101,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 102,
                'title' => 'employee_access',
            ],
            [
                'id'    => 103,
                'title' => 'provider_create',
            ],
            [
                'id'    => 104,
                'title' => 'provider_edit',
            ],
            [
                'id'    => 105,
                'title' => 'provider_show',
            ],
            [
                'id'    => 106,
                'title' => 'provider_delete',
            ],
            [
                'id'    => 107,
                'title' => 'provider_access',
            ],
            [
                'id'    => 108,
                'title' => 'brand_create',
            ],
            [
                'id'    => 109,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 110,
                'title' => 'brand_show',
            ],
            [
                'id'    => 111,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 112,
                'title' => 'brand_access',
            ],
            [
                'id'    => 113,
                'title' => 'proforma_create',
            ],
            [
                'id'    => 114,
                'title' => 'proforma_edit',
            ],
            [
                'id'    => 115,
                'title' => 'proforma_show',
            ],
            [
                'id'    => 116,
                'title' => 'proforma_delete',
            ],
            [
                'id'    => 117,
                'title' => 'proforma_access',
            ],
            [
                'id'    => 118,
                'title' => 'claim_create',
            ],
            [
                'id'    => 119,
                'title' => 'claim_edit',
            ],
            [
                'id'    => 120,
                'title' => 'claim_show',
            ],
            [
                'id'    => 121,
                'title' => 'claim_delete',
            ],
            [
                'id'    => 122,
                'title' => 'claim_access',
            ],
            [
                'id'    => 123,
                'title' => 'billing_access',
            ],
            [
                'id'    => 124,
                'title' => 'payment_create',
            ],
            [
                'id'    => 125,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 126,
                'title' => 'payment_show',
            ],
            [
                'id'    => 127,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 128,
                'title' => 'payment_access',
            ],
            [
                'id'    => 129,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 130,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 131,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 132,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 133,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 134,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 135,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 136,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 137,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 138,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 139,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 140,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 141,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 142,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 143,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 144,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 145,
                'title' => 'asset_create',
            ],
            [
                'id'    => 146,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 147,
                'title' => 'asset_show',
            ],
            [
                'id'    => 148,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 149,
                'title' => 'asset_access',
            ],
            [
                'id'    => 150,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 151,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 152,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 153,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 154,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 155,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 156,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 157,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 158,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 159,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 160,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 161,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 162,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 163,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 164,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 165,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 166,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 167,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 168,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 169,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 170,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 171,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 172,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 173,
                'title' => 'expense_create',
            ],
            [
                'id'    => 174,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 175,
                'title' => 'expense_show',
            ],
            [
                'id'    => 176,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 177,
                'title' => 'expense_access',
            ],
            [
                'id'    => 178,
                'title' => 'income_create',
            ],
            [
                'id'    => 179,
                'title' => 'income_edit',
            ],
            [
                'id'    => 180,
                'title' => 'income_show',
            ],
            [
                'id'    => 181,
                'title' => 'income_delete',
            ],
            [
                'id'    => 182,
                'title' => 'income_access',
            ],
            [
                'id'    => 183,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 184,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 185,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 186,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 187,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 188,
                'title' => 'setup_access',
            ],
            [
                'id'    => 189,
                'title' => 'contact_tag_create',
            ],
            [
                'id'    => 190,
                'title' => 'contact_tag_edit',
            ],
            [
                'id'    => 191,
                'title' => 'contact_tag_show',
            ],
            [
                'id'    => 192,
                'title' => 'contact_tag_delete',
            ],
            [
                'id'    => 193,
                'title' => 'contact_tag_access',
            ],
            [
                'id'    => 194,
                'title' => 'priority_create',
            ],
            [
                'id'    => 195,
                'title' => 'priority_edit',
            ],
            [
                'id'    => 196,
                'title' => 'priority_show',
            ],
            [
                'id'    => 197,
                'title' => 'priority_delete',
            ],
            [
                'id'    => 198,
                'title' => 'priority_access',
            ],
            [
                'id'    => 199,
                'title' => 'comment_create',
            ],
            [
                'id'    => 200,
                'title' => 'comment_edit',
            ],
            [
                'id'    => 201,
                'title' => 'comment_show',
            ],
            [
                'id'    => 202,
                'title' => 'comment_delete',
            ],
            [
                'id'    => 203,
                'title' => 'comment_access',
            ],
            [
                'id'    => 204,
                'title' => 'booking_access',
            ],
            [
                'id'    => 205,
                'title' => 'booking_list_create',
            ],
            [
                'id'    => 206,
                'title' => 'booking_list_edit',
            ],
            [
                'id'    => 207,
                'title' => 'booking_list_show',
            ],
            [
                'id'    => 208,
                'title' => 'booking_list_delete',
            ],
            [
                'id'    => 209,
                'title' => 'booking_list_access',
            ],
            [
                'id'    => 210,
                'title' => 'wlist_status_create',
            ],
            [
                'id'    => 211,
                'title' => 'wlist_status_edit',
            ],
            [
                'id'    => 212,
                'title' => 'wlist_status_show',
            ],
            [
                'id'    => 213,
                'title' => 'wlist_status_delete',
            ],
            [
                'id'    => 214,
                'title' => 'wlist_status_access',
            ],
            [
                'id'    => 215,
                'title' => 'mlog_create',
            ],
            [
                'id'    => 216,
                'title' => 'mlog_edit',
            ],
            [
                'id'    => 217,
                'title' => 'mlog_show',
            ],
            [
                'id'    => 218,
                'title' => 'mlog_delete',
            ],
            [
                'id'    => 219,
                'title' => 'mlog_access',
            ],
            [
                'id'    => 220,
                'title' => 'assets_rental_create',
            ],
            [
                'id'    => 221,
                'title' => 'assets_rental_edit',
            ],
            [
                'id'    => 222,
                'title' => 'assets_rental_show',
            ],
            [
                'id'    => 223,
                'title' => 'assets_rental_delete',
            ],
            [
                'id'    => 224,
                'title' => 'assets_rental_access',
            ],
            [
                'id'    => 225,
                'title' => 'booking_status_create',
            ],
            [
                'id'    => 226,
                'title' => 'booking_status_edit',
            ],
            [
                'id'    => 227,
                'title' => 'booking_status_show',
            ],
            [
                'id'    => 228,
                'title' => 'booking_status_delete',
            ],
            [
                'id'    => 229,
                'title' => 'booking_status_access',
            ],
            [
                'id'    => 230,
                'title' => 'booking_slot_create',
            ],
            [
                'id'    => 231,
                'title' => 'booking_slot_edit',
            ],
            [
                'id'    => 232,
                'title' => 'booking_slot_show',
            ],
            [
                'id'    => 233,
                'title' => 'booking_slot_delete',
            ],
            [
                'id'    => 234,
                'title' => 'booking_slot_access',
            ],
            [
                'id'    => 235,
                'title' => 'employee_attendance_create',
            ],
            [
                'id'    => 236,
                'title' => 'employee_attendance_edit',
            ],
            [
                'id'    => 237,
                'title' => 'employee_attendance_show',
            ],
            [
                'id'    => 238,
                'title' => 'employee_attendance_delete',
            ],
            [
                'id'    => 239,
                'title' => 'employee_attendance_access',
            ],
            [
                'id'    => 240,
                'title' => 'learning_center_access',
            ],
            [
                'id'    => 241,
                'title' => 'technical_documentation_create',
            ],
            [
                'id'    => 242,
                'title' => 'technical_documentation_edit',
            ],
            [
                'id'    => 243,
                'title' => 'technical_documentation_show',
            ],
            [
                'id'    => 244,
                'title' => 'technical_documentation_delete',
            ],
            [
                'id'    => 245,
                'title' => 'technical_documentation_access',
            ],
            [
                'id'    => 246,
                'title' => 'tech_docs_type_create',
            ],
            [
                'id'    => 247,
                'title' => 'tech_docs_type_edit',
            ],
            [
                'id'    => 248,
                'title' => 'tech_docs_type_show',
            ],
            [
                'id'    => 249,
                'title' => 'tech_docs_type_delete',
            ],
            [
                'id'    => 250,
                'title' => 'tech_docs_type_access',
            ],
            [
                'id'    => 251,
                'title' => 'skills_category_create',
            ],
            [
                'id'    => 252,
                'title' => 'skills_category_edit',
            ],
            [
                'id'    => 253,
                'title' => 'skills_category_show',
            ],
            [
                'id'    => 254,
                'title' => 'skills_category_delete',
            ],
            [
                'id'    => 255,
                'title' => 'skills_category_access',
            ],
            [
                'id'    => 256,
                'title' => 'clients_review_create',
            ],
            [
                'id'    => 257,
                'title' => 'clients_review_edit',
            ],
            [
                'id'    => 258,
                'title' => 'clients_review_show',
            ],
            [
                'id'    => 259,
                'title' => 'clients_review_delete',
            ],
            [
                'id'    => 260,
                'title' => 'clients_review_access',
            ],
            [
                'id'    => 261,
                'title' => 'video_tutorial_create',
            ],
            [
                'id'    => 262,
                'title' => 'video_tutorial_edit',
            ],
            [
                'id'    => 263,
                'title' => 'video_tutorial_show',
            ],
            [
                'id'    => 264,
                'title' => 'video_tutorial_delete',
            ],
            [
                'id'    => 265,
                'title' => 'video_tutorial_access',
            ],
            [
                'id'    => 266,
                'title' => 'video_category_create',
            ],
            [
                'id'    => 267,
                'title' => 'video_category_edit',
            ],
            [
                'id'    => 268,
                'title' => 'video_category_show',
            ],
            [
                'id'    => 269,
                'title' => 'video_category_delete',
            ],
            [
                'id'    => 270,
                'title' => 'video_category_access',
            ],
            [
                'id'    => 271,
                'title' => 'vip_plan_access',
            ],
            [
                'id'    => 272,
                'title' => 'suscription_create',
            ],
            [
                'id'    => 273,
                'title' => 'suscription_edit',
            ],
            [
                'id'    => 274,
                'title' => 'suscription_show',
            ],
            [
                'id'    => 275,
                'title' => 'suscription_delete',
            ],
            [
                'id'    => 276,
                'title' => 'suscription_access',
            ],
            [
                'id'    => 277,
                'title' => 'plan_create',
            ],
            [
                'id'    => 278,
                'title' => 'plan_edit',
            ],
            [
                'id'    => 279,
                'title' => 'plan_show',
            ],
            [
                'id'    => 280,
                'title' => 'plan_delete',
            ],
            [
                'id'    => 281,
                'title' => 'plan_access',
            ],
            [
                'id'    => 282,
                'title' => 'company_access',
            ],
            [
                'id'    => 283,
                'title' => 'documentation_create',
            ],
            [
                'id'    => 284,
                'title' => 'documentation_edit',
            ],
            [
                'id'    => 285,
                'title' => 'documentation_show',
            ],
            [
                'id'    => 286,
                'title' => 'documentation_delete',
            ],
            [
                'id'    => 287,
                'title' => 'documentation_access',
            ],
            [
                'id'    => 288,
                'title' => 'insurance_create',
            ],
            [
                'id'    => 289,
                'title' => 'insurance_edit',
            ],
            [
                'id'    => 290,
                'title' => 'insurance_show',
            ],
            [
                'id'    => 291,
                'title' => 'insurance_delete',
            ],
            [
                'id'    => 292,
                'title' => 'insurance_access',
            ],
            [
                'id'    => 293,
                'title' => 'bank_create',
            ],
            [
                'id'    => 294,
                'title' => 'bank_edit',
            ],
            [
                'id'    => 295,
                'title' => 'bank_show',
            ],
            [
                'id'    => 296,
                'title' => 'bank_delete',
            ],
            [
                'id'    => 297,
                'title' => 'bank_access',
            ],
            [
                'id'    => 298,
                'title' => 'documentation_category_create',
            ],
            [
                'id'    => 299,
                'title' => 'documentation_category_edit',
            ],
            [
                'id'    => 300,
                'title' => 'documentation_category_show',
            ],
            [
                'id'    => 301,
                'title' => 'documentation_category_delete',
            ],
            [
                'id'    => 302,
                'title' => 'documentation_category_access',
            ],
            [
                'id'    => 303,
                'title' => 'maintenance_plan_access',
            ],
            [
                'id'    => 304,
                'title' => 'checkpoint_create',
            ],
            [
                'id'    => 305,
                'title' => 'checkpoint_edit',
            ],
            [
                'id'    => 306,
                'title' => 'checkpoint_show',
            ],
            [
                'id'    => 307,
                'title' => 'checkpoint_delete',
            ],
            [
                'id'    => 308,
                'title' => 'checkpoint_access',
            ],
            [
                'id'    => 309,
                'title' => 'care_plan_create',
            ],
            [
                'id'    => 310,
                'title' => 'care_plan_edit',
            ],
            [
                'id'    => 311,
                'title' => 'care_plan_show',
            ],
            [
                'id'    => 312,
                'title' => 'care_plan_delete',
            ],
            [
                'id'    => 313,
                'title' => 'care_plan_access',
            ],
            [
                'id'    => 314,
                'title' => 'maintenance_suscription_create',
            ],
            [
                'id'    => 315,
                'title' => 'maintenance_suscription_edit',
            ],
            [
                'id'    => 316,
                'title' => 'maintenance_suscription_show',
            ],
            [
                'id'    => 317,
                'title' => 'maintenance_suscription_delete',
            ],
            [
                'id'    => 318,
                'title' => 'maintenance_suscription_access',
            ],
            [
                'id'    => 319,
                'title' => 'employee_holiday_create',
            ],
            [
                'id'    => 320,
                'title' => 'employee_holiday_edit',
            ],
            [
                'id'    => 321,
                'title' => 'employee_holiday_show',
            ],
            [
                'id'    => 322,
                'title' => 'employee_holiday_delete',
            ],
            [
                'id'    => 323,
                'title' => 'employee_holiday_access',
            ],
            [
                'id'    => 324,
                'title' => 'employee_skill_create',
            ],
            [
                'id'    => 325,
                'title' => 'employee_skill_edit',
            ],
            [
                'id'    => 326,
                'title' => 'employee_skill_show',
            ],
            [
                'id'    => 327,
                'title' => 'employee_skill_delete',
            ],
            [
                'id'    => 328,
                'title' => 'employee_skill_access',
            ],
            [
                'id'    => 329,
                'title' => 'employee_rating_create',
            ],
            [
                'id'    => 330,
                'title' => 'employee_rating_edit',
            ],
            [
                'id'    => 331,
                'title' => 'employee_rating_show',
            ],
            [
                'id'    => 332,
                'title' => 'employee_rating_delete',
            ],
            [
                'id'    => 333,
                'title' => 'employee_rating_access',
            ],
            [
                'id'    => 334,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
