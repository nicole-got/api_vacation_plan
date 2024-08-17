<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Holiday Plan</title>
</head>

<body style="font-size: 12px;">
    <!-- <h2 style="text-align: center">Contas</h2> -->

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #adb5bd;">
                <th style="border: 1px solid #ccc;">ID</th>
                <th style="border: 1px solid #ccc;">Title</th>
                <th style="border: 1px solid #ccc;">Description</th>
                <th style="border: 1px solid #ccc;">Date</th>
                <th style="border: 1px solid #ccc;">Participants</th>
            </tr>
        </thead>

        <tbody>
                <tr>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $holidayPlan->id }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $holidayPlan->title }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $holidayPlan->description }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $holidayPlan->date }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $holidayPlan->participants }}</td>
                </tr>
                <!-- <tr>
                    <td colspan="4">Not plan found!</td>
                </tr> -->
        </tbody>

    </table>
</body>

</html>
