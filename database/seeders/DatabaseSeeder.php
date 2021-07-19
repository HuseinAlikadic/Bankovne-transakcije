<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rate;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Rate::insert([
            ['type'=>1],
            ['type'=>2],
            ['type'=>3],
            ['type'=>4]
        ]);
        \App\Models\Customer::insert([
            ['first_name'=>'Husein',
            'last_name'=>'Alikadić',
            'date_of_birth'=>'2019-03-10',
            'address'=>'Olovo',
            'rating_id'=>2],
            ['first_name'=>'Emina',
            'last_name'=>'Alikadić',
            'date_of_birth'=>'2015-03-10',
            'address'=>'Sarajevo',
            'rating_id'=>1]
        ]);
        \App\Models\FinancialInstitution::insert([
            ['name_of_bank'=>'Raifaizen'],
            ['name_of_bank'=>'Unicredit'],
            ['name_of_bank'=>'Inteza']
        ]);
        \App\Models\Account::insert([
            ['broj_racuna'=>252,
            'custumer_id'=>1,
            'bilans_racuna'=>2000,
            'financial_institution_id'=>1
        ],
        ['broj_racuna'=>32,
        'custumer_id'=>2,
        'bilans_racuna'=>100,
        'financial_institution_id'=>2
        ]
        ]);
        \App\Models\PostingKnjizenje::insert([
            ['money_value'=>1252,
            'id_from_account'=>1,
            'id_to_account'=>1,
            'financial_institutions_id'=>2,
            'booking_date'=>'2010-05-11',
            ]
        ]);
        \App\Models\Credit::insert([
            ['custumer_id'=>1,
            'original_term'=>'gggggg kokok ',
            'remaining_term'=>null,
            'credit_amount'=>200,
            'curent_credit_amount'=>153,
            ]
        ]);
        \App\Models\CreditPosting::insert([
            ['value_of_payment'=>13,
            'credit_id'=>1,
            'account_id'=>1,
            ]
        ]);
    }
}