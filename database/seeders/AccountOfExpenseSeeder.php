<?php

namespace Database\Seeders;

use App\Models\AccountOfExpense;
use Illuminate\Database\Seeder;

class AccountOfExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $expenses = [
            'Monthly Food Package Widows / Needy',
            'Ramadan Package / Eid Package',
            'Books Scheme / Stationery Orphan / Destitute',
            'Uniform Winter Package Students / Girls',
            'Semester Fee / Admission / Examination / Indigent Students',
            'Marriage Expenses of Poor Children',
            'Treatment (as needed)',
            'Renovation of Benches',
            'Office Exp / Office Almirah',
            'Photocopies, Printing & Office Stationery',
            'PenaFlex',
            'Expenditure Sewing Center (Shed) Other Equipment',
            'Electric Water Cooler Filter Stabilizer Equipment Fittings',
            'Signboard / Direction Board',
            'Bank Charges / Taxes + Cheque Book Charges',
            'Rent Shop Tent Service',
            'Rent Sewing Center',
            'Car Rental Expenses (Students) Kalah to Kotli',
            'Repairing Water Cooler / Replacement Filter / Jangla',
            'Distribution Sewing Machine Orphan / Widow / Destitute',
            'Salary Office Boy',
            'Salary Sewing Instructor (Teacher)',
            'Community Welfare',
            'Shields / Sewing Center Position Vision Holders / Others',
            'Electricity Bill Sewing Center Sharing',
            'Courier Charges',
            'Master Computer High School Malhar',
            'Library Expenses',
        ];

        foreach ($expenses as $expense) {
            AccountOfExpense::firstOrCreate(
                ['name' => $expense],
                ['description' => null]
            );
        }
    }
}
