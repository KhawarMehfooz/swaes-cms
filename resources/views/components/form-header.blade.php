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
