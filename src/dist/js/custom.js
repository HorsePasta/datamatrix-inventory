toastr.options = {
    "debug": false,
    "positionClass": "toast-bottom-full-width",
    "onclick": null,
    "fadeIn": 300,
    "fadeOut": 1000,
    "timeOut": 2500,
    "extendedTimeOut": 1000,
    "preventDuplicates": true
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///// Function matrix()
// The matrix() function manages the creation of the data matrix for all components.
// matrix.create() takes data from the #datamatrix-form or in a json/object format.
// matrix.createPng() creates the saveable / printable datamatrix card with some basic information to allow for ID
// matrix.addCsv() calls teh manageCsv.add() function to add the current datamatrix to the exportable CSV
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function matrix() {
    function create(data) {
        console.log('matrix.create')

        if (data == null) {
            //If we dont pass existing data with "data" then build the object and json
            const formData = $('#datamatrix-form').serializeArray()
            const formObject = {}
            formData.forEach(function (input) {
                if (input.value === undefined || input.value == "" ) {
                    formObject[input.name] = "N/A"
                } else {
                    formObject[input.name] = input.value
                }
            })
            //If we pass existing data with "data" create the SVG that way
            data = formObject
            svgNode = DATAMatrix(JSON.stringify(data));
        }

        //Create the SVG and place it in the datamatrix-svg element
        svgNode = DATAMatrix(JSON.stringify(data));
        $('#datamatrix-svg').html(svgNode)

        //TODO device if datamatrix-data should be a temp cache database here
        //Place the generated data into the #datamatrix-data hidden element
        $('#datamatrix-data').data('datamatrix',JSON.stringify(data))

        $('#datamatrix-png').html('<canvas id="datamatrix-canvas" width="256" height="300" style="display: none"></canvas>')

        createPng(data);
    }

    function read() {
        console.log('matrix.read')
    }

    function createPng(data) {
        console.log('matrix.createPng')
        //TODO device if datamatrix-data should be a temp cache database here as well
        //Get the svg data from the page element
        let svg = new XMLSerializer().serializeToString($('#datamatrix-svg svg')[0]);
        //Init the canvas we will use to create the png. Set size and properties here.
        let canvas = $('#datamatrix-canvas')[0]
        let ctx = canvas.getContext("2d");
        let DOMURL = self.URL || self.webkitURL || self;
        let svgPng = new Image();
        svgPng.src = DOMURL.createObjectURL(new Blob([svg], {type: "image/svg+xml;charset=utf-8"}));
        //draw the svg and text to the png canvas to display it.
        svgPng.onload = function() {
            //Draw datamatrix to canvas
            ctx.drawImage(svgPng, 0, 0);

            //Draw text info to the datamatrix
            ctx.font = "14px Arial";
            ctx.fillText("Name: "+data['name'],10,270);
            ctx.fillText("Asset: "+data['asset'],10,290);

            //Create the png data blob
            var png = canvas.toDataURL("image/png");
            //Change the source of the datamatrix-png to be the png data blob
            $('#datamatrix-png').attr('src',png)
            DOMURL.revokeObjectURL(png);
        };
    }

    function createThenAdd() {
        matrix.create()
        matrix.addCsv()
    }

    function addCsv() {
        console.log('matrix.addCsv')
        const data = $('#datamatrix-data').data('datamatrix')
        console.log(data)
        manageCsv.add(JSON.parse(data))
    }

    matrix.create = create;
    matrix.read = read;
    matrix.addCsv = addCsv;
    matrix.createThenAdd = createThenAdd;
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///// Function manageCsv()
// The manageCsv() function manages the csv creation and management.
// manageCsv.get() fetches the current CSV stored in the browser store. If it does not exist it is created.
// manageCsv.add() adds assets to the CSV database.
// manageCsv.remove() removes a line from the CSV
// manageCsv.clear() clears all lines from the CSV
// manageCsv.save() generates and saves the CSV to the device //TODO implement this
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function manageCsv() {
    function get() {
        console.log('csv.get')

        const db =  new PouchDB('csv-database');
        db.allDocs({
            include_docs: true
        }).then(function (result) {
            $('#csv-display-table-data').html('')
            result.rows.forEach(function(row){
                $('#csv-display-table-data').append(`
                <tr data-raw-json='${row.doc.asset['asset']}'>
                    <td>${row.doc.asset['name']}</td>
                    <td>${row.doc.asset['manufacturer']}</td>
                    <td>${row.doc.asset['model']}</td>
                    <td>${row.doc.asset['asset']}</td>
                    <td>${row.doc.asset['serial']}</td>
                    <td>${row.doc.asset['product']}</td>
                    <td>${row.doc.asset['room']}</td>
                    <td>${row.doc.asset['action']}</td>
                    <td>${row.doc.asset['toRoom']}</td>
                    <td>${row.doc.asset['notes']}</td>
                    <td><button type="button" class="button small radius " onclick='matrix.create(${JSON.stringify(row.doc.asset)})'>Make Code</button>
                    <button type="button" class="button small radius alert" onclick="manageCsv.remove('${row.doc.asset['asset']}')">Remove</button></td>
                </tr>
            `);
            })
        }).catch(function (err) {
            console.error(err);
        });

    }

    function add(data) {
        //TODO add already exists message and check
        console.log('csv.add')
        console.log(data)

        //TODO probably verify data is an object not string/json

        //Init new or existing database
        const db =  new PouchDB('csv-database');

        db.get(data.asset).catch(function (err) {
            //If the asset does not exist we need to build the doc
            if (err.name === 'not_found') {
                return {
                    _id: data.asset,
                    title: data.asset,
                    asset: data
                };
            } else { // hm, some other error
                throw err;
            }
        }).then(function (configDoc) {
            //Take the new doc and add it to the db
            db.put(configDoc);
        }).then(function () {
            manageCsv.get()
            toastr.success('Added to CSV')
        }).catch(function (err) {
            // handle any errors
            console.error(err)
        });

    }

    function remove(data) {
        console.log('csv.remove')

        const db =  new PouchDB('csv-database');
        db.get(data).then(function(doc) {
            return db.remove(doc);
        }).then(function (result) {
            toastr.success('Asset removed from CSV')
            manageCsv.get()
        }).catch(function (err) {
            console.log(err);
        });
    }

    function clear() {
        console.log('csv.clear')
        new PouchDB('csv-database').destroy().then(function () {
            new PouchDB('csv-database');
            location.reload()
        });
    }


    function save() {
        console.log('csv.save')
        const db =  new PouchDB('csv-database');
        let rows = []
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent +=  "Name,Manufacturer,Model,Asset Tag,Serial,Product Number,Room,Action,To Room,Notes\r\n"

        db.allDocs({
            include_docs: true
        }).then(function (results) {
            results.rows.forEach(function (result) {
                rows.push(Object.values(result.doc.asset))
            })
        }).then(function () {
            rows.forEach(function(rowArray) {
                console.log(rowArray)
                let row = rowArray.join(",")
                if (typeof row == "undefined") {
                    row = '';
                }
                row = row.replace(/(\r\n|\n|\r)/gm, " ");
                console.log(row)
                csvContent += row + "\r\n";
            });
            let encodedUri = encodeURI(csvContent);
            let link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "scanned-assets.csv");
            document.body.appendChild(link);

            link.click();

        }).catch(function (err) {
            console.error(err);
        });

    }

    manageCsv.clear = clear;
    manageCsv.remove = remove;
    manageCsv.add = add;
    manageCsv.get = get;
    manageCsv.save = save;
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///// Function scanner()
// The scanner() function handles the main datamatrix scanner and display of currently scanned data
// scanner.start() starts the datamatrix scanner and triggers scan success callback.
// scanner.scanResult() shows the last scanned data with the option to add to CSV or scan more.
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function scanner() {
    console.log('scanner')
    function start() {
        console.log('scanner.start')
        const readerDom = $('#reader')
        readerDom.show()
        const scanWidth = $( window ).width() * 0.80;
        const config = {
            fps: 8,
            qrbox: scanWidth,
            aspectRatio:1.0
        };

        //Init the scanner
        const html5QrCode = new Html5Qrcode("reader", { formatsToSupport: [ Html5QrcodeSupportedFormats.DATA_MATRIX ] });

        //Callback on success
        function scanSuccess(decodedText,decodedResult) {
            console.log('scanner.scanSuccess')
            ///DEBUG

            console.debug(`Code matched = ${decodedText}`, decodedResult);
            ///DEBUG END

            //Parse the json from the scan into a js object and show asset data
            scanner.scanResult(JSON.parse(decodedText));
            //addAssetData(qrCodeData.at,qrCodeData)
            readerDom.hide()
            html5QrCode.stop()
            toastr.success('Scanned');
            readerDom.hide()
        }

        html5QrCode.start({ facingMode: "environment" }, config, scanSuccess);
        $('#start-scanner').remove()
    }

    function scanResult(data) {
        console.log('scanner.scanResult')

        assetHtml = `
        <div class="grid-x">
            <div class="cell small-6" >
            <div class="asset-data-text ">
                <p><b>Name:</b> ${data['name']}<p>
                <p><b>Manufacturer:</b> ${data['manufacturer']}<p>
                <p><b>Asset Tag:</b> ${data['asset']}<p>
                <p><b>Serial:</b> ${data['serial']}<p>
                <p><b>Model:</b> ${data['model']}<p>
                <p><b>Product #:</b> ${data['product']}<p>
            </div>
            </div>
            
            <div class="cell small-6" >
            <div class="asset-data-text">
                <p><b>Room:</b> ${data['room']}<p>
                <p><b>Action:</b> ${data['action']}<p>
                <p><b>To Room:</b> ${data['toRoom']}<p>
            </div>
            </div>
            <div class="cell small-12" >
            <div class="asset-data-text">
                <p><b>Notes:</b> ${data['notes']}<p>
            </div>
            </div>
        </div>
        
        <button type="button" class="secondary button expanded radius large" id="csv-add" onclick='manageCsv.add(${JSON.stringify(data)})'>Add to CSV</button>
        <button type="button" class="primary button expanded radius large"  onclick='scanner.start()'>Scan Another</button>
        <br>
        `;

        $('#asset-data').html(assetHtml);
    }

    scanner.start = start;
    scanner.scanResult = scanResult;

}


//////////////////////////////////////////////////
//////////////////////////////////////////////////
//////////////////////////////////////////////////
//////////////////////////////////////////////////

/*
function addAssetData(id, assetData, database = 'asset-data') {
    //Init new or existing database
   const db =  new PouchDB(database);

    db.get(id).catch(function (err) {
        //If the asset does not exist we need to build the doc

        if (err.name === 'not_found') {
            console.log(err)
            return {
                _id: id,
                title: id,
                asset: assetData
            };
        } else { // hm, some other error
            throw err;
        }
    }).then(function (configDoc) {
        //Take the new doc and add it to the db
        db.put(configDoc);
    }).catch(function (err) {
        // handle any errors
    });

    db.allDocs({
        include_docs: true
    }).then(function (result) {
        result.rows.forEach(row => console.log(row.doc))
    }).catch(function (err) {
        console.error(err);
    });
}

 */

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///// Function scanAssetTag()
// The scanAssetTag() function allows for scanning of asset tag barcodes into the asset-tag field of createDatamatrix.
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function scanBarcodeTag(scanId) {
    console.log('scanAssetTag')

    const  readerId = scanId+'TagReader';
    const readerDom = $('#'+readerId)
    readerDom.show()
    const scanWidth = readerDom.width() * 0.95;
    const config = {
        fps: 8
    };

    function onScanSuccess(decodedText, decodedResult) {
        ///DEBUG
        console.debug(`Code matched = ${decodedText}`, decodedResult);
        ///DEBUG END

        // Add the result to the asset text field
        $('#'+scanId+'-tag-input').val(decodedText)
        toastr.success('Scanned '+scanId+' Tag');
        html5QrCode.stop()
        readerDom.hide()
    }

    const html5QrCode = new Html5Qrcode(readerId, {
        experimentalFeatures: {
            useBarCodeDetectorIfSupported: true
        }

    });
    html5QrCode.start({ facingMode: "environment" }, config, onScanSuccess);
}




