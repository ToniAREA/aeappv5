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
                'title' => 'claim_create',
            ],
            [
                'id'    => 114,
                'title' => 'claim_edit',
            ],
            [
                'id'    => 115,
                'title' => 'claim_show',
            ],
            [
                'id'    => 116,
                'title' => 'claim_delete',
            ],
            [
                'id'    => 117,
                'title' => 'claim_access',
            ],
            [
                'id'    => 118,
                'title' => 'billing_access',
            ],
            [
                'id'    => 119,
                'title' => 'payment_create',
            ],
            [
                'id'    => 120,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 121,
                'title' => 'payment_show',
            ],
            [
                'id'    => 122,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 123,
                'title' => 'payment_access',
            ],
            [
                'id'    => 124,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 125,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 126,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 127,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 128,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 129,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 130,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 131,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 132,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 133,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 134,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 135,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 136,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 137,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 138,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 139,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 140,
                'title' => 'asset_create',
            ],
            [
                'id'    => 141,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 142,
                'title' => 'asset_show',
            ],
            [
                'id'    => 143,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 144,
                'title' => 'asset_access',
            ],
            [
                'id'    => 145,
                'title' => 'assets_history_create',
            ],
            [
                'id'    => 146,
                'title' => 'assets_history_edit',
            ],
            [
                'id'    => 147,
                'title' => 'assets_history_show',
            ],
            [
                'id'    => 148,
                'title' => 'assets_history_delete',
            ],
            [
                'id'    => 149,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 150,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 151,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 152,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 153,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 154,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 155,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 156,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 157,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 158,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 159,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 160,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 161,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 162,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 163,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 164,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 165,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 166,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 167,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 168,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 169,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 170,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 171,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 172,
                'title' => 'expense_create',
            ],
            [
                'id'    => 173,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 174,
                'title' => 'expense_show',
            ],
            [
                'id'    => 175,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 176,
                'title' => 'expense_access',
            ],
            [
                'id'    => 177,
                'title' => 'income_create',
            ],
            [
                'id'    => 178,
                'title' => 'income_edit',
            ],
            [
                'id'    => 179,
                'title' => 'income_show',
            ],
            [
                'id'    => 180,
                'title' => 'income_delete',
            ],
            [
                'id'    => 181,
                'title' => 'income_access',
            ],
            [
                'id'    => 182,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 183,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 184,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 185,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 186,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 187,
                'title' => 'setup_access',
            ],
            [
                'id'    => 188,
                'title' => 'contact_tag_create',
            ],
            [
                'id'    => 189,
                'title' => 'contact_tag_edit',
            ],
            [
                'id'    => 190,
                'title' => 'contact_tag_show',
            ],
            [
                'id'    => 191,
                'title' => 'contact_tag_delete',
            ],
            [
                'id'    => 192,
                'title' => 'contact_tag_access',
            ],
            [
                'id'    => 193,
                'title' => 'comment_create',
            ],
            [
                'id'    => 194,
                'title' => 'comment_edit',
            ],
            [
                'id'    => 195,
                'title' => 'comment_show',
            ],
            [
                'id'    => 196,
                'title' => 'comment_delete',
            ],
            [
                'id'    => 197,
                'title' => 'comment_access',
            ],
            [
                'id'    => 198,
                'title' => 'booking_access',
            ],
            [
                'id'    => 199,
                'title' => 'booking_list_create',
            ],
            [
                'id'    => 200,
                'title' => 'booking_list_edit',
            ],
            [
                'id'    => 201,
                'title' => 'booking_list_show',
            ],
            [
                'id'    => 202,
                'title' => 'booking_list_delete',
            ],
            [
                'id'    => 203,
                'title' => 'booking_list_access',
            ],
            [
                'id'    => 204,
                'title' => 'wlist_status_create',
            ],
            [
                'id'    => 205,
                'title' => 'wlist_status_edit',
            ],
            [
                'id'    => 206,
                'title' => 'wlist_status_show',
            ],
            [
                'id'    => 207,
                'title' => 'wlist_status_delete',
            ],
            [
                'id'    => 208,
                'title' => 'wlist_status_access',
            ],
            [
                'id'    => 209,
                'title' => 'mlog_create',
            ],
            [
                'id'    => 210,
                'title' => 'mlog_edit',
            ],
            [
                'id'    => 211,
                'title' => 'mlog_show',
            ],
            [
                'id'    => 212,
                'title' => 'mlog_delete',
            ],
            [
                'id'    => 213,
                'title' => 'mlog_access',
            ],
            [
                'id'    => 214,
                'title' => 'assets_rental_create',
            ],
            [
                'id'    => 215,
                'title' => 'assets_rental_edit',
            ],
            [
                'id'    => 216,
                'title' => 'assets_rental_show',
            ],
            [
                'id'    => 217,
                'title' => 'assets_rental_delete',
            ],
            [
                'id'    => 218,
                'title' => 'assets_rental_access',
            ],
            [
                'id'    => 219,
                'title' => 'booking_status_create',
            ],
            [
                'id'    => 220,
                'title' => 'booking_status_edit',
            ],
            [
                'id'    => 221,
                'title' => 'booking_status_show',
            ],
            [
                'id'    => 222,
                'title' => 'booking_status_delete',
            ],
            [
                'id'    => 223,
                'title' => 'booking_status_access',
            ],
            [
                'id'    => 224,
                'title' => 'booking_slot_create',
            ],
            [
                'id'    => 225,
                'title' => 'booking_slot_edit',
            ],
            [
                'id'    => 226,
                'title' => 'booking_slot_show',
            ],
            [
                'id'    => 227,
                'title' => 'booking_slot_delete',
            ],
            [
                'id'    => 228,
                'title' => 'booking_slot_access',
            ],
            [
                'id'    => 229,
                'title' => 'employee_attendance_create',
            ],
            [
                'id'    => 230,
                'title' => 'employee_attendance_edit',
            ],
            [
                'id'    => 231,
                'title' => 'employee_attendance_show',
            ],
            [
                'id'    => 232,
                'title' => 'employee_attendance_delete',
            ],
            [
                'id'    => 233,
                'title' => 'employee_attendance_access',
            ],
            [
                'id'    => 234,
                'title' => 'learning_center_access',
            ],
            [
                'id'    => 235,
                'title' => 'technical_documentation_create',
            ],
            [
                'id'    => 236,
                'title' => 'technical_documentation_edit',
            ],
            [
                'id'    => 237,
                'title' => 'technical_documentation_show',
            ],
            [
                'id'    => 238,
                'title' => 'technical_documentation_delete',
            ],
            [
                'id'    => 239,
                'title' => 'technical_documentation_access',
            ],
            [
                'id'    => 240,
                'title' => 'tech_docs_type_create',
            ],
            [
                'id'    => 241,
                'title' => 'tech_docs_type_edit',
            ],
            [
                'id'    => 242,
                'title' => 'tech_docs_type_show',
            ],
            [
                'id'    => 243,
                'title' => 'tech_docs_type_delete',
            ],
            [
                'id'    => 244,
                'title' => 'tech_docs_type_access',
            ],
            [
                'id'    => 245,
                'title' => 'skills_category_create',
            ],
            [
                'id'    => 246,
                'title' => 'skills_category_edit',
            ],
            [
                'id'    => 247,
                'title' => 'skills_category_show',
            ],
            [
                'id'    => 248,
                'title' => 'skills_category_delete',
            ],
            [
                'id'    => 249,
                'title' => 'skills_category_access',
            ],
            [
                'id'    => 250,
                'title' => 'clients_review_create',
            ],
            [
                'id'    => 251,
                'title' => 'clients_review_edit',
            ],
            [
                'id'    => 252,
                'title' => 'clients_review_show',
            ],
            [
                'id'    => 253,
                'title' => 'clients_review_delete',
            ],
            [
                'id'    => 254,
                'title' => 'clients_review_access',
            ],
            [
                'id'    => 255,
                'title' => 'video_tutorial_create',
            ],
            [
                'id'    => 256,
                'title' => 'video_tutorial_edit',
            ],
            [
                'id'    => 257,
                'title' => 'video_tutorial_show',
            ],
            [
                'id'    => 258,
                'title' => 'video_tutorial_delete',
            ],
            [
                'id'    => 259,
                'title' => 'video_tutorial_access',
            ],
            [
                'id'    => 260,
                'title' => 'video_category_create',
            ],
            [
                'id'    => 261,
                'title' => 'video_category_edit',
            ],
            [
                'id'    => 262,
                'title' => 'video_category_show',
            ],
            [
                'id'    => 263,
                'title' => 'video_category_delete',
            ],
            [
                'id'    => 264,
                'title' => 'video_category_access',
            ],
            [
                'id'    => 265,
                'title' => 'vip_plan_access',
            ],
            [
                'id'    => 266,
                'title' => 'suscription_create',
            ],
            [
                'id'    => 267,
                'title' => 'suscription_edit',
            ],
            [
                'id'    => 268,
                'title' => 'suscription_show',
            ],
            [
                'id'    => 269,
                'title' => 'suscription_delete',
            ],
            [
                'id'    => 270,
                'title' => 'suscription_access',
            ],
            [
                'id'    => 271,
                'title' => 'plan_create',
            ],
            [
                'id'    => 272,
                'title' => 'plan_edit',
            ],
            [
                'id'    => 273,
                'title' => 'plan_show',
            ],
            [
                'id'    => 274,
                'title' => 'plan_delete',
            ],
            [
                'id'    => 275,
                'title' => 'plan_access',
            ],
            [
                'id'    => 276,
                'title' => 'company_access',
            ],
            [
                'id'    => 277,
                'title' => 'documentation_create',
            ],
            [
                'id'    => 278,
                'title' => 'documentation_edit',
            ],
            [
                'id'    => 279,
                'title' => 'documentation_show',
            ],
            [
                'id'    => 280,
                'title' => 'documentation_delete',
            ],
            [
                'id'    => 281,
                'title' => 'documentation_access',
            ],
            [
                'id'    => 282,
                'title' => 'insurance_create',
            ],
            [
                'id'    => 283,
                'title' => 'insurance_edit',
            ],
            [
                'id'    => 284,
                'title' => 'insurance_show',
            ],
            [
                'id'    => 285,
                'title' => 'insurance_delete',
            ],
            [
                'id'    => 286,
                'title' => 'insurance_access',
            ],
            [
                'id'    => 287,
                'title' => 'bank_create',
            ],
            [
                'id'    => 288,
                'title' => 'bank_edit',
            ],
            [
                'id'    => 289,
                'title' => 'bank_show',
            ],
            [
                'id'    => 290,
                'title' => 'bank_delete',
            ],
            [
                'id'    => 291,
                'title' => 'bank_access',
            ],
            [
                'id'    => 292,
                'title' => 'documentation_category_create',
            ],
            [
                'id'    => 293,
                'title' => 'documentation_category_edit',
            ],
            [
                'id'    => 294,
                'title' => 'documentation_category_show',
            ],
            [
                'id'    => 295,
                'title' => 'documentation_category_delete',
            ],
            [
                'id'    => 296,
                'title' => 'documentation_category_access',
            ],
            [
                'id'    => 297,
                'title' => 'maintenance_plan_access',
            ],
            [
                'id'    => 298,
                'title' => 'checkpoint_create',
            ],
            [
                'id'    => 299,
                'title' => 'checkpoint_edit',
            ],
            [
                'id'    => 300,
                'title' => 'checkpoint_show',
            ],
            [
                'id'    => 301,
                'title' => 'checkpoint_delete',
            ],
            [
                'id'    => 302,
                'title' => 'checkpoint_access',
            ],
            [
                'id'    => 303,
                'title' => 'care_plan_create',
            ],
            [
                'id'    => 304,
                'title' => 'care_plan_edit',
            ],
            [
                'id'    => 305,
                'title' => 'care_plan_show',
            ],
            [
                'id'    => 306,
                'title' => 'care_plan_delete',
            ],
            [
                'id'    => 307,
                'title' => 'care_plan_access',
            ],
            [
                'id'    => 308,
                'title' => 'maintenance_suscription_create',
            ],
            [
                'id'    => 309,
                'title' => 'maintenance_suscription_edit',
            ],
            [
                'id'    => 310,
                'title' => 'maintenance_suscription_show',
            ],
            [
                'id'    => 311,
                'title' => 'maintenance_suscription_delete',
            ],
            [
                'id'    => 312,
                'title' => 'maintenance_suscription_access',
            ],
            [
                'id'    => 313,
                'title' => 'employee_holiday_create',
            ],
            [
                'id'    => 314,
                'title' => 'employee_holiday_edit',
            ],
            [
                'id'    => 315,
                'title' => 'employee_holiday_show',
            ],
            [
                'id'    => 316,
                'title' => 'employee_holiday_delete',
            ],
            [
                'id'    => 317,
                'title' => 'employee_holiday_access',
            ],
            [
                'id'    => 318,
                'title' => 'employee_skill_create',
            ],
            [
                'id'    => 319,
                'title' => 'employee_skill_edit',
            ],
            [
                'id'    => 320,
                'title' => 'employee_skill_show',
            ],
            [
                'id'    => 321,
                'title' => 'employee_skill_delete',
            ],
            [
                'id'    => 322,
                'title' => 'employee_skill_access',
            ],
            [
                'id'    => 323,
                'title' => 'employee_rating_create',
            ],
            [
                'id'    => 324,
                'title' => 'employee_rating_edit',
            ],
            [
                'id'    => 325,
                'title' => 'employee_rating_show',
            ],
            [
                'id'    => 326,
                'title' => 'employee_rating_delete',
            ],
            [
                'id'    => 327,
                'title' => 'employee_rating_access',
            ],
            [
                'id'    => 328,
                'title' => 'remote_device_access',
            ],
            [
                'id'    => 329,
                'title' => 'iot_plan_create',
            ],
            [
                'id'    => 330,
                'title' => 'iot_plan_edit',
            ],
            [
                'id'    => 331,
                'title' => 'iot_plan_show',
            ],
            [
                'id'    => 332,
                'title' => 'iot_plan_delete',
            ],
            [
                'id'    => 333,
                'title' => 'iot_plan_access',
            ],
            [
                'id'    => 334,
                'title' => 'iot_suscription_create',
            ],
            [
                'id'    => 335,
                'title' => 'iot_suscription_edit',
            ],
            [
                'id'    => 336,
                'title' => 'iot_suscription_show',
            ],
            [
                'id'    => 337,
                'title' => 'iot_suscription_delete',
            ],
            [
                'id'    => 338,
                'title' => 'iot_suscription_access',
            ],
            [
                'id'    => 339,
                'title' => 'iot_device_create',
            ],
            [
                'id'    => 340,
                'title' => 'iot_device_edit',
            ],
            [
                'id'    => 341,
                'title' => 'iot_device_show',
            ],
            [
                'id'    => 342,
                'title' => 'iot_device_delete',
            ],
            [
                'id'    => 343,
                'title' => 'iot_device_access',
            ],
            [
                'id'    => 344,
                'title' => 'iot_received_data_create',
            ],
            [
                'id'    => 345,
                'title' => 'iot_received_data_edit',
            ],
            [
                'id'    => 346,
                'title' => 'iot_received_data_show',
            ],
            [
                'id'    => 347,
                'title' => 'iot_received_data_delete',
            ],
            [
                'id'    => 348,
                'title' => 'iot_received_data_access',
            ],
            [
                'id'    => 349,
                'title' => 'checkpoints_group_create',
            ],
            [
                'id'    => 350,
                'title' => 'checkpoints_group_edit',
            ],
            [
                'id'    => 351,
                'title' => 'checkpoints_group_show',
            ],
            [
                'id'    => 352,
                'title' => 'checkpoints_group_delete',
            ],
            [
                'id'    => 353,
                'title' => 'checkpoints_group_access',
            ],
            [
                'id'    => 354,
                'title' => 'currency_create',
            ],
            [
                'id'    => 355,
                'title' => 'currency_edit',
            ],
            [
                'id'    => 356,
                'title' => 'currency_show',
            ],
            [
                'id'    => 357,
                'title' => 'currency_delete',
            ],
            [
                'id'    => 358,
                'title' => 'currency_access',
            ],
            [
                'id'    => 359,
                'title' => 'finalcial_document_create',
            ],
            [
                'id'    => 360,
                'title' => 'finalcial_document_edit',
            ],
            [
                'id'    => 361,
                'title' => 'finalcial_document_show',
            ],
            [
                'id'    => 362,
                'title' => 'finalcial_document_delete',
            ],
            [
                'id'    => 363,
                'title' => 'finalcial_document_access',
            ],
            [
                'id'    => 364,
                'title' => 'social_account_access',
            ],
            [
                'id'    => 365,
                'title' => 'financial_document_item_create',
            ],
            [
                'id'    => 366,
                'title' => 'financial_document_item_edit',
            ],
            [
                'id'    => 367,
                'title' => 'financial_document_item_show',
            ],
            [
                'id'    => 368,
                'title' => 'financial_document_item_delete',
            ],
            [
                'id'    => 369,
                'title' => 'financial_document_item_access',
            ],
            [
                'id'    => 370,
                'title' => 'finantial_document_tax_create',
            ],
            [
                'id'    => 371,
                'title' => 'finantial_document_tax_edit',
            ],
            [
                'id'    => 372,
                'title' => 'finantial_document_tax_show',
            ],
            [
                'id'    => 373,
                'title' => 'finantial_document_tax_delete',
            ],
            [
                'id'    => 374,
                'title' => 'finantial_document_tax_access',
            ],
            [
                'id'    => 375,
                'title' => 'finantial_document_discount_create',
            ],
            [
                'id'    => 376,
                'title' => 'finantial_document_discount_edit',
            ],
            [
                'id'    => 377,
                'title' => 'finantial_document_discount_show',
            ],
            [
                'id'    => 378,
                'title' => 'finantial_document_discount_delete',
            ],
            [
                'id'    => 379,
                'title' => 'finantial_document_discount_access',
            ],
            [
                'id'    => 380,
                'title' => 'user_setting_create',
            ],
            [
                'id'    => 381,
                'title' => 'user_setting_edit',
            ],
            [
                'id'    => 382,
                'title' => 'user_setting_show',
            ],
            [
                'id'    => 383,
                'title' => 'user_setting_delete',
            ],
            [
                'id'    => 384,
                'title' => 'user_setting_access',
            ],
            [
                'id'    => 385,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
