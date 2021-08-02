<!DOCTYPE html>
<html lang="en">

<?php require_once 'header.php'; ?>
<body>

<div class="grid-container">
<div class="grid-x fluid">
    <div class="cell">
        <a href="/" class="button small expanded secondary">Back</a>
        <h3 class="text-center">Enter Asset Information</h3>
        <p class="text-center">Click "<i class="fas fa-barcode"></i> Scan" to scan barcodes. </p>
        <p class="text-center">Click "<i class="fas fa-thumbtack"></i>" to keep existing text. </p>

        <form id="datamatrix-form">
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="small-12 cell">
                        <div class="input-group">
                            <span class="input-group-label">Item / Category</span>
                            <input class="input-group-field" type="text" name="name" placeholder="'Z240 Workstation'">
                        </div>
                    </div>

                    <div class="small-12 cell">
                        <div class="input-group">
                            <span class="input-group-label">Manufacturer</span>
                            <input class="input-group-field" type="text" name="manufacturer" placeholder="'Hewlett Packard">
                        </div>
                    </div>

                    <div class="small-12 cell">
                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-label">Model</span>
                                <input class="input-group-field" id="model-tag-input" type="text" name="model" placeholder="Model">
                                <div class="input-group-button">
                                    <button type="button" class="button" onclick="scanBarcodeTag('model')"><i class="fas fa-barcode"></i> Scan</button>
                                </div>
                                <div class="input-group-button">
                                    <button type="button" class="button pin pinned" onclick="pinInput('model')"><i class="fas fa-thumbtack"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="modelTagReader"></div>
                    </div>


                    <div class="small-12 cell">
                        <div class="input-group">
                                <div class="input-group">
                                    <span class="input-group-label">Asset Tag</span>
                                    <input class="input-group-field" id="asset-tag-input" type="text" name="asset" placeholder="Asset Tag">
                                    <div class="input-group-button">
                                        <button type="button" class="button" onclick="scanBarcodeTag('asset')"><i class="fas fa-barcode"></i> Scan</button>
                                    </div>
                                    <div class="input-group-button">
                                        <button type="button" class="button pin" onclick="pinInput('asset')"><i class="fas fa-thumbtack"></i></button>
                                    </div>
                                </div>
                        </div>
                        <div id="assetTagReader"></div>
                    </div>

                    <div class="small-12 cell">
                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-label">Serial</span>
                                <input class="input-group-field" id="serial-tag-input" type="text" name="serial" placeholder="Serial">
                                <div class="input-group-button">
                                    <button type="button" class="button" onclick="scanBarcodeTag('serial')"><i class="fas fa-barcode"></i> Scan</button>
                                </div>
                                <div class="input-group-button">
                                    <button type="button" class="button pin" onclick="pinInput('serial')"><i class="fas fa-thumbtack"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="serialTagReader"></div>
                    </div>

                    <div class="small-12 cell">
                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-label">Product</span>
                                <input class="input-group-field" id="product-tag-input" type="text" name="product" placeholder="Product">
                                <div class="input-group-button">
                                    <button type="button" class="button" onclick="scanBarcodeTag('product')"><i class="fas fa-barcode"></i> Scan</button>
                                </div>
                                <div class="input-group-button">
                                    <button type="button" class="button pin" onclick="pinInput('product')"><i class="fas fa-thumbtack"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="productTagReader"></div>
                    </div>


                        <div class="small-12 cell">
                        <fieldset class="cell large-6">
                            <legend>Action</legend>
                            <input type="radio" name="action" value="Moved" id="formMoved" required=""><label for="formMoved">Moved</label>
                        </fieldset>
                    </div>


                    <div class="small-12 cell">
                        <div class="input-group">
                            <span class="input-group-label">Room #</span>
                            <input class="input-group-field" type="text" name="room" placeholder="Room / Location">
                        </div>
                    </div>

                    <div class="small-12 cell">
                        <div class="input-group">
                            <span class="input-group-label">To Room #</span>
                            <input class="input-group-field" type="text" name="toRoom" placeholder="To Room / Location">
                        </div>
                    </div>


                    <div class="small-12 cell">
                        <label>Notes
                            <textarea type="text" rows="8" name="notes" placeholder="..."></textarea>
                        </label>
                    </div>
                </div>
            </div>

            <button type="button" class="button expanded" onclick="matrix.create()">Create</button>
            <button type="button" class="button expanded secondary" onclick="matrix.createThenAdd()">Create & Append CSV</button>
        </form>

    </div>


    <!-- Datamatrix Display -->
    <div class="grid-x fluid">
        <div class="cell text-center">
            <!-- Datamatrix SVG container. Hidden by default since SVG is not easy to deal with from mobile -->
            <div id="datamatrix-svg" style="display: none;"></div>
            <div id="datamatrix-data"  style="display: none;"></div>

            <!-- Datamatrix PNG container. -->
            <img id="datamatrix-png">
        </div>
    </div>

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


</body>
</html>