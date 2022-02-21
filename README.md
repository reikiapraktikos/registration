## SET UP
```console
make init
```
## Usage
### CREATE
```console
docker exec -it backend php index.php create test test@gmail.com 861111111 'random 123' '2000-01-01 00:00:00'
```
- name - test 
- email - test@gmail.com
- phone number - 861111111 (Format: LT format)
- address - random 123
- date - 2000-01-01 00:00:00 (Format: Y-m-d H:i:s)
### UPDATE
```console
docker exec -it backend php index.php update 1 test test@gmail.com 861111111 'random 123' '2000-01-01 00:00:00'
```
- id - 1
- name - test (Optional)
- email - test@gmail.com (Optional)
- phone number - 861111111 (Format: LT format, Optional)
- address - random 123 (Optional)
- date - 2000-01-01 00:00:00 (Format: Y-m-d H:i:s, Optional)
### FIND
```console
docker exec -it backend php index.php find 2000-01-01 desc 0 100
```
- date - 2000-01-01 (Format: Y-m-d)
- order - desc (Default: asc, Optional)
- offset - 0 (Default: 0, Min: 0, Optional)
- limit - 100 (Default: 0, Max: 10000, Optional)

### DELETE
```console
docker exec -it backend php index.php delete 1
```
- id - 1
