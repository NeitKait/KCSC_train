# task 6: cơ bản về sql và nghìn lẻ một cách truy vấn

Về cơ bản, SQL là một ngôn ngữ tiêu chuẩn để lưu trữ, thao tác và truy xuất dữ liệu trong cơ sở dữ liệu.

Một cơ sở dữ liệu thường chứa một hoặc nhiều bảng. Mỗi bảng được xác định bằng một tên. Bảng chứa các bản ghi với dữ liệu. Trong task này chúng ta sẽ sử dụng mẫu database Northwind.
![](https://i.imgur.com/NaPcoqn.png)

# Một số câu lệnh phổ biến. 

## SELECT 
dùng để truy xuất dữ liệu từ cơ sở dữ liệu Dữ liệu trả về được lưu trữ trong một bảng, được gọi là result-set.

cú pháp: 
SELECT 'cột' FROM 'bảng'; 
ví dụ có thể chọn tất cả các cộ trong bảng customers với cú pháp: SELECT * FROM Customers;
![](https://i.imgur.com/UmLtIW6.png)
tương tự với chọn từng cột trong bảng bằng cách thay * bằng tên cột.

## SELECT DISTINCT
trả về các giá trị khác nhau tại một cột của một bảng. Nếu có 2 hoặc nhiều hơn giá trị giống nhau thì sẽ chỉ trả về 1 giá trị. 
ví dụ có thể tìm các giá trị khác nhau tại cột country từ bảng customer với cú pháp: SELECT DISTINCT Country FROM Customers;
![](https://i.imgur.com/tVMvIPA.png)

## Mệnh đề WHERE
dùng  để lọc dữ liệu, chỉ truy vấn dữ liệu thoả mãn điều kiện trong mệnh đề WHERE

cú pháp: 
SELECT column1, column2, ...
FROM table_name
WHERE condition;

ví dụ: có thể chọn tất cả mọi người trong bảng có country từ mexico với cú pháp: SELECT * FROM Customers
WHERE Country='Mexico';
![](https://i.imgur.com/EMvuQE6.png)

## ORDER BY
dùng để sắp xếp result-set theo thứ tự tăng dần hoặc giảm dần, mặc định là tăng dần. còn nếu ký tự là chữ thì sẽ sắp xếp theo bảng chữ cái. có thể chọn asc nếu là tăng và desc là giảm.
cú pháp: 
SELECT column1, column2, ...
FROM table_name
ORDER BY column1, column2, ... ASC|DESC;

ví dụ: có thể chọn tất cả mọi người trong bảng theo thứ tự tăng dần theo bảng chữ cái của country. 
![](https://i.imgur.com/N6R2pUA.png)

## toán tử

có thể được dùng linh hoạt các toán tử như '>''<' '!=' '=' '<=' '>=' linh hoạt cùng với WHERE để lọc ra những đối tượng cần tìm kiếm. 
ví dụ muốn tìm kiếm những đối tượng giá lớn hơn 53 sẽ có cú pháp: SELECT * FROM Products
WHERE Price >= 53;
![](https://i.imgur.com/nuLwX8Y.png)

## toán tử and, or, not
AND chọn bản ghi nếu các điều kiện là TRUE OR chọn bản ghi nếu một trong các điều kiện là TRUE NOT chọn bản ghi nếu điều kiện là FALSE

cú pháp:
 
 AND: 
SELECT column1, column2, ...
FROM table_name
WHERE condition1 AND condition2 AND condition3 ...;

 OR
 SELECT column1, column2, ...
FROM table_name
WHERE condition1 OR condition2 OR condition3 ...;
 
 NOT
 SELECT column1, column2, ...
FROM table_name
WHERE NOT condition;

ví dụ: SELECT * FROM Customers
WHERE NOT Country='Germany' AND NOT Country='USA'; 
![](https://i.imgur.com/FoFuZfj.png)

## INSERT INTO
dùng để chèn bản ghi mới vào bảng
có 2 cách sử dụng. 
Chỉ định tên cột được chèn Syntax:
INSERT INTO table_name (column1, column2, column3, ...)
VALUES (value1, value2, value3, ...);

Trong trường hợp thêm giá trị cho tất cả các cột thì không cần chỉ định tên cột Syntax:
INSERT INTO table_name
VALUES (value1, value2, value3, ...);

ví dụ: 
INSERT INTO Customers (CustomerName, City, Country)
VALUES ('Cardinal', 'Stavanger', 'Norway');
![](https://i.imgur.com/OGuyp7D.png)

## DELETE
dùng để xóa bản ghi hiện có trong bảng. 
cú pháp: DELETE FROM table_name WHERE condition;
Xoá tất cả bản ghi, giữ nguyên cấu trúc bảng Syntax: DELETE FROM table_name;

ví dụ : Xoá tất cả bản ghi, giữ nguyên cấu trúc bảng Syntax: DELETE FROM table_name;
ban đầu : 
![](https://i.imgur.com/6tOidVa.png)
sau xóa:
![](https://i.imgur.com/mtKzd8F.png)


## JOIN
dùng để kết hợp các hàng có liên quan từ 2 bảng thành 1 bảng.
có 4 kiểu join
 
 ### INNER JOIN
 Kết hợp những hàng có chung CustomerID thành một bảng (những hàng không liên quan sẽ được bỏ qua), sau đó SELECT OrderID và CustomersName
 cú pháp: 
 SELECT column_name(s)
FROM table1
INNER JOIN table2
ON table1.column_name = table2.column_name;

![](https://i.imgur.com/XljJqyv.png)

 ### LEFT JOIN
 Trả về CustomerName của toàn bộ bảng bên trái (Customers), và OrderID của bản ghi phù hợp từ bảng bên phải (Oders). nếu bảng bên phải không có bản ghi phù hợp với bảng bên trái, OrderID là null
 cú pháp:
 SELECT column_name(s)
FROM table1
LEFT JOIN table2
![](https://i.imgur.com/9WXkOJz.png)

### RIGHT JOIN
Trả về LastName, FirstName của toàn bộ bảng bên phải (Employees) và OrderID của bản ghi phù hợp từ bảng bên trái (Oders). nếu bảng bên trái không có bản ghi phù hợp với bảng bên phải, OrderID là null
cú pháp: 
SELECT column_name(s)
FROM table1
RIGHT JOIN table2
ON table1.column_name = table2.column_name;
![](https://i.imgur.com/4NoyIFO.png)

### FULL OUTER JOIN
Trả về tất cả các bản ghi từ cả hai bảng, các bản ghi không liên quan với nhau được trả về giá trị null phù hợp
cú pháp: 
SELECT column_name(s)
FROM table1
FULL OUTER JOIN table2
ON table1.column_name = table2.column_name
WHERE condition;
![](https://i.imgur.com/C8EX8pH.png)

### SELF JOIN 
SELF JOIN dùng để kết hợp một bảng với chính nó Syntax:
cú pháp: 
SELECT column_name(s)
FROM table1 T1, table1 T2
WHERE condition;
phần này em cũng chưa hiểu lắm đang tìm hiểu thêm. 

## UNION
UNION là toán tử dùng để kết hợp result-set của hai hay nhiều câu lệnh SELECT

Các result-set phải có cùng số cột
Các cột phải có kiểu dữ liệu giống nhau
Các cột trong result-set phải có cùng thứ tự Syntax:

cú pháp:
SELECT column_name(s) FROM table1
UNION
SELECT column_name(s) FROM table2;
ví dụ: 
customers table: 
![](https://i.imgur.com/h1SuA8N.png)
SELECT City FROM Customers
UNION
SELECT City FROM Suppliers
ORDER BY City;

Nếu customer và suppliers đến từ cùng một thành phố thì thành phố chỉ được liệt kê một lần.
![](https://i.imgur.com/9IVQCht.png)
Nếu muốn in các giá trị trùng nhau nhiều lần, sử dụng UNION ALL Ví dụ:
SELECT City FROM Customers
UNION ALL
SELECT City FROM Suppliers
ORDER BY City;
![](https://i.imgur.com/900dXur.png)

# Một số hàm phổ biến.
## MIN(), MAX()
trả về giá trị nhỏ nhất và lớn nhất của cột được chọn. 
cú pháp: 
SELECT MIN(column_name)
FROM table_name
WHERE condition;

SELECT MAX(column_name)
FROM table_name
WHERE condition;

ví dụ: 
![](https://i.imgur.com/4NAybzK.png)
SELECT MIN(Price) AS SmallestPrice
FROM Products;

giá sản phẩm rẻ nhất sẽ là: 
![](https://i.imgur.com/wGtN3hO.png)

## COUNT(),AVG(), SUM()

COUNT() trả về số hàng phù hợp AVG() trả về giá trị trung bình của một cột có giá trị là số SUM() trả về tổng của một cột có giá trị là số Syntax:
cú pháp: 
SELECT COUNT(column_name)
FROM table_name
WHERE condition;

SELECT AVG(column_name)
FROM table_name
WHERE condition;

SELECT SUM(column_name)
FROM table_name
WHERE condition;