<x-filament-panels::page>
    <style>
        .application-form {
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

            .application-form {
                min-height: auto !important;
                box-shadow: none;
                border-radius: 0;

            }

            #application-preview,
            #application-preview * {
                visibility: visible;
            }

            #application-preview {
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

    <div id="application-preview" class="application-form">
        <!-- Header -->
        <div class="header" style="width: 100%;">
            <table style="width: 100%; border: none;">
                <tr>
                    <!-- Logo on Left -->
                    <td style="width: 80px; text-align: left; vertical-align: middle; border: none;">
                        <img src="{{ asset('storage/' . $generalSettings->logo) }}" alt="Logo"
                            style="height: 70px; width: auto; object-fit:cover;">
                    </td>

                    <!-- Organization Info in Center -->
                    <td style="text-align: center; vertical-align: middle; border: none;">
                        <h2 style="margin: 0; font-size: 20px; font-weight: bold; text-transform: uppercase;">
                            {{ strtoupper($generalSettings->organization_name) }}<sup>&reg;</sup>
                        </h2>
                        <p style="margin: 0; font-size: 14px;">{{ $generalSettings->address }}</p>
                    </td>
                </tr>
            </table>
        </div>
        <hr>


        <table style="width:100%; margin:10px 0;">
            <tr>
                <td style="text-align:left; border: 0; font-style: italic;">
                    Ref No: {{ $record->id }}
                </td>
                <td style="text-align:right; border: 0;">
                    Dated: {{ \Carbon\Carbon::parse($record->dated)->format('d:m:Y') }}

                </td>

            </tr>
        </table>

        <h3 style="text-align:center; margin: 16px 0; font-size: 22px; font-weight: bold;">Application For Fees</h3>

        @php
            /** @var \App\Filament\Resources\FeeApplications\Pages\ViewFeeApplication $this */
            $record = $this->record;
        @endphp


        <!-- Applicant Details -->
        <table>
            <tr class="section-title">
                <td colspan="4">Applicant Details</td>
            </tr>
            <tr>
                <td>Name of Applicant</td>
                <td colspan="1">{{ $record->name }}</td>
                <td>Father Name</td>
                <td>{{ $record->father_name }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td colspan="3">{{ $record->address }}</td>
            </tr>
            <tr>
                <td>CNIC No.</td>
                <td colspan="3">{{ $record->cnic }}</td>
            </tr>
            <tr>
                <td>Institution Name</td>
                <td>{{ $record->institution_name }}</td>
                <td>Session</td>
                <td>{{ $record->session }}</td>
            </tr>
            <tr>
                <td>Total Fees</td>
                <td>{{ $generalSettings->currency_symbol }} {{ number_format($record->total_fee, 2) }}</td>
                <td>Bank</td>
                <td>{{ $record->bank }}</td>
            </tr>
            <tr>
                <td>Mobile No.</td>
                <td>{{ $record->mobile_number }}</td>
                <td>Challan No.</td>
                <td>{{ $record->chalan_number }}</td>
            </tr>
            <tr>
                <td style="">Additional Details</td>
                <td colspan="3">{{ $record->additional_details }}</td>
            </tr>
        </table>

        <!-- Guardian Details -->
        <table style="margin-top: 24px;">
            <tr class="section-title">
                <td colspan="4">Parent / Guardian Details</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $record->guardian_name }}</td>
                <td>Address</td>
                <td>{{ $record->guardian_address }}</td>
            </tr>
            <tr>
                <td>CNIC No.</td>
                <td>{{ $record->guardian_cnic }}</td>
                <td>Mobile No.</td>
                <td>{{ $record->guardian_mobile_number }}</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td colspan="3">{{ $generalSettings->currency_symbol }} {{ number_format($record->guardian_amount, 2) }}</td>
            </tr>
        </table>

        <table style="width:100%; margin-top:60px;">
            <tr>
                <td style="text-align:left; border: 0; font-weight: normal;">
                    Applicant Signature
                </td>
                <td style="text-align:right; border: 0;">
                    Parent / Guardian Signature
                </td>
            </tr>
        </table>

        <!-- Approval -->
        <div class="footer" style=" width: 200px">
            <p style="font-size: 14px; font-weight: bold;">Approved by</p>
            <p>{{ $generalSettings->president }} <small>(President)</small></p>
            <p style="font-size: 11px">{{ $generalSettings->organization_name }}<sup>&reg;</sup></p>
        </div>
    </div>

    <!-- PDF Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function printPreview() {
            window.print();
        }

        function downloadPDF() {
            const element = document.getElementById('application-preview');

            // Remove min-height temporarily
            const originalMinHeight = element.style.minHeight;
            element.style.minHeight = 'auto';

            const opt = {
                margin: [0, 0, 0, 0],
                filename: '{{ $record->id }}_Fee_Form_SWAES.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, scrollX: 0, scrollY: 0 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
            };


            html2pdf().from(element).set(opt).save().then(() => {
                // Restore min-height
                element.style.minHeight = originalMinHeight;
            });
        }


    </script>
</x-filament-panels::page>