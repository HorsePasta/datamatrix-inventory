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
                        <th>Make</th>
                        <th>Model</th>
                        <th>Asset Tag</th>
                        <th>Serial</th>
                        <th>Product #</th>
                        <th>MAC</th>
                        <th>Action</th>
                        <th>Room#</th>
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