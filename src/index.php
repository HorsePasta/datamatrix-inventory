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
<?php require_once 'table.php'; ?>

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