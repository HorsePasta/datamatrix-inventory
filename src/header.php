<head>
    <meta charset="utf-8" />
    <!-- IE support and mobile width init -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Inventory V2.0.0</title>

    <!-- Javascript libraries -->
    <script src="dist/js/html5-qrcode.min.js"></script>
    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/toastr.min.js"></script>
    <script src="dist/js/pouchdb.min.js"></script>
    <script src="dist/js/datamatrix.min.js"></script>
    <script src="dist/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/solid.min.js" integrity="sha512-Qc+cBMt/4/KXJ1F6nNQahXIsgPygHM4S2XWChoumV8qkpZ9oO+gBDBEpOxgbkQQ/6DlHx6cUxa5nBhEbuiR8xw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- CSS -->
    <link href="dist/css/toastr.css" rel="stylesheet"/>
    <link href="dist/css/foundation.css" rel="stylesheet"/>
    <link href="dist/css/custom.css"  rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Get the current CSV and init manageCsv,matrix,scanner -->
    <script>
        manageCsv();
        matrix()
        manageCsv.get()
        scanner()
    </script>

</head>