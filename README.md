# About
This project exists to allow for easy inventory of systems by utilizing datamatrix codes to hold asset information.

## Install / Usage

###Update an existing image
```bash
git clone https://github.com/HorsePasta/datamatrix-inventory.git .
```

###Build the image.
```docker
docker build -t datamatrix-inventory:latest .
```

###Run the container via command.
```docker
docker run -itd -p 443:443 datamatrix-inventory:latest
```

###Run the container via docker-compose
```docker-compose
todo
```

##Build with specific branch
```docker
docker build -t datamatrix-inventory:2.1 https://github.com/HorsePasta/datamatrix-inventory.git#2.1
```



## TODO
This project is a work in progress and the following tasks still need tyo be completed.

| Feature      | Version Expected | Status |
| ----------- | ----------- | ----------- |
| Scan normal barcodes option for entering asset,model,serial,etc.  | 2.1.x |🚧|
| Allow pinning of fields for easy input of repeat data             | 2.1.x |✅|
| Update notifier                                                   | 2.2.x |⭕|
| Auto updater                                                      | 2.3.x |⭕|
| Utilize Webpack, NPM, SASS to allow for faster development        | 3.x |⭕|
| Implement service works for fully offline functionality           | 3.x |⭕|
| Auto versioning support                                           | 3.x |⭕|
| Allow for external camera select for better laptop support        | 3.x |⭕|
| Allow for external USB IR scanners                                | 3.x |⭕|
| Email finished CSV or upload to location / remote path            | 3.x |🚧|
| Run or build options with custom domain + ssl via lets encrypt    | 3.x |⭕|
| Add polish with JS animations                                     | 3.x |⭕|

#Data Structure
- Device Information
    - Item Name 
    - Category 
    - Model name 
    - Manufacturer 
    - Model Number 
    - Serial number 
    - Asset Tag 
    - Location 
    - To Location 
    - Action 
    - Notes 

