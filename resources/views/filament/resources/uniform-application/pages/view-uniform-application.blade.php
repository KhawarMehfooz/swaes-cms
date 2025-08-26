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
        <x-form-header />

        <hr>

        <table style="width:100%; margin:10px 0;">
            <tr>
                <td style="text-align:left; border: 0; font-style: italic;">
                    Ref No: {{ $record->id }}
                </td>
                <td style="text-align:right; border: 0;">
                    Dated: {{ \Carbon\Carbon::parse($record->application_date)->format('d/m/Y') }}

                </td>

            </tr>
        </table>

        <h3 style="text-align:center; margin: 16px 0; font-size: 22px; font-weight: bold;">Registration Form</h3>
        <h3 style="text-align:center; margin: 16px 0; font-size: 20px; font-weight: 600;">Free Uniform Scheme for Year
            <span class="">{{ $record->scheme_year }}</span></h3>

        @php
            /** @var \App\Filament\Resources\FeeApplications\Pages\ViewFeeApplication $this */
            $record = $this->record;
        @endphp


        <!-- Applicant Details -->
        <table>
            <tr class="section-title">
                <td colspan="4" style="text-align: center;">Student Details</td>
            </tr>
            <tr>
                <td>Name of Applicant</td>
                <td colspan="1">{{ $record->student_name }}</td>
                <td>Father/Guardian Name</td>
                <td>{{ $record->guardian_name }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td colspan="3">{{ $record->student_address }}</td>
            </tr>
            <tr>
                <td>Guardian CNIC No.</td>
                <td>{{ $record->guardian_cnic }}</td>
                <td>Guardian Mobile No.</td>
                <td>{{ $record->guardian_contact_number }}</td>
            </tr>
            <tr>
                <td>Guardian Source of Income</td>
                <td colspan="3">{{ $record->guardian_source_of_income ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Institution Name</td>
                <td>{{ $record->institution_name }}</td>
                <td>Class</td>
                <td>{{ $record->class }}</td>
            </tr>
        </table>

        <!-- Uniform Details -->
        <table style="margin-top: 24px;">
            <tr class="section-title">
                <td colspan="4" style="text-align: center;">Uniform Details</td>
            </tr>
            <tr style="border: 1px solid">
                <th style="border: 1px solid" colspan="2">Item Name</th>
                <th style="border: 1px solid" colspan="2">Details</th>
            </tr>
            @foreach($record->uniform_details as $detail)
                <tr>
                    <td colspan="2">{{ $detail['item_name'] }}</td>
                    <td colspan="2">{{ $detail['item_detail'] }}</td>
                </tr>
            @endforeach
        </table>

        <table style="width:100%; margin-top:80px;">
            <tr>
                <td style="text-align:left; border: 0; font-weight: normal;">
                    Applicant Signature
                </td>
                <td style="text-align:center; border: 0; font-weight: normal;">
                    Parents/ Guardian Signature
                </td>
                <td style="text-align:right; border: 0; font-weight: normal;">
                    Signature/ Stamp School/College Principal
                </td>


            </tr>
        </table>

        <!-- Approval -->
        <x-form-footer />
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
                filename: '{{ $record->id }}_Uniform_Application_SWAES.pdf',
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