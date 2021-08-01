# About
This project exists to allow for easy inventory of systems by utilizing datamatrix codes to hold asset information.

| Feature      | Description |
| ----------- | ----------- |
| Header      | Title       |
| Paragraph   | Text        |

## Install / Usage
```docker
docker build -t datamatrix-inventory:latest .
docker run -p 443:443
```

## TODO
This project is a work in progress and the following tasks still need tyo be completed.
- Utilize Webpack, NPM, SASS to allow for faster development.
- add to csv from info entry screen
- scan normal barcodes option for entering asset numbers etc.
- Add polish with JS animations
- Allow for a remote server to be specified in the docker-compose to allow syncing of local tada to a remote database for datamatrix printing or storage

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

