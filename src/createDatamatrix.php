<!DOCTYPE html>
<html lang="en">

<?php require_once 'header.php'; ?>
<script>
    managePinStatus.getCurrentPins()
</script>
<body>

<div class="grid-container">
<div class="grid-x fluid">
    <div class="cell">
        <a href="/" class="button small expanded secondary">Back</a>
        <h3 class="text-center">Enter Asset Information</h3>
        <p class="text-center">Click "<i class="fas fa-barcode"></i> Scan" to scan barcodes. </p>
        <p class="text-center">Click "<i class="fas fa-thumbtack"></i>" to keep existing text between page reloads. </p>

        <form id="datamatrix-form">
            <div class="grid-container">
                <div class="grid-x grid-padding-x">

                    <div class="small-12 cell">
                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-label">Item / Category</span>
                                <input class="input-group-field" id="name-tag-input" type="text" name="name" placeholder="Z240 Workstation"  onchange="managePinStatus.enablePinButton('name');">
                                <div class="input-group-button">
                                    <button type="button" class="button" onclick="scanBarcodeTag('name')"><i class="fas fa-barcode"></i> Scan</button>
                                </div>
                                <div class="input-group-button">
                                    <button type="button" class="button pin" disabled id="namePin" onclick="managePinStatus.togglePin('name')"><i class="fas fa-thumbtack"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="nameTagReader"></div>
                    </div>

                    <div class="small-12 cell">
                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-label">Manufacturer</span>
                                <input class="input-group-field" id="manufacturer-tag-input" type="text" name="manufacturer" placeholder="HP"  onchange="managePinStatus.enablePinButton('manufacturer');">
                                <div class="input-group-button">
                                    <button type="button" class="button" onclick="scanBarcodeTag('manufacturer')"><i class="fas fa-barcode"></i> Scan</button>
                                </div>
                                <div class="input-group-button">
                                    <button type="button" class="button pin" disabled id="manufacturerPin" onclick="managePinStatus.togglePin('manufacturer')"><i class="fas fa-thumbtack"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="manufacturerTagReader"></div>
                    </div>

                    <div class="small-12 cell">
                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-label">Model</span>
                                <input class="input-group-field" id="model-tag-input" type="text" name="model" placeholder="Model"  onchange="managePinStatus.enablePinButton('model');">
                                <div class="input-group-button">
                                    <button type="button" class="button" onclick="scanBarcodeTag('model')"><i class="fas fa-barcode"></i> Scan</button>
                                </div>
                                <div class="input-group-button">
                                    <button type="button" class="button pin" disabled id="modelPin" onclick="managePinStatus.togglePin('model')"><i class="fas fa-thumbtack"></i></button>
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
                            </div>
                        </div>
                        <div id="serialTagReader"></div>
                    </div>

                    <div class="small-12 cell">
                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-label">Product</span>
                                <input class="input-group-field" id="product-tag-input" type="text" name="product" placeholder="Product"  onchange="managePinStatus.enablePinButton('product');">
                                <div class="input-group-button">
                                    <button type="button" class="button" onclick="scanBarcodeTag('product')"><i class="fas fa-barcode"></i> Scan</button>
                                </div>
                                <div class="input-group-button">
                                    <button type="button" class="button pin" disabled id="productPin" onclick="managePinStatus.togglePin('product')"><i class="fas fa-thumbtack"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="productTagReader"></div>
                    </div>

                    <div class="small-12 cell">
                        <div class="input-group">
                            <div class="input-group">
                                <span class="input-group-label">MAC Address</span>
                                <input class="input-group-field" id="mac-tag-input" type="text" name="mac" placeholder="00:00:00:00:00:00">
                                <div class="input-group-button">
                                    <button type="button" class="button" onclick="scanBarcodeTag('mac')"><i class="fas fa-barcode"></i> Scan</button>
                                </div>
                            </div>
                        </div>
                        <div id="macTagReader"></div>
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
<?php require_once 'table.php'; ?>


</body>
</html>