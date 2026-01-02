<x-filament-panels::page>
    <style>
        .balance-sheet {
            width: 210mm;
            min-height: 297mm;
            padding: 10mm;
            background: #fff;
            color: #000;
            font-family: 'Times New Roman', serif;
            font-size: 14px;
            margin: 0 auto;
            position: relative;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border-radius: 2px;
        }

        .header,
        .footer {
            text-align: center;
            font-weight: bold;
        }

        .header img {
            height: 50px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            table-layout: fixed;
        }

        td {
            border: 1px solid #000;
            padding: 5px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            text-align: start;
            vertical-align: top
        }

        td:nth-child(1),
        td:nth-child(3) {
            width: 25%;
            font-weight: bold;
        }

        .section-title {
            text-align: center;
            font-weight: bold;
            background: #f2f2f2;
        }

        .signature {
            margin-top: 60px;
            text-align: right;
        }

        .footer {
            margin-top: 70px;
            margin-left: auto;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .balance-sheet {
                min-height: auto !important;
                box-shadow: none;
                border-radius: 0;

            }

            #balance-sheet-preview,
            #balance-sheet-preview * {
                visibility: visible;
            }

            #balance-sheet-preview {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
    <!-- Buttons -->
    <div class="mt-6 flex justify-center gap-4">
        <x-filament::button color="primary" icon="heroicon-o-printer" onclick="printPreview()">
            Print
        </x-filament::button>

        <x-filament::button color="info" icon="heroicon-o-document-arrow-down" onclick="downloadPDF()">
            Download PDF
        </x-filament::button>
    </div>

    <!-- Balance Sheet Start -->

    <div id="balance-sheet-preview" class="balance-sheet">

        <!-- Header -->
        <x-form-header />

        <hr>

        <h3 style="text-align:center; margin: 16px 0; font-size: 22px; font-weight: bold;">
            Balance Sheet - {{ \Carbon\Carbon::parse($record->month)->format('F Y') }}
        </h3>

        <!-- Opening Balance -->
        <table style="width: 100%; margin-bottom: 0px; border-collapse: collapse;">
            <tr>
                <td
                    style="font-weight: bold; border: 1px solid #ddd; border-bottom: none; border-right:none; padding: 8px;">
                    Opening Balance:</td>
                <td
                    style="font-weight: bold; text-align: right; border: 1px solid #ddd; border-bottom: none; border-left: none; padding: 8px;">
                    {{ $generalSettings->currency_symbol . ' ' . number_format($record->opening_balance, 2) }}
                </td>
            </tr>
        </table>

        <!-- Transactions Table -->
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
            <thead>
                <tr style="background-color: #f3f3f3; text-align: left;">
                    <th style="padding: 8px; border: 1px solid #ddd;">Date</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Particulars</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align:right;">Debit (Expense)</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align:right;">Credit (Income)</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align:right;">Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $transactions = $record->transactions()->with('accountOfExpense')->orderBy('created_at')->get();
                    $runningBalance = $record->opening_balance;
                @endphp

                @forelse($transactions as $transaction)
                    @php
                        if ($transaction->type === 'income') {
                            $credit = $transaction->amount;
                            $debit = 0;
                            $runningBalance += $credit;
                        } elseif ($transaction->type === 'expense') {
                            $debit = $transaction->amount;
                            $credit = 0;
                            $runningBalance -= $debit;
                        }
                    @endphp
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;">
                            {{ $transaction->created_at->format('d M Y') }}
                        </td>
                        <td style="padding: 8px; border: 1px solid #ddd;">
                            @if ($transaction->type === 'expense' && $transaction->accountOfExpense)
                                {{ $transaction->accountOfExpense->name }}
                            @else
                                {{ $transaction->purpose }}
                            @endif
                        </td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align:right;">
                            {{ $debit ? number_format($debit, 2) : '-' }}
                        </td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align:right;">
                            {{ $credit ? number_format($credit, 2) : '-' }}
                        </td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align:right;">
                            {{ number_format($runningBalance, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 12px; border:none;">
                            No transactions found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr style="font-weight: bold; background-color: #f9f9f9;">
                    <td colspan="4" style="padding: 8px; border: 1px solid #ddd;">Closing Balance</td>
                    <td style="padding: 8px; border: 1px solid #ddd; text-align:right;">
                        {{ $generalSettings->currency_symbol . ' ' . number_format($runningBalance, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>


    </div>

    <!-- Balance  sheet end -->


    <!-- PDF Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function printPreview() {
            window.print();
        }

        function downloadPDF() {
            const element = document.getElementById('balance-sheet-preview');

            // Remove min-height temporarily
            const originalMinHeight = element.style.minHeight;
            element.style.minHeight = 'auto';

            const opt = {
                margin: [0, 0, 0, 0],
                filename: '{{ $record->month }}_Balance_Sheet.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    scrollX: 0,
                    scrollY: 0
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                }
            };


            html2pdf().from(element).set(opt).save().then(() => {
                // Restore min-height
                element.style.minHeight = originalMinHeight;
            });
        }
    </script>

</x-filament-panels::page>
