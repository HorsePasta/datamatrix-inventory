<!DOCTYPE html>
<html lang="en">
<!-- Include the header so it is the same across all pages -->
<?php require_once 'header.php'; ?>

<body>
<!-- Home page buttons -->
<div class="grid-x fluid">
    <div class="cell">
        <!-- Start the scanner -->
        <button type="button" id="start-scanner" class="button expanded secondary" onclick="scanner.start()">Scan Code</button>
        <!-- Create a code -->
        <a href="createDatamatrix.php" class="button info expanded">Create Data Matrix</a>

        <!-- Scanner container placeholder -->
        <div id="reader"></div>

        <!-- Data display for current code placeholder --->
        <div class="asset-data" id="asset-data"></div>
    </div>
</div>

<!-- CSV Container -->
<div class="grid-x fluid">
    <div class="cell">
    <div class="csv-display" id="csv-display">
        <!-- CSV Table -->
        <h4 class="text-center">Scanned Assets</h4>
        <div class="table-scroll">
        <table id="csv-display-table">
            <tbody>
            <tr>
                <th>Name</th>
                <th>Manufacturer</th>
                <th>Model</th>
                <th>Asset Tag</th>
                <th>Serial</th>
                <th>Product #</th>
                <th>Room#</th>
                <th>Action</th>
                <th>To Room#</th>
                <th>Notes</th>
                <th></th>
            </tr>
            </tbody>

            <tbody id="csv-display-table-data"></tbody>

        </table>
        </div>

        <button type="button" id="csv-reset" class="button  alert float-left" onclick="manageCsv.clear()">Clear CSV</button>
        <button type="button" id="csv-save" class="button  primary float-right" onclick="manageCsv.save()">Save CSV</button>
    </div>
    </div>
</div>

<!-- Datamatrix Display -->
<div class="grid-x fluid">
    <div class="cell text-center">
        <!-- Datamatrix SVG container. Hidden by default since SVG is not easy to deal with from mobile -->
        <div id="datamatrix-svg" style="display: none;"></div>

        <!-- Datamatrix PNG container. -->
        <img id="datamatrix-png">
    </div>
</div>


</body>
</html>